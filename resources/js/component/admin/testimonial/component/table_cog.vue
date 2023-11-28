<template lang="">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

            <a class="dropdown-item"  href="#" @click="openAddModal(item)">ნახვა / რედაქტირება</a>
            <a  class="dropdown-item bg-danger" href="#" @click="candidateDelete(item.id)"> წაშლა</a>


        </div>
    </div>
    <add_testimonial :visible="showAddModal" :item="item"/>
</template>
<script>
import add_testimonial from '../modal/add_testimonial.vue'
import { ref } from 'vue';
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

        return {
            openAddModal,
            showAddModal
        }
    }
}
</script>
<style lang="">

</style>
