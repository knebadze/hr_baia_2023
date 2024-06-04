<script setup>
import { onMounted } from "vue";
import StaffTable from "../../component/StaffTable.vue";
import has_vacancy_control from "../component/has_vacancy_control.vue";
import { useHrStore } from "../../../../../store/admin/staff/hr/hrStore";
import { storeToRefs } from "pinia";

const hrStore = useHrStore();
const { hr, cla, hasVacancyControl } = storeToRefs(hrStore);
const { fetchHrs } = hrStore;
const handlerIsActive = (item, index) => {
    hr.value[index].is_active = item
};
onMounted(async () => {
    await fetchHrs()
});
</script>
<template>
<div>
    <StaffTable :data="hr" :cla="cla"  @is_active="handlerIsActive" :role="2"/>
    <has_vacancy_control :items="hasVacancyControl" v-if="hasVacancyControl.length > 0"/>
</div>
</template>
