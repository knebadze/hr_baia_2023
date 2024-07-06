import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { getAdministrator } from "../../../../services/administrator";

export const useAdministratorStore = defineStore("administrator", () => {
    const administrators = ref([]);
    const cla = ref([]);
    const adminViewAndPermission = ref({});
    const setAdministrators = (data) => {
        administrators.value = _.forEach(data, function (value) {
            if (value.is_active == 1) {
                value["switch"] = true;
            } else {
                value["switch"] = false;
            }
        });
    };
    const fetchAdministrator = async () => {
        try {
            const response = await getAdministrator();
            const { data } = response;
            setAdministrators(data.staff);
            cla.value = data.cla;
            adminViewAndPermission.value = data.adminViewAndPermission;
        } catch (error) {
            console.error("Error fetching Administrator:", error);
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
        administrators,
        cla,
        fullView,
        fullPermission,
        adminId,
        fetchAdministrator,
    };
});
