<template lang="">
    <div>
        <!-- LOADING AREA START ===== -->
        <loading
            :active="loader"
            :can-cancel="true"
            color="#01ecd5"

            :is-full-page="fullPage"
        />
        <!-- LOADING AREA  END ====== -->
        <update_form :item="data" :cla="cla" @emitUpdateData="handlerUpdate"/>
    </div>
</template>
<script>
import _ from 'lodash';
import { ref, computed } from 'vue';
import { I18n } from 'laravel-vue-i18n';
// import { useVuelidate } from '@vuelidate/core';
// import { required, numeric, maxLength, email } from '@vuelidate/validators';
import Swal from 'sweetalert2';
// import moment from 'moment';
import update_form from '../components/update_vacancy/update_form.vue';

 // Import component
 import Loading from 'vue3-loading-overlay'
    // Import stylesheet
    import 'vue3-loading-overlay/dist/vue3-loading-overlay.css';
export default {
    components:{
        update_form,
        loading: Loading
    },
    props: {
        data: Object,
    },
setup(props) {
    const getLang = computed(() => {
        return I18n.getSharedInstance().options.lang;
    });
    // const minDate = computed(() => moment().format('YYYY-MM-DD'));
    // const maxDate = ref(null);
    // let min_age, max_age = null;
    // const workInformationSchedule = ref(null);
    const loader = ref(false);
    const fullPage = ref(true);
    const send = ref(false);
    const cla = ref(_.cloneDeep(props.data.classificatory));
    cla.value.workSchedule = props.data.classificatory.workSchedule.filter(item => item.id !== 10 && item.id !== 11);
    const vacancy = {...props.data.model.vacancy}


    const showAlert = () => {
        //let html =  `ეწვიეთ ლინკს სადაც შეგიძლიათ მიიღოთ ინფორმაცია თქვენი ვაკანსიის შესახებ, თქვენი ტელეფონის ნომრის გამოყენებით`;
        Swal.fire({
                    title: '<strong>ვაკანსია წარმატებით დარედაქტირდა</strong>',
                    icon: 'success',
                    html:'',

                    showCloseButton: false,
                    confirmButtonText: 'მთავარზე დაბრუნება',
                    showCancelButton: false,
                    focusConfirm: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back();

                    }

                })
    };

    const update = (model) => {
        send.value = true
        loader.value = true
        axios.post('/update_vacancy' ,{
            data: model,
        })
        .then(function (response) {
            if (response.status == 200) {
                toast.success("წარმატებით დარედაქტირდა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                loader.value = false
                showAlert()
            }
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    };
    const handlerUpdate = (item) =>{
        update(item);
    };



    return {
        cla,
        handlerUpdate,
        getLang,
        loader,
        fullPage

    };
},
methods: {


},
};
</script>
<style lang="">

</style>
