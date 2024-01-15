<template lang="">
    <div class="col-xl-12 col-lg-12 col-md-12 " v-if="showDiv">
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
</template>
<script>
import CodeInput from './CodeInput.vue';
import { ref, watch, computed } from 'vue';
export default {
    components:{
        CodeInput
    },
    emits:['sendParentAction'],
    props:{
        visible: Boolean,
        item: Object,
    },
    setup(props, { emit }) {
        const showDiv = ref(false)
        const showError = ref(false);
        const verifyFull = ref(false);
        const countdown = ref(60);
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });

        const setupTimeout = ()=> {
            const intervalId = setInterval(() => {
                countdown.value --;
                if (countdown.value <= 0) {
                    showDiv.value = false;
                }
            }, 1000);
        };

        watch(() => props.visible, (newValue, oldValue) => {
            if (newValue == true) {
                showDiv.value = true
                setupTimeout();
            }else{
                showDiv.value = false
            }
        });

        const onChange = (v) =>{
            showError.value = false
            if (v.length == 5) {
                check(v)
            }
        };

        const check = (v) =>{
            let data = { code: v, ...props.item }
            axios({
                method: "post",
                url: "/check_verify_code",
                data: data,

            })
            .then(function (response) {
                if (response.status == 200) {
                    if (response.data) {
                        emit('sendParentAction')
                    } else {
                        showError.value = true
                    }

                }
            })
            .catch(function (error) {
                // handle error

                console.log(error);
            })
        }

        const onComplete = (v) =>{

            if (v) {
                verifyFull.value = !verifyFull.value
            }
        };

        return{
            getLang,
            showDiv,
            showError,
            countdown,
            onChange,
            onComplete
        }
    }
}
</script>
<style scoped>
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
