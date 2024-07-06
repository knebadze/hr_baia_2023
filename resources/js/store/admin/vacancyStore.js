import { defineStore, storeToRefs } from "pinia";
import { ref, computed } from "vue";
import { useLoadingStore } from "../loaderStore";
export const useVacancyStore = defineStore("vacancy", () => {
    const vacancies = ref([]);
    const staticVacancies = ref([]);
    const countVacancy = ref(0);
    const pagination = ref({
        current_page: 1,
        last_page: 2,
    });
    const loadingStore = useLoadingStore();
    const { loadingActive } = storeToRefs(loadingStore);
    const adminViewAndPermission = ref({});
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
            adminViewAndPermission.value = data.adminViewAndPermission;
        } catch (error) {
            console.error("Error fetching Vacancies:", error);
            loadingActive.value = false;
            throw error; // Propagate the error to the caller
        }
    };

    const filterVacancy = async (page = 1, filterData) => {
        try {
            const response = await axios.post(
                `/admin_vacancy_filter?page=${page}`,
                filterData
            );
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
            console.error("Error filtering vacancies:", error);
            throw error; // Propagate the error to the caller
        }
    };

    const updateHr = (id, new_hr) => {
        const index = vacancies.value.findIndex((vacancy) => vacancy.id == id);
        vacancies.value[index].hr = new_hr;
        vacancies.value[index].hr_id = new_hr.id;
    }

    const fullView = computed(() => {
        return adminViewAndPermission.value.view == "full";
    });

    const fullPermission = computed(() => {
        return adminViewAndPermission.value.permission == "full";
    });
    const fullFilter = computed(() => {
        return adminViewAndPermission.value.filter == "full";
    });
    const adminId = computed(() => {
        return adminViewAndPermission.value.admin_id;
    });
    return {
        vacancies,
        staticVacancies,
        pagination,
        countVacancy,
        loadingActive,
        fullPermission,
        adminId,
        fullView,
        fullFilter,
        fetchVacancy,
        filterVacancy,
        updateHr,
    };
});
