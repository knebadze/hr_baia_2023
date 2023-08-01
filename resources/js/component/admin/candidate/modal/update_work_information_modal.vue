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
                        <h5 class="pb-2">სამუშაო ინფორმაციის რედაქტირება</h5>
                        <div class="row border py-2" v-for="(item, index) in m.work_information" :key="index">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>კატეგორია</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect  v-model="item.category" :options="cla.category" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>გრაფიკი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="item.work_schedule"  :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false">
                                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ანაზღაურება</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="number" v-model="item.payment" step="50">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ვალუტა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect  v-model="item.currency" :options="cla.currency" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="m.go_vacation">
                                    <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="m.stay_night">
                                    <label class="form-check-label" for="exampleCheck2">შეეძლოს ღამე დარჩენა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="m.work_additional_hours">
                                    <label class="form-check-label" for="exampleCheck3">შეეძლო დამატებით საათებში მუშაობა</label>
                                </div>
                            </div>
                        </div>
                        <!-- <button type="button" class="btn btn-danger ml-2" @click.prevent="deletion(index, item)" ><i class=""></i>წაშლა</button> -->
                        <h5 class="pb-2">უცხო ენის დამატება</h5>
                        <!-- <div class="row border py-3">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>უცხო ენა</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect  v-model="newItem.language" :options="cla.languages" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ცოდნის დონე</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect  v-model="newItem.level" :options="cla.languageLevels" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success float-right" @click="add(newItem)" ><i class="fa fa-plus"></i> დამატება</button>
                            </div>
                        </div> -->
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
                console.log('this.m', this.items);
                this.cla = this.items.cla
                this.showConfirm = true

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
                            data: {'model':this.m, 'type': 'language'},
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
                if (!item.hasOwnProperty('language') || !item.hasOwnProperty('level')) {
                    toast.error("ორივე პარამეტრის შევსება სავალდებულოა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                if (Object.values(this.m).some((el) => el.language.id === item.language.id)) {
                    toast.error("ეს უცხო ენა უკვე დამატებული გაქვთ", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                item.candidate_id = this.m[0].candidate_id
                this.m[Object.keys(this.m).length + 1] = item
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
