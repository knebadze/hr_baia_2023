<template lang="">
    <div>
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>დასახელება</th>
                <th>მნიშვნელობა</th>
                <th>მოქმედება</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in data" :key="index">
                <td>{{ item.id }}</td>
                <td>{{ item.description }}</td>
                <td>{{ item.meaning }}</td>

                <td>
                    <button class="btn btn-info" @click="openModal(item)"> <i class="fa fa-pen"></i> რედაქტირება</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <update_modal :visible="showModal" :item="modalData"/>
    </div>
</template>
<script>
import update_modal from '../modal/update_modal.vue';
import { ref } from 'vue';
export default {
    components:{
        update_modal
    },
    props:{
        data: Object
    },
    setup(props) {
        console.log(props.data);
        const showModal = ref(false);
        const modalData = ref(null)
        const openModal = (item) =>{
            showModal.value = !showModal.value;
            modalData.value = item;
        };

        return {
            showModal,
            modalData,
            openModal
        }
    }
}
</script>
<style lang="">

</style>
