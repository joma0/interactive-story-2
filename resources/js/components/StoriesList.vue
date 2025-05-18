<script setup>
import { defineEmits, defineProps } from "vue";

const props = defineProps({
    stories: Array,
    loading: Boolean,
    error: Object,
});

const emit = defineEmits(["selectStory"]);

function selectStory(story) {
    emit("selectStory", story);
}
</script>

<template>
    <section class="w-full">
        <p v-if="loading" class="text-center text-gray-600">
            Chargement des histoires ...
        </p>
        <p v-if="error" class="text-center text-red-600">
            Erreur : {{ error.statusText }}
        </p>

        <ul
            v-if="stories"
            class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6"
        >
            <li
                v-for="story in stories"
                :key="story.id"
                @click="selectStory(story)"
                class="bg-gray-800 rounded-lg shadow-md p-6 hover:bg-gray-700 transition-colors cursor-pointer border border-gray-700"
            >
                <h3 class="text-xl font-semibold mb-2 text-white">
                    {{ story.title }}
                </h3>
                <p class="text-gray-300">{{ story.description }}</p>
            </li>
        </ul>
    </section>
</template>
