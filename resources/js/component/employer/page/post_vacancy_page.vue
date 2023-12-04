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
                        <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                    </ul>
                        <input
                            type="text"
                            class="form-control"
                            :class="(m.number == null )?'is-invalid':''"
                            v-model="m.number"
                            placeholder="555666777"
                            onkeypress="return /[0-9]/i.test(event.key)"
                        >
                        <!-- <span v-if="send && !v.employer.number.required.$response" style='color:red'>* </span>
                        <span v-if="send && !v.employer.number.numeric.$response" style='color:red'>* </span> -->
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-4 col-md-12">
                <button class="btn btn-primary" @click="send">send</button>
            </div>
        </div>

    </div>
</template>
<script>
import { ref } from 'vue';
import _ from 'lodash';
export default {
    props:{
        data: Object,
    },
    setup(props) {
        const cla = ref(_.cloneDeep(props.data.classificatory));
        console.log(cla.value);
        const m = ref({});
        m.value.number_code = cla.value.numberCode.find(item => item.id == 79)
        console.log(m.value);

        const chooseNumberCode = (item) =>{
            model.value.number_code = item
        };

        const send = () =>{
            axios({
                method: "post",
                url: "/send_add_vacancy_validate_sms",
                data: data,

            })
            .then(function (response) {
                if (response.data.status == 200) {
                    if (response.data.data.type == "e") {
                        toast.error(response.data.data.message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }
                    loader.value = false
                    m.value = formData
                    showAlert()
                }
            })
            .catch(function (error) {
                // handle error
                loader.value = false
                console.log(error);
            })
        }
        return {
            cla,
            m,
            chooseNumberCode,
            send
        }

    }
}
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
