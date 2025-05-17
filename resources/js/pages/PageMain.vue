<script setup>
import { ref, watch, computed, nextTick } from "vue";
import { useFetchJson } from "@/composables/useFetchJson";

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
    fetchChapters({ url: `stories/${story.id}/chapters` });
}

function nextChapter(nextChapterId) {
    currentChapter.value = chapters.value.find(
        (chapter) => chapter.id === nextChapterId
    );
    console.log(currentChapter);
}

// Mettre à jour currentChapter
watch(chapters, (newData) => {
    if (newData && newData.length) {
        const firstChapter = newData.find((chapter) => chapter.number === 1);
        if (firstChapter) currentChapter.value = firstChapter;
    }
});

// Afficher les choix
watch(currentChapter, (chapter) => {
    if (chapter && chapter.number != 5) {
        fetchChoices({ url: `chapters/${chapter.id}/choices` });
    }
});
</script>

<template>
    <section id="all-stories">
        <h2>Choisissez votre histoire</h2>
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
    <section id="current-story">
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
</template>

<style scoped></style>
