<template lang="">
    <vacancy_list v-for="(item, index) in items" :key="index" :item="item" :auth="auth"></vacancy_list>
</template>
<script setup>
import vacancy_list from '../employer/components/list/VacancyList.vue';

const props = defineProps({
    items: Object,
    auth: Object
});
</script>
<style lang="">

</style>
