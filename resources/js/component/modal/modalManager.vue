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
       if(this.auth &&  this.auth.status == 0){
            var url = new URL( location.href)
            if (url.pathname == `/${this.getLang}/user/userProfile`) {
                return;
            }
            this.showPersonInformation = true
        }else if(this.auth && this.auth.status == 1){

            var url = new URL( location.href)
            if (url.pathname == `/${this.getLang}/user/work_information`) {
                return;
            }
            this.$swal(
                {
                    title: '<p>გილოცავთ თქვენ დაასრულეთ თქვენი პირადი ინფორმაციის შევსება!!!</p>',
                    icon: 'info',
                    html:
                        'შემდეგი ეტაპი არის სამუშაო ინფორმაციის ველების შევსება რათ ჩვენ ვიცოდეთ რა კატეგორიის, ანაზღაურების და სამუშაო გრაფიკის მქონე ვაკანსიები შემოგთავაზოთ თქვენ და ასევე ამ ინფორმაციის გათვალისწინებით მოხდება დამსაქმებლებისთის თქვენი კანდიდატურის შეთავაზება',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: 'შესავსებად გადასვლა',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.replace(`/${this.getLang}/user/work_information`)
                }
            })

        }
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
