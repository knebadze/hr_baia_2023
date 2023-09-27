<template lang="">
  <!-- Modal -->
  <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">ინფორმაცია</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()"></button>
            </div>
            <div class="modal-body">
                <p>გილოცავთ თქვენ გაირეთ რეგისტრაციის ეტაპი!!!</p>
                <p>ვინაიდან თქვენ რეგისტრაციისთვის გამოიყენეთ სოციალური ქსელი ჩვენ არ ვიცით ვინ ხართ კანდიდატი თუ დამსაქმებელი?</p>
                <ul class="nav d-flex justify-content-between mb-4" id="myTab" role="tablist">

                    <!--Signup Candidate-->
                    <li class="nav-item" role="presentation">
                        <button :class="candidateButton"  id="candidateEvent" @click="buttonAction('candidate')"  type="button"><i class="fas fa-user-tie"></i> {{ $t('lang.modal_registration_candidate') }}</button>
                    </li>
                    <!--Signup Employer-->
                    <li class="nav-item" role="presentation">
                        <button :class="employerButton" id="employerEvent"  @click="buttonAction('employer')"  type="button"><i class="fas fa-building"></i> {{ $t('lang.modal_registration_employer') }}</button>
                    </li>

                </ul>
                <ul v-if="employerSection" class="nav d-flex justify-content-between mb-4" id="myTab" role="tablist">

                    <!--Signup Candidate-->
                    <li class="nav-item" role="presentation">
                        <button :class="personButton"  id="candidateEvent"  @click="buttonAction('person')" type="button"><i class="fas fa-user-tie"></i> {{ $t('lang.modal_registration_physical_person') }}</button>
                    </li>
                    <!--Signup Employer-->
                    <li class="nav-item" role="presentation">
                        <button :class="companyButton" id="employerEvent"  @click="buttonAction('company')"  type="button"><i class="fas fa-building"></i> {{ $t('lang.modal_registration_company') }}</button>
                    </li>

                </ul>
            </div>
            <div v-if="footerSection" class="modal-footer">
                <button type="button" class="btn btn-success" @click.prevent="save(updateData)" ><i class=""></i>დასრულება</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
export default {
    props:{
        visible: Boolean,
    },
    data() {
        return {
            showConfirm: true,
            candidateButton: 'btn btn-outline-info',
            employerButton: 'btn btn-outline-info',
            employerSection: false,
            footerSection: false,
            personButton: 'btn btn-outline-secondary',
            companyButton: 'btn btn-outline-secondary',
            updateData:'',
        }
    },
    created(){
        // this.showConfirm = this.visible
    },
    computed:{

    },
    methods:{
        show(){
            this.showConfirm = true
        },
        hide(){
           this.showConfirm = false
        },
        buttonAction(key){
            if (key == 'candidate') {
                this.candidateButton = 'btn btn-info';
                this.employerButton = 'btn btn-outline-info';
                this.employerSection = false;
                this.footerSection = true;
                this.updateData = key
            }else if(key == 'employer'){
                this.employerButton = 'btn btn-info'
                this.candidateButton = 'btn btn-outline-info'
                this.employerSection = true
                this.footerSection = false
            }else if(key == 'person'){
                this.personButton = 'btn btn-secondary'
                this.companyButton = 'btn btn-outline-secondary'
                this.footerSection = true;
                this.updateData = key
            }else if(key == 'company'){
                this.companyButton = 'btn btn-secondary'
                this.personButton = 'btn btn-outline-secondary'
                this.footerSection = true;
                this.updateData = key
            }
        },
        save(updateData){
            axios.post('/unknown_profile_update' ,{
                data: updateData,
            })
            .then(function (response) {
                // handle success
                if (response.status == 200) {
                    toast.success("წარმატებით დაემატა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    setTimeout(() => {
                        document.location.reload();
                    }, 2000);
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
            this.show()
        },
    }
}
</script>
<style lang="">

</style>
