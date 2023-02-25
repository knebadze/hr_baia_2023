<template lang="">
        <unknownUser :visible="showUnknownUser" v-if="auth && auth.user_type_id == 4"></unknownUser>
        <personInformation :visible="showPersonInformation"></personInformation>
</template>
<script>
import unknownUser from './unknownUser.vue';
import personInformation from './personInformation.vue';
import { I18n } from 'laravel-vue-i18n'
export default {
    components:{
        unknownUser,
        personInformation,
    },
    props:{
        auth:Object
    },
    data() {
        return {
            showUnknownUser: false,
            showPersonInformation: false
        }
    },
    created(){
        if (this.auth && this.auth.user_type_id == 4) {
            this.showUnknownUser = true
        }else if(this.auth && this.auth.user_type_id == 1 && this.auth.is_active == 1){
            var url = new URL( location.href)
            if (url.pathname == `/${this.getLang}/user/candidateProfile`) {
                return;
            }
            this.showPersonInformation = true
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    mounted(){
        console.log('this.auth', this.auth);

    }
}
</script>
<style lang="">

</style>
