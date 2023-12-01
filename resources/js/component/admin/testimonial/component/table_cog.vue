<template lang="">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

            <a class="dropdown-item"  href="#" @click="openAddModal(item)">ნახვა / რედაქტირება</a>
            <a  class="dropdown-item bg-danger" href="#" @click="deleteTestimonial(item.id)"> წაშლა</a>


        </div>
    </div>
    <add_testimonial :visible="showAddModal" :item="item"/>
</template>
<script>
import add_testimonial from '../modal/add_testimonial.vue'
import { ref } from 'vue';
import Swal from 'sweetalert2';
export default {
    components:{
        add_testimonial
    },
    props:{
        item: Object
    },
    setup(props) {
        const showAddModal = ref(false)
        const openAddModal = () =>{
            showAddModal.value = !showAddModal.value
        };

        const deleteTestimonial = (id) =>{
            Swal.fire({
                title: 'ნამდვილად გსურთ წაშლა?',
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios({
                        method: "post",
                        url: "/delete_testimonial",
                        data: {'id': id,},

                    })
                    .then(function (response) {
                        // handle success
                        if (response.status == 200) {
                            // currentObj.candidate_id = response.data.data;
                            toast.success('წარმატებით წაიშალა', {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                            setTimeout(() => {
                                document.location.reload();
                            }, 1500);
                            // alert()

                        }


                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

                } else if (result.isDenied) {
                    return
                }
            });

        }

        return {
            openAddModal,
            showAddModal,
            deleteTestimonial
        }
    }
}
</script>
<style lang="">

</style>
