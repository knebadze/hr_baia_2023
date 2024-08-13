<template lang="">
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">ტესტიმონიალის დამატება</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>სახელი გვარი KA</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.fullName_ka" type="text" placeholder="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>სახელი გვარი EN</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.fullName_en" type="text" placeholder="" :disabled="!m.fullName_en">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>სახელი გვარი RU</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.fullName_ru" type="text" placeholder="" :disabled="!m.fullName_ru">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>პროფესია KA</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.profession_ka" type="text" placeholder="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>პროფესია EN</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.profession_en" type="text" placeholder="" :disabled="!m.profession_en">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>პროფესია RU</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.profession_ru" type="text" placeholder="" :disabled="!m.profession_ru">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>ტექსტი KA</label>
                            <div class="ls-inputicon-box">
                                <textarea class="form-control" v-model="m.text_ka" type="text" placeholder="" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>ტექსტი EN</label>
                            <div class="ls-inputicon-box">
                                <textarea class="form-control" v-model="m.text_en" type="text" placeholder="" rows="3" :disabled="!m.text_en"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>ტექსტი RU</label>
                            <div class="ls-inputicon-box">
                                <textarea class="form-control" v-model="m.text_ru" type="text" placeholder="" rows="3" :disabled="!m.text_ru"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <button type="button" class="btn btn-info" @click.prevent="translate(m)" ><i class="fa fa-language"></i> თარგმნა</button>
                        <hr>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12" v-if="m.image_path">
                        <img :src="`/storage/${m.image_path}`" alt="" style="width: 100px">
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12" >
                        <div class="form-group">
                            <label><span class="text-danger">* </span>სურათი</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" type="file" ref="fileInput" @change="handleFileChange">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <div class="form-check">
                            <input class="form-check-input" v-model="m.active" type="checkbox" id="isActiveCheckbox">
                            <label class="form-check-label" for="isActiveCheckbox"><span class="text-danger">*</span> აქტიურია</label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button v-if="item" type="button" class="btn btn-success" @click.prevent="update(m)" ><i class=""></i>რედაქტირება</button>
                <button v-else type="button" class="btn btn-success" @click.prevent="save(m)" ><i class=""></i>შენახვა</button>
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
        const showConfirm = ref(false);
        const m = ref(null);
        m.value = props.item ? { ...props.item }: {};
        // m.value.active = false
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        m.value.lang = getLang.value
        const mTranslate = ref(false)
        const file = ref(null);



        const show = () =>{
            showConfirm.value = true
        };

        const hide = () =>{
            showConfirm.value = false
        }

        const handleFileChange = (event) => {
            file.value = event.target.files[0];
            m.value.file_name = file.value.name
        };

        const translate = (item) =>{
            axios({
                method: "post",
                url: "/translate_testimonial",
                data: {'model': item},

            })
            .then(function (response) {
                if (response.status == 200) {
                    m.value = response.data
                    mTranslate.value = true
                    toast.success('წარმატებით თარგმნა', {
                        theme: 'colored',
                        autoClose: 1000,
                    });

                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }

        const save = (item) =>{

            if (!mTranslate.value) {
                toast.error("თარგმნეთ მონაცემები", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return;
            }
            let data = {...item}

            const sendFormData = new FormData();
            sendFormData.append('data', JSON.stringify(data))
            if (file.value) {
                sendFormData.append('file', file.value);
            }

            axios.post('/add_testimonial', sendFormData)
            .then(function (response) {
                if (response.data.status == 200) {

                    toast.success("ინფორმაცია წარმატებით შეინახა", {
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
        };

        const update = (item) =>{
            if (!mTranslate.value) {
                toast.error("თარგმნეთ მონაცემები", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return;
            }
            let data = {...item}

            const sendFormData = new FormData();
            sendFormData.append('data', JSON.stringify(data))
            if (file.value) {
                sendFormData.append('file', file.value);
            }

            axios.post('/update_testimonial', sendFormData)
            .then(function (response) {
                if (response.status == 200) {

                    toast.success("ინფორმაცია წარმატებით დარედაქტირდა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    hide()
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
            handleFileChange,
            save,
            translate,
            update
        }
    }
}
</script>
<style scoped>
  .modal-body{
      height: 250px;
      overflow-y: auto;
  }

  @media (min-height: 500px) {
      .modal-body { height: 400px; }
  }

  @media (min-height: 800px) {
      .modal-body { height: 700px;  }
  }
</style>
