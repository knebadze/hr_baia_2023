<template lang="">
    <div>
        <verify_number v-if="showVerifySection" :cla="cla.numberCode" @verifyEmit="handlerVerify"/>
        <post_vacancy v-if="showPostSection" :data="data"/>

    </div>
</template>
<script>
import { ref } from 'vue';
import _ from 'lodash';
import verify_number from '../components/verify_number.vue';
import post_vacancy from '../components/post_vacancy.vue';
export default {
    components:{
        verify_number,
        post_vacancy
    },
    props:{
        data: Object,
    },
    setup(props) {
        const cla = ref(_.cloneDeep(props.data.classificatory));
        const showVerifySection = ref(true);
        const showPostSection = ref(false);
        const handlerVerify = (item) =>{
            console.log('child', item);
            showVerifySection.value = false
            showPostSection.value = item
        }

        return {
            cla,
            handlerVerify,
            showVerifySection,
            showPostSection
        }

    }
}
</script>
<style scoped>
  


</style>
