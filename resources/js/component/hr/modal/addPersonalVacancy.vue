<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">ვაკანსიისთვის კანდიდატის შერჩევა</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div v-if="this.info" class="col-12">
                    <div  class="alert alert-dismissible alert-info" >
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
                        <span>ეს კანდიდატი უკვე გყავთ დამატებული ვაკანსიაზე <strong>{{ ` "${m.type.name}" ` }}</strong>  ველში</span>
                    </div>
                </div>
                 <div class=" col-md-12">
                    <div class="form-group">
                        <label>შესარჩევი ტიპი</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="m.type" :options="cla.qualifyingType" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="აირჩიე ტიპი"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="m.type && m.type.id == 3">
                    <div class=" col-md-6" >
                        <div class="form-group">
                            <label>გასაუბრების ადგილი</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.interview_place" :options="cla.interviewPlace" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="აირჩიე ტიპი"  :searchable="true" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label> გასაუბრების დრო </label>
                                <input class="form-control" v-model="m.interview_date" type="datetime-local" >
                            </div>
                        </div>
                </div>
              </div>
              <div class="modal-footer">
                <button v-if="this.info" type="button" class="btn btn-success" @click.prevent="update()" ><i class=""></i>განახლება</button>
                <button v-else type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
              </div>
              </div>
          </div>
      </div>
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  export default {
        props:{
            visible: Boolean,
            item: Object
        },
        data() {
            return {
                showConfirm: false,
                cla:{},
                m: null,
                info: {}
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
                    console.log('item', this.item);

                    let result = await this.getClassificatory();
                    console.log('result', result.data);
                    this.cla = result.data.classificatory
                    this.info  = result.data.findCandidate
                    this.m = {...this.item}
                    this.m['type'] = (result.data.findCandidate)?result.data.findCandidate.qualifying_type:null
                    this.showConfirm = true

                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            // makeModel(item){
            //     var newItem = {}
            //     newItem.id = item.id
            //     newItem.status = item.status
            //     newItem.status_change_reason = item.status_change_reason

            //     return {...newItem}
            // },
            getClassificatory(){
                return axios.post('/get_add_personal_info' ,{
                    data: {'candidate_id':this.item.candidate_id, 'vacancy_id':this.item.vacancy_id },
                })

            },
            save(){

                console.log('this.m', this.m);
                let currentObj = this
                axios.post('/add_vacancy_personal' ,{
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
                        // setTimeout(() => {
                        //     document.location.reload();
                        // }, 2000);
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            update(){

                console.log('this.m', this.m);
                let currentObj = this
                axios.post('/update_vacancy_personal' ,{
                    data: this.m,
                })
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    if (response.status == 200) {
                        toast.success("წარმატებით განახლდა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        currentObj.hide()
                        // setTimeout(() => {
                        //     document.location.reload();
                        // }, 2000);
                    }



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },

            // forItem(item){
            //     var editedFields = {}
            //     for (const field in item) {
            //         if ( item[field] !== this.item[field] ) {
            //                 editedFields[field] = this.item[field]
            //         }
            //     }
            //     return editedFields
            // },
            // changeFormat(time){
            //     return moment(time).format("YYYY-MM-DD HH:mm")
            // }

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
