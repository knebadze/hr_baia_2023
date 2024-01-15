<template lang="">
    <div id="accordion" >
        <div class="card card-primary" >
            <div class="card-header">
            <h4 class="card-title w-100 d-flex justify-content-between">
                <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                    სარეგისტრაციო ინფორმაცია
                </a>
                <i class="fas fa-angle-down float-right"></i>
            </h4>
            </div>
            <div id="collapseOne" class="collapse" :class="addUserColspan" data-parent="#accordion" >
                <div class="card-body">
                    <Add_user :data="addUserData" ></Add_user>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import Add_user from '../component/add_user.vue';
export default {
    components:{
        Add_user,
    },
    props:{
        data: Object
    },
    emits: ['messageFromChild'],
    data() {
        return {
            candidateInfoSave:false,
            candidateLanguageSave:false,
            candidate_id:null

        }
    },

    computed:{
        addUserColspan(){
            return 'show'
            // (this.data.model.candidate_information.user.id == '')?'show':'hide'
        },
        addUserData(){
            return {
                // 'user_id': this.data.basic.auth.id,
                'model': '',
                'cla': {
                    'gender': this.data.classificatory.gender,
                }
            }
        },


    },
    created() {
        // this.data.model.candidate_information.candidate.id = 4
    },
    methods: {
        handleMessageFromChildren(item) {
        // Handle the emitted event
            this.candidate_id = item
        },
    },
}
</script>
<style lang="">

</style>
