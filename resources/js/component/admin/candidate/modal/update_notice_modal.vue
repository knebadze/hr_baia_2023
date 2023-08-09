<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">რედაქტირება</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">

                    <div>
                        <h5 class="pb-2">დოკუმენტის რედაქტირება</h5>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>დოკუმენტის დასახელება</th>
                                    <th>მოქმედება</th>
                                </tr>

                            </thead>
                            <tbody>
                                 <tr v-for="(item, index) in m" :key="index">
                                    <td>
                                        {{ item.notice.name_ka }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info ml-2" @click.prevent="openPDF(item.file_path)" title="ნახვა"><i class="fa fa-eye"></i></button>
                                        <button type="button" class="btn btn-danger ml-2" @click.prevent="remove(index, item)" title="წაშლა"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="pb-2">დოკუმენტის დამატება</h5>
                        <div class="row border py-3">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>დასახელება</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect  v-model="newItem.notice" :options="cla.notice" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>{{ $t('lang.user_profile_page_references_file') }} (PDF ფორმატში)</label>
                                    <div class="ls-inputicon-box">
                                        <input type="file" class="form-control" ref="fileInput" @change="handleFileChange" :placeholder="$t('lang.user_profile_page_medical_please_info')"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success float-right" @click="add(newItem)" ><i class="fa fa-plus"></i> დამატება</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hide()" ><i class=""></i>გაუქმება</button>
                    <!-- <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button> -->
                </div>
            </div>
        </div>
    </div>
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import _ from 'lodash'
  export default {
        props:{
            visible: Boolean,
            items: Object,
        },
        data() {
            return {
                showConfirm: false,
                m: null,
                cla:[],
                newItem:{},
                classificatory:{},
                file:null
            }
        },
        created(){
        },
        computed:{
            getLang(){
                return I18n.getSharedInstance().options.lang
            },
        },
        methods:{
            show(){
                this.m = this.items.item
                console.log('this.m', this.items);
                this.cla = this.items.cla
                this.showConfirm = true

            },
            hide(){
                this.showConfirm = false
            },
            handleFileChange(event) {
                this.file = event.target.files[0];
            },
            add(item){
                item['file'] = (this.file)?this.file.name:null
                if (this.m.length > 0 &&  item.notice.id != 6 && this.m.some((element) => element.notice.id === item.notice.id)) {
                    toast.warning("ცნობა უკვე ატვირთულია შესაცვლელად წაშალეთ ძველი ცნობა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                if (this.file != null && this.file.type !== 'application/pdf') {
                    toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }

                if (this.file == null || item.notice == '') {
                    toast.error("ყველა ველის შევსება სავალდებულოა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                item.user_id = this.items.user_id

                const formData = new FormData();
                formData.append('data', JSON.stringify(item))
                if (this.file) {
                    formData.append('file', this.file);
                }
                console.log('item',item);
                let currentObj = this;
                axios.post('/add_candidate_file', formData)
                .then(function (response) {
                    console.log(response.data);
                    if (response.data.status == 200) {
                        currentObj.m = response.data.data;
                        toast.success("ინფორმაცია წარმატებით შეინახა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            remove(index, id){
                this.$swal({
                    title: 'ნამდვილად გსურთ წაშლა?',
                    //   showDenyButton: true,
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        // console.log(index);
                        // return
                        const removed = this.m.splice(index, 1);
                        axios({
                            method: "post",
                            url: "/delete_candidate_info",
                            data: {'id':id, 'type': 'notice'},

                        })
                        .then(function (response) {
                            // console.log(response.data);
                            if (response.data.status == 200) {
                                toast.success("წარმატებით წაიშალა", {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })

                    } else if (result.isDenied) {
                        return
                    }
                });


            },
            openPDF(item) {
                const pdfUrl = `/storage/${item}`;
                window.open(pdfUrl, '_blank');
            },

        },

        watch:{
            visible: function(){
                this.show()
            },

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
