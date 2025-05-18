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
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-prose mx-auto">
            <div v-if="hash === '#all-stories'">
                <p class="text-base md:text-lg leading-relaxed mb-8">
                    Tu ouvres lentement les yeux. Autour de toi, le silence est
                    total, lourd, comme suspendu. Tu ne sais pas où tu es. Tu ne
                    te souviens pas comment tu es arrivé là. Tout ce dont tu es
                    sûr, c’est qu’on te poursuit. Une présence obscure,
                    insaisissable, une menace qui t’a forcé à fuir, à t’échapper
                    par un chemin que tu ne comprends pas encore. Tu ne sais pas
                    qui c’est, ni pourquoi elle te veut. Mais tu sens leur
                    souffle glacé sur ta nuque, même s’ils ne sont pas là. Tu as
                    dû disparaître, te cacher, t’enfoncer dans ce lieu inconnu…
                    Maintenant, tu es seul. Perdu. Ton seul espoir est de
                    comprendre cet endroit étrange qui t’entoure, et de trouver
                    un moyen de t’échapper avant que l’ombre ne te rattrape. Le
                    mystère commence maintenant.
                </p>

                <h2
                    class="text-2xl md:text-3xl font-serif text-center mb-8 pb-4 border-b border-gray-700"
                >
                    Quel scénario t'inspire le plus ?
                </h2>

                <StoriesList
                    :stories="stories"
                    :loading="storiesLoading"
                    :error="storiesError"
                    @selectStory="onSelectStory"
                />
            </div>

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
        </div>
    </div>
</template>

<style scoped></style>
