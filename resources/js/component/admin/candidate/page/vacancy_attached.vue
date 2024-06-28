<template lang="">
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">მიბმული ვაკანსიები</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6 class="m-0">
                            კანდიდატი: {{ candidate.user.name_ka }}
                            <p>
                                ID:
                                <u
                                    class="text-primary"
                                    @click="
                                        openCandidateFullInfoModal(candidate.id)
                                    "
                                    >{{ candidate.id }}</u
                                >
                            </p>
                        </h6>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <hr />
        </div>
        <section class="content">
            <div class="container-fluid">
                <attached_tableVue
                    v-if="tableConfig.length > 0"
                    v-for="(item, index) in tableConfig"
                    :key="index"
                    :items="item"
                    :auth="auth"
                />
                <p v-else class="text-center">
                    მიბმული ვაკანსია ვერ მოიძებნა!!!
                </p>
            </div>
        </section>
        <candidateFullInfoModalVue
            :visible="candidateFullInfoModalShow"
            :candidate_id="candidate_id"
        ></candidateFullInfoModalVue>
    </div>
</template>
<script>
import _ from "lodash";
import { ref, computed } from "vue";
import attached_tableVue from "../component/attached/attached_table.vue";
import candidateFullInfoModalVue from "../modal/candidateFullInfoModal.vue";
export default {
    components: {
        attached_tableVue,
        candidateFullInfoModalVue,
    },
    props: {
        data: Object,
        auth: Object,
        candidate: Object,
    },
    setup(props) {
        const items = ref(props.data);

        const tableConfig = computed(() => {
            let data = [];
            const employedData = _.filter(props.data, function (o) {
                return o.qualifying_type_id == 8 || o.qualifying_type_id == 8;
            });
            const employedObj = {
                type: "employed",
                title: "დასაქმებული კანდიდატი",
                header: [
                    "ID",
                    "შემკვეთი",
                    "კატეგორია",
                    "ვაკანსიის სტატუსი",
                    "დამატების თარიღი",
                    "დაწყების დრო",
                    "დასრულების დრო",
                    "სტატუსი",
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
                    "შემკვეთი",
                    "კატეგორია",
                    "ვაკანსიის სტატუსი",
                    "დამატების თარიღი",
                    "დაწყების დრო",
                    "დასრულების დრო",
                    "სტატუსი",
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
                    "შემკვეთი",
                    "კატეგორია",
                    "ვაკანსიის სტატუსი",
                    "დამატების თარიღი",
                    "გასაუბრების დრო",
                    "გასაუბრების ადგილი",
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
                    "კატეგორია",
                    "ვაკანსიის სტატუსი",
                    "ტიპი",
                    "დამატების თარიღი",
                    "მოქმედება",
                ],
                data: noteData,
            };
            noteData.length > 0 && data.push(noteObj);

            return data;
        });
        const candidateFullInfoModalShow = ref(false);
        const candidate_id = ref(null);

        const openCandidateFullInfoModal = (id) => {
            candidateFullInfoModalShow.value =
                !candidateFullInfoModalShow.value;
            candidate_id.value = id;
        };

        return {
            tableConfig,
            openCandidateFullInfoModal,
            candidateFullInfoModalShow,
            candidate_id,
        };
    },
};
</script>
<style lang=""></style>
