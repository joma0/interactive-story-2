<script setup>
import { ref, watch, computed, nextTick } from "vue";
import { useFetchJson } from "@/composables/useFetchJson";
import { setItem, getItem } from "../utils/jsonStorage";

//Router
const hash = ref(window.location.hash || "#all-stories");

function router() {
    hash.value = window.location.hash || "#all-stories";
}

// Ajouter un event listener au changement de hash dans l'url
window.addEventListener("hashchange", router);

// Appeler une première fois render directement au chargement de la page
router();

// Reprendre la progression
const savedProgress = ref(getItem("story-in-progress"));
const showResumePrompt = ref(!!savedProgress.value);

function backToInProgress() {
    if (!savedProgress.value) return;

    const { savedStory, savedChapter, savedStoryChapters, savedChoices } =
        savedProgress.value;

    currentStory.value = savedStory;
    currentChapter.value = savedChapter;
    chapters.value = savedStoryChapters;
    choices.value = savedChoices;

    window.location.hash = "#current-story";
    showResumePrompt.value = false;
}

function resetProgress() {
    localStorage.removeItem("story-in-progress");
    savedProgress.value = null;
    window.location.hash = "#all-stories";
    showResumePrompt.value = false;
}

// Histoire et chapitre en cours de lecture
const currentStory = ref(null);
const currentChapter = ref(null);

// Charger les histoires
const {
    data: stories,
    error: storiesError,
    loading: storiesLoading,
} = useFetchJson({ url: "stories" });

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
    currentChapter.value = chapters.value.find(
        (chapter) => chapter.id === nextChapterId
    );
    console.log(currentChapter);
}

// Afficher les choix
watch(currentChapter, (chapter) => {
    if (chapter && chapter.number != 5) {
        const localChoices = savedProgress.value?.choices?.[chapter.id];
        if (localChoices) {
            choices.value = localChoices;
        } else {
            fetchChoices({ url: `chapters/${chapter.id}/choices` });
        }
    }
});

// Sauvegarder la progression
watch(
    [currentStory, currentChapter, chapters, choices],
    ([story, chapter, chapters, choices]) => {
        if (story && chapter && chapters?.length) {
            const data = {
                savedStory: story,
                savedChapter: chapter,
                savedStoryChapters: chapters,
                savedChoices: choices,
            };
            setItem("story-in-progress", data);
        }
    }
);
</script>

<template>
    <section id="all-stories" v-if="hash === '#all-stories'">
        <h2 class="text-green-600 text-2xl font-bold mb-4">
            Choisissez votre histoire
        </h2>
        <p v-if="storiesLoading">Chargement des histoires ...</p>
        <p v-if="storiesError">Erreur : {{ storiesError.statusText }}</p>
        <ul v-if="stories">
            <li
                v-for="story in stories"
                :key="story.id"
                @click="readStory(story)"
            >
                {{ story.title }}
            </li>
        </ul>
    </section>
    <section
        id="current-story"
        v-if="hash === '#current-story' && currentStory"
    >
        <h2>{{ currentStory?.title }}</h2>
        <p v-if="chaptersLoading || choicesLoading">Chargement du livre</p>
        <p v-if="chaptersError">Erreur : {{ chaptersError.statusText }}</p>
        <p v-if="choicesError">Erreur : {{ choicesError.statusText }}</p>

        <div v-if="currentChapter && !choicesLoading && choices.length">
            <h3 v-if="currentChapter">Chapitre {{ currentChapter.number }}</h3>
            <p v-if="currentChapter">{{ currentChapter.text }}</p>
            <ul v-if="currentChapter.number != 5">
                <li
                    v-for="choice in choices"
                    :key="choice.id"
                    @click="nextChapter(choice.result_chapter_id)"
                >
                    {{ choice.text }}
                </li>
            </ul>
            <p v-if="currentChapter.number === 5">Fin de l'histoire</p>
        </div>
    </section>

    <section v-if="showResumePrompt">
        <h2>Souhaitez-vous reprendre votre lecture ?</h2>
        <button @click="backToInProgress">Reprendre l'histoire</button>
        <button @click="resetProgress">Recommencer une histoire</button>
    </section>
</template>

<style scoped></style>
