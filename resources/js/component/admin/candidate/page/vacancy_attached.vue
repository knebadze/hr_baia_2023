<template lang="">
    <div>

        <attached_tableVue v-if="tableConfig.length > 0" v-for="(item, index) in tableConfig" :key="index" :items="item" :auth="auth"/>
        <p v-else class="text-center">მიბმული ვაკანსია ვერ მოიძებნა!!!</p>

    </div>
</template>
<script>

import _ from 'lodash';
import { ref, computed } from 'vue'
import attached_tableVue from '../component/attached/attached_table.vue';
export default {
    components:{
        attached_tableVue
    },
    props:{
        data: Object,
        auth: Object
    },
    setup(props) {
        const items = ref(props.data)

        const tableConfig = computed(() => {
            let data = []
            const employedData = _.filter(props.data, function(o) {return  o.qualifying_type_id ==  6 || o.qualifying_type_id ==  7 });
            const employedObj = {
                type: 'employed',
                title:'დასაქმებული კანდიდატი',
                header: ['ID', 'შემკვეთი', 'კატეგორია', 'ვაკანსისი სტატუსი', 'დამატების თარიღი', 'დაწყების დრო', 'დასრულების დრო', 'სტატუსი', 'მოქმედება'],
                data: employedData
            };
            employedData.length > 0 && data.push(employedObj);

            const trialData = _.filter(props.data, function(o) {return  o.qualifying_type_id ==  5 });
            const trialObj = {
                type: 'trail',
                title:'გამოსაცდელი ვადით',
                header: ['ID', 'შემკვეთი', 'კატეგორია', 'ვაკანსისი სტატუსი', 'დამატების თარიღი', 'დაწყების დრო', 'დასრულების დრო', 'სტატუსი', 'მოქმედება'],
                data: trialData
            };
            trialData.length > 0 && data.push(trialObj);

            const interviewData = _.filter(props.data, function(o) {return  o.qualifying_type_id ==  4 });
            const interviewObj = {
                type: 'interview',
                title:'გასაუბრებაზე ცხადდებიან',
                header: ['ID', 'შემკვეთი', 'კატეგორია', 'ვაკანსისი სტატუსი', 'დამატების თარიღი', 'გასაუბრების დრო', 'გასაუბრების ადგილი', 'მოქმედება'],
                data: interviewData
            };
            interviewData.length > 0 && data.push(interviewObj);

            const noteData = _.filter(items.value, function(o) { return o.qualifying_type_id ==  1 || o.qualifying_type_id ==  2 || o.qualifying_type_id ==  3});
            const noteObj = {
                type: 'note',
                title:'ჩანიშვნები',
                header: ['ID', 'შემკვეთი', 'კატეგორია', 'ვაკანსისი სტატუსი', 'ტიპი', 'დამატების თარიღი', 'მოქმედება'],
                data: noteData
            };
            noteData.length > 0 && data.push(noteObj);

            return  data;
        })
        console.log(items.value);

        return {
            tableConfig
        }
    },
}
</script>
<style lang="">

</style>
