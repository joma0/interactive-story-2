<script setup>
import { ref } from "vue";
import { BookOpenIcon, XCircleIcon } from "@heroicons/vue/24/outline";

import { useFetchJson } from "@/composables/useFetchJson";
import { useStoryReader } from "../composables/useStoryReader";
import { useRouter } from "../composables/useRouter";
import { useSavedProgress } from "../composables/useSavedProgress";

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

// Vérifier si une progression est sauvegardée dans le local storage
const hasSavedProgress = ref(false);
const { resetProgress, getProgress } = useSavedProgress();
if (getProgress()) {
    hasSavedProgress.value = true;
}

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

// Reprendre l'histoire
function resumeStory() {
    if (hasSavedProgress) {
        window.location.hash = "#current-story";
    }
}

// Fonction pour abandonner l'histoire
function abandonStory() {
    resetProgress();
    hasSavedProgress.value = false;
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

                <div
                    v-if="hasSavedProgress"
                    class="bg-gray-800 rounded-lg p-6 mb-8 border-l-4 border-blue-500 shadow-lg"
                >
                    <p class="text-lg mb-4 text-center">
                        Vous avez quitté sans terminer votre histoire. Que
                        souhaitez-vous faire ?
                    </p>
                    <div class="flex justify-center gap-4">
                        <button
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md"
                            @click="resumeStory"
                        >
                            <BookOpenIcon class="h-5 w-5 mr-2" />
                            Reprendre l'histoire
                        </button>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors shadow-md"
                            @click="abandonStory"
                        >
                            <XCircleIcon class="h-5 w-5 mr-2" />
                            Abandonner l'histoire
                        </button>
                    </div>
                </div>

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
