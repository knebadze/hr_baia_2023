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
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        დასრულების თარიღის გადაწევა
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> დასრულების თარიღი</label>
                            <input
                                class="form-control"
                                v-model="m.end_date"
                                type="date"
                                :min="min"
                            />
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
            min: null,
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
            this.m = { id: this.item.id, end_date: this.item.end_date };
            this.min = this.item.end_date;
        },
        hide() {
            this.showConfirm = false;
        },
        save() {
            let currentObj = this;
            this.$swal({
                title: "ნამდვილად გსურთ დასრულების თარიღის გადაწევა?",
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
                        url: "/move_end_date",
                        data: { model: this.m },
                    })
                        .then(function (response) {
                            if (response.data.status == 200) {
                                toast.success("წარმატებით განახლდა", {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
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
