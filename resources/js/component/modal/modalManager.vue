<template lang="">
        <unknownUser :visible="showModal"></unknownUser>
</template>
<script>
import unknownUser from './unknownUser.vue';
export default {
    components:{
        unknownUser
    },
    props:{
        auth:Object
    },
    data() {
        return {
            showModal:true
        }
    },
    created(){

    },
    mounted(){
        console.log('this.auth', this.auth);
    }
}
</script>
<style lang="">

</style>
