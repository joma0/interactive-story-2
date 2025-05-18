import { ref, watch } from "vue";
import { useFetchJson } from "@/composables/useFetchJson";
import { useSavedProgress } from "@/composables/useSavedProgress";

export function useStoryReader() {
    // Histoire et chapitre en cours de lecture
    const currentStory = ref(null);
    const currentChapter = ref(null);

    // Charger les chapitres d'une histoire
    const {
        data: chapters,
        error: chaptersError,
        loading: chaptersLoading,
        execute: fetchChapters,
    } = useFetchJson({ immediate: false });

    // Charger les choix d'un chapitre
    const {
        data: choices,
        error: choicesError,
        loading: choicesLoading,
        execute: fetchChoices,
    } = useFetchJson({ immediate: false });

    // Gérer la sauvegarde de progression
    const { saveProgress, resetProgress, getProgress } = useSavedProgress();

    // Sauvegarder la progression
    watch(
        [currentStory, chapters, currentChapter, choices],
        ([story, chapters, chapter, choices]) => {
            saveProgress(story, chapters, chapter, choices);
        }
    );

    // Restaurer la progression
    if (getProgress()) {
        const { savedStory, savedChapters, savedChapter, savedChoices } =
            getProgress();
        currentStory.value = savedStory;
        chapters.value = savedChapters;
        currentChapter.value = savedChapter;
        choices.value = savedChoices;
    }

    // Sélectionner une histoire :
    function readStory(story) {
        currentStory.value = story;
        window.location.hash = "#current-story";
        fetchChapters({ url: `stories/${story.id}/chapters` });

        // Attribuer le premier chapitre à currentChapter
        watch(
            chapters,
            (newData) => {
                if (newData && newData.length) {
                    const firstChapter = newData.find(
                        (chapter) => chapter.number === 1
                    );
                    if (firstChapter) currentChapter.value = firstChapter;
                }
            },
            { once: true }
        );
    }

    function nextChapter(nextChapterId) {
        if (!chapters.value) {
            console.warn("Chapitres non chargés !");
            return;
        }
        currentChapter.value = chapters.value.find(
            (chapter) => chapter.id === nextChapterId
        );
        console.log(currentChapter);
    }

    // Afficher les choix
    watch(currentChapter, (chapter) => {
        if (chapter && chapter.number != 5) {
            fetchChoices({ url: `chapters/${chapter.id}/choices` });
        }
    });

    return {
        currentStory,
        currentChapter,
        chapters,
        chaptersError,
        chaptersLoading,
        choices,
        choicesError,
        choicesLoading,
        readStory,
        nextChapter,
    };
}
