<template lang="">
        <!-- <unknownUser :visible="showUnknownUser" v-if="auth && auth.user_type_id == 4"></unknownUser> -->
        <personInformation :visible="showPersonInformation" v-if="this.auth &&  this.auth.is_active == 1"></personInformation>
        <!-- <workInformation :visible="showWorkInformation" v-if="this.auth && this.auth.user_type_id == 1 && this.auth.is_active == 2" :lang="getLang"></workInformation> -->
</template>
<script>
import unknownUser from './unknownUser.vue';
import personInformation from './personInformation.vue';

export default {
    components:{
        unknownUser,
        personInformation,
        // workInformation
    },
    props:{
        auth:Object
    },
    data() {
        return {
            showUnknownUser: false,
            showPersonInformation: false,

        }
    },
    created(){

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    mounted(){
        // console.log('this.auth', this.auth);

    }
}
</script>
<style lang="">

</style>
