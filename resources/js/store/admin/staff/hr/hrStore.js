import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { getHr } from "../../../../services/hr";
export const useHrStore = defineStore("hr", () => {
    const hr = ref([]);
    const cla = ref([]);
    const hasVacancyControl = ref([]);
    const adminViewAndPermission = ref({});
    const setHrs = (data) => {
        hr.value = _.forEach(data, function (value) {
            if (value.is_active == 1) {
                value["switch"] = true;
            } else {
                value["switch"] = false;
            }
        });
    };
    const fetchHrs = async () => {
        try {
            const response = await getHr();
            console.log(response);
            const { data } = response;
            setHrs(data.staff);
            cla.value = data.cla;
            hasVacancyControl.value = data.hasVacancyControl;
            adminViewAndPermission.value = data.adminViewAndPermission;
        } catch (error) {
            console.error("Error fetching hr:", error);
            throw error;
        }
    };

    const fullView = computed(() => {
        return adminViewAndPermission.value.view == "full";
    });

    const fullPermission = computed(() => {
        return adminViewAndPermission.value.permission == "full";
    });
    const adminId = computed(() => {
        return adminViewAndPermission.value.admin_id;
    });
    return {
        hr,
        cla,
        hasVacancyControl,
        fullView,
        fullPermission,
        adminId,
        fetchHrs,
    };
});
