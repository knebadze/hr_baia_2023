<template lang="">
    <div class="row">
        <section class="col-lg-6" v-for="(item, index) in data" :key="index">
            <div class="card collapsed-card ">
                <div class="card-header border-0">
                    <h3 class="card-title">
                    {{ item.description }}
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body" >
                    <card_body
                        :item="item"
                        :key="item.id"
                        @formEmit="handleUpdate"
                        ref="childComponents"
                        :refId="`body_${item.id}`"
                    />
                </div>
                <!-- /.card-body-->
                <div class="card-footer " >
                    <button class="btn btn-primary float-rigth" @click="update(index)">რედაქტირება</button>
                </div>
            </div>
            <!-- /.card -->
        </section>

    </div>
</template>
<script>
import { ref } from 'vue';
import card_body from '../components/card_body.vue';
import Swal from 'sweetalert2';
export default {
    components:{
        card_body
    },
    props:{
        data: Object
    },
    setup(props) {
        console.log('props.data',props.data);
        const childComponents = ref({});

        const handleUpdate = (formData) => {
            // Do something with the form data received from the child
            console.log('formData',formData);
            Swal.fire({
                    title: 'ნამდვილად გსურთ რედაქტირება?',
                    // html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
                    //   showDenyButton: true,
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                // return
                    if (result.isConfirmed) {
                        axios({
                            method: "post",
                            url: "/sms_template_update",
                            data: { 'model': formData },
                        })
                        .then(function (response) {
                            if (response.status == 200 ) {
                                toast.success('წარმატებით შესრულდა', {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });

                            } else {
                                // Handle the case where the update failed
                                toast.error('შეცდომა: შეუძლებელია განახლება', {
                                    theme: 'colored',
                                    autoClose: 2000,
                                });
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    } else if (result.isDenied) {
                        return
                    }
                });
        };

        const update = (item) => {
            const childComponent = childComponents.value[item];
            if (childComponent) {
                childComponent.submitForm();
            }
        };

        return {
            childComponents,
            handleUpdate,
            update,
        };
    }
}
</script>
<style lang="">

</style>
