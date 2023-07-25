<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show " tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
              <div class="modal-content border border-danger">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">კანდიდატის გადაყვანა ვაკანსის (ID:{{ item.code }}) დასაქმებულის სტატუსში</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body ">
                <div class=" col-md-12">
                    <div class="form-group">
                        <label>აირჩიე კანდიდატი</label>
                        <div class="ls-inputicon-box">
                            <select class="form-control" id="exampleFormControlSelect1" v-model="selected">
                                <option value="">აირჩიე</option>
                                <option v-for="(item, index) in info" :key="index" :value="item">{{ `${item.candidate.user.name_ka} - (ID: ${item.candidate_id}) - ${item.qualifying_type.name}`}} </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class=" col-md-12 border mb-3"></div>
                <h6><i class="fa fa-search"></i>ან მოძებნე</h6>
                <hr>
                <div class="row">
                    <div class=" col-md-4">
                        <div class="form-group">
                            <label>კანდიდატის ID</label>
                            <div class="ls-inputicon-box">
                                <input type="text" class="form-control"  id="" v-model="search.id">
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-4">
                        <div class="form-group">
                            <label>სახელი გვარი</label>
                            <div class="ls-inputicon-box">
                                <input type="text" class="form-control" id="" v-model="search.name">
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-4">
                        <div class="form-group">
                            <label>ნომერი</label>
                            <div class="ls-inputicon-box">
                                <input type="text" class="form-control" id="" v-model="search.number">
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12 d-flex justify-content-end">
                        <button  type="button" class="btn btn-info" @click.prevent="find()" ><i class="fa fa-search"></i> ძებნა</button>
                    </div>
                </div>
                <div class="mt-2" v-if="candidate.length > 0">
                    <div class=" col-md-12 border mb-3"></div>
                    <h6><i class="fa fa-users"></i> მოიძებნა {{ candidate.length }} კანდიდატი</h6>
                    <hr>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>სახელი გვარი</th>
                                <th>ნომერი</th>
                                <th>სურათი</th>
                                <th>არჩევა</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in candidate" :key="index">
                                <td>{{ item.id }}</td>
                                <td>{{ item.user.name_ka }}</td>
                                <td>{{ item.user.number }}</td>
                                <td><img :src="'/images/user-avatar/'+item.user.avatar" alt="#" style="height:50px"></td>
                                <td>
                                    <button v-if=" m.candidate_id == item.id" type="button" class="btn btn-danger" @click.prevent="cancel()" title='გაუქმება'><i class="fa fa-times"></i></button>
                                    <button v-else type="button" class="btn btn-warning" @click.prevent="chose(item.id)" title='არჩევა'><i class="fa fa-plus"></i></button>

                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>

              </div>
              <div class="modal-footer">


                <button  type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
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
            item: Object
        },
        data() {
            return {
                showConfirm: false,
                cla:{},
                m: {
                    'candidate_id': null,
                    'vacancy_id': null
                },
                info: {},
                search:{},
                selected: null,
                candidate:[],
            }
        },
        created(){

            // this.showConfirm = this.visible
        },
        computed:{
            getLang(){
                return I18n.getSharedInstance().options.lang
            },
        },
        methods:{
            async show(){
                try {

                    let result = await this.getClassificatory();
                    this.info  = result.data
                    this.showConfirm = true

                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            getClassificatory(){
                return axios.post('/get_add_personal_was_employed_info' ,{
                    data: this.item.id ,
                })

            },
            save(){
                if (!this.m.candidate_id && !this.m.vacancy_id) {
                    toast.error("შესანახად აირჩიეთ კანდიდატი", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                console.log('this.m', this.m);
                let currentObj = this
                axios.post('/add_vacancy_personal_was_employed' ,{
                    data: this.m,
                })
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    if (response.status == 200) {
                        toast.success("წარმატებით დაემატა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        currentObj.hide()
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            find(){
                let currentObj = this;
                axios({
                        method: "post",
                        url: '/find_personal',
                        data: this.search,

                    })
                .then(function (response) {
                    // handle success
                    console.log('candidate',response.data);
                    currentObj.candidate = response.data

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            chose(id){
                if (this.m.candidate_id && this.m.vacancy_id) {
                    toast.error("თქვენ უკვე აირჩიეთ კანდიდატი", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                this.m.candidate_id = id
                this.m.vacancy_id = this.item.id
            },
            cancel(){
                this.m.candidate_id = null
                this.m.vacancy_id = null
            }

        },
        watch:{
            visible: function(){
                this.show()
            },
            'selected':function (newValue, oldValue) {
                this.m.candidate_id = newValue.candidate_id
                this.m.vacancy_id = newValue.vacancy_id
            }
        }
  }
  </script>
  <style lang="">

  </style>
