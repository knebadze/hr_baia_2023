<template lang="">
        <button class="site-button" @click="interest(item)">
            {{ $t('lang.individual_vacancies_page_middle_interest_button') }}
        </button>
</template>
<script>
import { ref, computed } from 'vue';
import Swal from 'sweetalert2';
export default {
    props:{
        item: Object,
        auth: Object
    },
    emits:['emitReceiveChild'],
    setup(props, { emit }) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const checkInterest = ref(false);

        const addStorage = () => {
            const pathName = window.location.pathname;

            // Make an API call to store data in Laravel
            axios.post('/store_path', { pathName })
            .then(response => {
                // console.log('response',response);
                // Handle success if needed
            })
            .catch(error => {
                console.error('Error storing data in Laravel:', error);
            });
        };

        const interest = (item) =>{
            if (props.auth != null ) {
                if (props.auth.role_id != 3) {
                    toast.error("თქვენ არ გაქვთ დაინტერესების უფლება", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }else if(props.auth.role_id == 3  ){
                    if (props.auth.candidate.status_id == 8) {
                        toast.error("თქვენ ჯერ არ გაქვთ დაინტერესების უფლება, გთხოვთ შეავსოთ ინფორმაცია", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    } else if(props.auth.candidate.status_id == 10) {
                        toast.error("არ გაქვთ დაინტერესების უფლება, თქვენ უკვე დასაქმებული ხართ", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }

                }else if(props.auth.role_id == 3){

                }
                sendInterestAxios(item)

            }else{
                let url = new URL( location.href)
                Swal.fire(
                    {
                        title: '<p>დაინტერესებამდე სავალდებულოა გაიაროთ ავტორიზაცია!!!</p>',
                        icon: 'info',
                        html:
                            'თუ ჯერ არ ხართ რეგისტრირებული გთხოვთ დარეგისტრირდეთ',
                        showCloseButton: true,
                        showCancelButton: false,
                        showDenyButton: true,
                        focusConfirm: false,
                        confirmButtonText: 'რეგისტრაცია',
                        denyButtonText: 'შესვლა',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.replace(`${url.origin}/${getLang.value}/register`)
                    }else if (result.isDenied) {
                        addStorage()
                        window.location.replace(`${url.origin}/${getLang.value}/login`)
                    }
                })
            }
        };

        const sendInterestAxios = (item) =>{
            console.log(item);
            axios({
                method: "post",
                url: '/interest_vacancy',
                data: {'id': item.id, 'check': checkInterest.value},

            })
            .then(function (response) {
                if (response.data.status == 200) {
                    let text;
                    if(response.data.data.type == 'w'){
                        Swal.fire({
                            title: '<p>თქვენი სამუშაო კატეგორია არ შეესაბამება ვაკანსიის კატეგორიას!!!</p>',
                            icon: 'info',
                            html:
                                'აუცილებელია დაამატოთ შესაფერისი სამუშაო კატეგორია',
                            showCloseButton: true,
                            showCancelButton: true,
                            showDenyButton: false,
                            focusConfirm: false,
                            confirmButtonText: 'კატეგორიის დამატება',
                            cancelButtonText:'გაუქმება'
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                // !!!!!!!!!!!!!!!!!!!!!!!!!!!აქ შეიძლება ჩაშენდეს ავტომატური დამატების სერვისი!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                                window.location.replace(`/${getLang.value}/user/userProfile?stage=6`)
                            }
                        })
                    }else if(response.data.data.type == 's'){
                        Swal.fire({
                            title: '<strong>თქვენი დაინტერესება მიღებულია</strong>',
                            icon: 'success',
                            html:'შემკვეთს გადაეგზავნება თქვენი ფოტოანკეტა, მოხდება მასთან თქვენი კანდიდატურის განხილვა და მისი მხრიდანაც დაინტერესების შემთხვევაში გაგასაუბრებთ შემკვეთს',

                            showCloseButton: true,
                            // confirmButtonText: 'მთავარზე დაბრუნება',
                            showCancelButton: false,
                            focusConfirm: false,
                        }).then((result) => {
                            // if (result.isConfirmed) {
                            //     let url = new URL( location.href)
                            //     if (props.data.model.role_id == 3) {
                            //         window.location.replace(`${url.origin}/ka`);
                            //     }else{
                            //         window.location.replace( `${url.origin}/admin/vacancy?ka`);
                            //     }

                            // }

                        })
                        emit('emitReceiveChild', item.id, response.data)
                    }
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };
        return {
            interest
        }
    }
}
</script>
<style lang="">

</style>
