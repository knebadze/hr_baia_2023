<template lang="">
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <!-- <div class="d-flex justify-content-between"> -->
                <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_category_end_schedule') }}</h4>
                <!-- <button type="button" class="btn btn-success" @click="addWorkInfoModal()"><i class="fa fa-plus"></i> დამატება</button> -->

            <!-- </div> -->
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <p class="text-danger">{{ $t('lang.user_profile_page_category_end_schedule_title') }}</p>
            <!-- <small>{{ $t('lang.user_profile_page_category_end_schedule_title_2') }}</small> -->
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_category_title') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="model.category" :options="cla.category" :searchable="true" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :allow-empty="false" @blur="v.category.$touch">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <span v-if="!v.category.required.$response" style='color:red'>* </span>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_schedule_title') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="model.work_schedule"  :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false" @blur="v.work_schedule.$touch">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <span v-if="!v.work_schedule.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" v-if="showAdditionalSchedule">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>სასურველი სამუშაო გრაფიკი</label>
                            <textarea class="form-control" rows="3" v-model="model.additional_schedule" placeholder="ჩაწერეთ სასურველი სამუშაო დღეები და საათები" @blur="v$.m[`additional_schedule_${getLang}`].$touch"></textarea>
                            <!-- <span v-if="!v.additional_schedule.required.$response" style='color:red'>* </span> -->
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_salary_title') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" type="number" step="50" v-model="model.payment" @blur="v.payment.$touch" style='height:45px;'>
                                <span v-if="!v.payment.required.$response" style='color:red'>* </span>
                                <span v-if="!v.payment.numeric.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_currency_title') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="model.currency" :options="cla.currency" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v.currency.$touch">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="!v.currency.required.$response" style='color:red'>* </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div v-if="m.category"> -->
                <div class="row" v-if=" model.category.id == 1 || model.category.id == 2 || model.category.id == 4">
                    <div class="col-xl-4 col-lg-6 col-md-12" v-if="model.category.id != 4">
                        <div class="form-group">

                            <div class="ls-inputicon-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" v-model="model.go_vacation" id="flexCheckDefault">
                                    <label>{{ ('შეძლებთ არდადეგებზე გაყოლას?') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">

                            <div class="ls-inputicon-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" v-model="model.stay_night" id="flexCheckDefault">
                                    <label>{{ $t('შეძლებთ ღამე დარჩენას?') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">

                            <div class="ls-inputicon-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" v-model="model.work_additional_hours" id="flexCheckDefault">
                                    <label>{{ $t('შეძლებთ დამატებით საათებში მუშაობას?') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <div class="col-lg-12 col-md-12 mt-4" >
                    <div class="text-right ">
                        <button class="btn btn-success"
                        @click.prevent="add(model)"
                        title="დამატება" data-bs-toggle="tooltip"
                        data-bs-placement="top">{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- table -->
    <div class="panel panel-default" v-if="m.length != 0" >
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_category_end_schedule_table') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <div class="p-a20 table-responsive">
                <table class="table twm-table table-striped table-borderless">
                <thead>
                    <tr>
                    <th>N</th>
                    <th>{{ $t('lang.user_profile_page_category_title') }}</th>
                    <th>{{ $t('lang.user_profile_page_work_schedule_title') }}</th>
                    <th>{{ $t('lang.user_profile_page_work_salary_title') }}</th>
                    <th>{{ $t('lang.user_profile_page_work_currency_title') }}</th>
                    <th>{{ $t('lang.user_profile_page_work_actions_title') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(item, index) in m" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td><span style="margin-bottom: 5px; margin-right: 5px;" class="badge rounded-pill bg-success p-2">{{ item.category[`name_${getLang}`] }}</span></td>
                    <td><span style="margin-bottom: 5px; margin-right: 5px;" v-for="i in item.work_schedule" class="badge rounded-pill bg-primary p-2">{{ i[`name_${getLang}`] }}</span></td>
                    <td>{{ item.payment }}</td>
                    <td>{{ item.currency[`name_${getLang}`] }}</td>
                    <td>
                        <!-- <button type="button" :title="$t('lang.user_profile_page_category_end_schedule_table_action_tooltips_view')" data-bs-toggle="tooltip" data-bs-placement="top" @click="editWorkInformation(item)">
                            <i class="fa fa-eye"></i>
                        </button> -->
                        <button :title="$t('lang.user_profile_page_category_end_schedule_table_action_tooltips_del')" data-bs-toggle="tooltip" data-bs-placement="top" @click="remove(index, item.id)">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, computed, watch } from 'vue';
import { I18n } from 'laravel-vue-i18n';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, maxLength } from '@vuelidate/validators';
export default {
    emits: ['validateAndEmit'],
    props: {
        data: Object,
    },
    setup(props, { emit }) {

        const showAdditionalSchedule = ref(false);
        const cla = ref(props.data.cla)
        const formData = {...props.data.model.workInformation};

        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });


        formData.lang = getLang;
        formData.stay_night = 0;
        formData.go_vacation = 0;
        formData.work_additional_hours = 0;
        formData.additional_schedule = props.data.model.workInformation[`additional_schedule_${getLang.value}`]
        const model = ref(formData);
        const m = ref(props.data.model.getWorkInformation)

        const rules = {
            category: { required },
            payment: { required, numeric },
            currency: { required},
            work_schedule: { required },
            // additional_schedule: showAdditionalSchedule.value ? { required }: {}
        };

        const v = useVuelidate(rules, model);


        const getWorkSchedule = () => model.value.work_schedule;
        watch(getWorkSchedule, (newVal) => {
            showAdditionalSchedule.value = _.find(newVal, function(o) { if(o.id == 9) return true; });
        });

        const add = (item) =>{
            let data = {...item}
            if (m.value.length > 0 && m.value.some((element) => element.category_id === data.category.id)) {
                toast.error('არჩეულ კატეგორიაზე უკვე გაქვთ ინფორმაცია შევსებული', {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            if (data.work_schedule.id == 9 && data.additional_schedule == '') {
                toast.error('სავალდებულოა სამუშაო დღეების და საათების მითითება', {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            if (showAdditionalSchedule.value) {
                data[`additional_schedule_${getLang.value}`] = data.additional_schedule;
            }

            v.value.$touch();
            if (!v.value.$invalid) {
                validateAndSubmit(data)

            }else{
                toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
                    theme: 'colored',
                    autoClose: 2000,
                });
            }
        }


        const validateAndSubmit = (item) => {
            axios({
                method: "post",
                url: "/add_candidate",
                data: {'model':item, 'type': 'work_information', 'user_id': props.data.user_id},

            })
            .then(function (response) {
                if (response.data.status == 200) {
                    m.value.push(item)
                    model.value.category = "";
                    model.value.work_schedule = "";
                    model.value.additional_schedule = "";
                    model.value.payment = 800;
                    model.value.currency = "";
                    model.stay_night = 0;
                    model.go_vacation = 0;
                    model.work_additional_hours = 0;
                    toast.success("ინფორმაცია წარმატებით შეინახა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })

        };

        const validateAndEmit = () => {
            const isFormValid = m.value.length > 0 ? true: false;
            console.log('isFormValid', isFormValid);
            emit("validateAndEmit", isFormValid);
        }


;


        return {
            m,
            model,
            cla,
            v,
            validateAndSubmit,
            add,
            getLang,
            validateAndEmit,
            showAdditionalSchedule

        };
    },
    methods: {
        remove(index, id){
            this.$swal({
                title: 'ნამდვილად გსურთ წაშლა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const removed = this.m.splice(index, 1);
                    axios({
                        method: "post",
                        url: "/delete_candidate_info",
                        data: {'id':id, 'type': 'work_information'},

                    })
                    .then(function (response) {
                        if (response.data.status == 200) {
                            toast.success("წარმატებით წაიშალა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

                } else if (result.isDenied) {
                    return
                }
            });


        },
    },
};
</script>
<style lang="">

</style>
