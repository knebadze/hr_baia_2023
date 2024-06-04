import { defineStore } from "pinia";
import { ref } from "vue";
import { getAdministrator } from "../../../../services/administrator";

export const useAdministratorStore = defineStore("administrator", () => {
    const administrators = ref([]);
    const cla = ref([]);
    const setAdministrators = (data) => {
        administrators.value = _.forEach(data, function (value) {
            if (value.is_active == 1) {
                value["switch"] = true;
            } else {
                value["switch"] = false;
            }
        });
    }
    const fetchAdministrator = async () => {
        try {
            const response = await getAdministrator();
            console.log("Administrator:", response.data);
            const { data } = response;
            setAdministrators(data.staff);
            cla.value = data.cla;
        } catch (error) {
            console.error("Error fetching Administrator:", error);
            throw error;
        }
    };
    return {
        administrators,
        cla,
        fetchAdministrator,
    };
});
