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
    // console.log('props.data',props.data);
    const vacancy = {...props.data.model.vacancy}

    // const formData = () => {
    //     let [datePart, timePart] = vacancy.interview_date.split(' ');
    //     const { id: employer_id, ...employerWithoutId } = vacancy.employer;
    //     const { id: demand_id , ...demandWithoutId } = vacancy.demand;
    //     console.log(employerWithoutId);
    //     const data = {
    //         ...employerWithoutId,
    //         ...vacancy,
    //         ...demandWithoutId,
    //         characteristic:vacancy.characteristic,
    //         vacancy_duty: vacancy.vacancy_duty,
    //         vacancy_for_who_need: vacancy.vacancy_for_who_need,
    //         vacancy_benefit: vacancy.vacancy_benefit,
    //         interviewDate:datePart,
    //         interviewTime:timePart,
    //         driving_license: vacancy.vacancy_driving_license
    //     };
    //     data.employer_id = employer_id
    //     data.demand_id = demand_id

    //     data.name = data[`name_${getLang.value}`];
    //     data.address = data[`address_${getLang.value}`];
    //     data.street = data[`street_${getLang.value}`];
    //     data.number_code = cla.value.numberCode.find(element => element.phonecode == 995);

    //     data.additional_schedule = data[`additional_schedule_${getLang.value}`];
    //     data.title = data[`title_${getLang.value}`];
    //     data.category_id = data.category
    //     data.work_schedule_id = data.work_schedule
    //     data.currency_id = data.currency
    //     data.term_id = data.term
    //     data.interview_place_id = data.interview_place
    //     data.go_vacation = data.go_vacation == 0 ? false : true;
    //     data.stay_night = data.stay_night == 0 ? false : true;
    //     data.work_additional_hours = data.work_additional_hours == 0 ? false : true;

    //     data.education_id = data.education
    //     data.language_id = data.language
    //     data.language_level_id = data.language_level
    //     data.specialty_id = data.specialty
    //     data.has_experience = data.has_experience == 0 ? false : true;
    //     data.has_recommendation = data.has_recommendation == 0 ? false : true;


    //     data.lang = getLang.value;
    //     data.getLang = getLang.value;
    //     data.number_code = cla.value.numberCode.find(element => element.phonecode == 995);

    //     return data;
    // }

    // const model = {...formData()}
    // const m = ref(model)
    // console.log(m.value);




    // const benefitText = ref(vacancy.vacancy_benefit ? vacancy.vacancy_benefit.map(i => i[`name_${getLang.value}`]).join(', '): '');
    // const  localText = () => {
    //     return  {
    //         '1':{
    //             ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
    //             en:'',
    //             ru:'',
    //         },
    //         '2':{
    //             ka:'ორშაბათი_დან პარასკევის ჩათლით, 09:00_დან 18:00_მდე',
    //             en:'',
    //             ru:'',
    //         },
    //         '3':{
    //             ka:'ორშაბათი_დან პარასკევის ჩათლით, 08:00_დან 13:00_მდე',
    //             en:'',
    //             ru:'',
    //         },
    //         '4':{
    //             ka:'ორშაბათი_დან პარასკევის ჩათლით, 13:00_დან 17:00_მდე',
    //             en:'',
    //             ru:'',
    //         },
    //         '5':{
    //             ka:'ორშაბათი_დან პარასკევის ჩათლით, 21:00_დან 07:00_მდე',
    //             en:'',
    //             ru:'',
    //         },
    //         '6':{
    //             ka:'შაბათი და კვირა, 09:00_დან 18:00_მდე',
    //             en:'',
    //             ru:'',
    //         },
    //         '7':{
    //             ka:'ორშაბათი, ოთხშაბათი, პარასკევი, 09:00_დან 18:00_მდე',
    //             en:'',
    //             ru:'',
    //         },
    //         '8':{
    //             ka:'ხვალ, 09:00_დან 18:00_მდე',
    //             en:'',
    //             ru:'',
    //         },
    //         '9':{
    //             ka:'ორშაბათი, ხუთშაბათი, შაბათი, 09:00_დან 18:00_მდე',
    //             en:'',
    //             ru:'',
    //         },

    //     }
    // };

    // const rules = {
    //             name: { required },
    //             number: { required, numeric },
    //             address: { required },
    //             email: { email },
    //             category_id: { required },
    //             payment: { required },
    //             currency_id: { required },
    //             work_schedule_id: { required },
    //             additional_schedule: { required },
    //             start_date: { required },
    //             term_id: { required },
    //         vacancy_for_who_need: { required }

    // };
    // const v = useVuelidate(rules, m);
    // const watchWorkSchedule = () => m.value.work_schedule_id;
    // watch(watchWorkSchedule, (newVal) => {

    //     if (newVal != '') {
    //         m.value.additional_schedule = localText()[`${newVal.id}`][`${getLang.value}`]
    //         const priceMap = {
    //             1: 1100,
    //             2: 1300,
    //             3: 500,
    //             4: 500,
    //             5: 900,
    //             6: 500,
    //             7: 700,
    //             8: 50,
    //             9: 600,
    //             // Add more cases as needed
    //         };

    //         let price = priceMap[newVal.id] || 0;
    //         m.payment = price;
    //     }
    // });

    // const watchCategory = () => m.value.category_id;
    // watch(watchCategory, (newVal) => {
    //     cla.value.forWhoNeed = _.filter(props.data.classificatory.forWhoNeed, function(o) { return o.category_id == newVal.id; });
    //     cla.value.duty = _.filter(props.data.classificatory.duty, function(o) { return o.category_id == newVal.id; });
    // });

    // const startDate = (item) =>{
    //     console.log('item', item);
    //     maxDate.value = item
    // }

    // const chooseNumberCode = (item) =>{
    //     model.value.number_code = item
    // };
    // const handleFileChange = (event) => {
    //     file.value = event.target.files[0];
    //     model.value.file_name = file.value.name
    // };
    // const addBenefit = (item) => {
    //     if (!m.value.vacancy_benefit.some((benefit) => benefit.id == item.id)) {
    //         m.value.vacancy_benefit.push(item)
    //        benefitText.value += `${item[`name_${getLang.value}`]}, `;
    //     }
    // };

    // const minAge = (item) =>{

    //     const numberAsString = item.toString();
    //     if (numberAsString.length == 2) {
    //         min_age = item
    //     }else if(numberAsString.length > 2){
    //         m.value.demand.min_age = min_age
    //     }
    //     if (numberAsString.length == 2 && item < 18) {
    //         m.value.demand.min_age = 18
    //         toast.error("მინიმალური ასაკი არ უნდა იყოს 18 ზე ნაკლები", {
    //             theme: 'colored',
    //             autoClose: 1000,
    //         });
    //         return
    //     }
    // }

    // const maxAge = (item) =>{

    //     const numberAsString = item.toString();
    //     if (numberAsString.length == 2) {
    //         max_age = item
    //     }else if(numberAsString.length > 2){
    //         m.value.demand.max_age = max_age
    //     }
    //     if (numberAsString.length == 2 && item > 70) {
    //         m.value.demand.max_age = 70
    //         toast.error(`მაქსიმალური ასაკი არ უნდა იყოს 70 ზე მეტი`, {
    //             theme: 'colored',
    //             autoClose: 1000,
    //         });
    //         return
    //     }
    // }

    // const forItem = (item) => {
    //     var editedFields = {};
    //     for (const field in item) {
    //         const rawValue = item[field]; // Extract the raw value from a ref

    //         if (rawValue !== model[field]) {
    //             console.log('rawValue', rawValue);
    //             console.log('model[field]', model[field]);
    //             // return
    //             editedFields[field] = rawValue;
    //         }
    //     }
    //     console.log('item',item);
    //     console.log('editedFields',editedFields);
    //     return
    //     return editedFields;
    // };

    // const add = (item) =>{
    //     let data = JSON.parse(JSON.stringify(item))
    //     // if (file.value != null && file.value.type !== 'application/pdf') {
    //     //     toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
    //     //         theme: 'colored',
    //     //         autoClose: 1000,
    //     //     });
    //     //     return
    //     // }
    //     // if (data.has_recommendation.id == 1) {
    //     //     data[`name_${getLang.value}`] = data.name;
    //     //     data[`position_${getLang.value}`] = data.position;
    //     // }else{
    //     //     data[`no_reason_info_${getLang}`] = data.no_reason_info;
    //     // }
    //     // data.candidate_id = props.data.candidate_id
    //     // const sendFormData = new FormData();
    //     // sendFormData.append('data', JSON.stringify(data))
    //     // if (file.value) {
    //     //     sendFormData.append('file', file.value);
    //     // }

    //     // loader.value = true
    //     data[`name_${getLang.value}`] = data.name
    //     data[`address_${getLang.value}`] = data.address
    //     data[`street_${getLang.value}`] = data.street
    //     data[`additional_schedule_${getLang.value}`] = data.additional_schedule

    //     v.value.$touch();
    //     if (!v.value.$invalid) {
    //         let editedFields = forItem(data)
    //         let html =  `
    //             ${data.start_date}_დან ${data.term_id[`name_${getLang.value}`]},
    //             ${(data[`for_who_${getLang.value}`])?data[`for_who_${getLang.value}`]:''}
    //             გვესაჭიროება ${data.category_id[`name_${getLang.value}`]}.
    //             მისამართი: ${data[`address_${getLang.value}`]} ${data[`street_${getLang.value}`]},
    //             გრაფიკი: ${data.work_schedule_id[`name_${getLang.value}`]},
    //             ${data[`additional_schedule_${getLang.value}`]}.
    //             ანაზღაურება: ${data.payment} ${data.currency_id[`name_${getLang.value}`]}.
    //             მოვალეობები: ${data.vacancy_duty.map(i => i[`name_${getLang.value}`]).join(', ')}
    //         `;
    //         Swal.fire({
    //             title: '<p>თქვენი ვაკანსია</p>',
    //             // icon: 'info',
    //             html:html,
    //             showCloseButton: true,
    //             showCancelButton: false,
    //             focusConfirm: false,
    //             confirmButtonText: 'რედაქტირება',
    //             // icon: 'success',
    //             customClass: {
    //                 confirmButton: 'btn btn-success',
    //                 cancelButton: 'btn btn-danger',
    //             },
    //             width: '60%'
    //         }).then((result) => {
    //             /* Read more about isConfirmed, isDenied below */
    //             if (result.isConfirmed) {

    //                 validateAndSubmit(data, editedFields)
    //             }
    //         })


    //     }else{
    //         loader.value = false
    //         toast.warning("აუცილებელია სავალდებულო ველები იყოს შევსებული", {
    //             theme: 'colored',
    //             autoClose: 2000,
    //         });
    //     }
    // }
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
        console.log('handler item', item);
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
