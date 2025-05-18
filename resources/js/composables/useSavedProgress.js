import { ref, watch } from "vue";
import { getItem, setItem, removeItem } from "@/utils/jsonStorage";

export function useSavedProgress() {
    const STORAGE_KEY = "story-in-progress";

    function saveProgress(story, chapters, chapter, choices) {
        if (story && chapter && chapters?.length) {
            const data = {
                savedStory: story,
                savedStoryChapters: chapters,
                savedChapter: chapter,
                savedChoices: choices,
            };
            setItem(STORAGE_KEY, data);
        }
    }

    function resetProgress() {
        removeItem(STORAGE_KEY);
        return true;
    }

    function getProgress() {
        return getItem(STORAGE_KEY);
    }

    return {
        saveProgress,
        resetProgress,
        getProgress,
    };
}
