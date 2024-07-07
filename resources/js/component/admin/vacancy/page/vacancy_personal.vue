<template lang="">
    <div>
        <personal_table
            v-if="tableConfig.length > 0"
            v-for="(item, index) in tableConfig"
            :key="index"
            :items="item"
            :auth="auth"
            :adminViewAndPermission="adminViewAndPermission"
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
        const items = ref(props.data.store);
        const adminViewAndPermission = ref(props.data.adminViewAndPermission);
        
        const tableConfig = computed(() => {
            const config = [
                {
                    typeIds: [7, 8],
                    type: "employed",
                    title: "დასაქმებული კანდიდატი",
                    headers: [
                        "ID",
                        "ტიპი",
                        "სახელი გვარი",
                        "დაწყების დრო",
                        "დასრულების დრო",
                        "სტატუსი",
                        "მოქმედების თარიღი",
                        "მოქმედება",
                    ],
                },
                {
                    typeIds: [6],
                    type: "trail",
                    title: "გამოსაცდელი ვადით",
                    headers: [
                        "ID",
                        "სახელი გვარი",
                        "დაწყების დრო",
                        "დასრულების დრო",
                        "სტატუსი",
                        "მოქმედების თარიღი",
                        "მოქმედება",
                    ],
                },
                {
                    typeIds: [5],
                    type: "approved",
                    title: "დამსაქმებლის მოწონებული",
                    headers: [
                        "ID",
                        "სახელი გვარი",
                        "დაწყების დრო",
                        "დასრულების დრო",
                        "სტატუსი",
                        "მოქმედების თარიღი",
                        "მოქმედება",
                    ],
                },
                {
                    typeIds: [4],
                    type: "interview",
                    title: "გასაუბრებაზე ცხადდებიან",
                    headers: [
                        "ID",
                        "სახელი გვარი",
                        "გასაუბრების დრო",
                        "გასაუბრების ადგილი",
                        "სტატუსი",
                        "მოქმედების თარიღი",
                        "მოქმედება",
                    ],
                },
                {
                    typeIds: [1, 2, 3],
                    type: "note",
                    title: "ჩანიშვნები",
                    headers: [
                        "ID",
                        "შემკვეთი",
                        "ტიპი",
                        "მოქმედების თარიღი",
                        "მოქმედება",
                    ],
                },
            ];

            let data = config
                .map(({ typeIds, type, title, headers }) => {
                    const filteredData = _.filter(props.data.store, (o) =>
                        typeIds.includes(o.qualifying_type_id)
                    );
                    return filteredData.length > 0
                        ? { type, title, header: headers, data: filteredData }
                        : null;
                })
                .filter((obj) => obj !== null);

            return data;
        });

        return {
            tableConfig,
            adminViewAndPermission,
        };
    },
};
</script>
<style lang=""></style>
