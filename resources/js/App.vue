<script setup>
import { ref } from "vue";
import TheHeader from "@/components/TheHeader.vue";
import PageMain from "@/pages/PageMain.vue";
const n = ref(1);
</script>

<template>
    <div>
        <TheHeader />
        <main>
            <PageMain />
        </main>
    </div>
</template>

<style scoped></style>
