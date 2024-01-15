<template lang="">
    <div class="container-fluid">
    <div class="main">
        <div class="row parent">
            <div class="col-md-12 text-center">
                <h2 style="padding-bottom: 2%; padding-top: 2%;">ვაკანსიის დამატება </h2>
                <h5>ნომრის ვერიფიკაცია</h5>
            </div>
            <div class="col-xl-6 col-lg-8 col-md-12">
                <div class="form-group">
                    <label><span class="text-danger">* </span>{{ ('ტელეფონის ნომერი') }}</label>
                    <div class="input-group mb-3">
                        <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${m.number_code.iso.toLowerCase()}`"></span>+{{ m.number_code.phonecode }}</button>
                        <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                            <li v-for="item in cla" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                        </ul>
                        <input
                            type="text"
                            class="form-control"
                            :class="(m.number == null )?'is-invalid':''"
                            v-model="m.number"
                            placeholder="555666777"
                            onkeypress="return /[0-9]/i.test(event.key)">
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-4 col-md-12">
                <div class="form-group">
                    <label for=""></label>
                    <div class="input-group mb-3">
                        <button class="site-button" @click="send">გაგზავნა</button>
                    </div>
                </div>
            </div>
            <verify_code_div :visible="showVerifyCodeInput" :item="checkData"  @sendParentAction="handlerAction"/>
            <!-- <div class="col-xl-12 col-lg-12 col-md-12 " v-if="showVerifyCodeInput">
                <hr>
                <div class="text-center">
                    <p>შეიყვანეთ ვერიფიკაციის კოდი</p>
                </div>
                <div class="form-group">
                    <div class="input-group mt-3">
                        <CodeInput
                            :fields="5"
                            :fieldWidth="32"
                            :fieldHeight="32"
                            :required="true"
                            @change="onChange"
                            @complete="onComplete"
                        />
                        <p class="mr-2 countDownSeconds" style="">
                            {{ countdown }}
                        </p>
                    </div>
                    <p class="text-danger" v-if="showError">კოდი არასწორია!</p>
                </div>
            </div> -->
        </div>
    </div>
</div>
</template>
<script>
import { ref, defineComponent, computed } from 'vue';
// import CodeInput from "./CodeInput.vue";
import Swal from 'sweetalert2';
import verify_code_div from './verify_code_div.vue';
export default defineComponent({
    components:{
        // CodeInput,
        verify_code_div
    },
    props:{
        cla: Object
    },
    emits:['verifyEmit'],
    setup(props, { emit }) {
        const m = ref({});
        const showVerifyCodeInput = ref(false)
        const verifyNumber = ref(null)
        const checkNumberData = ref(null)
        const showError = ref(false)
        const checkData = ref(null);
        m.value.number_code = props.cla.find(item => item.id == 79)
        const chooseNumberCode = (item) =>{
            model.value.number_code = item
        };

        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });



        const send = () =>{
            checkData.value = {
                type: "employer",
                number: m.value.number
            }
            axios({
                method: "post",
                url: "/send_add_vacancy_validate_sms",
                data:{model: m.value},

            })
            .then(function (response) {
                if (response.status == 200) {
                    toast.success("ნომერზე გაიგზავნა ვერიფიკაციის კოდი", {
                        theme: 'colored',
                        autoClose: 2000,
                    });
                    // verifyNumber.value = response.data.randomNumber
                    checkNumberData.value = response.data
                    showVerifyCodeInput.value = !showVerifyCodeInput.value
                }
            })
            .catch(function (error) {
                // handle error

                console.log(error);
            })


        }

        const sendSms = (item) =>{
            // const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            axios({
                method: "post",
                url: "/send_sms_add_vacancy",
                data:{model: item},
                // headers: {
                //     'X-CSRF-TOKEN': csrfToken,
                // },

            })
            .then(function (response) {
                if (response.status == 200) {

                    // let url = new URL( location.href)
                    // window.location.replace(`${url.origin}/ka`);
                }
            })
            .catch(function (error) {
                // handle error

                console.log(error);
            })
        }
        // const verifyFull = ref(false)

        const getSwal = () => {
            let postVacancyData = {
                active: true,
                employer: m.value,
                used_category: null
            };

            if (checkNumberData.value.length > 0) {
                let activeVacancy = checkNumberData.value.filter((x) => x.status_id == 1 || x.status_id == 2 || x.status_id == 3 );
                let closeVacancy = checkNumberData.value.some((x) => x.status_id > 3 );
                let hr = checkNumberData.value[0].hr.user;
                let employer = checkNumberData.value[0].employer;
                postVacancyData.employer = employer;
                if (activeVacancy.length > 0) {
                    // let filter = checkNumberData.value.filter((x) => x.status_id == 1 || x.status_id == 2 || x.status_id == 3 );
                    const activeVacancyIds = activeVacancy.map(i => i.category_id)
                    postVacancyData.used_category = activeVacancyIds;
                    let html = `თქვენ უკვე გემსახურებათ HR: ${hr.name_ka}.
                        თუ ნამდვილად გსურთ ახალი ვაკანსიის დამატებას დააწექით ღილაკს "დამატება",
                        თუ მიმდინარე ვაკანსიაზე გსურთ ინფორმაცია დააწექით ღილაკს "შეხსენება"`
                    Swal.fire({
                        title: '<p>თქვენი გაქვთ აქტიური ვაკანსია</p>',
                        // icon: 'info',
                        html:html,
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "დამატება",
                        denyButtonText: '<i class="fa fa-bell"></i> შეხსენება',
                        // icon: 'success',
                        customClass: {
                            confirmButton: 'btn-success',
                            denyButton: 'btn-primary',
                        },
                        // width: '60%'
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            emit('verifyEmit', postVacancyData)
                            return
                        }else if (result.isDenied) {
                            sendSms({
                                data: {
                                    to: hr.number,
                                    number: employer.number,
                                    name: employer.name_ka
                                },
                                type: 'employer_want_call_you_hr'
                            })
                            let url = new URL( location.href)
                            window.location.replace( `${url.origin}/${getLang.value}/candidate_search/[${activeVacancyIds}]`);
                            return
                        }
                    })
                }else if(closeVacancy){
                    let html = `
                        <div>
                            <h3>თქვენ უკვე გქონდათ ჩვენთან განთავსებული ვაკანსია,</h3>
                            <small>თუ ნამდვილად გსურთ ახალი ვაკანსიის დამატება, დააწექით ღილაკს "დამატება"</small>
                            <small>თუ გსურთ დაგიკავშირდეთ HR, დააწექით ღილაკს "გადმორეკვა"</small>
                            <small>თუ გსურთ ძველი ვაკანსიის გამეორება, დააჭექით ღილაკს "გამეორება"</small>
                        </div>
                        <hr/>
                        <div class="swal-buttons">
                            <button class="btn btn-success" id="confirmBtn">დამატება</button>
                            <button class="btn btn-primary" id="denyBtn"><i class="fa fa-bell"></i> გადმორეკვა</button>
                            <button class="btn btn-info" id="redoBtn">გამეორება</button>
                        </div>
                    `;

                    Swal.fire({
                    title: '',
                    html: html,
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false,
                    customClass: {
                        container: 'custom-swal-container',
                    },
                    didOpen: () => {
                        const confirmBtn = Swal.getPopup().querySelector('#confirmBtn');
                        const denyBtn = Swal.getPopup().querySelector('#denyBtn');
                        const redoBtn = Swal.getPopup().querySelector('#redoBtn');

                        confirmBtn.addEventListener('click', () => {
                            emit('verifyEmit', postVacancyData);
                            Swal.close();
                        });

                        denyBtn.addEventListener('click', () => {
                            sendSms(
                                {
                                    data: {
                                        hr_number: hr.number,
                                        hr_name: hr.name_ka,
                                        employer_number: employer.number,
                                        employer_name: employer.name_ka
                                    },
                                    type: ['try_add_vacancy_again_send_employer', 'try_add_vacancy_again_send_hr']
                                }
                            );
                            Swal.close();
                                let url = new URL( location.href)
                                window.location.replace(`${url.origin}/${getLang.value}/candidate`);
                        });

                        redoBtn.addEventListener('click', () => {
                            // Call your redo function here
                            // Example: redoFunction();
                            alert()
                            Swal.close();
                        });
                    },
                    });
                }
            }else{
                emit('verifyEmit', postVacancyData)
            }

        };

        const handlerAction = () =>{
            getSwal()
        }

        return {
            m,
            chooseNumberCode,
            send,
            showVerifyCodeInput,
            handlerAction,
            checkData
        }
    }
})
</script>
<style scoped>
.main {
    background-image: url('/public/public/images/candidates/candidate-bg2.jpg');
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    height: 100vh;
    border-radius: 5px;
    position: relative;
  }

    .parent {
        background-color: rgb(255, 255, 255);
        position: absolute;
        /* padding: 60px 0; */
        left: 10%;
        top: 30%;
        width: 80%;
    }


</style>
