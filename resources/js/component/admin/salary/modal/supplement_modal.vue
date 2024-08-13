<template lang="">
    <!-- Modal -->
    <div
        v-if="showConfirm"
        class="modal fade show"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        id="modalMap"
        style="display: block"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-xl"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        {{ item.name_ka }}ს ხელფასისი დანამატი
                    </h6>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="hide()"
                    >
                        X
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>მიმდინარე ხელფასი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.full_salary"
                                        type="number"
                                        placeholder="0"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>დანამატი</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.supplement"
                                        type="number"
                                        placeholder="0"
                                        step="10"
                                        @input="supplement(m.supplement)"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ხელფასი სულ</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.total_salary"
                                        type="number"
                                        placeholder="0"
                                        step="10"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>ჩარიცხვის ტიპი</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.type" :options="cla" deselect-label="Can't remove this value" track-by="name" label="name" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                            </div>
                        </div>
                    </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-success"
                        @click.prevent="save()"
                    >
                        <i class=""></i>შენახვა
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import moment from "moment";
export default {
    props: {
        visible: Boolean,
        item: Object,
    },
    data() {
        return {
            showConfirm: false,
            data: {},
            m: null,
            cla: [
                { id: 0, name: "არასრული" },
                { id: 1, name: "სრული" },
            ],
            check: null,
        };
    },
    created() {
        // this.showConfirm = this.visible
    },
    computed: {
        getLang() {
            return I18n.getSharedInstance().options.lang;
        },
    },
    methods: {
        // async
        show() {
            this.showConfirm = true;
            this.m = { ...this.item };
            this.m.total_salary =
                Number(this.m.full_salary) + Number(this.m.supplement);
        },
        hide() {
            this.showConfirm = false;
        },
        supplement(item) {
            this.m.total_salary =
                Number(this.m.full_salary) + Number(this.m.supplement);
        },
        save() {
            let currentObj = this;
            this.$swal({
                title: "ნამდვილად გსურთ შენახვა?",
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
                        url: "/salary_supplement",
                        data: { model: this.m },
                    })
                        .then(function (response) {
                            if (
                                response.status == 200 &&
                                response.data.message === "Update successful"
                            ) {
                                toast.success("წარმატებით შესრულდა", {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
                                setTimeout(() => {
                                    document.location.reload();
                                }, 1500);
                            } else {
                                // Handle the case where the update failed
                                toast.error("შეცდომა: შეუძლებელია განახლება", {
                                    theme: "colored",
                                    autoClose: 2000,
                                });
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else if (result.isDenied) {
                    return;
                }
            });
        },
        // getClassificatory(){
        //     return axios.post('/get_add_black_list_info' ,{
        //           data: {'id':this.item.id, 'type': this.item.type},
        //       })

        // },
    },
    watch: {
        visible: {
            immediate: true,
            handler(newVal) {
                this.show();
            },
        },
    },
};
</script>
<style lang=""></style>
