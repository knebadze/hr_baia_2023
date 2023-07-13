<template lang="">
    <div v-for="(item, index) in arr" :key="index">
        <div>
            <h5>{{ index }}</h5>
            <hr>
        </div>
        <candidateTable :data="item" :vacancy="vacancy"></candidateTable>
    </div>
</template>
<script>
import candidateTable from '../component/candidateTable.vue';
export default {
    components:{
        candidateTable
    },
    props:{
        data: Object
    },
    data() {
        return {
            arr:{},
            vacancy:{}
        }
    },
    computed:{

    },
    created(){

        this.arr = this.groupedData(this.data.qualifying)
        this.vacancy.vacancy_id = this.data.vacancy.id
        this.vacancy.interview_date = this.data.vacancy.interview_date
        this.vacancy.interview_place = this.data.vacancy.interview_place
    },
    methods:{
        groupedData(data){
            const groupedData = data.reduce((result, obj) => {
                // Check if the ID already exists in the result object
                if (result[obj.qualifying_type_id]) {
                    // If the ID exists, push the current object into its corresponding array
                    result[obj.qualifying_type.name].push(obj.candidate);
                } else {
                    // If the ID doesn't exist, create a new array with the current object
                    result[obj.qualifying_type.name] =[obj.candidate];
                }
                return result;
            }, {});
            return  groupedData

        }
    },
    mounted() {
    },
}
</script>
<style lang="">

</style>
