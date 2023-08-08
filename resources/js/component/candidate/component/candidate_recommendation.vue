<template lang="">
    <div class="panel panel-default" >
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_recomendation_title') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_recomendation_from') }}</label>
                        <div class="ls-inputicon-box">
                            <!-- <select class="wt-select-box selectpicker"  v-model="m.recommendation"  data-live-search="false" title=""  data-bv-field="size">
                                <option :value="1">წარმოვადგენ</option>
                                <option :value="2">ვერ წარმოვადგენ</option>
                            </select> -->
                            <multiselect v-model="m.has_recommendation" :options="cla.yesNo" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.has_recommendation.$touch">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <span v-if="v$.m.has_recommendation.required.$invalid && v$.m.has_recommendation.$dirty" style='color:red'>* {{ v$.m.has_recommendation.required.$message}}</span>

                        </div>
                    </div>
                </div>
                <div class="row" v-if="m.has_recommendation && m.has_recommendation.id == 1">
                    <div class="col-xl-6 col-lg-6 col-md-12 " >
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_recomendation_where_from') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.recommendation_whom" :options="cla.recommendationFromWhom" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.recommendation_whom.$touch">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="v$.m.recommendation_whom.required.$invalid && v$.m.recommendation_whom.$dirty" style='color:red'>* {{ v$.m.recommendation_whom.required.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_recomendation_name') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m[`name_${getLang}`]" type="text" placeholder="" @blur="v$.m[`name_${getLang}`].$touch">
                                <i class="fs-input-icon fa fa-star"></i>
                                <span v-if="v$.m[`name_${getLang}`].required.$invalid && v$.m[`name_${getLang}`].$dirty" style='color:red'>* {{ v$.m[`name_${getLang}`].required.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="m.recommendation_whom.id == 2 " class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>თანამდებობა</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m[`position_${getLang}`]" type="text" placeholder="" @blur="v$.m[`position_${getLang}`].$touch">
                                <span v-if="v$.m[`position_${getLang}`].required.$invalid && v$.m[`position_${getLang}`].$dirty" style='color:red'>* {{ v$.m[`position_${getLang}`].required.$message}}</span>
                                <i class="fs-input-icon fa fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_number') }}</label>
                            <div class="input-group mb-3">
                                <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${m.number_code.iso.toLowerCase()}`"></span>+{{ m.number_code.phonecode }}</button>
                                <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                    <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="m.number" placeholder="555666777" @blur="v$.m.number.$touch">
                                <span v-if="v$.m.number.required.$invalid && v$.m.number.$dirty" style='color:red'>* {{ v$.m.number.required.$message}}</span>
                                <span v-if="v$.m.number.numeric.$invalid && v$.m.number.$dirty" style='color:red'>* {{ v$.m.number.numeric.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div  class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>ფაილი</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" type="file" ref="fileInput" @change="handleFileChange">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="showNoRecommendation">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>რეცომდაციის არ ქონის მიზეზი</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.no_reason" :options="cla.noRecommendationReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false" @blur="v$.m.no_reason.$touch">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <span v-if="v$.m.no_reason.required.$invalid && v$.m.no_reason.$dirty" style='color:red'>* {{ v$.m.no_reason.required.$message}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>დამატაბითი ინფორმაცია</label>
                            <textarea class="form-control" rows="3" v-model="m[`no_reason_info_${getLang}`]" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება"></textarea>
                        </div>
                    </div>
                </div>
                <div v-if="m.has_recommendation && m.has_recommendation.id == 1" class="col-lg-12 col-md-12">
                    <div class="text-right ">
                        <button class="btn btn-success"
                        @click="add()"
                        title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">დამატება
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>
                <div v-if="items.length > 0 && items[0].has_recommendation.id == 1 " class="col-lg-12 col-md-12">
                    <div class="panel-body wt-panel-body">
                        <div class="p-a20 table-responsive">
                            <table class="table twm-table table-striped table-borderless">
                                <thead>
                                    <tr>
                                    <th>N</th>
                                    <th>{{ $t('lang.user_profile_page_recomendation_from') }}</th>
                                    <th>{{$t('lang.user_profile_page_recomendation_name')}}</th>
                                    <th>{{ $t('lang.user_profile_page_work_number_code') }}</th>
                                    <th>{{$t('lang.user_profile_page_recomendation_number')}}</th>
                                    <th>{{$t('პოზიცია')}}</th>
                                    <th>{{$t('lang.user_profile_page_recomendation_file')}}</th>
                                    <th>{{$t('lang.user_profile_page_work_actions_title')}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in items" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td><span :class="( item.recommendation_whom.id == 1)?'badge bg-success p-2':'badge bg-info text-dark p-2'">{{ item.recommendation_whom[`name_${getLang}`] }}</span></td>
                                    <td>{{ item[`name_${getLang}`] }}</td>
                                    <td>+{{ item.number_code.phonecode}}</td>
                                    <td>{{ item.number }}</td>
                                    <td>{{ item[`position_${getLang}`] }}</td>
                                    <td><u class="text-primary" @click="openPDF(item.file_path)">{{ item.file_name }}</u></td>
                                    <td>
                                        <button @click="remove(index, item.id)" title="წაშლა" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div v-if="m.candidateRecommendation.length > 0 && m.candidateRecommendation[0].has_recommendation.id == 2" class="col-lg-12 col-md-12">
                    <div class="panel-body wt-panel-body">
                        <div class="p-a20 table-responsive">
                            <table class="table twm-table table-striped table-borderless">
                                <thead>
                                    <tr>
                                    <th>არ ქონის მიზეზი</th>
                                    <th>დამატებითი ინფორმაცია</th>
                                    <th>action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m.candidateRecommendation">
                                    <td>{{ item.no_reason[`name_${getLang}`] }}</td>
                                    <td>{{ item[`no_reason_info_${getLang}`].substr(0, 30)+ '...' }}</td>
                                    <td>
                                        <button @click="removeRecommendation(index, item.id)" title="წაშლა" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                        <button @click="editRecommendation(item)" title="რედაქტირება" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fa fa-pen"></i>
                                        </button>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-lg-12 col-md-12 mt-4">
                    <div class="text-left">
                        <button type="submit" @click.prevent="add()"  class="site-button">{{$t('lang.user_profile_page_work_button_save')}}</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
 </template>
 <script>
 import { useVuelidate } from '@vuelidate/core'
 import { required, email, helpers, requiredIf, numeric, maxLength } from '@vuelidate/validators'
 import _ from 'lodash'
export default {
    setup () {
        return { v$: useVuelidate() }
    },
    props:{
        data: Object,

    },
    data() {
        return {
            m:null,
            cla: null,
            items:[],
            showNoRecommendation: false,
            file:null
        }
    },
    validations () {
        const validations = {
            m:{
                has_recommendation:{
                    required:helpers.withMessage('რეკომენდაციის შევსება სავალდებულოა', required )
                },
                recommendation_whom:{},
                name_ka:{},
                name_en:{},
                name_ru:{},
                position_ka:{},
                position_en:{},
                position_ru:{},
                number:{},
                no_reason:{},
                no_reason_info_ka:{},
                no_reason_info_en:{},
                no_reason_info_ru:{},
            },

        }
        if (this.m.has_recommendation && this.m.has_recommendation.id == 1) {
            validations.m.recommendation_whom = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required )
            }
            if (this.m.recommendation_whom.id == 2) {
                validations.m[`position_${this.getLang}`] = {
                    required:helpers.withMessage('შევსება სავალდებულოა', required )
                }
            }
            validations.m[`name_${this.getLang}`] = {
                required:helpers.withMessage('შევსება სავალდებულოა', required )
            }
            validations.m.number = {
                required:helpers.withMessage('შევსება სავალდებულოა', required ),
                numeric: helpers.withMessage('ნომერი უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
            }
        } else {
            validations.m.no_reason = {
                required:helpers.withMessage('არჩევა სავალდებულოა', required )
            }
            validations.m[`no_reason_info_${this.getLang}`] = {
                maxLength: helpers.withMessage('დაშვებულია 100 სიმბოლო', maxLength(100) )
            }
        }

        return validations
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    created(){
        this.m = {...this.data.model.recommendation}
        this.items = this.data.model.candidateRecommendation
        this.cla = _.cloneDeep(this.data.cla)
        this.m.number_code = this.cla.numberCode.find(element => element.phonecode == 995);
        this.m.user_id = this.data.user_id
    },
    methods: {
        async add(){
            const isFormCorrect = await this.v$.m.$validate()
            if (!isFormCorrect) return;
            if (this.file != null && this.file.type !== 'application/pdf') {
                toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            this.m.lang = this.getLang
            this.m.candidate_id = this.data.candidate_id
            let currentObj = this;
            const formData = new FormData();
            formData.append('data', JSON.stringify(this.m))
            if (this.file) {
                formData.append('file', this.file);
            }

            axios.post('/add_candidate_recommendation', formData)
            .then(function (response) {

                // handle success
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    currentObj.items.push(response.data.data)
                    toast.success("წარმატებით დაემატა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    currentObj.m = {...currentObj.data.model.recommendation}
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        remove(index, id){
            let currentObj = this
            this.$swal({
                title: 'ნამდვილად გსურთ წაშლა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const removed = this.items.splice(index, 1);
                    axios.post('/delete_candidate_recommendation' ,{
                        data: id,
                    })
                    .then(function (response) {
                        if (response.status == 200) {
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
                    // this.hide()

                } else if (result.isDenied) {
                    return
                }
            });
        },
        openPDF(item) {
            const pdfUrl = `/storage/${item}`;
            window.open(pdfUrl, '_blank');
        },
        handleFileChange(event) {
            this.file = event.target.files[0];
            this.m.file_name = this.file.name
        },
        chooseNumberCode(item){
            this.m.number_code = item
        },
    },
    watch:{
    }
}
</script>
<style lang="">

</style>
