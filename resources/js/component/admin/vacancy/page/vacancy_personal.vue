<template lang="">
    <div>
        <personal_table
            v-if="tableConfig.length > 0"
            v-for="(item, index) in tableConfig"
            :key="index"
            :items="item"
            :auth="auth"
        />
        <p v-else class="text-center">შერჩეული პერსონალი ვერ მოიძებნა!!!</p>
    </div>
</template>
<script>
import _ from "lodash";
import { ref, computed } from "vue";
import personal_table from "../component/personalTables/personal_table.vue";
export default {
    components: {
        personal_table,
    },
    props: {
        data: Object,
        auth: Object,
    },
    setup(props) {
        const items = ref(props.data);
        console.log(items.value);
        const tableConfig = computed(() => {
            let data = [];
            const employedData = _.filter(props.data, function (o) {
                return o.qualifying_type_id == 7 || o.qualifying_type_id == 8;
            });
            const employedObj = {
                type: "employed",
                title: "დასაქმებული კანდიდატი",
                header: [
                    "ID",
                    "ტიპი",
                    "სახელი გვარი",
                    "დაწყების დრო",
                    "დასრულების დრო",
                    "სტატუსი",
                    "მოქმედების თარიღი",
                    "მოქმედება",
                ],
                data: employedData,
            };
            employedData.length > 0 && data.push(employedObj);

            const trialData = _.filter(props.data, function (o) {
                return o.qualifying_type_id == 6;
            });
            const trialObj = {
                type: "trail",
                title: "გამოსაცდელი ვადით",
                header: [
                    "ID",
                    "სახელი გვარი",
                    "დაწყების დრო",
                    "დასრულების დრო",
                    "სტატუსი",
                    "მოქმედების თარიღი",
                    "მოქმედება",
                ],
                data: trialData,
            };
            trialData.length > 0 && data.push(trialObj);

            const approvedByEmployerData = _.filter(props.data, function (o) {
                return o.qualifying_type_id == 5;
            });
            const approvedObj = {
                type: "approved",
                title: "დამსაქმებლის მოწონებული",
                header: [
                    "ID",
                    "სახელი გვარი",
                    "დაწყების დრო",
                    "დასრულების დრო",
                    "სტატუსი",
                    "მოქმედების თარიღი",
                    "მოქმედება",
                ],
                data: approvedByEmployerData,
            };
            approvedByEmployerData.length > 0 && data.push(approvedObj);

            const interviewData = _.filter(props.data, function (o) {
                return o.qualifying_type_id == 4;
            });
            const interviewObj = {
                type: "interview",
                title: "გასაუბრებაზე ცხადდებიან",
                header: [
                    "ID",
                    "სახელი გვარი",
                    "გასაუბრების დრო",
                    "გასაუბრების ადგილი",
                    "სტატუსი",
                    "მოქმედების თარიღი",
                    "მოქმედება",
                ],
                data: interviewData,
            };
            interviewData.length > 0 && data.push(interviewObj);

            const noteData = _.filter(items.value, function (o) {
                return (
                    o.qualifying_type_id == 1 ||
                    o.qualifying_type_id == 2 ||
                    o.qualifying_type_id == 3
                );
            });
            const noteObj = {
                type: "note",
                title: "ჩანიშვნები",
                header: [
                    "ID",
                    "შემკვეთი",
                    "ტიპი",
                    "მოქმედების თარიღი",
                    "მოქმედება",
                ],
                data: noteData,
            };
            noteData.length > 0 && data.push(noteObj);

            return data;
        });

        return {
            tableConfig,
        };
    },
};
</script>
<style lang=""></style>
