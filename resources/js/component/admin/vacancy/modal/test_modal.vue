<template lang="">
  <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">რედაქტირება</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
  </div>
</template>
<script>
import { ref, watch } from 'vue';

export default {
    props: {
    visible: Boolean,
  },
  setup(props) {
    const showConfirm = ref(false)

    const show = () => {
        console.log('hello');
      // logic to show the modal
    };

    watch(() => props.visible, (newValue) => {
      if (newValue) {
        show();
      }
    });

    return {
      showConfirm
      // other properties and methods you want to expose
    };
  },
};
</script>
<style lang="">

</style>
