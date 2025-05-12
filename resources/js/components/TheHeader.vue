<script setup>
const goToLogin = () => {
    window.location.href = "/login";
};
const goToRegister = () => {
    window.location.href = "/register";
};
const goToProfile = () => {
    window.location.href = "/user";
};
</script>

<template>
    <header class="flex justify-between items-center p-4 bg-white shadow">
        <h1 class="text-xl font-bold">Header</h1>
        <button
            @click="goToLogin"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
        >
            Se connecter
        </button>
        <button
            @click="goToRegister"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
        >
            S'inscrire
        </button>
        <button
            @click="goToProfile"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
        >
            Profil
        </button>
    </header>
</template>

<style scoped></style>
