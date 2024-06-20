<template lang="">
    <div>
        <h5><i class="fa fa-table"></i> ცხრილი</h5>
        <hr />
    </div>

    <!-- <div class="row">
        <div class="col-md-12 border">

            <div class="row">
                <div class="col-md-4">
                    <dl class="row">

                        <dt class="col-sm-4">ვაკანსიის ID:</dt>
                        <dd class="col-sm-8"></dd>
                    </dl>
                    <p>ვისი: </p>
                    <p>ვინ ჩარიცხა: </p>
                    <p>ტიპი: </p>
                </div>
                <div class="col-md-4">
                    <p>თანხა: </p>
                    <p>staff %: </p>
                    <p>ბონუსი: </p>
                    <p>ქვითარი: </p>
                </div>
            </div>

        </div>
    </div> -->

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">ტიპი</th>
                    <th>ID</th>
                    <th v-if="role_id == 1">staff</th>
                    <th>ვისი</th>
                    <!-- <th>ვინ ჩარიცხა</th>
                    <th>ჩარიცხვის ტიპი</th> -->
                    <!-- <th>უნდა ჩაირიცხოს სულ</th> -->
                    <th>თანხა</th>
                    <th>staff %</th>
                    <th>ბონუსი</th>
                    <th>გადახდის თარიღი</th>
                    <th>სტატუსი</th>
                    <!-- <th>ქვითარი</th> -->
                    <!-- <th>სტატუსი</th> -->
                    <!-- <th v-if="role_id == 1">მოქმედება</th> -->
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
                    <td v-if="role_id == 1">{{ item.name_ka }}</td>
                    <td>
                        {{
                            item.vacancy_type == 1
                                ? "კანდიდატი"
                                : "დამსაქმებელი"
                        }}
                    </td>
                    <td>{{ item.money }}</td>
                    <!-- <td><span :class="(item.type == 1)?'badge badge-success':'badge badge-danger'">{{ (item.type == 1)?'სრული':'არასრული' }}</span></td> -->
                    <!-- <td>{{ item.money }}</td> -->
                    <td>{{ item.type == 2 ? item.bonus_percent : "ფიქს." }}</td>
                    <td>
                        {{
                            item.type == 2
                                ? (item.money * item.bonus_percent) / 100
                                : 10
                        }}
                    </td>
                    <td>{{ item.date }}</td>
                    <!-- <td>
                        <button type="button" class="btn btn-info" @click="showFile(item.file_path)" title="" :disabled="(item.file_path)?false:true"><i :class="(item.file_path)?'fa fa-eye':'fa fa-eye-slash'"></i></button>
                    </td> -->
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
                    <!-- <td v-if="role_id == 1">
                        <button type="button" class="btn btn-info mr-1" @click="agree(item)" title="დადასტურება" :disabled="(item.agree == 0)?false:true"><i class="fa fa-check-square"></i> </button>
                        <button type="button" class="btn btn-success" @click="editModal(item)" title="რედაქტირება" :disabled="(item.agree == 0)?false:true"><i class="fa fa-pen"></i> </button>

                    </td> -->
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
import moment from "moment";
import vacancyFullInfoModal from "../../vacancy/modal/vacancyFullInfoModal.vue";
import candidateFullInfoModal from "../../candidate/modal/candidateFullInfoModal.vue";
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
        };
    },
    computed: {},
    created() {
        for (let i = 0; i < this.items.length; i++) {
            // Access the element to update in each object
            const createdAtMoment = moment(this.items[i].date);
            this.items[i].created_at = moment(this.items[i].created_at).format(
                "YYYY-MM-DD HH:mm"
            );

            if (createdAtMoment.isBefore(moment(), "day")) {
                this.items[i]["status"] = "გადაცილება";
            } else {
                this.items[i]["status"] = "მიმდინარე";
            }
        }
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
