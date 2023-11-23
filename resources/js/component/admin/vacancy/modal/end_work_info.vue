<template lang="">
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">შეწყვეტის მიზეზი</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">
                    <p>{{ item.end_work_reason_id == 13? 'კანდიდატს აღარ სურს მუშაობა' :item.end_work_reason_id == 14? 'შემკვეთს სურს კანდიდატის შეცვლა':'შემკვეთს სურს ვაკანსიის შეწყვეტა' }}</p>
                    <p>{{ item.end_work_reason }}</p>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    props:{
        visible: Boolean,
        item: Object
    },
    data() {
        return {
            showConfirm: false
        }
    },
    methods: {
        show(){
            console.log('hello', this.item);
            this.showConfirm = true
        },
        hide(){
            this.showConfirm = false
        }
    },
    watch:{
        visible: function(){
            console.log('hello');
            this.show()
        }
    }
}
</script>
<style lang="">

</style>
