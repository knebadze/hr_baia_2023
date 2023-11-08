<template lang="">
    <div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a v-if="item.status.id != 4 && item.status.id != 5" class="dropdown-item" href="#" @click="openModal(item)">რედაქტირება</a>
            </div>
        </div>
        <vacancyUpdate
            :visible="showModal"
            :item="modalData"
        ></vacancyUpdate>
    </div>
</template>
<script>
import { ref, computed, nextTick  } from "vue";
// import { markRaw } from 'vue';
import vacancyUpdate from "../modal/vacancyUpdate.vue"
import test_modal from "../modal/test_modal.vue";
export default {
    components:{
        vacancyUpdate,
        // test_modal: markRaw(test_modal),
    },
    props:{
        item: Object
    },
    setup(props) {
        // console.log(props.item);
        const modalComponent = ref(null);
        const showModal = ref(false);
        const modalData = ref(null);

        const openModal = async(item) =>{
            // modalComponent.value = vacancyUpdate;
            modalData.value = item
            // await nextTick();
            showModal.value = !showModal.value;
            // console.log(modalData);

        };

        return{
            modalComponent,
            showModal,
            modalData,

            openModal,
        }
    }
}
</script>
<style lang="">

</style>
