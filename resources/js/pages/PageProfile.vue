<script setup>
import { ref, onMounted } from "vue";
import TheHeader from "../components/TheHeader.vue";

const user = ref(null);
const showEditForm = ref(false);
const showDeleteForm = ref(false);
const errors = ref([]);
const successMessage = ref("");

// Charger les données de l'utilisateur
onMounted(async () => {
    try {
        const response = await fetch("/api/user");
        user.value = await response.json();
    } catch (error) {
        console.error("Erreur lors du chargement du profil:", error);
    }
});

// Mettre à jour le profil
const updateProfile = async (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);

    try {
        const response = await fetch("/api/user", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(Object.fromEntries(formData)),
        });

        if (response.ok) {
            successMessage.value = "Profil mis à jour avec succès";
            user.value = await response.json();
        } else {
            const data = await response.json();
            errors.value = Object.values(data.errors).flat();
        }
    } catch (error) {
        console.error("Erreur lors de la mise à jour:", error);
    }
};

// Supprimer le compte
const deleteAccount = async (event) => {
    event.preventDefault();
    if (!confirm("Êtes-vous sûr de vouloir supprimer votre compte ?")) return;

    try {
        await fetch("/api/user", {
            method: "DELETE",
        });
        window.location.href = "/";
    } catch (error) {
        console.error("Erreur lors de la suppression:", error);
    }
};

// Se déconnecter
const logout = async () => {
    try {
        await fetch("/logout", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        });
        window.location.href = "/";
    } catch (error) {
        console.error("Erreur lors de la déconnexion:", error);
    }
};
</script>

<template>
    <div class="min-h-screen bg-gray-900">
        <TheHeader />

        <main class="container mx-auto px-4 py-8">
            <div
                v-if="user"
                class="max-w-2xl mx-auto bg-gray-800 rounded-lg shadow-xl p-6"
            >
                <h1 class="text-2xl font-bold mb-6 text-white">
                    Bienvenue, {{ user.name }} !
                </h1>

                <!-- Messages de succès et erreurs -->
                <div
                    v-if="successMessage"
                    class="bg-green-600 text-white p-4 rounded mb-4"
                >
                    {{ successMessage }}
                </div>
                <div
                    v-if="errors.length"
                    class="bg-red-600 text-white p-4 rounded mb-4"
                >
                    <ul>
                        <li v-for="error in errors" :key="error">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <!-- Informations utilisateur -->
                <div class="mb-8 text-gray-300">
                    <p class="mb-2">Nom : {{ user.name }}</p>
                    <p>Email : {{ user.email }}</p>
                </div>

                <!-- Formulaire de modification -->
                <section class="mb-8">
                    <button
                        @click="showEditForm = !showEditForm"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    >
                        Modifier mes informations
                    </button>

                    <form
                        v-if="showEditForm"
                        @submit="updateProfile"
                        class="mt-4 space-y-4"
                    >
                        <div>
                            <label for="name" class="block text-gray-300 mb-1"
                                >Nom :</label
                            >
                            <input
                                type="text"
                                id="name"
                                name="name"
                                :value="user.name"
                                required
                                class="w-full px-3 py-2 bg-gray-700 text-white rounded"
                            />
                        </div>

                        <div>
                            <label for="email" class="block text-gray-300 mb-1"
                                >Email :</label
                            >
                            <input
                                type="email"
                                id="email"
                                name="email"
                                :value="user.email"
                                required
                                class="w-full px-3 py-2 bg-gray-700 text-white rounded"
                            />
                        </div>

                        <div>
                            <label
                                for="password"
                                class="block text-gray-300 mb-1"
                            >
                                Nouveau mot de passe :
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full px-3 py-2 bg-gray-700 text-white rounded"
                            />
                            <small class="text-gray-400">
                                Si vous ne voulez pas changer votre mot de
                                passe, laissez ce champ vide.
                            </small>
                        </div>

                        <button
                            type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                        >
                            Mettre à jour
                        </button>
                    </form>
                </section>

                <!-- Section suppression compte -->
                <section class="mb-8">
                    <button
                        @click="showDeleteForm = !showDeleteForm"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                    >
                        Supprimer mon compte
                    </button>

                    <form
                        v-if="showDeleteForm"
                        @submit="deleteAccount"
                        class="mt-4"
                    >
                        <p class="text-gray-300 mb-4">
                            Êtes-vous bien sûr de vouloir supprimer votre compte
                            ? Cette suppression est définitive.
                        </p>
                        <label class="flex items-center text-gray-300">
                            <input type="checkbox" required class="mr-2" />
                            Je confirme la suppression de mon compte.
                        </label>
                        <button
                            type="submit"
                            class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                        >
                            Supprimer définitivement
                        </button>
                    </form>
                </section>

                <!-- Bouton déconnexion -->
                <button
                    @click="logout"
                    class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700"
                >
                    Se déconnecter
                </button>
            </div>
        </main>
    </div>
</template>
