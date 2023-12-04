<template lang="">
    <div class="main">
        <div class="row parent">
            <div class="col-md-12 text-center">
                <h1>text</h1>
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
                            onkeypress="return /[0-9]/i.test(event.key)"
                        >
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-4 col-md-12">
                <button class="btn btn-primary" @click="send">send</button>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 " v-if="showVerifyCodeInput">
                <div class="form-group">
                    <div class="input-group mt-3">
                        <CodeInput
                            :fields="5"
                            :fieldWidth="56"
                            :fieldHeight="56"
                            :required="true"
                            @change="onChange"
                            @complete="onComplete"
                        />
                        <p class="mr-2">
                            {{ countdown }}
                        </p>
                    </div>
                    <p class="text-danger" v-if="showError">კოდი არასწორია!</p>
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
        const showVerifyCodeInput = ref(true)
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
                    showVerifyCodeInput.value = true
                    verifyNumber.value = response.data.randomNumber
                    checkNumberData.value = response.data.check
                    setupTimeout(response.data)
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
                    document.location.reload();
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
                url: "/send_sms_add_vacancy_again",
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
        const onChange = (v) =>{
            showError.value = false
            if (v.length == 5) {
                if (v == verifyNumber.value) {
                    let activeVacancy = checkNumberData.value.length > 0 ?checkNumberData.value.some((x) => x.status_id == 1 || x.status_id == 2 || x.status_id == 3 || x.status_id == 6 || x.status_id == 7):false
                    if (activeVacancy) {
                        let html = `თქვენ უკვე გემსახურებათ `
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
                                emit('verifyEmit', true)
                                return
                            }else if (result.isDenied) {
                                sendSms()
                                return
                            }
                        })
                    }else{
                        emit('verifyEmit', true)
                    }
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
.main{
    background-image: url('/storage/app/public/images/candidate-bg2.jpg') ;
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    height: 100vh;
    border-radius: 5px;
    position: relative;
  }

    .parent{
        background-color: rgb(255, 255, 255);
        position: absolute;
        padding: 60px 0;
        left: 10%;
        top: 30%;
        width: 80%;

    }
</style>
