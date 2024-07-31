<template lang="">
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_work_exp_title') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <p class="text-danger">{{ $t('lang.user_profile_page_work_exp_please_feel') }} </p>
            <div class="row">
                <div class=" col-md-12">
                    <div class="form-group">
                        <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_exp_experience') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="model.has_experience"
                                :options="cla.yesNo"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                placeholder="Select one"
                                :searchable="true"
                                :allow-empty="false"
                                :disabled="m.length > 0"
                            >
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>

                        </div>
                    </div>
                </div>
                <div class="row" v-if="showYesWorkExperience">
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('სტაჟი') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="model.work_experience" :options="cla.workExperiences" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" >
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <!-- <span v-if="v$.model.work_experience.required.$invalid && v$.model.work_experience.$dirty" style='color:red'>* {{ v$.model.work_experience.required.$message}}</span> -->
                            </div>
                        </div>
                    </div>
                    <div  class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_position') }}</label>
                            <div class="ls-inputicon-box">
                                <input
                                    class="form-control"
                                    v-model="model.position"
                                    type="text"
                                    placeholder=""
                                >
                                <i class="fs-input-icon fa fa-tasks"></i>
                                <!-- <span v-if="v$.model[`position_${getLang}`].required.$invalid && v$.model[`position_${getLang}`].$dirty" style='color:red'>* {{ v$.model[`position_${getLang}`].required.$message}}</span> -->
                            </div>
                        </div>
                    </div>
                    <div  class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_object') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="model.object" type="text" placeholder="" >
                                <i class="fs-input-icon fa fa-map-marker"></i>
                                <!-- <span v-if="v$.model[`object_${getLang}`].required.$invalid && v$.model[`object_${getLang}`].$dirty" style='color:red'>* {{ v$.model[`object_${getLang}`].required.$message}}</span> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="showNoWorkExperience">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><span class="text-danger">* </span>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="model.no_reason" :options="cla.noExperienceReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" v-if="model.no_reason && model.no_reason.id == 17">
                        <div class="form-group">
                            <label>დამატაბითი ინფორმაცია</label>
                            <textarea class="form-control" rows="3" v-model="model.no_reason_info" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                        </div>
                    </div>
                </div>
                <div v-if="model.has_experience" class="col-lg-12 col-md-12">
                    <div class="text-right ">
                        <button class="btn btn-success"
                            @click.prevent="add(model)"
                            title="დამატება"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            :disabled="send"
                        >{{ $t('lang.user_profile_page_work_button_add_info') }}
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>

                <div v-if="m.length != 0" class="col-lg-12 col-md-12">

                    <div class="panel-body wt-panel-body">
                        <div class="p-a20 table-responsive">
                            <table class="table twm-table table-striped table-borderless" v-if="m[0].has_experience.id == 1">
                                <thead>
                                    <tr>
                                    <th>N</th>
                                    <th>{{ $t('lang.user_profile_page_work_exp') }}</th>
                                    <th>{{ $t('lang.user_profile_page_work_position') }}</th>
                                    <th>{{ $t('lang.user_profile_page_work_object') }}</th>
                                    <th>{{ $t('lang.user_profile_page_work_actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ (item.work_experience)?item.work_experience[`name_${getLang}`]:'' }}</td>
                                    <td>{{ item[`position_${getLang}`] }}</td>
                                    <td>{{ item[`object_${getLang}`] }}</td>
                                    <td>
                                        <button @click="remove(index, item.id)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table twm-table table-striped table-borderless" v-if="m[0].has_experience.id == 2">
                                <thead>
                                    <tr>

                                    <th>არ ქონის მიზეზი</th>
                                    <th>დამატებითი ინფორმაცია</th>
                                    <th>{{ $t('lang.user_profile_page_work_actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m">
                                        <td>{{ item.no_reason[`name_${getLang}`] }}</td>
                                        <td>{{(item[`no_reason_info_${getLang}`])?item[`no_reason_info_${getLang}`].substr(0, 30)+ '...':''  }}</td>
                                        <td>
                                            <button @click="remove(index, item.id)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>
<script>
import { ref, computed, watch } from 'vue';
import { I18n } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
// import { useVuelidate } from '@vuelidate/core';
// import { required, numeric, maxLength } from '@vuelidate/validators';
export default {
    emits: ['validateAndEmit'],
    props: {
        data: Object,
    },
    setup(props, { emit }) {

        const send = ref(false)
        const cla = ref(props.data.cla)
        const formData = props.data.model.candidateWorkExperience;

        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });


        formData.lang = getLang;

        let m = ref(formData);
        const model = ref({
            has_experience: '',
            work_experience:'',
            position:'',
            object:'',
            no_reason:'',
            no_reason_info:'',
        });
        const showNoWorkExperience = ref(false);
        const showYesWorkExperience = ref(false);
        if (m.value.length > 0) {
            model.value.has_experience = m.value[0].has_experience
            m.value[0].has_experience.id == 1 ? showYesWorkExperience.value = true: showNoWorkExperience.value = true
            // showYesWorkExperience.value = true
        }

        const getHasExperience = () => model.value.has_experience;
        watch(getHasExperience, (newVal) => {
            if (newVal.id == 2) {
                showNoWorkExperience.value = true;
                showYesWorkExperience.value = false;
            }

            if(newVal.id == 1){
                showYesWorkExperience.value = true;
                showNoWorkExperience.value = false;
            }
        });

        const add = (item) =>{
            send.value = true;
            let data = {...item}
            if (data.has_experience.id == 1 && (data.work_experience == '' || data.position == '' || data.object == '')) {
                toast.error("სამუშაო გამოცდილების ყველ ველის შევსება სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false;
                return;
            }
            if (data.has_experience.id == 2 && data.no_reason == '') {
                toast.error("მიზეზის არქონის არჩევა სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false;
                return;
            }
            if (data.has_experience.id == 1) {
                data[`position_${getLang.value}`] = data.position;
                data[`object_${getLang.value}`] = data.object;
            }else{
                data[`no_reason_info_${getLang.value}`] = data.no_reason_info;
            }


            m.value.push(data)
            validateAndSubmit(data)
            model.value.work_experience = "";
            model.value.position = "";
            model.value.object = "";
        }


        const validateAndSubmit = (item) => {
            axios({
                method: "post",
                url: "/add_candidate",
                data: {'model':item, 'type': 'general_work', 'user_id': props.data.model.user_id},

            })
            .then(function (response) {
                if (response.data.status == 200) {
                    m.value = response.data.data;
                    send.value = false;
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
            emit("validateAndEmit", isFormValid);
        }

        const remove = (index, id) => {
            Swal.fire({
                title: 'ნამდვილად გსურთ წაშლა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const removed = m.value.splice(index, 1);
                    axios({
                        method: "post",
                        url: "/delete_candidate_info",
                        data: {'id':id, 'type': 'general_work'},

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


        }


;


        return {
            m,
            model,
            cla,
            validateAndSubmit,
            add,
            getLang,
            validateAndEmit,
            showNoWorkExperience,
            showYesWorkExperience,
            send,
            remove

        };
    },
    methods: {

    },
};
</script>
