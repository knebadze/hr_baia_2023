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
                            <input type="text" class="form-control" name="" id="" value="დასაქმდა" disabled>
                            <!-- <multiselect v-model="m.type" :options="cla.qualifyingType" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="აირჩიე ტიპი"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect> -->
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
                                <input type="text" class="form-control"  id="">
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-4">
                        <div class="form-group">
                            <label>სახელი გვარი</label>
                            <div class="ls-inputicon-box">
                                <input type="text" class="form-control" id="">
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-4">
                        <div class="form-group">
                            <label>ნომერი</label>
                            <div class="ls-inputicon-box">
                                <input type="text" class="form-control" id="">
                            </div>
                        </div>
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
            // async
            show(){
                // try {
                    console.log('item', this.item);

                    // let result = await this.getClassificatory();
                    // console.log('result', result.data);
                    // this.cla = result.data.classificatory
                    // this.info  = result.data.findCandidate
                    this.m = {...this.item}
                    // this.m['type'] = (result.data.findCandidate)?result.data.findCandidate.qualifying_type:null
                    this.showConfirm = true

                // } catch (error) {
                //     console.log(error);
                // }

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
