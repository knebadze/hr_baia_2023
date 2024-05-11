import { defineStore } from "pinia";
import { ref, watch } from "vue";
import _ from "lodash";
export const useLoadingStore = defineStore("loading", () => {
    const loadingActive = ref(false);

    const setLoading = (status) => {
        loadingActive.value = status;
    }

    return {
        loadingActive,
        setLoading,
    };
});

