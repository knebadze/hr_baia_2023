<template lang="">
    <!-- Modal -->
    <div
        v-if="showConfirm"
        class="modal fade show"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        id="modalMap"
        aria-hidden="true"
        style="display: block"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-lg"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        ვაკანსიის გადაწერა
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
                    <p class="text-center text-info">
                        ამჟამად ვაკანსია ეკუთვნის HR: {{ item.hr.user.name_ka }}
                    </p>
                    <h5 class="text-center">
                        ნამდვილად გსურთ ვაკანსის გადაწერა?
                    </h5>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>აირჩიე hr</label>
                                <div class="ls-inputicon-box">
                                    <multiselect
                                        v-model="m.new_hr"
                                        :options="cla"
                                        deselect-label="Can't remove this value"
                                        track-by="name_ka"
                                        label="name_ka"
                                        placeholder="Select one"
                                        :searchable="true"
                                        :allow-empty="false"
                                    >
                                        <template
                                            slot="singleLabel"
                                            slot-scope="{ option }"
                                        ></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
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
import _ from "lodash";
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
            reminder: {},
            cla: null,
            edit: {},
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
        async show() {
            try {
                let result = await this.getClassificatory();
                let item = this.item;
                this.cla = _.filter(result.data, function (o) {
                    return o.hr.id != item.hr.id;
                });
                this.m = this.item;
                this.edit = {
                    hr: this.item.hr,
                };
                this.showConfirm = true;
            } catch (error) {}
        },
        hide() {
            this.showConfirm = false;
        },
        getClassificatory() {
            return axios.post("/get_hr_cla", {
                data: this.item.id,
            });
        },
        save() {
            let currentObj = this;
            this.$swal({
                title: "ნამდვილად გსურთ ვაკანსიისს სხვა hr_ზე გადაწერა?",
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
                        url: "/change_hr_in_vacancy",
                        data: { model: this.m, edit: this.edit },
                    })
                        .then(function (response) {
                            if (response.data.status == 200) {
                                toast.success("წარმატებით განახლდა", {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
                                currentObj.hide();
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
    watch: {
        visible: function () {
            this.show();
        },
    },
};
</script>
<style lang=""></style>
