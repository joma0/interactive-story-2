import { ref, onMounted, onUnmounted } from "vue";

export function useRouter() {
    const hash = ref(window.location.hash || "#all-stories");

    function updateHash() {
        hash.value = window.location.hash || "#all-stories";
    }

    onMounted(() => {
        window.addEventListener("hashchange", updateHash);
    });

    onUnmounted(() => {
        window.removeEventListener("hashchange", updateHash);
    });

    // Au chargement de la page
    updateHash();

    return { hash };
}
