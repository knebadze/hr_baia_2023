<template lang="">
    <div class=" mt-3" >
        <hr>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-danger" @click="doNotLike(id)"> <i class="fa fa-thumbs-down"></i> არ მომწონს</button>
            <button type="button" class="btn btn-success" @click="like(id)"> <i class="fa fa-thumbs-up"></i> მომწონს</button>
        </div>
    </div>
</template>
<script>
import { ref, computed } from 'vue';
import Swal from 'sweetalert2';
export default {
    props: {
        id: Number
    },
    emits:['newData'],
    setup(props, { emit }) {
        const url = new URL(location.href)
        const showButton = computed(() => {
            let pathName = url.pathname;
            let extractedPart = pathName.match(/\/employer\/photo_questionnaire/);
            console.log(extractedPart);
            return extractedPart ? extractedPart[0] : null;

        })
        console.log(showButton.value);
        const doNotLike = (id) =>{
            Swal.fire({
                title: 'დარწმუნებული ხართ რომ ეს კანდიდატი არ მოგწონთ?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'დიახ',
                denyButtonText: `არა`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: '/do_not_like_candidate',
                        data: {'id': id},

                    })
                    .then(function (response) {
                        if (response.status == 200) {
                            if (showButton.value) {
                                let url = new URL(location.href)
                                window.location.replace(`${url.origin}/ka`);
                            }else{
                                emit('newData', id, 0)
                            }
                            // var index = currentObj.interest.findIndex(object => {
                            //     return object.id === id;
                            // });
                            // currentObj.interest[index]['employer_answer'] = 0
                        }

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                } else if (result.isDenied) {

                }
            })

        };
        const like = (id) => {
            Swal.fire({
                title: 'დარწმუნებული ხართ რომ ეს კანდიდატი მოგწონთ?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'დიახ',
                denyButtonText: `არა`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: '/like_candidate',
                        data: {'id': id},

                    })
                    .then(function (response) {
                        if (response.status == 200) {
                            if (showButton.value) {
                                window.location.replace(`${url.origin}/ka`);
                            }else{
                                emit('newData', id, 1)
                            }
                            // var index = currentObj.interest.findIndex(object => {
                            //     return object.id === id;
                            // });
                            // currentObj.interest[index]['employer_answer'] = 1
                        }

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

                } else if (result.isDenied) {

                }
            })
        };
        return {
            doNotLike,
            like
        }
    }
}
</script>
<style lang="">

</style>
