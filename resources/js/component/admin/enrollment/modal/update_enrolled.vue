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
                        რედაქტირება
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
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>ვინ ჩარიცხა</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.name"
                                        type="text"
                                        placeholder="0"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>staff %</label>
                                <div class="ls-inputicon-box">
                                    <input
                                        class="form-control"
                                        v-model="m.hr_percent"
                                        type="number"
                                        placeholder="0"
                                        step="0.5"
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
            m: {},
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
            this.m = this.item;
            this.m.type = this.cla.find(
                (element) => element.id == this.item.type
            );
        },
        hide() {
            this.showConfirm = false;
        },
        save() {
            // if (!this.m.hasOwnProperty('reason')) {
            //     toast.error('შევსება სავალდებულოა', {
            //         theme: 'colored',
            //         autoClose: 2000,
            //     });
            //     return
            // }
            let currentObj = this;
            this.$swal({
                title: "ნამდვილად გსურთ რედაქტირება?",
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
                        url: "/enrollment_update",
                        data: { model: this.m },
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
        getClassificatory() {
            return axios.post("/get_add_black_list_info", {
                data: { id: this.item.id, type: this.item.type },
            });
        },
    },
    watch: {
        visible: function () {
            this.show();
        },
    },
};
</script>
<style lang=""></style>
