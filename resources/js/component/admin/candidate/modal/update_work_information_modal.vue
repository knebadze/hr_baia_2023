<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">რედაქტირება</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">

                    <div>
                        <h5 class="pb-2">სამუშაო ინფორმაციის რედაქტირება</h5>
                        <div class="row border py-2" v-for="(item, index) in m" :key="index">
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
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="item.go_vacation">
                                    <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="item.stay_night">
                                    <label class="form-check-label" for="exampleCheck2">შეეძლოს ღამე დარჩენა</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="item.work_additional_hours">
                                    <label class="form-check-label" for="exampleCheck3">შეეძლო დამატებით საათებში მუშაობა</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label>დამატებითი სამუშაო გრაფიკი</label>
                                    <div class="ls-inputicon-box">
                                        <textarea class="form-control" v-model="item.additional_schedule_ka" type="text" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12 mt-3 d-flex justify-content-between">
                                <button type="button" class="btn btn-danger ml-2" @click.prevent="deletion(item.id)" ><i class="fa fa-trash"></i> წაშლა</button>
                                <button type="button" class="btn btn-success" @click.prevent="save(item)" ><i class=""></i>ცვლილების შენახვა</button>
                            </div>
                        </div>
                        <!-- <button type="button" class="btn btn-danger ml-2" @click.prevent="deletion(index, item)" ><i class=""></i>წაშლა</button> -->

                        <section class="content ">
                            <div class="container-fluid">
                                <div id="accordion" >
                                    <div class="card card-primary" >
                                        <div class="card-header">
                                        <h4 class="card-title w-100 d-flex justify-content-between">
                                            <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                                                სამუშაო ინფორმაციის დამატება
                                            </a>
                                            <i class="fas fa-angle-down float-right"></i>
                                        </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse hide"  data-parent="#accordion" >
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label>კატეგორია</label>
                                                            <div class="ls-inputicon-box">
                                                                <multiselect  v-model="newItem.category" :options="cla.category" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                                                </multiselect>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label>გრაფიკი</label>
                                                            <div class="ls-inputicon-box">
                                                                <multiselect v-model="newItem.work_schedule"  :options="cla.workSchedule" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true"  label="name_ka" track-by="name_ka" :preselect-first="false">
                                                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
                                                                </multiselect>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label>ანაზღაურება</label>
                                                            <div class="ls-inputicon-box">
                                                                <input class="form-control" type="number" v-model="newItem.payment" step="50">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label>ვალუტა</label>
                                                            <div class="ls-inputicon-box">
                                                                <multiselect  v-model="newItem.currency" :options="cla.currency" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                                                </multiselect>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                                        <div class=" form-check">
                                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" v-model="newItem.go_vacation">
                                                            <label class="form-check-label" for="exampleCheck1">შეეძლოს არდადეგებზე გაყოლა</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                                        <div class=" form-check">
                                                            <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" v-model="newItem.stay_night">
                                                            <label class="form-check-label" for="exampleCheck2">შეეძლოს ღამე დარჩენა</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-md-12 mt-3">
                                                        <div class=" form-check">
                                                            <input type="checkbox" class="form-check-input" id="exampleCheck3" value="1" v-model="newItem.work_additional_hours">
                                                            <label class="form-check-label" for="exampleCheck3">შეეძლო დამატებით საათებში მუშაობა</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label>დამატებითი სამუშაო გრაფიკი</label>
                                                            <div class="ls-inputicon-box">
                                                                <textarea class="form-control" v-model="newItem.additional_schedule_ka" type="text" placeholder="" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-success float-right" @click="add(newItem)" ><i class="fa fa-plus"></i> დამატება</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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
                this.m = makeModel(this.items.item)
                function makeModel(params) {
                    let arr =[]
                    params.forEach(element => {
                        element.stay_night = (element.stay_night == 1 )?true:0;
                        element.go_vacation = (element.go_vacation == 1 )?true:0;
                        element.work_additional_hours = (element.work_additional_hours == 1 )?true:0;
                        arr.push(element)
                    });

                    return {...arr}
                }
                this.cla = this.items.cla
                this.showConfirm = true

            },
            hide(){
                this.showConfirm = false
            },
            save(item){
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
                            data: {'model':item, 'type': 'work_information'},
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
            deletion(item){
                let currentObj = this
                this.$swal({
                    title: 'ნამდვილად გსურთ წაშლა?',
                    //   showDenyButton: true,
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post('/update_candidate' ,{
                            data: {'model':item, 'type': 'work_information_delete'},
                        })
                        .then(function (response) {
                            if (response.status == 200) {
                                currentObj.hide()
                                toast.success("წარმატებით წაიშალა", {
                                    theme: 'colored',
                                    autoClose: 1000,
                                });
                                setTimeout(() => {
                                    document.location.reload();
                                }, 1000);
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
            add(item){
                // if (!item.hasOwnProperty('language') || !item.hasOwnProperty('level')) {
                //     toast.error("ორივე პარამეტრის შევსება სავალდებულოა", {
                //         theme: 'colored',
                //         autoClose: 1000,
                //     });
                //     return
                // }
                if (Object.values(this.m).some((el) => el.category.id === item.category.id)) {
                    toast.error("ეს კატეგორია უკვე დამატებული გაქვთ", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                (!item.hasOwnProperty('stay_night'))?item.stay_night = 0:'';
                (!item.hasOwnProperty('go_vacation'))?item.go_vacation = 0:'';
                (!item.hasOwnProperty('work_additional_hours'))?item.work_additional_hours = 0:'';
                item.candidate_id = this.items.candidate_id;
                item.category_id = item.category.id
                this.m[Object.keys(this.m).length ] = {...item}

                this.save(item)
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
