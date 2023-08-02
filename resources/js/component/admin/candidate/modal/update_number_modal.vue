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
                        <h5 class="pb-2">უცხო ენის რედაქტირება</h5>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>კოდი</th>
                                    <th>ნომერი</th>
                                    <th>მფლობელი</th>
                                    <th>მოქმედება</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in m" :key="index">
                                    <td>
                                        <div class="form-group">
                                            <div class="ls-inputicon-box">
                                                <multiselect  v-model="item.number_code" :options="cla.numberCode" deselect-label="Can't remove this value" track-by="phonecode" label="phonecode" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                                </multiselect>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" v-model="item.number" type="text"  >
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="ls-inputicon-box">
                                                <multiselect  v-model="item.number_owner" :options="cla.numberOwner" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                                </multiselect>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger ml-2" @click.prevent="deletion(index, item)" ><i class=""></i>წაშლა</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h5 class="pb-2">ნომრის დამატება</h5>
                        <div class="row border py-3">
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>კოდი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect  v-model="newItem.number_code" :options="cla.numberCode" deselect-label="Can't remove this value" track-by="phonecode" label="phonecode" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ნომერი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="newItem.number" type="text"  >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>მფლობელი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect  v-model="newItem.number_owner" :options="cla.numberOwner" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
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
                    <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
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
                numberCode: {
                    'phonecode': '',
                    'iso':''
                },
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
                this.m = {...this.items.item}
                console.log('this.m', this.m);
                this.cla = this.items.cla
                this.showConfirm = true
                console.log(this.cla.numberCode.find(element => element.numbercode == 995));
                this.newItem.number_code = this.cla.numberCode.find(element => element.phonecode == 995);

            },
            hide(){
                this.showConfirm = false
            },
            save(){
                let currentObj = this
                this.$swal({
                    title: 'ნამდვილად გსურთ რედაქტირება?',
                    //   showDenyButton: true,
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post('/update_candidate' ,{
                            data: {'model':this.m, 'type': 'number'},
                        })
                        .then(function (response) {
                            if (response.status == 200) {
                                currentObj.hide()
                                toast.success("წარმატებით დარედაქტირდა", {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });
                            }

                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                        // this.hide()

                    } else if (result.isDenied) {
                        return
                    }
                });

            },
            deletion(index, item){
                if (item.language_level_id == 1) {
                    toast.error("მშობლიური ენის წაშლა არ შეიძლება გთხოვთ დაარედაქტიროთ", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                delete this.m[index];
            },
            add(item){
                // if (!item.hasOwnProperty('language') || !item.hasOwnProperty('level')) {
                //     toast.error("ორივე პარამეტრის შევსება სავალდებულოა", {
                //         theme: 'colored',
                //         autoClose: 1000,
                //     });
                //     return
                // }
                if (Object.values(this.m).some((el) => el.number_owner.id === item.number_owner.id)) {
                    toast.error("ეს უცხო ენა უკვე დამატებული გაქვთ", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                item.candidate_id = this.items.candidate_id
                this.m[Object.keys(this.m).length ] = item
            }

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
