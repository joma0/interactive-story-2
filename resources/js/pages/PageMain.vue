<script setup>
import { useFetchJson } from "@/composables/useFetchJson";
import { useStoryReader } from "../composables/useStoryReader";
import { useRouter } from "../composables/useRouter";

import StoriesList from "../components/StoriesList.vue";
import CurrentStory from "../components/CurrentStory.vue";

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

function onSelectStory(story) {
    readStory(story);
}

function onSelectChoice(nextChapterId) {
    nextChapter(nextChapterId);
}
</script>

<template>
    <StoriesList
        v-if="hash === '#all-stories'"
        :stories="stories"
        :loading="storiesLoading"
        :error="storiesError"
        @selectStory="onSelectStory"
    />

    <CurrentStory
        v-if="hash === '#current-story' && currentStory"
        :currentStory="currentStory"
        :currentChapter="currentChapter"
        :chaptersLoading="chaptersLoading"
        :choicesLoading="choicesLoading"
        :chaptersError="chaptersError"
        :choicesError="choicesError"
        :choices="choices"
        @selectChoice="onSelectChoice"
    />
</template>

<style scoped></style>
