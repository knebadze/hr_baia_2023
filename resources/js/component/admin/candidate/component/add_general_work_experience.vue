<template lang="">
    <div class="row">
        <div class=" col-md-12">
            <div class="form-group">
                <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_exp_experience') }}</label>
                <div class="ls-inputicon-box">
                    <multiselect v-model="candidateWorkExperienceModel.has_experience" :options="cla.yesNo" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" >
                        <template slot="singleLabel" slot-scope="{ option }"></template>
                    </multiselect>
                    <!-- <span v-if="v$.candidateWorkExperienceModel.has_experience.required.$invalid && v$.candidateWorkExperienceModel.has_experience.$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel.has_experience.required.$message}}</span> -->
                </div>
            </div>
        </div>
        <div class="row col-md-12" v-if="showYesWorkExperience">
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_exp') }}</label>
                    <div class="ls-inputicon-box">
                        <multiselect v-model="candidateWorkExperienceModel.work_experience" :options="cla.workExperiences" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false" >
                            <template slot="singleLabel" slot-scope="{ option }"></template>
                        </multiselect>
                        <!-- <span v-if="v$.candidateWorkExperienceModel.work_experience.required.$invalid && v$.candidateWorkExperienceModel.work_experience.$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel.work_experience.required.$message}}</span> -->
                    </div>
                </div>
            </div>
            <div  class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_position') }}</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" v-model="candidateWorkExperienceModel[`position_${getLang}`]" type="text" placeholder="" >
                        <!-- <span v-if="v$.candidateWorkExperienceModel[`position_${getLang}`].required.$invalid && v$.candidateWorkExperienceModel[`position_${getLang}`].$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel[`position_${getLang}`].required.$message}}</span> -->
                    </div>
                </div>
            </div>
            <div  class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label><span class="text-danger">* </span>{{ $t('lang.user_profile_page_work_object') }}</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" v-model="candidateWorkExperienceModel[`object_${getLang}`]" type="text" placeholder="" >
                        <!-- <span v-if="v$.candidateWorkExperienceModel[`object_${getLang}`].required.$invalid && v$.candidateWorkExperienceModel[`object_${getLang}`].$dirty" style='color:red'>* {{ v$.candidateWorkExperienceModel[`object_${getLang}`].required.$message}}</span> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-12" v-if="showNoWorkExperience">
            <div class="col-md-12">
                <div class="form-group">
                    <label>სამუშაო გამოცდილების არ ქონის მიზეზი</label>
                    <div class="ls-inputicon-box">
                        <multiselect v-model="candidateWorkExperienceModel.no_reason" :options="cla.noExperienceReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                            <template slot="singleLabel" slot-scope="{ option }"></template>
                        </multiselect>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>დამატაბითი ინფორმაცია</label>
                    <textarea class="form-control" rows="3" v-model="candidateWorkExperienceModel[`no_reason_info_${getLang}`]" :placeholder="$t('lang.user_profile_page_medical_please_info')"></textarea>
                </div>
            </div>
        </div>
        <div v-if="candidateWorkExperienceModel.has_experience" class="col-lg-12 col-md-12">
            <div class="text-right ">
                <button class="btn btn-success"
                @click="addCandidateWorkExperience(candidateWorkExperienceModel)"
                title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_work_button_add_info') }}
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
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(item, index) in m">
                                <td>{{ item.no_reason[`name_${getLang}`] }}</td>
                                <td>{{(item[`no_reason_info_${getLang}`])?item[`no_reason_info_${getLang}`].substr(0, 30)+ '...':''  }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</template>
<script>
export default {
    props:{
        data: Object,

    },
    data() {
        return {
            m:null,
            cla: null,
            candidateWorkExperienceModel: {
                'has_experience':'',
                'work_experience':'',
                'position_ka':'',
                'position_en':'',
                'position_ru':'',
                'object_ka':'',
                'object_en':'',
                'object_ru':'',
                'no_reason':'',
                'no_reason_info_ka':'',
                'no_reason_info_en':'',
                'no_reason_info_ru':'',
            },
            showNoWorkExperience: false,
            showYesWorkExperience: false,
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    created(){
        this.m = this.data.model
        this.cla = this.data.cla
        // this.m.user_id = this.data.user_id
    },
    methods: {
        // async
        add(item){
            console.log('item',item);
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_candidate",
                data: {'model':item, 'type': 'general_work', 'user_id': this.data.user_id},

            })
            .then(function (response) {
                console.log(response.data);
                if (response.data.status == 200) {
                    currentObj.m = response.data.data;
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
        },
        addCandidateWorkExperience(workExperience){
            console.log('workExperience',JSON.parse(JSON.stringify(workExperience)));
            var data = JSON.parse(JSON.stringify(workExperience))
            if (data.has_experience.id == 1 && (data.work_experience == '' || data[`position_${this.getLang}`] == '' || data[`object_${this.getLang}`]== '')) {
                toast.error("სამუშაო გამოცდილების ყველ ველის შევსება სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return;
            }
            if (data.has_experience.id == 2 && data.no_reason == '') {
                toast.error("მიზეზის არქონის არჩევა სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return;
            }

            if (this.m.length > 0 && this.m[0].has_experience.id != data.has_experience.id) {
                this.$swal({
                    title: 'თქვენ უკვე შეავსეთ ზოგადი სამუშაო ინფორმაცია თუ ამ ცვლილებას დაეთანხმებით ავტომატურად წაიშლება წინა შევსებული ინფორმაცია. <br><p>გსურთ გაგრძელება?</p>',
                    showDenyButton: true,
                    confirmButtonText: 'კი',
                    denyButtonText: `არა`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.m.push(data)
                        this.add(data)
                        this.candidateWorkExperienceModel['work_experience'] = ''
                        this.candidateWorkExperienceModel[`position_${this.getLang}`] = ''
                        this.candidateWorkExperienceModel[`object_${this.getLang}`] = ''
                    } else if (result.isDenied) {
                        this.candidateWorkExperienceModel.has_experience = '';
                    }
                })
                return
            }
            this.m.push(data)
            this.add(data)
            this.candidateWorkExperienceModel['work_experience'] = ''
            this.candidateWorkExperienceModel[`position_${this.getLang}`] = ''
            this.candidateWorkExperienceModel[`object_${this.getLang}`] = ''
        },
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
                        data: {'id':id, 'type':'general_work'},

                    })
                    .then(function (response) {
                        // console.log(response.data);
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
    watch:{
        'candidateWorkExperienceModel.has_experience.id': function(newVal, oldVa){
            console.log('newVal', newVal);
            if (newVal == 2) {
                this.showNoWorkExperience = true;
                this.showYesWorkExperience = false;
            }

            if(newVal == 1){
                this.showYesWorkExperience = true;
                this.showNoWorkExperience = false;
            }
        }
    },
}
</script>
<style lang="">

</style>
