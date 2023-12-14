<template lang="">
    <div class="twm-error-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="twm-error-content">
                    <h4 class="twm-error-title2 site-text-primary">მიიღეთ ინფორმაციაა თქვენს ვაკანსიაზე</h4>
                    <p>გამოიყენეთ თქვენის მიერ ვაკანსიაში მითითებული ტელეფონის ნომერი.</p>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="twm-error-image">
                    <div class="twm-bnr-search-bar">
                        <form>
                            <div class="row">

                                <!--Location-->
                                <div class="form-group  col-md-9">
                                    <label>{{ ('ტელეფონის ნომერი') }}</label>
                                    <div class="twm-inputicon-box">
                                        <input v-model="number" type="text"  required class="form-control" :placeholder=" $t('მაგ:555321065')" onkeypress="return /[0-9]/i.test(event.key)">

                                    </div>
                                </div>

                                <!--Find job btn-->
                                <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                    <button type="button" class="site-button" @click="verify()">{{ $t('lang.welcome_leftside_bar_search_job_location_job_search_button') }}</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <verify_code_div :visible="showVerifyCodeInput" :verifyNumber="verifyNumber" @sendParentAction="handlerAction"/>
            <my_vacancy_table v-if="tableData" :items="tableData"/>


        </div>
    </div>
    <!-- <interest_modal :visible="showInterestModal" :id="vacancyId"></interest_modal> -->
</template>
<script>
// import interest_modal from '../modal/interest_modal.vue'
import verify_code_div from '../components/verify_code_div.vue';
// import show_update_vacancy from '../show_update_vacancy.vue';
import my_vacancy_table from '../components/my_vacancy/my_vacancy_table.vue';
import { ref, computed } from 'vue';
import Swal from 'sweetalert2';

export default {
    components:{
        my_vacancy_table,
        // show_update_vacancy,
        verify_code_div
    },
    props:{
        // data: Object
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });

        const number = ref(null);
        const showVerifyCodeInput = ref(false);
        const verifyNumber = ref(null);
        const tableData = ref(null);

        const verify = () =>{
            axios({
                method: "post",
                url: '/check_and_verify_number',
                data: {'number':number.value},

            })
            .then(function (response) {
                console.log('response.data',response.data);
                if (response.data.type == 's') {
                    showVerifyCodeInput.value = !showVerifyCodeInput.value
                    verifyNumber.value = response.data.randomNumber
                }else{
                    Swal.fire({
                        title: '<strong>თქვენ არ გაქვთ აქტიური ვაკანსია</strong>',
                        icon: 'info',
                        html:'დასამატებლად გთხოვთ გამოიყენოთ ღილაკი დამატება',

                        showCloseButton: true,
                        confirmButtonText: 'დამატება',
                        showCancelButton: false,
                        focusConfirm: false,
                    }).then((result) => {
                        let url = new URL( location.href)
                        if (result.isConfirmed) {
                            window.location.replace( `${url.origin}/ka/post_job`);
                        }else{
                            window.location.replace( `${url.origin}/ka`);
                        }

                    })
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };

        const find = () =>{
            console.log(number.value);
            axios({
                    method: "post",
                    url: '/find_my_vacancy',
                    data: {'number':number.value},

                })
                .then(function (response) {
                    console.log('response.data',response);
                    tableData.value = response.data

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        };

        const handlerAction = () =>{
            showVerifyCodeInput.value = false
            find()
        };

        return{
            getLang,
            number,
            verify,
            showVerifyCodeInput,
            verifyNumber,
            handlerAction,
            tableData
        }
    },
    // data() {
    //     return {
    //         search:null,
    //         vacancy:null,
    //         interest:null,
    //         showInterestModal: false,
    //         vacancyId:null
    //     }
    // },
    // methods: {

    //     find(){
    //         let currentObj = this;
    //         axios({
    //                 method: "post",
    //                 url: '/find_my_vacancy',
    //                 data: {'code':this.search},

    //             })
    //             .then(function (response) {
    //                 console.log('response.data',response.data);
    //                 currentObj.vacancy = response.data.data.vacancy
    //                 // currentObj.interest = response.data.interest

    //             })
    //             .catch(function (error) {
    //                 // handle error
    //                 console.log(error);
    //             })
    //     },
    //     showInterest(id){
    //         this.vacancyId = id
    //         this.showInterestModal = !this.showInterestModal
    //     },


    // },
    // mounted(){
    // }

}
</script>
<style lang="">

</style>
