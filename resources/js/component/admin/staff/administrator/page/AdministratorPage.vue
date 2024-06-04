<script setup>
import { onMounted } from "vue";
import StaffTable from "../../component/StaffTable.vue";
// import AdministratorTable from "../component/AdministratorTable.vue";
import { useAdministratorStore } from "../../../../../store/admin/staff/administrator/administratorStore";
import { storeToRefs } from "pinia";

const administratorStore = useAdministratorStore();
const { administrators, cla } = storeToRefs(administratorStore);
const { fetchAdministrator } = administratorStore;
const handlerIsActive = (item, index) => {
    administrators.value[index].is_active = item
};
onMounted(async () => {
    await fetchAdministrator()
});
</script>
<template>
<div>
    <StaffTable :data="administrators" :cla="cla"  @is_active="handlerIsActive" :role="4"/>
    <!-- <has_vacancy_control :items="data.hasVacancyControl"/> -->
</div>
</template>
