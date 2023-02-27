<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <mainInfo :data="m.auth" :genderCLA="data.classificator.gender"></mainInfo>
        </div>
    </div>
</template>
<script>
import mainInfo from '../candidate/mainInfo.vue';
export default {
    components:{
        mainInfo
    },
    props:{
        data: Object,
    },
    data() {
        return {
            m:null
        }
    },
    created(){
        this.m = { ...this.data.candidate, ...this.data.basic };
    }
}
</script>
<style lang="">

</style>
