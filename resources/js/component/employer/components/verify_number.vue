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

            <div class="col-xl-12 col-lg-12 col-md-12 " v-if="showVerifyCodeInput">
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
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { ref, defineComponent } from 'vue';
import CodeInput from "./CodeInput.vue";
import Swal from 'sweetalert2';
export default defineComponent({
    components:{
        CodeInput
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
        m.value.number_code = props.cla.find(item => item.id == 79)
        const chooseNumberCode = (item) =>{
            model.value.number_code = item
        };




        const send = () =>{
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
                    verifyNumber.value = response.data.randomNumber
                    checkNumberData.value = response.data.check
                    if (verifyNumber.value !== null) {
                        showVerifyCodeInput.value = true
                        setupTimeout(response.data)
                    }

                    console.log(response.data);
                }
            })
            .catch(function (error) {
                // handle error

                console.log(error);
            })


        }
        const countdown = ref(60)
        const setupTimeout = ()=> {
            const intervalId = setInterval(() => {
                countdown.value --;
                if (countdown.value <= 0) {
                // clearInterval(intervalId);
                    showVerifyCodeInput.value = false;
                    // document.location.reload();
                }
            }, 1000);
            // setTimeout(() => {
            //     showVerifyCodeInput.value = false;
            //     document.location.reload();
            // }, 60000); // 1 minutes in milliseconds
        };

        const sendSms = (item) =>{
            axios({
                method: "post",
                url: "/send_sms_add_vacancy",
                data:{model: item},

            })
            .then(function (response) {
                if (response.status == 200) {

                    console.log(response.data);
                    let url = new URL( location.href)
                    window.location.replace(`${url.origin}/ka`);
                }
            })
            .catch(function (error) {
                // handle error

                console.log(error);
            })
        }
        const verifyFull = ref(false)

        const getSwal = () => {
            let postVacancyData = {
                active: true,
                employer: m.value,
                used_category: null
            };
            if (checkNumberData.value.length > 0) {

                let activeVacancy = checkNumberData.value.some((x) => x.status_id == 1 || x.status_id == 2 || x.status_id == 3 );
                let closeVacancy = checkNumberData.value.some((x) => x.status_id == 6 || x.status_id == 7 );
                let hr = checkNumberData.value[0].hr.user;
                let employer = checkNumberData.value[0].employer;
                postVacancyData.employer = employer;
                if (activeVacancy) {
                    let filter = checkNumberData.value.filter((x) => x.status_id == 1 || x.status_id == 2 || x.status_id == 3 );
                    postVacancyData.used_category = filter.map(i => i.category_id)
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
                                    hr_number: hr.number,
                                    hr_name: hr.name_ka,
                                    employer_number: employer.number,
                                    employer_name: employer.name_ka
                                },
                                type: ['try_add_vacancy_again_send_employer', 'try_add_vacancy_again_send_hr']
                            })
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

        const onChange = (v) =>{
            showError.value = false
            if (v.length == 5) {
                if (v == verifyNumber.value) {
                    getSwal()
                } else {
                    showError.value = true
                }


            }
        }



        const onComplete = (v) =>{

            if (v) {
                console.log("onComplete ", v);
                verifyFull.value = !verifyFull.value
            }
        }
        return {
            m,
            chooseNumberCode,
            send,
            showVerifyCodeInput,
            onChange,
            onComplete,
            showError,
            countdown
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

    .countDownSeconds {
        padding: 0.3%;
        border-radius: 15px;
        border-style: solid;
        background-color: rgb(2,117,216,0.1);
        border-color: rgb(2,117,216,0.9);
        border-width: 1px;
        margin-top: 16px;
        margin-left: 1% !important;

    }
</style>
