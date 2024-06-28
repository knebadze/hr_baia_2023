import { defineStore } from "pinia";
import { reactive, ref } from "vue";
import { fetchUnfinishedRegistrations } from "../../services/administrator";
import { toastNotification } from "../../helper/toastNotification";
export const useUnfinishedRegistrationStore = defineStore(
    "unfinishedRegistration",
    () => {
        const unfinishedRegistration = ref([]);
        const pagination = ref({
            current_page: 1,
            last_page: 2,
        });
        const count = ref(0);
        const role_id = ref(null);
        const getDataType = ref("first_data");
        const cla = ref([]);
        const filterItem = reactive({
            author: null,
            assigned: null,
            status: null,
            candidate_name: null,
            candidate_number: null,
            date_from: null,
            date_to: null,
            all: null,
        });
        const fetchUnfinishedRegistrations = async (page) => {
            try {
                const response = await axios.post(
                    `/fetch_unfinished_registration?page=${page}`
                );
                const data = response.data;
                const { unfinishedRegistrations, total } = data;
                // Update the store's state
                unfinishedRegistration.value = unfinishedRegistrations.data;
                pagination.value = {
                    current_page: unfinishedRegistrations.current_page,
                    last_page: unfinishedRegistrations.last_page,
                };
                count.value = total;
                role_id.value = data.role_id;
                cla.value = data.classificatory;
            } catch (error) {
                console.error(
                    "Error fetching unfinished registrations:",
                    error
                );
                throw error; // Propagate the error to the caller
            }
        };

        const filterUnfinishedRegistrations = async (page, filterData) => {
            try {
                const response = await axios.post(
                    `/unfinished_registration_filter?page=${page}`,
                    filterData
                );
                const data = response.data;
                const { unfinishedRegistrations, total } = data;
                getDataType.value = "filter";
                // Update the store's state
                unfinishedRegistration.value = unfinishedRegistrations.data;
                pagination.value = {
                    current_page: unfinishedRegistrations.current_page,
                    last_page: unfinishedRegistrations.last_page,
                };
                count.value = total;
            } catch (error) {
                console.error(
                    "Error filtering unfinished registrations:",
                    error
                );
                throw error; // Propagate the error to the caller
            }
        };
        const completed = async (id) => {
            try {
                const response = await axios.post(`/completed_registration`, {
                    id,
                });
                const data = response.data;
                let findIndex = _.findIndex(unfinishedRegistration.value, [
                    "id",
                    id,
                ]);
                unfinishedRegistration.value.splice(findIndex, 1);
                toastNotification("წარმატებით შესრულდა", "success");
            } catch (error) {
                console.error("Error completing registration:", error);
                if (error.response.status == 403) {
                    toastNotification(
                        "თქვენ ჯერ არ დაგისრულებიათ კანდიდატის რეგისტრაცია",
                        "error"
                    );
                    // return;
                }
                throw error; // Propagate the error to the caller
            }
        };
        const getData = async (page = 1) => {
            if (getDataType.value == "first_data") {
                await fetchUnfinishedRegistrations(page);
            } else if (getDataType.value == "filter") {
                await filterUnfinishedRegistrations(page, filterItem);
            }
        };
        return {
            unfinishedRegistration,
            pagination,
            count,
            role_id,
            cla,
            filterItem,
            fetchUnfinishedRegistrations,
            filterUnfinishedRegistrations,
            getData,
            completed,
        };
    }
);
