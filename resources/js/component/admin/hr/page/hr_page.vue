<template lang="">
    <div>
        <hr_table :data="data.hr"/>
        <has_vacancy_control :items="data.hasVacancyControl"/>
    </div>
</template>
<script>
import hr_table from '../component/hr_table.vue';
import has_vacancy_control from '../component/has_vacancy_control.vue';
export default {
    components:{
        hr_table,
        has_vacancy_control
    },
    props:{
        data:Object
    },
    setup(props) {

    }
}
</script>
<style lang="">

</style>
