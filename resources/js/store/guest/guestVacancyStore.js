import { defineStore } from "pinia";
import { ref, watch } from "vue";
import _ from "lodash";
export const useGuestVacancyStore = defineStore("guestVacancy", () => {
    const vacancies = ref([]);
    const staticVacancies = ref([]);
    const count = ref(0);
    const staticCount = ref(0);
    const pagination = ref({
        current_page: 1,
        last_page: 2,
    });
    const auth = ref(null);
    const cla = ref([]);
    const getDataType = ref("first_data");
    const filterItem = ref({
        category: [],
        schedule: [],
        word: null,
        location: null,
        time: null,
        payment: null,
    });

    //vacancy
    // const vacancyDetail = ref(null);

    //method
    const anyNonNull = (newValue) => {
        return _.some(newValue, (value) => {
            if (Array.isArray(value)) {
                return value.length > 0;
            }
            return value !== null;
        });
    };

    const setData = (data) => {
        console.log("data", data);
        const { total, vacancy, classificatory, authUser } = data;
        // Update the store's state
        vacancies.value = vacancy.data;
        staticVacancies.value = vacancy.data;
        count.value = total;
        staticCount.value = total;
        pagination.value = {
            current_page: vacancy.current_page,
            last_page: vacancy.last_page,
        };
        cla.value = classificatory;
        auth.value = authUser;
    };
    const fetchVacancy = async (page = 1) => {
        try {
            const response = await axios.get(`/fetch_vacancy?page=${page}`);
            const data = response.data;
            setData(data)
            console.log("data", data);
        } catch (error) {
            console.error("Error fetching Vacancies:", error);
            throw error; // Propagate the error to the caller
        }
    };

    const filterVacancy = async (page = 1, filterData) => {
        try {
            const response = await axios.post(
                `/vacancy_filter?page=${page}`,
                filterData
            );
            const data = response.data;
            console.log("data", data);
            const { total, vacancy } = data;
            // Update the store's state
            vacancies.value = vacancy.data;
            count.value = total;
            pagination.value = {
                current_page: vacancy.current_page,
                last_page: vacancy.last_page,
            };
        } catch (error) {
            console.error("Error filtering vacancies:", error);
            throw error; // Propagate the error to the caller
        }
    };
    const getData = async (page = 1) => {
        if (getDataType.value == "first_data") {
            await fetchVacancy(page);
        } else if (getDataType.value == "filter") {
            await filterVacancy(page, filterItem.value);
        }
    };

    const interested = (id, response) => {
        let find = _.find(vacancies.value, { id: id });
        find.vacancy_interest.push(response.data.qualifying);
    }

    // vacancy
    // const fetchVacancyDetail = async (id) => {}
    watch(
        filterItem,
        (newValue, oldValue) => {
            if (anyNonNull(newValue)) {
                console.log("filterItem changed:", newValue);
                getDataType.value = "filter";
                filterVacancy(1, newValue);
            } else {
                getDataType.value = "first_data";
                vacancies.value = staticVacancies.value;
                count.value = staticCount.value;
                pagination.value = {
                    current_page: 1,
                    last_page: 2,
                };
            }
        },
        { deep: true }
    );
    return {
        vacancies,
        staticVacancies,
        pagination,
        count,
        cla,
        auth,
        filterItem,
        fetchVacancy,
        filterVacancy,
        getData,
        setData,
        interested
    };
});
