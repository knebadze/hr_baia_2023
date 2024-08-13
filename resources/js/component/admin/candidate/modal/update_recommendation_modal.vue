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
                        <div v-if="Object.keys(m).length > 0">
                            <h5 class="pb-2">რეკომენდაციიის რედაქტირება</h5>
                            <div class="row border py-2" v-if="m[0].has_recommendation.id == 1" v-for="(item, index) in m" :key="index">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>საიდან</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect  v-model="item.recommendation_whom" :options="cla.recommendationFromWhom" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12" v-if="item.recommendation_whom.id == 2">
                                    <div class="form-group">
                                        <label>პოზიცია</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" type="text" v-model="item.position_ka">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>სახელი გვარი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" type="text" v-model="item.name_ka">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>ქვეყნის კოდი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect  v-model="item.number_code" :options="cla.numberCode" deselect-label="Can't remove this value" track-by="phonecode" label="phonecode" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12" >
                                    <div class="form-group">
                                        <label>ნომერი</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" type="text" v-model="item.number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="item.file_path">
                                    <p><u class="text-primary" @click="openPDF(item.file_path)">ფაილის ნახვა</u></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> {{(item.file_path)?'ფაილის განახლება':'ფაილის დამატება'  }} </label>
                                        <div class="ls-inputicon-box">
                                            <input type="file" ref="fileInput" @change="handleFileChange" />
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-md-12 mt-3 d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger ml-2" @click.prevent="deletion(item)" ><i class="fa fa-trash"></i> წაშლა</button>
                                    <button type="button" class="btn btn-success" @click.prevent="update(item)" ><i class=""></i>ცვლილების შენახვა</button>
                                </div>
                            </div>
                            <div class="row border py-2" v-if="m[0].has_recommendation.id == 2" v-for="(item, index) in m" :key="index">
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>არ ქონის მიზეზი</label>
                                        <div class="ls-inputicon-box">
                                            <multiselect  v-model="item.no_reason" :options="cla.noRecommendationReason" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                <template slot="singleLabel" slot-scope="{ option }"></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>არ ქონის მიზეზი დამატებით</label>
                                        <div class="ls-inputicon-box">
                                            <textarea class="form-control" v-model="item.no_reason_info_ka" type="text" placeholder="" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12 mt-3 d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger ml-2" @click.prevent="deletion(item)" ><i class="fa fa-trash"></i> წაშლა</button>
                                    <button type="button" class="btn btn-success" @click.prevent="update(item)" ><i class=""></i>ცვლილების შენახვა</button>
                                </div>
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
                                                რეკომენდაციის დამატება
                                            </a>
                                            <i class="fas fa-angle-down float-right"></i>
                                        </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse hide"  data-parent="#accordion" >
                                            <div class="card-body">

                                                <form @submit.prevent="add" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>გაქვთ რეკომენდაცია?</label>
                                                                <div class="ls-inputicon-box">
                                                                    <multiselect  v-model="newItem.has_recommendation" :options="cla.yesNo" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                                        <template slot="singleLabel" slot-scope="{ option }"></template>
                                                                    </multiselect>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 row" v-if="newItem.has_recommendation && newItem.has_recommendation.id == 1">
                                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>საიდან</label>
                                                                    <div class="ls-inputicon-box">
                                                                        <multiselect  v-model="newItem.recommendation_whom" :options="cla.recommendationFromWhom" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                                                        </multiselect>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-12" v-if="newItem.recommendation_whom == 2">
                                                                <div class="form-group">
                                                                    <label>პოზიცია</label>
                                                                    <div class="ls-inputicon-box">
                                                                        <input class="form-control" type="text" v-model="newItem.position_ka">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>სახელი გვარი</label>
                                                                    <div class="ls-inputicon-box">
                                                                        <input class="form-control" type="text" v-model="newItem.name_ka">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>ქვეყნის კოდი</label>
                                                                    <div class="ls-inputicon-box">
                                                                        <multiselect  v-model="newItem.number_code" :options="cla.numberCode" deselect-label="Can't remove this value" track-by="phonecode" label="phonecode" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                                                        </multiselect>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>ნომერი</label>
                                                                    <div class="ls-inputicon-box">
                                                                        <input class="form-control" type="text" v-model="newItem.number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>ფაილი</label>
                                                                    <div class="ls-inputicon-box">
                                                                        <input type="file" ref="fileInput" @change="handleFileChange" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-12 row" v-if="newItem.has_recommendation && newItem.has_recommendation.id == 2">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>არ ქონის მიზეზი</label>
                                                                    <div class="ls-inputicon-box">
                                                                        <multiselect  v-model="newItem.no_reason" :options="cla.noRecommendationReason" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                                                        </multiselect>
                                                                    </div>
                                                                </div>
                                                                <div class=" col-md-12">
                                                                    <div class="form-group">
                                                                        <label>არ ქონის მიზეზი დამატებით</label>
                                                                        <div class="ls-inputicon-box">
                                                                            <textarea class="form-control" v-model="newItem.no_reason_info_ka" type="text" placeholder="" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-success float-right"  ><i class="fa fa-plus"></i> დამატება</button>
                                                        </div>

                                                    </div>
                                                </form>
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
                    <!-- <button type="button" class="btn btn-success" @click.prevent="update()" ><i class=""></i>შენახვა</button> -->
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
                file: null
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
            openPDF(item) {
                const pdfUrl = `/storage/${item}`;
                window.open(pdfUrl, '_blank');
            },
            handleFileChange(event) {
                this.file = event.target.files[0];
            },
            update(item){
                let currentObj = this
                // let item = this.item
                item.candidate_id = this.items.candidate_id
                item.file_name = (this.file)?this.file.name:null
                const formData = new FormData();
                formData.append('data', JSON.stringify(item))
                if (this.file) {
                    formData.append('file', this.file);
                }
                this.$swal({
                    title: 'ნამდვილად გსურთ რედაქტირება?',
                    //   showDenyButton: true,
                    cancelButtonText:'არა',
                    confirmButtonText: 'კი',
                    showCancelButton: true,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post('/update_candidate_recommendation', formData)
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
                        axios.post('/delete_candidate_recommendation' ,{
                            data: item.id,
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
            add(){
                let currentObj = this
                if (!this.file && this.file.type !== 'application/pdf') {
                    toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }
                let item = this.newItem
                item.candidate_id = this.items.candidate_id
                item.file_name = (this.file)?this.file.name:null
                const formData = new FormData();
                formData.append('data', JSON.stringify(item))
                if (this.file) {
                    formData.append('file', this.file);
                }

                axios.post('/add_candidate_recommendation', formData)
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
            }

        },

        watch:{
            visible: function(){
                this.show()
            },
            'newItem.has_recommendation': function(newVal, oldVal){
                if (Object.keys(this.items.item).length > 0 && newVal.id != this.items.item[0].recommendation) {
                    toast.warning("თუ თქვენ შეცვლით 'გაქვთ რეკომენდაცია?'_ს ველს ძველი მონაცემი წაიშლება", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }
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
