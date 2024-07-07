<template lang="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ items.title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
                                role="button"
                                class="text-primary"
                                @click="
                                    openCandidateFullInfoModal(
                                        item.candidate_id
                                    )
                                "
                                >{{ item.candidate_id }}</u
                            >
                        </td>
                        <td v-if="type == 'employed'">
                            {{ item.qualifying_type }}
                        </td>
                        <td>{{ item.candidate_name }}</td>
                        <td v-if="type == 'note'">
                            {{ item.qualifying_type }}
                        </td>

                        <td v-if="type == 'interview'">
                            {{ item.interview_date }}
                        </td>
                        <td v-if="type == 'interview'">
                            {{ item.interview_place }}
                        </td>
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
                        <td>{{ item.updated_at }}</td>
                        <td>
                            <table_cog
                                :item="item"
                                :auth="auth"
                                v-if="auth.role_id == 2 || (fullPermission || item.hr_parent_id == auth.id)"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <candidateFullInfoModalVue
        :visible="candidateFullInfoModalShow"
        :candidate_id="candidate_id"
    ></candidateFullInfoModalVue>
    <end_work_info :visible="showEndWorkInfoModal" :item="modalItem" />
</template>
<script>
import { ref, computed } from "vue";
import table_cog from "./table_cog.vue";
import candidateFullInfoModalVue from "../../../candidate/modal/candidateFullInfoModal.vue";
import end_work_info from "../../modal/end_work_info.vue";

export default {
    components: {
        table_cog,
        candidateFullInfoModalVue,
        end_work_info,
    },
    props: {
        items: Object,
        auth: Object,
        adminViewAndPermission: Object,
    },
    setup(props) {
        const data = ref(props.items.data);
        const type = ref(props.items.type);
        console.log(data.value);
        const candidateFullInfoModalShow = ref(false);
        const candidate_id = ref(null);

        const openCandidateFullInfoModal = (id) => {
            candidateFullInfoModalShow.value =
                !candidateFullInfoModalShow.value;
            candidate_id.value = id;
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

        const fullPermission = computed(() => {
            return props.adminViewAndPermission ? props.adminViewAndPermission.permission == "full": null;
        });

        return {
            data,
            type,

            candidateFullInfoModalShow,
            candidate_id,

            showEndWorkInfoModal,
            modalItem,

            openCandidateFullInfoModal,
            openEndWorkInfoModal,
            fullPermission,
        };
    },
};
</script>
<style lang=""></style>
