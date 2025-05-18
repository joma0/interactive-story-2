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
    <section v-if="currentStory" class="max-w-prose mx-auto mt-16">
        <h2
            class="text-3xl font-serif text-center mb-8 border-b border-gray-700 pb-4"
        >
            {{ currentStory.title }}
        </h2>
        <p v-if="chaptersLoading || choicesLoading">Chargement...</p>
        <p v-if="chaptersError">Erreur : {{ chaptersError.statusText }}</p>
        <p v-if="choicesError">Erreur : {{ choicesError.statusText }}</p>

        <div
            v-if="!chaptersLoading && !choicesLoading && choices.length"
            class="mt-8"
        >
            <p v-if="!currentChapter">Ce chapitre n'existe pas</p>
            <h3
                class="text-2xl font-serif text-center italic mb-24 text-gray-400"
            >
                Chapitre {{ currentChapter.number }}
            </h3>
            <p class="text-lg leading-relaxed mb-12">
                {{ currentChapter.text }}
            </p>

            <ul
                v-if="currentChapter.number !== 5"
                class="grid grid-cols-1 gap-6 mt-8"
            >
                <li
                    v-for="choice in choices"
                    :key="choice.id"
                    @click="selectChoice(choice.result_chapter_id)"
                    class="bg-gray-800 rounded-lg shadow-md p-6 hover:bg-gray-700 transition-colors cursor-pointer border border-gray-700"
                >
                    <p class="text-gray-300">{{ choice.text }}</p>
                </li>
            </ul>

            <p
                v-if="currentChapter.number === 5"
                class="text-center font-serif italic text-xl text-gray-400"
            >
                Fin de l'histoire
            </p>
        </div>
    </section>
</template>
