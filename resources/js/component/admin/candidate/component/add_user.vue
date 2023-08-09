<template lang="">
    <div class="row">
        <div class="col-sm-4">
            <!-- text input -->
            <div class="form-group">
            <label>სახელი გვარი</label>
                <input type="text" class="form-control" v-model="m.name_ka" placeholder="სახელი გვარი">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>ნომერი</label>
                <input class="form-control " :class="( v$.m.number.$error)?'is-invalid':''"  v-model="m.number" type="text" @blur="v$.m.number.$touch" placeholder="ნომერი">
                <span v-if="v$.m.number.required.$invalid && v$.m.number.$dirty" style='color:red'>* {{ v$.m.number.required.$message}}</span>
                <span v-if="v$.m.number.numeric.$invalid && v$.m.number.$dirty" style='color:red'>* {{ v$.m.number.numeric.$message}}</span>
                <span v-if="v$.m.number.maxLength.$invalid && v$.m.number.$dirty" style='color:red'>* {{ v$.m.number.maxLength.$message}}</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>მაილი</label>
                <input class="form-control"  v-model="m.email" type="email" placeholder="მაილი">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>პაროლი</label>
                <input class="form-control"  v-model="m.password" type="text" placeholder="პაროლი">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>დაბადების თარიღი</label>
                <input class="form-control d" auth-provide=""  type="date" v-model="m.date_of_birth" placeholder="mm/dd/yyyy" @blur="v$.m.date_of_birth.$touch">
                <span v-if="v$.m.date_of_birth.required.$invalid && v$.m.date_of_birth.$dirty" style='color:red'>* {{ v$.m.date_of_birth.required.$message}}</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>სქესი</label>
                <multiselect v-model="m.gender" :options="cla.gender" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one" :searchable="true" :allow-empty="false" @blur="v$.m.gender.$touch">
                    <template slot="singleLabel" slot-scope="{ option }"></template>
                </multiselect>
                <span v-if="v$.m.gender.required.$invalid && v$.m.gender.$dirty" style='color:red'>* {{ v$.m.gender.required.$message}}</span>
            </div>
        </div>
        <div class="col-sm-12 d-flex justify-content-between">
            <button class="btn btn-primary" @click="generatePassword()"> პაროლის გენერირება</button>
            <button class="btn btn-success" @click.prevent="add()"> დამატება</button>
        </div>
    </div>
</template>
<script>
import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers,  numeric, maxLength } from '@vuelidate/validators'
export default {
    setup () {
        return { v$: useVuelidate() }
    },
    props:{
        data: Object
    },
    data() {
        return {
            m:null,
            cla:{}
        }
    },
    validations () {
        const validations = {
                m:{
                    number: {
                        required: helpers.withMessage('ნომრის შევსება სავალდებულოა', required ),
                        numeric: helpers.withMessage('ნომრი უნდა შედგებოდეს მხოლოდ ციფრებისგან', numeric ),
                        maxLength: helpers.withMessage('ნომრი უნდა შედგებოდეს 9 ციფრებისგან', maxLength(9) )
                    },
                    gender: {required: helpers.withMessage('სქესის არჩევა სავალდებულოა', required )},
                    date_of_birth: {required: helpers.withMessage('დაბადების თარიღის შევსება სავალდებულოა', required )}

                },
        }
        return validations
    },
    created(){
        this.m = {...this.data.model}
        this.cla = this.data.cla
    },
    methods: {
        async add(){
            const isFormCorrect = await this.v$.$validate()
            if (!isFormCorrect) return;
            let currentObj = this;
            console.log('currentObj',currentObj);
            axios({
                method: "post",
                url: "/add_user",
                data: this.m,

            })
            .then(function (response) {
                console.log(response.data);
                if (response.data.status == 200) {
                    // currentObj.m = {...response.data.data};
                    toast.success("ინფორმაცია წარმატებით შეინახა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    setTimeout(() => {
                        document.location.reload();
                    }, 1500);
                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        generatePassword(){
            const length = 8;
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789!@#$%';
            let password = '';

            for (let i = 0; i < length; i++) {
                password += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            this.m.password = password
        }
    },
    watch:{

    }
}
</script>
<style lang="">

</style>
