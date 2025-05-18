<script setup>
import { ref, watch, computed, nextTick } from "vue";
import { useFetchJson } from "@/composables/useFetchJson";
import { useStoryReader } from "../composables/useStoryReader";
import { useRouter } from "../composables/useRouter";

//Router
const { hash } = useRouter();

// Charger les histoires
const {
    data: stories,
    error: storiesError,
    loading: storiesLoading,
} = useFetchJson({ url: "stories" });

// Lire une histoire
// Lecture d’histoire
const {
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
} = useStoryReader();
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
</template>

<style scoped></style>
