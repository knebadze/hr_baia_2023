<template lang="">
       
        <personInformation :visible="showPersonInformation" v-if="this.auth &&  this.auth.is_active == 1"></personInformation>
        <!-- <workInformation :visible="showWorkInformation" v-if="this.auth && this.auth.user_type_id == 1 && this.auth.is_active == 2" :lang="getLang"></workInformation> -->
</template>
<script>
import personInformation from './personInformation.vue';

export default {
    components:{
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

    }
}
</script>
<style lang="">

</style>
