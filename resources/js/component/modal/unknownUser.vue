<template lang="">
  <!-- Modal -->
  <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">ნამდვილად გსურთ კითხვარის დადასტურება?</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="hide()" ><i class="fa fa-times"></i> არა</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        visible: Boolean,
    },
    data() {
        return {
            showConfirm: true,
        }
    },
    created(){
        // this.showConfirm = this.visible
    },
    methods:{
        show(){
            this.showConfirm = true
        },
        hide(){
           this.showConfirm = false
        },
    },
    watch:{
        visible: function(){
            this.show()
        },
    }
}
</script>
<style lang="">

</style>
