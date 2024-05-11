import { defineStore, storeToRefs } from 'pinia';
import { ref } from 'vue';
import { useLoadingStore } from '../loaderStore';
export const useVacancyStore = defineStore('vacancy', () => {
    const vacancies = ref([]);
    const staticVacancies = ref([]);
    const countVacancy = ref(0);
    const pagination = ref({
        current_page: 1,
        last_page: 2,
    });
    const loadingStore = useLoadingStore();
    const { loadingActive } = storeToRefs(loadingStore);
    const fetchVacancy = async (page = 1) => {
        try {
            loadingActive.value = true;
            const response = await axios.get(`/get_vacancy?page=${page}`);
            const data = response.data;
            const { count, vacancy } = data;
            // Update the store's state
            vacancies.value = vacancy.data;
            staticVacancies.value = vacancy.data;
            countVacancy.value = count;
            pagination.value = {
                current_page: vacancy.current_page,
                last_page: vacancy.last_page,
            };
            loadingActive.value = false;
        } catch (error) {
            console.error('Error fetching Vacancies:', error);
            loadingActive.value = false;
            throw error; // Propagate the error to the caller
        }
    }

    const filterVacancy = async (page = 1, filterData) => {
        try {
            const response = await axios.post(`/admin_vacancy_filter?page=${page}`, filterData);
            const data = response.data;
            const { count, vacancy } = data;
            // Update the store's state
            vacancies.value = vacancy.data;
            countVacancy.value = count;
            pagination.value = {
                current_page: vacancy.current_page,
                last_page: vacancy.last_page,
            };
        } catch (error) {
            console.error('Error filtering vacancies:', error);
            throw error; // Propagate the error to the caller
        }
    }
    return {
        vacancies,
        staticVacancies,
        pagination,
        countVacancy,
        loadingActive,
        fetchVacancy,
        filterVacancy
    }
});
