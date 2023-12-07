<template lang="">
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">{{ m.description }}  რედაქტირება</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>დასახელება</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.description" type="text" placeholder="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>მნიშვნელობა</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.meaning" type="text" placeholder="" >
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-success" @click.prevent="update(m)" >რედაქტირება</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, computed, watch } from 'vue'
export default {
    components:{
    },
    props:{
        visible: Boolean,
        item: Object
    },
    setup(props) {
        console.log(props.item);
        const showConfirm = ref(false);
        let m = ref();
        // m.value.active = false
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });




        const show = () =>{
            showConfirm.value = true
            m.value = { ...props.item }
        };

        const hide = () =>{
            showConfirm.value = false
        }


        const update = (item) =>{
            axios({
                method: "post",
                url: "/update_global_variable",
                data: {'model': item},

            })
            .then(function (response) {
                if (response.status == 200) {
                    toast.success('წარმატებით დარედაქტირდა', {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    hide();
                    setTimeout(() => {
                        document.location.reload();
                    }, 1500);

                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }



        watch(() => props.visible, (newValue) => {
            show()
        });


        return {
            showConfirm,
            hide,
            m,
            update
        }
    }
}
</script>
<style scoped>
  .modal-body{
      height: 150px;
      overflow-y: auto;
  }

  @media (min-height: 500px) {
      .modal-body { height: 100px; }
  }

  @media (min-height: 800px) {
      .modal-body { height: 300px;  }
  }
</style>
