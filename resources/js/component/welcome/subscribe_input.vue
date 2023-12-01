<template lang="">
    <div class="ftr-nw-content">
            <div class="row">
                <div class="col-md-5">
                    <div class="ftr-nw-title">
                        {{ $t('lang.footer_subscribe_first_text') }}
                    </div>
                </div>
                <div class="col-md-7">
                    <form >
                        <div class="ftr-nw-form">
                            <input v-model="email" class="form-control" :placeholder="$t('lang.footer_subscribe_form_placeholder')" type="text">
                            <button class="ftr-nw-subcribe-btn" @click.prevent="submit">{{ $t('lang.footer_subscribe_button') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>
<script>
import { ref } from 'vue';
export default {
    setup() {
        const email = ref(null);
        const submit = () =>{
            axios.post('/subscribe' ,{
                    data: {email: email.value}
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200) {
                        toast.success("წარმატებით შესრულდა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        email.value = null
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        }
        return{
            submit,
            email
        }
    }
}
</script>
<style lang="">

</style>
