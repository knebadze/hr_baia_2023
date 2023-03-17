<template lang="">
        <!-- Modal -->
<div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLongTitle">სამუშაო ინფორმაციის დეტალები</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()"></button>
        </div>
        <div class="modal-body">
            <!--personal information-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ 'კატეგორია' }}</label>
                        <div class="ls-inputicon-box">
                            <!-- <select class="form-select form-select-lg border-0 rounded " v-model="m.workInformation.category_id" style="background-color: #f0f6fe;" name="" id="">
                                <option class="mb-2" v-for="category in classificator.category" :value="category.id">{{ category[`name_${getLang}`] }}</option>
                            </select> -->
                            <multiselect v-model="m.category" :options="data.classificator.category" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ 'სამუშაო გრაფიკი' }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.work_schedule"  :options="data.classificator.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name_ka" track-by="name_ka" :preselect-first="false">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                </multiselect>
                                <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" v-if="showAdditionalSchedule">
                        <div class="form-group">
                            <label>სასურველი სამუშაო გრაფიკი</label>
                            <textarea class="form-control" rows="3" v-model="m[`additional_schedule_${getLang}`]" placeholder="ჩაწერეთ სასურველი სამუშაო დღეები და საათები"></textarea>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ 'ანაზღაურება' }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" type="number" step="50" v-model="m.payment">
                                <i class="fs-input-icon fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ 'ვალუტა' }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.currency" :options="data.classificator.currency" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <!-- <i class="fs-input-icon fa fa-usd"></i> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div v-if="m.no_family_has_work_experience && m.no_family_has_work_experience.length != 0" class="col-lg-12 col-md-12">

                        <div class="panel-body wt-panel-body">
                            <div class="p-a20 table-responsive">
                                <table class="table twm-table table-striped table-borderless" v-if="m.no_family_has_work_experience[0].pivot.work_experience_id == 1">
                                    <thead>
                                        <tr>
                                        <th>N</th>
                                        <th>{{ $t('lang.user_profile_page_work_exp') }}</th>
                                        <!-- <th>{{ $t('lang.user_profile_page_work_position') }}</th> -->
                                        <th>{{ $t('lang.user_profile_page_work_object') }}</th>
                                        <th>{{ $t('lang.user_profile_page_work_actions') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(item, index) in m.no_family_has_work_experience">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ item[`name_${getLang}`] }}</td>
                                        <td>{{ item.pivot[`object_${getLang}`] }}</td>
                                        <!-- <td><input type="text"></td> -->
                                        <td>
                                            <button @click="removeNWFE(index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button @click="removeNWFE(index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table twm-table table-striped table-borderless" v-if="m.no_family_has_work_experience[0].pivot.work_experience_id == 2">
                                    <thead>
                                        <tr>

                                        <th>არ ქონის მიზეზი</th>
                                        <th>დამატებითი ინფორმაცია</th>
                                        <th>action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(item, index) in m.no_family_has_work_experience">
                                            <td>{{ item.no_reason[`name_${getLang}`] }}</td>
                                            <td>{{(item[`no_reason_info_${getLang}`])?item[`no_reason_info_${getLang}`].substr(0, 30)+ '...':''  }}</td>
                                        <td>
                                            <button @click="removeNWFE(index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                            <!-- <button @click="removeRow('experience',index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="fa fa-trash-alt"></i>
                                            </button> -->

                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="text-right">
                        <button type="submit" @click.prevent="updateWorkInformation()"  class="site-button">{{ 'განახლება' }}</button>
                    </div>
                </div>

            </div>


        </div>
        <!-- <div  class="modal-footer">
            <button type="" class="site-button" >{{ 'განახლება'}}</button>
        </div> -->
        </div>
    </div>
</div>

</template>
<script>
import _ from 'lodash'
export default {
    components:{

    },
    props:{
        visible: Boolean,
        data: Object,
    },
    data() {
        return {
            m:null,
            showConfirm: false,
            newData: {},
        }
    },
    created(){
        // this.showConfirm = this.visible

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        showAdditionalSchedule(){
            return  _.find(this.data.item.work_schedule, function(o) { if(o.id == 9) return true; });

        }
    },
    methods:{
        show(){
            this.showConfirm = true
            this.m = {...this.data.item}
            console.log('this.m',this.m);
        },
        hide(){
           this.showConfirm = false
           this.sendMessageToParent(this.showConfirm)
        },
        sendMessageToParent(arg){
            this.$emit('messageFromChild', arg)
        },
        updateWorkInformation(){
            let currentObj = this;
            axios({
                method: "post",
                url: "/update_work_information",
                data: this.m,

            })
            .then(function (response) {

                // handle success
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    if (response.data.data.message) {
                        toast.error(response.data.data.message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }
                    toast.success("წარმატებით განახლდა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    currentObj.hide()
                    // currentObj.newData = response.data.data
                    setTimeout(() => {
                        document.location.reload();
                    }, 1500);
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
    watch:{
        visible: function(){
            console.log('this.data', this.data);
            this.show()

        },
    }
}
</script>
<style lang="">

</style>
