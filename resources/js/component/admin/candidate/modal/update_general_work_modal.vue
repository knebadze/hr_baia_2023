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
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>სამუშაო გამოცდილება</label>
                            <div class="ls-inputicon-box">
                                <multiselect  v-model="experience" :options="cla.yesNo" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <div v-if="experience.id == 1">
                        <div v-if="Object.keys(m).length">
                            <h5 class="pb-2">ზოგადი სამუშაო გამოცდილების რედაქტირება</h5>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ობიექტი</th>
                                        <th>პოზიცია</th>
                                        <th>გამოცდილება</th>
                                        <th>მოქმედება</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in m" :key="index">
                                        <td>
                                            <div class="form-group">
                                                <div class="ls-inputicon-box">
                                                    <input class="form-control" type="text" v-model="item.object_ka">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="ls-inputicon-box">
                                                    <input class="form-control" type="text" v-model="item.position_ka">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="ls-inputicon-box">
                                                    <multiselect  v-model="item.work_experience" :options="cla.workExperiences" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
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
                        </div>

                        <h5 class="pb-2">გამოცდილები დამატება</h5>
                        <div class="row border py-3">
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ობიექტი</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="text" v-model="newItem.object_ka">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>პოზიცია</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="text" v-model="newItem.position_ka">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>სამუშაო გამოცდილება</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect  v-model="newItem.work_experience" :options="cla.workExperiences" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
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
                    <div class="row" v-if="experience.id == 2">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>არ ქონის მიზეზი</label>
                                <div class="ls-inputicon-box">
                                    <multiselect  v-model="m.no_reason" :options="cla.noExperienceReason" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                    </multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>არ ქონის მიზეზი დამატებით</label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" v-model="m.no_reason_info_ka" type="text" placeholder="" rows="3"></textarea>
                                </div>
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
                experience:{},
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
                this.experience = (this.items.item.length != 0)?this.items.item[0].has_experience:''
                this.cla = this.items.cla
                this.showConfirm = true

            },
            hide(){
                this.showConfirm = false
            },
            save(){
                if (this.experience.id == 2) {
                    this.m.has_experience = this.experience
                    this.m.candidate_id = this.items.candidate_id
                    this.m = [this.m]
                }
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
                            data: {'model':this.m, 'type': 'general_work_experience'},
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
                delete this.m[index];
            },
            add(item){
                if (!item.hasOwnProperty('object_ka') || !item.hasOwnProperty('position_ka') || !item.hasOwnProperty('work_experience')) {
                    toast.error("ყველა პარამეტრის შევსება სავალდებულოა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                item.candidate_id = this.items.candidate_id
                item.has_experience = this.experience
                this.m[Object.keys(this.m).length] = {...item}
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
