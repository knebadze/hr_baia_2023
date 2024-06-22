<template lang="">
    <div>
        <div class="mb-2 d-flex justify-content-end">
            <button
                class="btn btn-primary"
                type="button"
                title="ხელფასის გაცემა"
                v-if="role_id == 1 && disbursement_of_salary_button"
                @click="disbursement_of_salary()"
            >
                <i class="fa fa-check"></i> ხელფასის გაცემა
            </button>
        </div>
        <EasyDataTable
            v-model:items-selected="itemsSelected"
            :headers="headers"
            :items="items"
            table-class-name="customize-table"
            border-cell
        >
            <!-- <template #item-category="item">
            <span class="text-primary" v-for="(i, index) in item.get_work_information" :key="index" ><u style="cursor: pointer;" @click="openInfoModal('category', item.get_work_information[index])">{{ i.category.name_ka+', ' }}</u></span>
        </template>-->
            <template #item-status="item">
                <span
                    :class="
                        !item.disbursement_date
                            ? 'badge bg-warning p-1'
                            : item.disbursement_date && item.hr_agree == 0
                            ? 'badge bg-danger p-1'
                            : 'badge bg-success p-1'
                    "
                    >{{
                        !item.disbursement_date
                            ? "მიმდინარე"
                            : item.disbursement_date && item.hr_agree == 0
                            ? "დასადასტურებელი"
                            : "დადასტურებული"
                    }}</span
                >
            </template>
            <template #item-operation="item">
                <div class="operation-wrapper">
                    <button
                        v-if="role_id == 2 || role_id == 4"
                        :disabled="item.disbursement_date ? false : true"
                        class="btn btn-success"
                        type="button"
                        title="დადასტურება"
                        @click="agree(item)"
                    >
                        <i class="fa fa-check"></i>
                    </button>
                    <button
                        v-else
                        class="btn btn-success"
                        type="button"
                        title="დანამატის ჩაწერა"
                        @click="openSupplementModal(item)"
                    >
                        დანამატი
                    </button>
                </div>
            </template>
        </EasyDataTable>
        <!-- {{ statusChangeModal }} -->
        <!-- <infoModal :visible="showInfoModal" :type="modalType" :items="item"></infoModal> -->
        <component
            :is="supplementModalComponent"
            v-if="supplementModalComponent"
            :visible="showSupplementModal"
            :item="item"
        ></component>
    </div>
</template>
<script>
import { ref, computed } from "vue";
import moment from "moment";
import Slider from "@vueform/slider";
import "@vueform/slider/themes/default.css";
// import Switch from '../../inc/Switch.vue';
import _ from "lodash";
import { markRaw } from "vue";
// import infoModal from '../modal/info_modal.vue'

export default {
    components: {
        Slider,
        // infoModal,
    },
    props: {
        data: Object,
        role_id: Number,
        // hrId: Number
    },

    setup(props) {
        let url = new URL(location.href);
        const itemsSelected = ref([]);
        let updateUrl = ref(url.origin + "/admin/candidate_update");

        var showSupplementModal = ref(false);
        var item = ref();
        // let hr_id = ref(props.hrId)
        let disbursement_of_salary_button = ref(false);
        let supplementModalComponent = ref(null);
        let checkDisbursement = ref(false);

        const headers = ref([
            // { text: "id", value: "id" },
            {
                text: "ფიქსირებული ხელფასი",
                value: "fixed_salary",
                sortable: true,
            },
            {
                text: "ბონუსი ვაკანსიებიდან",
                value: "hr_bonus_from_vacancy",
                sortable: true,
            },
            {
                text: "ბონუსი ფაისანი რეგისტრაციებიდან",
                value: "hr_bonus_from_registration",
                sortable: true,
            },
            { text: "დანამატი", value: "supplement", sortable: true },
            { text: "სრული ხელფასი", value: "full_salary", sortable: true },
            { text: "დაწყების თარიღი", value: "created_at", sortable: true },
            { text: "გაცემის თარიღი", value: "disbursement_date" },
            { text: "სტატუსი", value: "status", sortable: true },

            { text: "Operation", value: "operation" },
        ]);

        if(props.role_id == 1){
            headers.value.unshift({ text: "role", value: "hr.user.role.name" });
            headers.value.unshift({ text: "staff", value: "hr.user.name_ka" });

        }
        let data = props.data;
        for (let i = 0; i < data.length; i++) {
            // Access the element to update in each object
            data[i].created_at = moment(data[i].created_at).format(
                "YYYY-MM-DD HH:mm"
            );
        }
        //  makeData(props.data)

        // cla = ref(props.data.classificatory)
        const items = ref(data);

        function makeData(params) {
            var arr = [];

            params.forEach((element) => {
                // let map = element.get_work_information.map(item => item.category.name_ka)
                element.category = map.toString();
                element.age = age(element.user.date_of_birth);

                arr.push(element);
            });
            return arr;
        }

        return {
            headers,
            items,
            itemsSelected,

            showSupplementModal,
            item,
            updateUrl,

            find,

            disbursement_of_salary_button,
            supplementModalComponent,
            checkDisbursement,
            // bodyRowClassNameFunction

            // statusChange
        };
    },
    methods: {
        disbursement_of_salary() {
            let currentObj = this;
            this.$swal({
                title: "ნამდვილად გსურთ ხელფასის გაცემა?",
                // html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
                //   showDenyButton: true,
                cancelButtonText: "არა",
                confirmButtonText: "კი",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: "/disbursement_of_salary",
                        data: {
                            items: this.itemsSelected,
                            check: this.checkDisbursement,
                        },
                    })
                        .then(function (response) {
                            console.log(response.data);
                            if (response.data.status == 200) {
                                let text;
                                if (response.data.data.type == "w") {
                                    currentObj
                                        .$swal({
                                            title: "<p>გიფიქსირდება დაუდასტურებელი ჩარიცხვები</p>",
                                            icon: "info",
                                            html: "დარწმუნებული ხართ რომ გსურთ ამ ჩარიცხვების შემდეგ თვეში გადადება?",
                                            showCloseButton: true,
                                            showCancelButton: true,
                                            showDenyButton: true,
                                            focusConfirm: false,
                                            confirmButtonText: "კი",
                                            denyButtonText:
                                                "ჩარიცხვებზე გადასვლა",
                                            cancelButtonText: "გაუქმება",
                                        })
                                        .then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            if (result.isConfirmed) {
                                                currentObj.checkDisbursement = true;
                                                currentObj.disbursement_of_salary();
                                            } else if (result.isDenied) {
                                                window.location.replace(
                                                    `/admin/enrollment`
                                                );
                                            }
                                        });
                                } else if (response.data.data.type == "s") {
                                    toast.success("თქვენ გაეცით ხელფასები", {
                                        theme: "colored",
                                        autoClose: 1000,
                                    });
                                    // setTimeout(() => {
                                    //     document.location.reload();
                                    // }, 1500);
                                }
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
        agree(item) {
            this.$swal({
                title: "ნამდვილად გსურთ ჩარიცხვის დადასტურება?",
                // html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
                //   showDenyButton: true,
                cancelButtonText: "არა",
                confirmButtonText: "კი",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: "/hr_agree_salary",
                        data: { id: item.id },
                    })
                        .then(function (response) {
                            if (response.data.status == 200) {
                                toast.success(
                                    "თქვენ დაადასტურეთ ხელფასის აღება",
                                    {
                                        theme: "colored",
                                        autoClose: 1000,
                                    }
                                );
                                // setTimeout(() => {
                                //     document.location.reload();
                                // }, 1500);
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
        async openSupplementModal(item) {
            if (!this.supplementModalComponent) {
                let module = await import("../modal/supplement_modal.vue");
                this.supplementModalComponent = markRaw(module.default);
            }
            this.item = item;
            this.showSupplementModal = !this.showSupplementModal;
        },
    },
    watch: {
        itemsSelected: {
            handler(newValue, oldValue) {
                if (newValue.length > 0) {
                    this.disbursement_of_salary_button = true;
                } else {
                    this.disbursement_of_salary_button = false;
                }
            },
            deep: true,
        },
    },
};
</script>
<style>
/* .my-candidate-row  {
            --easy-table-body-row-background-color: #f8b1b1;
            --easy-table-body-row-font-color: #070707;
        } */
.customize-table {
    --easy-table-border: 1px solid #445269;
    --easy-table-header-font-size: 18px;
    --easy-table-header-height: 50px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-body-row-height: 50px;
}
</style>
