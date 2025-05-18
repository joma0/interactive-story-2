<script setup>
import { defineEmits, defineProps } from "vue";

const props = defineProps({
    currentStory: Object,
    currentChapter: Object,
    chaptersLoading: Boolean,
    choicesLoading: Boolean,
    chaptersError: Object,
    choicesError: Object,
    choices: Array,
});

const emit = defineEmits(["selectChoice"]);

function selectChoice(nextChapterId) {
    emit("selectChoice", nextChapterId);
}
</script>

<template>
    <section v-if="currentStory">
        <h2>{{ currentStory.title }}</h2>
        <p v-if="chaptersLoading || choicesLoading">Chargement du livre</p>
        <p v-if="chaptersError">Erreur : {{ chaptersError.statusText }}</p>
        <p v-if="choicesError">Erreur : {{ choicesError.statusText }}</p>

        <div v-if="currentChapter && !choicesLoading && choices.length">
            <h3>Chapitre {{ currentChapter.number }}</h3>
            <p>{{ currentChapter.text }}</p>
            <ul v-if="currentChapter.number !== 5">
                <li
                    v-for="choice in choices"
                    :key="choice.id"
                    @click="selectChoice(choice.result_chapter_id)"
                >
                    {{ choice.text }}
                </li>
            </ul>
            <p v-if="currentChapter.number === 5">Fin de l'histoire</p>
        </div>
    </section>
</template>
