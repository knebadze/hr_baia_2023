<template lang="">
    <div>
        <h5><i class="fa fa-table"></i> ცხრილი</h5>
        <hr />
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">ტიპი</th>
                    <th>ID</th>
                    <th v-if="role_id == 1">staff</th>
                    <th>ვისი</th>
                    <th>თანხა</th>
                    <th>staff %</th>
                    <th>ბონუსი</th>
                    <th>გადახდის თარიღი</th>
                    <th>სტატუსი</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" :key="index">
                    <td>
                        <span
                            :class="
                                item.type == 1
                                    ? 'badge badge-primary'
                                    : 'badge badge-info'
                            "
                            >{{
                                item.type == 1 ? "კანდიდატი" : "ვაკანსია"
                            }}</span
                        >
                    </td>
                    <td>
                        <u class="text-primary" @click="fullModal(item)">{{
                            item.id
                        }}</u>
                    </td>
                    <td v-if="role_id == 1">{{ item.author_name }}</td>
                    <td>
                        {{
                            item.vacancy_type == 1
                                ? "კანდიდატი"
                                : "დამსაქმებელი"
                        }}
                    </td>
                    <td>{{ item.money }}</td>
                    <td>{{ item.type == 2 ? item.bonus_percent : "ფიქს." }}</td>
                    <td>
                        {{
                            item.type == 2
                                ? (item.money * item.bonus_percent) / 100
                                : 10
                        }}
                    </td>
                    <td :class="new Date(currentDate) > new Date(item.date) ? 'text-danger' : ''">{{ item.date }}</td>
                    <td>
                        <span
                            :class="
                                item.status == 'მიმდინარე'
                                    ? 'badge badge-warning'
                                    : 'badge badge-danger'
                            "
                            >{{ item.status }}</span
                        >
                    </td>
                </tr>
            </tbody>
        </table>
        <vacancyFullInfoModal
            :visible="vacancyModal"
            :vacancyId="modalId"
        ></vacancyFullInfoModal>
        <candidateFullInfoModal
            :visible="candidateModal"
            :candidate_id="modalId"
        ></candidateFullInfoModal>
        <!-- <update_enrolled :visible="updateModal" :item="item"></update_enrolled> -->
    </div>
</template>
<script>

import vacancyFullInfoModal from "../../vacancy/modal/vacancyFullInfoModal.vue";
import candidateFullInfoModal from "../../candidate/modal/candidateFullInfoModal.vue";
import moment from "moment";
// import update_enrolled from '../modal/update_enrolled.vue'
export default {
    components: {
        vacancyFullInfoModal,
        candidateFullInfoModal,
        // update_enrolled
    },
    props: {
        items: Object,
        role_id: Number,
    },
    data() {
        return {
            candidateModal: false,
            vacancyModal: false,
            updateModal: false,
            modalId: null,
            item: {},
            today: new Date(),
        };
    },
    computed: {
        currentDate() {
            // Return a formatted string for display purposes
            return this.today.toISOString().split('T')[0];
        },
    },
    created() {
    },
    methods: {
        fullModal(item) {
            if (item.type == 1) {
                this.candidateModal = !this.candidateModal;
                this.modalId = item.id;
            } else {
                this.vacancyModal = !this.vacancyModal;
                this.modalId = item.id;
            }
        },
        editModal(item) {
            this.updateModal = !this.updateModal;
            this.item = item;
        },
        showFile(item) {
            const pdfUrl = `/storage/${item}`;
            window.open(pdfUrl, "_blank");
        },
        agree(item) {
            let currentObj = this;
            this.$swal({
                title: "ნამდვილად გსურთ დადასტურება?",
                // html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
                //   showDenyButton: true,
                cancelButtonText: "არა",
                confirmButtonText: "კი",
                showCancelButton: true,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                // return
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: "/enrollment_agree",
                        data: { id: item.id },
                    })
                        .then(function (response) {
                            if (response.status == 200) {
                                toast.success("წარმატებით შესრულდა", {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
                                setTimeout(() => {
                                    document.location.reload();
                                }, 1500);
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                } else if (result.isDenied) {
                    return;
                }
            });
        },
    },

};
</script>
<style lang=""></style>
