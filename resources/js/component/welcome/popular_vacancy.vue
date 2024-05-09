<template lang="">
    <vacancy_list :items="items" :auth="auth"></vacancy_list>
</template>
<script>
import vacancy_list from '../employer/components/list/VacancyList.vue';
export default {
    components:{
        vacancy_list
    },
    props:{
        items: Object,
        auth: Object
    },
    computed:{

    },
    created(){
    }
}
</script>
<style lang="">

</style>
