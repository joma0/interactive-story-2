<script setup>
import { ref, onMounted } from "vue";
import { HomeIcon, UserIcon } from "@heroicons/vue/24/outline";

const isAuthenticated = ref(false);

// Fonction pour vérifier l'état de connexion
const checkAuth = async () => {
    try {
        const response = await fetch("check-auth");
        const data = await response.json();
        isAuthenticated.value = data.authenticated;
    } catch (error) {
        console.error(
            "Erreur lors de la vérification de l'authentification:",
            error
        );
    }
};

// Vérifier l'état de connexion au chargement du composant
onMounted(() => {
    checkAuth();
});

const goToLogin = () => {
    window.location.href = "/login";
};

const goToProfile = () => {
    window.location.href = "/user";
};

const goToHome = () => {
    window.location.href = "/";
};
</script>

<template>
    <header class="flex justify-between items-center p-4 bg-gray-800">
        <h1 class="text-xl font-bold text-white">Interactive Story</h1>

        <div class="flex gap-4">
            <button
                @click="goToHome"
                class="inline-flex items-center px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors"
            >
                <HomeIcon class="h-5 w-5 mr-2" />
                Accueil
            </button>

            <button
                v-if="!isAuthenticated"
                @click="goToLogin"
                class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
            >
                <UserIcon class="h-5 w-5 mr-2" />
                Se connecter
            </button>

            <button
                v-else
                @click="goToProfile"
                class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
            >
                <UserIcon class="h-5 w-5 mr-2" />
                Profil
            </button>
        </div>
    </header>
</template>

<style scoped></style>
