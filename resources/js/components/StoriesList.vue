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
    <section>
        <h2 class="text-green-600 text-2xl font-bold mb-4">
            Choisissez votre histoire
        </h2>
        <p v-if="loading">Chargement des histoires ...</p>
        <p v-if="error">Erreur : {{ error.statusText }}</p>
        <ul v-if="stories">
            <li
                v-for="story in stories"
                :key="story.id"
                @click="selectStory(story)"
            >
                {{ story.title }}
            </li>
        </ul>
    </section>
</template>
