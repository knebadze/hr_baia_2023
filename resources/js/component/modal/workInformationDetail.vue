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
                            <select class="form-select form-select-lg border-0 rounded " v-model="m.workInformation.category_id" style="background-color: #f0f6fe;" name="" id="">
                                <option class="mb-2" v-for="category in classificator.category" :value="category.id">{{ category[`name_${getLang}`] }}</option>
                            </select>
                            <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ 'სამუშაო გრაფიკი' }}</label>
                        <div class="ls-inputicon-box">
                            <select class="form-select form-select-lg border-0 rounded " v-model="m.workInformation.work_schedule_id" style="background-color: #f0f6fe;" name="" id="">
                                <option class="mb-2" v-for="workSchedule in classificator.workSchedule" :value="workSchedule.id">{{ workSchedule[`name_${getLang}`] }}</option>
                            </select>
                            <!-- <i class="fs-input-icon fa fa-smoking"></i> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ 'რომელი სათიდან?' }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" type="time" step="1" v-model="m.workInformation.from_hour">

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ 'რომელი სათამდე?' }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" type="time" step="1" v-model="m.workInformation.to_hour">

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ 'ანაზღაურება' }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" type="number" step="50" v-model="m.workInformation.payment">
                            <i class="fs-input-icon fa fa-money"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ 'ვალუტა' }}</label>
                        <div class="ls-inputicon-box">
                            <select class="form-select form-select-lg border-0 rounded " style="background-color: #f0f6fe;" v-model="m.workInformation.currency_id"  name="" id="">
                                <option class="mb-2" v-for="currency in classificator.currency" :value="currency.id">{{ currency[`name_${getLang}`] }}</option>
                            </select>
                            <i class="fs-input-icon fa fa-usd"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="text-right">
                        <button type="submit" @click.prevent="updateWorkInformation()"  class="site-button">{{ 'განახლება' }}</button>
                    </div>
                </div>

            </div>
            <!--რეკომენდაცია-->
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_recomendation_title') }}</h4>
                </div>
                <div class="panel-body wt-panel-body p-a20 m-b30 ">

                    <div class="row">
                        <div   class="col-lg-12 col-md-12">
                            <div class="panel-body wt-panel-body">
                                <div class="p-a20 table-responsive">
                                    <table v-if="m.recommendation[0].recommendation == 1" class="table twm-table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                            <th>N</th>
                                            <th>საიდან?</th>
                                            <th>სახელი გვარი</th>
                                            <th>ნომერი</th>
                                            <th>თანამდებობა</th>
                                            <th>ფაილი</th>
                                            <th>action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(item, index) in m.recommendation">
                                            <td>{{ index + 1 }}</td>
                                            <td><span :class="(item.recommendation_from_whom_id == 1)?'badge bg-success p-2':'badge bg-info text-dark p-2'">{{ item.recommendation_whom[`name_${getLang}`] }}</span></td>
                                            <td>{{ item.name }}</td>
                                            <td>{{ item.number }}</td>
                                            <td>{{ item.position }}</td>
                                            <td>{{ item.file }}</td>
                                            <td>
                                                <button type="button" title="ჩასწორება" data-bs-toggle="tooltip" data-bs-placement="top" @click="openModal(item)">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                                <button @click="removeRow(index, item.id)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <table v-else class="table twm-table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                            <th>რეცომენდაცია</th>
                                            <th>მიზეზი</th>
                                            <th>დამატებითი ინფორმაცია</th>
                                            <th>action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="(item, index) in m.recommendation">
                                            <td><span class="badge bg-danger p-2">{{ (item.recommendation == 2)?'ვერ წარმოვადგენ':'წარმოვადგენ' }}</span></td>
                                            <td>{{ item.recommendation_reason[`name_${getLang}`] }}</td>
                                            <td>{{ item.no_reason_info.substr(0, 30)+ '...'}}</td>
                                            <!-- <td>{{ item.position }}</td> -->
                                            <!-- <td>{{ item.file }}</td> -->
                                            <td>
                                                <button type="button" title="ჩასწორება" data-bs-toggle="tooltip" data-bs-placement="top" @click="openModal(item)">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                                <button @click="removeRow(index, item.id)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
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

        </div>
        <!-- <div  class="modal-footer">
            <button type="" class="site-button" >{{ 'განახლება'}}</button>
        </div> -->
        </div>
    </div>
</div>
<editRecommendation :visible="showEditModal" :data="editModalData"></editRecommendation>
</template>
<script>
import editRecommendation from './editRecommendation.vue'
export default {
    components:{
        editRecommendation
    },
    props:{
        visible: Boolean,
        data: Object,
        classificator:Object
    },
    data() {
        return {
            m:null,
            showConfirm: false,
            showEditModal: false,
            editModalData:{}
        }
    },
    created(){
        // this.showConfirm = this.visible
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
        show(){
            this.showConfirm = true
            this.m = {...this.data}
            console.log('this.m',this.m);
        },
        hide(){
           this.showConfirm = false
           this.sendMessageToParent(this.showConfirm)
        },
        sendMessageToParent(arg){
            this.$emit('messageFromChild', arg)
        },
        openModal(item){
            this.showEditModal = !this.showEditModal
            this.editModalData = {
                'item': item,
                'classificator': {
                    'recommendationFromWhom':this.classificator.recommendationFromWhom,
                    'noRecommendationReason': this.classificator.noRecommendationReason,
                },
            }
            console.log('this.editModalData', this.editModalData);
        },
        updateWorkInformation(){
            axios({
                method: "post",
                url: "/update_work_information",
                data: this.m.workInformation,

            })
            .then(function (response) {

                // handle success
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    toast.success("წარმატებით განახლდა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    // setTimeout(() => {
                    //     document.location.reload();
                    // }, 1500);
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
            console.log('this.classificator', this.classificator);
            this.show()

        },
    }
}
</script>
<style lang="">

</style>
