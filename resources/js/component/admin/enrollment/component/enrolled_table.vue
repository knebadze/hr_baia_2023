<template lang="">
    <div>
        <h5><i class="fa fa-table"></i> ცხრილი</h5>
        <p>
            მიმდინარე ჩარიცხვების დაწყების თარიღი:
            {{ start_date ? start_date : "ახალი ათვლა" }}
        </p>
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
                    <th>ვინ ჩარიცხა</th>
                    <th>ჩარიცხვის ტიპი</th>
                    <th>თანხა</th>
                    <th>staff %</th>
                    <th>ბონუსი</th>
                    <th>თარიღი</th>
                    <th>ქვითარი</th>
                    <th>სტატუსი</th>
                    <th v-if="role_id == 1">მოქმედება</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" :key="index">
                    <td>
                        <span
                            :class="
                                item.enrollment_type == 1
                                    ? 'badge badge-primary'
                                    : 'badge badge-info'
                            "
                            >{{
                                item.enrollment_type == 1
                                    ? "რეგისტრაცია"
                                    : "ვაკანსია"
                            }}</span
                        >
                    </td>
                    <td>
                        <u class="text-primary" @click="fullModal(item)">{{
                            item.enrollment_type == 1
                                ? item.candidate_id
                                : item.vacancy.code
                        }}</u>
                    </td>
                    <td v-if="role_id == 1">{{ item.author.name_ka }}</td>
                    <td>
                        {{
                            item.enrollment_type == 1
                                ? ""
                                : item.who_is_counting == 1
                                ? "კანდიდატი"
                                : "დამსაქმებელი"
                        }}
                    </td>
                    <td>{{ item.name }}</td>
                    <td>
                        <span
                            :class="
                                item.type == 1
                                    ? 'badge badge-success'
                                    : 'badge badge-danger'
                            "
                            >{{ item.type == 1 ? "სრული" : "არასრული" }}</span
                        >
                    </td>
                    <td>{{ item.money }}</td>
                    <td>{{ item.hr_percent ? item.hr_percent : "ფიქს." }}</td>
                    <td>{{ item.hr_bonus }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-info"
                            @click="showFile(item.file_path)"
                            title=""
                            :disabled="item.file_path ? false : true"
                        >
                            <i
                                :class="
                                    item.file_path
                                        ? 'fa fa-eye'
                                        : 'fa fa-eye-slash'
                                "
                            ></i>
                        </button>
                    </td>
                    <td>
                        <span
                            :class="
                                item.agree == 1
                                    ? 'badge badge-success'
                                    : 'badge badge-warning'
                            "
                            >{{
                                item.agree == 1 ? "დადასტურებული" : "მიმდინარე"
                            }}</span
                        >
                    </td>
                    <td v-if="role_id == 1">
                        <button
                            v-if="
                                !fullPermission &&
                                item.author.parent_id == admin_id
                            "
                            type="button"
                            class="btn btn-info mr-1"
                            @click="agree(item)"
                            title="დადასტურება"
                            :disabled="item.agree == 0 ? false : true"
                        >
                            <i class="fa fa-check-square"></i>
                        </button>
                        <button
                            v-if="
                                !fullPermission &&
                                item.author.parent_id == admin_id
                            "
                            type="button"
                            class="btn btn-success"
                            @click="editModal(item)"
                            title="რედაქტირება"
                            :disabled="item.agree == 0 ? false : true"
                        >
                            <i class="fa fa-pen"></i>
                        </button>
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
        <update_enrolled :visible="updateModal" :item="item"></update_enrolled>
    </div>
</template>
<script>
import moment from "moment";
import vacancyFullInfoModal from "../../vacancy/modal/vacancyFullInfoModal.vue";
import candidateFullInfoModal from "../../candidate/modal/candidateFullInfoModal.vue";
import update_enrolled from "../modal/update_enrolled.vue";
export default {
    components: {
        vacancyFullInfoModal,
        candidateFullInfoModal,
        update_enrolled,
    },
    props: {
        items: Object,
        role_id: Number,
        start_date: String,
        admin_id: Number,
        fullPermission: Boolean,
    },
    data() {
        return {
            candidateModal: false,
            vacancyModal: false,
            updateModal: false,
            modalId: null,
            item: {},
            date: null,
        };
    },
    computed: {},
    methods: {
        fullModal(item) {
            if (item.enrollment_type == 1) {
                this.candidateModal = !this.candidateModal;
                this.modalId = item.candidate_id;
            } else {
                this.vacancyModal = !this.vacancyModal;
                this.modalId = item.vacancy_id;
            }
        },
        editModal(item) {
            this.updateModal = !this.updateModal;
            this.item = { ...item };
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
                        data: { model: item },
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
                            } else {
                            }
                        })
                        .catch(function (error) {
                            if (error.response) {
                                // The request was made and the server responded with a non-200 status
                                // Handle the error using toast.error or other methods
                                toast.error(
                                    "მოხდა შეცდომა: " + error.response.status,
                                    {
                                        theme: "colored",
                                        autoClose: 1000,
                                    }
                                );
                            } else if (error.request) {
                                // The request was made but no response was received
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an error
                                console.log("Error", error.message);
                            }
                            console.log(error.config);
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
