import { defineStore, storeToRefs } from "pinia";
import { ref, reactive, watch } from "vue";
import { useLoadingStore } from "../../loaderStore";
import { useVacancyStore } from '../vacancyStore';
import _, { min } from "lodash";
import moment from "moment";

export const useChangeVacancyStatusStore = defineStore("VacancyStatus", () => {
    const vacancy = ref({});
    const responseData = ref({});
    const cla = ref([]);
    const history = ref([]);
    const maxDate = ref(null);
    const minData = ref(null);
    const reasonForCancel = ref(null);
    const currentDate = moment();
    const loadingStore = useLoadingStore();
    const { setLoading } = loadingStore;
    const getInfo = async () => {
        try {
            const response = await axios.post("/get_status_change_info", {
                data: vacancy.value.id,
            });
            responseData.value = response.data;
            history.value = responseData.value.history;
            maxDate.value = getMaxDate(vacancy.value);
            minData.value = currentDate.format("YYYY-MM-DD HH:mm");
            cla.value = makeCla(
                vacancy.value.status.id,
                responseData.value.status
            );
            reasonForCancel.value = responseData.value.reasonForCancel.filter(
                (o) => o.id != 33 && o.id != 34
            );
        } catch (error) {
            console.log(error);
        }
    };

    const setVacancy = (data) => {
        vacancy.value = data;
    };

    const makeCla = (id, claStatus) => {
        let status = [];
        const excludeMap = {
            1: [3],
            2: [2],
            3: [2, 3, 5, 6, 7],
            6: [3],
            7: [3],
        };

        if (_.has(excludeMap, id)) {
            status = claStatus.filter(
                (item) => !_.includes(excludeMap[id], item.id)
            );
        }

        return status;
    };
    const getMaxDate = (item) => {
        return moment(item.start_date)
            .subtract(1, "weeks")
            .format("YYYY-MM-DD HH:mm");
    };

    const changeStatus = (data) => {
        const vacancyStore = useVacancyStore();
        const { vacancies } = storeToRefs(vacancyStore);
        const index = _.findIndex(vacancies.value, (o) => o.id == data.id);
        const changeVacancy = vacancies.value[index];
        changeVacancy.status = data.status;
        changeVacancy.status_change_reason = data.status_change_reason;
        changeVacancy.reason_for_cancel = data.reason_for_cancel;
    };
    return {
        vacancy,
        cla,
        history,
        maxDate,
        minData,
        reasonForCancel,
        setVacancy,
        getInfo,
        changeStatus,
    };
});
