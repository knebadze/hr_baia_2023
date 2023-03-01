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
                            <select class="form-select form-select-lg border-0 rounded " v-model="m.workInformation.currency_id" style="background-color: #f0f6fe;" name="" id="">
                                <option class="mb-2" v-for="currency in classificator.currency" :value="currency.id">{{ currency[`name_${getLang}`] }}</option>
                            </select>
                            <i class="fs-input-icon fa fa-usd"></i>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <p>რეკომენდაცია</p>
            <div  class="col-lg-12 col-md-12">
                <div class="panel-body wt-panel-body">
                    <div class="p-a20 table-responsive">
                        <table class="table twm-table table-striped table-borderless">
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
                                <!-- <td><span :class="(item.recommendation_from_whom_id == 1)?'badge bg-success p-2':'badge bg-info text-dark p-2'">{{ item.recommendation_whom[`name_${getLang}`] }}</span></td> -->
                                <td>{{ item.name }}</td>
                                <td>{{ item.number }}</td>
                                <td>{{ item.position }}</td>
                                <td>{{ item.file }}</td>
                                <td>
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
        <div  class="modal-footer">
            <button type="" class="site-button" >{{ 'განახლება'}}</button>
        </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    props:{
        visible: Boolean,
        m: Object,
        classificator:Object
    },
    data() {
        return {
            showConfirm: false,
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
        },
        hide(){
           this.showConfirm = false
           this.sendMessageToParent(this.showConfirm)
        },
        sendMessageToParent(arg){
            this.$emit('messageFromChild', arg)
        }
    },
    watch:{
        visible: function(){
            console.log('showConfirm', this.showConfirm);
            this.show()
        },
    }
}
</script>
<style lang="">

</style>
