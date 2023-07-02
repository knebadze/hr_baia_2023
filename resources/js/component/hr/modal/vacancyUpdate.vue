<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl ინ " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">რედაქტირება</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="exampleInputEmail1">სახელი გვარი</label>
                            <input class="form-control" v-model="m.employer[`name_${getLang}`]" type="text" :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')">
                        </div>
                        <div class="col-3">
                            <label>მაილი</label>
                            <input class="form-control" v-model="m.employer.email" type="email" placeholder="employer@gmail.com">
                        </div>
                        <div class="col-5">
                             <label>{{ ('ტელეფონის ნომერი') }}</label>
                            <div class="input-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                        <span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}
                                    </button>
                                    <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                                        <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                                    </ul>
                                </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="m.employer.number" placeholder="555666777" onkeypress="return /[0-9]/i.test(event.key)" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="exampleInputEmail1">სათაური</label>
                            <input class="form-control" v-model="m[`title_${getLang}`]" type="text" :placeholder="$t('lang.employer_add_job_vacancy_name_placeholder')">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" @click.prevent="save(updateData)" ><i class=""></i>შენახვა</button>
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
                m: null,
                cla:[],
                numberCode: {
                    'phonecode': 995,
                    'iso':'ge'
                },
                editedFields:[]
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
                    console.log('result', result);
                    this.cla = result.data
                    // this.makeNewObject(this.item)
                    // console.log('singleObject',this.editedFields);
                    this.m = {...this.item}
                    console.log('this.item',this.item);
                    this.showConfirm = true
                } catch (error) {
                    console.log(error);
                }

            },
            hide(){
                this.showConfirm = false
            },
            getClassificatory(){
                return axios.post('/get_classificatory' ,{
                    //   data: updateData,
                  })

            },
            makeNewObject(item){
                console.log('make', item);
                var singleObject = [];

                for (const field in item) {
                    // console.log(item[field]);
                    // this.m.push()
                    if (typeof item[field] == 'object') {
                        this.makeNewObject(item[field])
                    }else{
                        if (!this.editedFields.includes(field)) {
                            this.editedFields[field] = item[field]
                        }

                    }

                }

            },
            // forItem(item){
            //     for (const field in item) {
            //         if (typeof item[field] == 'object') {
            //             this.forItem(item[field])
            //         }
            //         this.editedFields[field] = item[field]
            //         console.log('singleObject',this.editedFields);
            //     }
            // }
            //   save(updateData){
            //       axios.post('/unknown_profile_update' ,{
            //           data: updateData,
            //       })
            //       .then(function (response) {
            //           // handle success
            //           console.log(response.data);
            //           if (response.status == 200) {
            //               toast.success("წარმატებით დაემატა", {
            //                   theme: 'colored',
            //                   autoClose: 1000,
            //               });
            //               setTimeout(() => {
            //                   document.location.reload();
            //               }, 2000);
            //           }



            //       })
            //       .catch(function (error) {
            //           // handle error
            //           console.log(error);
            //       })
            //   }

        },
        watch:{
            visible: function(){
                this.show()
            },
            m: {
                deep: true,
                handler(newValue, oldValue) {
                    console.log('newVal',newValue);
                    console.log('oldVal',oldValue);
                    // if (oldValue != null) {
                    //     for (const field in newValue) {
                    //         // console.log(newVal[field]);
                    //         if (typeof newValue[field] == 'object') {
                    //             console.log(newValue[field]);
                    //             // return

                    //         }
                    //         if ( newValue[field] !== this.item[field] ) {
                    //             console.log(typeof newValue[field]);
                    //             this.editedFields[field] = newValue[field]
                    //             // .push(newValue[field]);
                    //         }
                    //     }
                    // }

                    // console.log('this.editedFields',this.editedFields);
                },

            }
        }
  }
  </script>
  <style lang="">

  </style>
