<template lang="">
    <!-- Modal -->
<div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLongTitle">ინფორმაცია</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
        </div>
        <div class="modal-body">
            <div class="row" v-if="type == 'category'">
                <div class="col-md-6">
                    <dl>
                        <dt>კატეგორია:</dt>
                        <dd>{{ items.category.name_ka }}</dd>
                        <dt>სამუშაო გრაფიკი:</dt>
                        <dd>{{ items.get_work_schedule.map(i => i.work_schedule.name_ka).join(', ') }}</dd>

                        <dt>ანაზღაურება:</dt>
                        <dd>{{ items.payment+' '+items.currency.name_ka }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl>
                        <dt v-if="items.additional_name_ka">დამატებითი სამუშაო გრაფიკი:</dt>
                        <dd>{{ items.additional_name_ka }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row" v-if="type == 'general_work'">
                <div class="col-md-6" v-for="item in items">
                    <dl>
                        <dt>პოზიცია:</dt>
                        <dd>{{ item.pivot.position_ka }}</dd>
                        <dt>ობიექტი:</dt>
                        <dd>{{ item.pivot.object_ka }}</dd>

                        <dt>გამოცდილება:</dt>
                        <dd>{{ item.name_ka }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row" v-if="type == 'family_work'">
                <div class="col-md-6" >
                    <dl>
                        <dt>რამდენ ოჯახში გიმუშავია:</dt>
                        <dd>{{ items.families_worked_count+' ოჯახში' }}</dd>
                        <dt>გამოცდილება (ჯამში):</dt>
                        <dd>{{ items.work_experience.name_ka }}</dd>

                    </dl>
                </div>
                <div class="col-md-6" >
                    <dl>
                        <dt>ოჯახში მუშაობდით:</dt>
                        <dd><span v-for="(item, index) in familyWorkSkill.category" :key="index">{{ item+', ' }}</span></dd>
                        <dt>აქედან ყველაზე ხანგრძლივად:</dt>
                        <dd>{{ items.longest.name_ka }}</dd>
                    </dl>
                </div>

                <div class="col-md-12" >
                    <hr>
                    <dl>
                        <dt>გევალებოდათ:</dt>
                        <dd>
                            <span class="badge badge-info mr-2" v-for="(item, index) in items.family_work_duty" :key="index">{{ item.name_ka+', ' }}</span>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="row" v-if="type == 'recommendation'">
                <div class="col-md-6" v-for="(item, index) in items" :key="index">
                    <dl>
                        <dt>საიდან:</dt>
                        <dd>{{ item.name_ka }}</dd>
                        <dt>რეკომენდატორის სახელი გვარი:</dt>
                        <dd>{{ item.pivot.name_ka }}</dd>

                        <dt v-if="item.pivot.recommendation_from_whom_id == 2">თანამდებობა:</dt>
                        <dd v-if="item.pivot.recommendation_from_whom_id == 2">{{ item.pivot.position_ka }}</dd>
                        <dt>რეკომენდატორის ნომერი:</dt>
                        <dd>{{ item.pivot.number}}</dd>
                    </dl>
                </div>
            </div>


        </div>
        <div  class="modal-footer">
            <button type="button" class="btn btn-success" @click="hide()" ><i class=""></i>გაუქმება</button>
        </div>
        </div>
    </div>
</div>

</template>
<script>
import _ from 'lodash'
export default {
props:{
   visible: Boolean,
   type: String,
   items: Object
},
data() {
    return {
        showConfirm: false,
        workInfo:{},
        // getData:{}
        familyWorkSkill:{}
    }
},
created(){
//    this.showConfirm = this.visible

},
methods:{
    show(){
       this.showConfirm = true
        // if(this.type == 'category'){
        //     let id = this.items.pivot.candidate_id
        //     let category_id = this.items.id
        //     this.getWorkInfo(id, category_id)
        // }
        // if (this.type == 'family_work') {
        //     let id = this.items.candidate_id
        //     this.getFamilyWorkInfo(id)
        // }
       console.log('data', this.items);
       console.log('type', this.type);
    },
    hide(){
        this.showConfirm = false
    },
    // getWorkInfo(id, category_id){
    //     let currentObj = this;

    //     console.log('id', id);
    //     axios({
    //         method: "post",
    //         url: "/candidate_work_info_data",
    //         data: {"id":id, 'category_id':category_id},

    //     })
    //     .then(function (response) {
    //         // handle success
    //         console.log('response.data',response.data);
    //         currentObj.workInfo = response.data

    //     })
    //     .catch(function (error) {
    //         // handle error
    //         console.log(error);
    //     })
    // },
    // getFamilyWorkInfo(id){
    //     let currentObj = this;

    //     console.log('id', id);
    //     axios({
    //         method: "post",
    //         url: "/candidate_family_work_info_data",
    //         data: {"id":id},

    //     })
    //     .then(function (response) {
    //         // handle success
    //         console.log('response.data',response.data);
    //         let category = [...new Set( _.map(response.data, 'category'))]
    //         currentObj.familyWorkSkill = {'category': category, 'skill':_.map(response.data, 'skill')}

    //     })
    //     .catch(function (error) {
    //         // handle error
    //         console.log(error);
    //     })
    // }

},
watch:{
   visible: function(){
       this.show()
   },
}
}
</script>
<style lang="">

</style>
