<template lang="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ items.title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table twm-table table-striped table-border">
                <thead>
                    <tr>
                        <th v-for="(item, index) in items.header" :key="index">
                            {{ item }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="index">
                        <td>
                            <u
                                class="text-primary"
                                @click="
                                    openVacancyFullInfoModal(item.vacancy_id)
                                "
                                >{{ item.code }}</u
                            >
                        </td>
                        <td>{{ item.employer_name }}</td>
                        <td>{{ item.category_name }}</td>
                        <td>
                            <span
                                :class="`badge bg-${item.vacancy_status_color} p-1`"
                                >{{ item.vacancy_status_name }}</span
                            >
                        </td>
                        <td v-if="type == 'note'">
                            {{ item.qualifying_type }}
                        </td>
                        <td>{{ item.created_at }}</td>
                        <td
                            v-if="
                                type == 'employed' ||
                                type == 'trail' ||
                                type == 'approved'
                            "
                        >
                            {{ item.start_date }}
                        </td>
                        <td
                            v-if="
                                type == 'employed' ||
                                type == 'trail' ||
                                type == 'approved'
                            "
                        >
                            {{ item.end_date }}
                        </td>
                        <td
                            v-if="
                                type == 'employed' ||
                                type == 'trail' ||
                                type == 'approved' ||
                                type == 'interview'
                            "
                            :class="
                                item.end_work_reason_id ? 'text-primary' : ''
                            "
                            @click="openEndWorkInfoModal(item)"
                        >
                            <span
                                :class="`badge bg-${item.status_color} p-1`"
                                >{{ item.status }}</span
                            >
                        </td>
                        <td v-if="type == 'interview'">
                            {{ item.interview_date }}
                        </td>
                        <td v-if="type == 'interview'">
                            {{ item.interview_place }}
                        </td>
                        <td >
                            <table_cog :item="item" :auth="auth" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <vacancyFullInfoModal
        :visible="vacancyFullInfoModalShow"
        :vacancyId="vacancy_id"
    ></vacancyFullInfoModal>
    <end_work_info :visible="showEndWorkInfoModal" :item="modalItem" />
</template>
<script>
import { ref } from "vue";
import moment from "moment";
// import table_cog from './table_cog.vue';
import table_cog from "../../../vacancy/component/personalTables/table_cog.vue";
import vacancyFullInfoModal from "../../../vacancy/modal/vacancyFullInfoModal.vue";
import end_work_info from "../../modal/end_work_modal.vue";
export default {
    components: {
        table_cog,
        vacancyFullInfoModal,
        end_work_info,
    },
    props: {
        items: Object,
        auth: Object,
    },
    setup(props) {
        console.log("props.items", props.items);
        const data = ref(props.items.data);
        const type = ref(props.items.type);
   

        const vacancyFullInfoModalShow = ref(false);
        const vacancy_id = ref(null);

        const openVacancyFullInfoModal = (id) => {
            vacancy_id.value = id;
            vacancyFullInfoModalShow.value = !vacancyFullInfoModalShow.value;
        };

        const showEndWorkInfoModal = ref(false);
        const modalItem = ref(null);
        const openEndWorkInfoModal = (item) => {
            if (!item.end_work_reason_id) {
                return;
            }
            showEndWorkInfoModal.value = !showEndWorkInfoModal.value;
            modalItem.value = {
                end_work_reason_id: item.end_work_reason_id,
                end_work_reason: item.end_work_reason,
            };
        };

        return {
            data,
            type,

            vacancyFullInfoModalShow,
            vacancy_id,

            showEndWorkInfoModal,
            modalItem,

            openVacancyFullInfoModal,
            openEndWorkInfoModal,
        };
    },
};
</script>
<style lang=""></style>
