<template lang="">
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ტესტიმონიალების ცხრილი </h3>

                <div class="card-tools">
                 <button class="btn btn-success" @click="openAddModal"><i class="fa fa-plus"></i> დამატება</button>
                </div>
            </div>
                <testimonial_table :items="data"/>
        </div>

        <add_testimonial :visible="showAddModal" />
    </div>
</template>
<script>
import testimonial_table from '../component/testimonial_table.vue';
import add_testimonial from '../modal/add_testimonial.vue';
import { ref } from 'vue'
export default {
    components:{
        testimonial_table,
        add_testimonial
    },
    props:{
        data: Object

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
