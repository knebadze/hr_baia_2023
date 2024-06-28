import { defineStore } from "pinia";
import { ref } from "vue";
import { getHr } from "../../../../services/hr";
export const useHrStore = defineStore("hr", () => {
    const hr = ref([]);
    const cla = ref([]);
    const hasVacancyControl = ref([]);
    const setHrs = (data) => {
        hr.value = _.forEach(data, function (value) {
            if (value.is_active == 1) {
                value["switch"] = true;
            } else {
                value["switch"] = false;
            }
        });
    }
    const fetchHrs = async () => {
        try {
            const response = await getHr();
            const { data } = response;
            setHrs(data.staff);
            cla.value = data.cla;
            hasVacancyControl.value = data.hasVacancyControl;
        } catch (error) {
            console.error("Error fetching hr:", error);
            throw error;
        }
    };
    return {
        hr,
        cla,
        hasVacancyControl,
        fetchHrs,
    };
});
