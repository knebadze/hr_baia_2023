<template lang="">
    <div>
        <reminderList :visible="showModal" :items="item"></reminderList>
    </div>
</template>
<script>
import axios from 'axios';
import moment from 'moment'
import  reminderList from '../modal/reminderList.vue'
export default {
    components:{
        reminderList
    },
    props:{
        // data: Object
    },
    data() {
        return {
            data:{},
            showModal: false,
            item: null
        }
    },
    computed:{

    },
    created(){
        axios.post('/hr_reminder_info' )
        .then((response)=> {
            // console.log('response', response)
            this.data = response.data
            // Get the current time
            // const currentTime = moment();
            // let baseTimeMoment = moment(response.data[0].date, "YYYY-MM-DD HH:mm");
            // const differenceInMinutes = currentTime.diff(baseTimeMoment, 'minutes');

            // if (differenceInMinutes >= -30) {
            //     console.log('differenceInMinutes', differenceInMinutes);
            // }
            if (Object.keys(this.data).length > 0) {
                this.openModal(this.data)
            }

        })
        .catch(function (error) {
            console.log(error);
        });
        // console.log('data', this.data);
    },
    methods:{
        openModal(item){
            this.showModal = !this.showModal
            this.item = item
        }
    },
    mounted() {
        // console.log('data', this.data);
    }

}
</script>
<style lang="">

</style>
