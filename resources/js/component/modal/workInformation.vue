<template lang="">
        <!-- Modal -->
<div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLongTitle">დაამატე კატეგორია და გრაფიკი</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()"></button>
        </div>
        <div class="modal-body">
            <!--personal information-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ 'კატეგორია' }}</label>
                        <div class="ls-inputicon-box">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>აირჩიე კატეგორია</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_additional_smoke') }}</label>
                        <div class="ls-inputicon-box">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="modal-footer">
            <button type="" class="site-button" >{{ 'შენახვა'}}</button>
        </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    props:{
        visible: Boolean,
        lang:String
    },
    data() {
        return {
            showConfirm: '',
        }
    },
    created(){
        this.showConfirm = this.visible
    },
    methods:{
        show(){
            this.showConfirm = true
        },
        hide(){
           this.showConfirm = false
           this.sendMessageToParent(this.showConfirm)
        },
        sendMessageToParent(arg){
            this.$emit('messageFromChild', arg)
        }
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
