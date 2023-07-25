<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-"></i> რედაქტირების ისტორია</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
                </div>
                <div class="modal-body">

                    <!-- <div class=" p-a20 my-3">
                        <h6 class=" m-a0">დამსაქმებელი </h6>
                    </div>
                    <hr> -->
                    <div class="border border-primary p-2">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ველის სახელი</label>
                                    <div class="ls-inputicon-box">
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="m.column_name">
                                            <option value="">ყველა</option>
                                            <option v-for="(item, index) in column" :key="index" :value="item">{{ item }} </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თარიღი (დან)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="date" v-model="m.date_from">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თარიღი (მდე)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="date" v-model="m.date_to">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-wrap">
                        <thead>
                            <tr>
                                <th>ველის სახელი</th>
                                <th >ძველი მნიშვნელობა</th>
                                <th>HR</th>
                                <th>რედაქტირების თარიღი</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in data" :key="index">
                                <td>{{ item.column_name }}</td>
                                <td :class="(item.old_value == 'ცარიელი იყო')?'text-danger':''">{{ item.old_value }}</td>
                                <td>{{ item.hr}}</td>
                                <td>{{ item.created_at}}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mr-3" @click="hide()" ><i class=""></i>გაუქმება</button>

                </div>
            </div>
        </div>
    </div>
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import moment from 'moment'
  export default {
        props:{
            visible: Boolean,
            vacancyId: Number
        },
        data() {
            return {
                showConfirm: false,
                data:{},
                staticData:{},
                column: {
                    'name_ka': 'სახელი გვარი',
                    'email': 'მაილი',
                    'number': 'ნომერი',
                    'number_code': 'ნომრის კოდი',
                    'address_ka': 'მისამართი',
                    'title_ka': 'სათაური',
                    'vacancy_for_who_need': 'ვისთვის გესაჭიროებათ?',
                    'category': 'კატეგორია',
                    'work_schedule': 'გრაფიკი',
                    'payment': 'ანაზღაურება',
                    'currency': 'ვალუტა',
                    'additional_schedule_ka': 'სამუშაო დღეები და საათები',
                    'status': 'სტატუსი',
                    'status_change_reason': 'სტატუსის შეცვლის მიზეზი',
                    'go_vacation': 'არდადეგებზე გაყოლა',
                    'stay_night': 'ღამე დარჩენა',
                    'work_additional_hours': 'დამატებითი სათები მუშაობა',
                    'start_date': 'დაწყების თარიღი',
                    'term': 'ვადა',
                    'vacancy_benefit': 'ბენეფიტები',
                    'comment':'კომენტარი სააგენტოსთვის',
                    'min_age': 'მინიმალური ასაკი',
                    'max_age': 'მაქსიმალური ასაკი',
                    'education': 'განათლება',
                    'specialty': 'სპეციალობა',
                    'language': 'უცხო ენა',
                    'language_level': 'უცხო ენის ცოდნის დონე',
                    'characteristic': 'მახასიათებლები',
                    'vacancy_duty': 'მოვალეობები',
                    'additional_duty_ka': 'მოვალეობები დამატებით',
                    'interview_place': 'გასაუბრების ადგილი',
                    'must_be_enrolled_employer': 'დამსაქმებლისგან უნდა ჩაირიცხოს',
                    'must_be_enrolled_candidate': 'კანდიდატისგან უნდა ჩაირიცხოს',
                    'must_be_enrolled_employer_date': 'დამსაქმებლისგან უნდა ჩაირიცხოს თარიღი',
                    'must_be_enrolled_candidate_date': 'კანდიდატისგან უნდა ჩაირიცხოს თარიღი',
                    'enrolled_candidate': 'კანდიდატისგან ჩაირიცხა',
                    'enrolled_employer': 'დამსაქმებლისგან ჩაირიცხა',
                    'enrolled_candidate_date': 'კანდიდატისგან თანხის ჩარიცხვის თარიღი',
                    'enrolled_employer_date': 'დამსაქმებლისგან თანხის ჩარიცხვის თარიღი',
                    'hr_bonus': 'ჰრ_ის ანაზღაურება'
                },
                m:{}
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
                    let result = await this.getInfo();
                    this.data = this.makeData(result.data)
                    this.staticData = this.makeData(result.data)
                    console.log('data', result.data);
                    this.showConfirm = true
                } catch (error) {
                    console.log(error);
                }

            },
            getInfo(){
                return axios.post('/get_vacancy_redacted_history_info' ,{
                    data: this.vacancyId,
                })
            },
            hide(){
                this.showConfirm = false
            },
            makeData(item){
                this.key('status')
                let arr = []
                let data = {}
                item.forEach(value => {
                    data = {
                        'column_name': this.key(value.column_name),
                        'old_value': (typeof JSON.parse(value.old_value) === 'object')?this.oldValue(JSON.parse(value.old_value)):JSON.parse(value.old_value),
                        'created_at': moment(value.created_at).format("YYYY-MM-DD HH:mm"),
                        'hr': value.hr.user.name_ka
                    }
                    arr.push(data)
                });
                return arr
            },
            key(item){
                return this.column[item]
            },
            oldValue(item){
                // console.log('old',item);
                if (item && item[0]) {
                    let str = ''
                    // console.log('if', item);
                    item.forEach(element => {
                        if (_.has(element, 'name_ka')) {
                            return str += element.name_ka + '; '
                        }else if(_.has(item, 'name')){
                            return str += element.name + '; '
                        }
                    });
                    return str
                }else if(item){
                    // console.log('else', item);
                    if (_.has(item, 'name_ka')) {
                        return item.name_ka
                    }else if(_.has(item, 'name')){
                        return item.name
                    }else if(item.length == 0){
                        return 'ცარიელი იყო'
                    }else if(item == null){
                        return 'ცარიელი იყო'
                    }
                }else{
                    return 'ცარიელი იყო'
                }
            },
        },
        watch:{
            visible: function(){
                this.show()
            },
            'm.column_name':function(newVal, oldVal){
                if (newVal == '' && oldVal != undefined) {
                    this.data = this.staticData
                    return

                }
                let data = this.data
                this.data =  _.filter(data, function(o) { return o.column_name === newVal; });

            },
            'm.date_from':function(newVal, oldVal){
                if (newVal == '' && oldVal != undefined) {
                    this.data = this.staticData
                    return
                }
                let data = this.data
                this.data =  _.filter(data, function(o) { return moment(o.created_at).format("YYYY-MM-DD") >= moment(newVal).format("YYYY-MM-DD"); });
            },
            'm.date_to':function(newVal, oldVal){
                if (newVal == '' && oldVal != undefined) {
                    this.data = this.staticData
                    return
                }
                let data = this.data
                this.data =  _.filter(data, function(o) { return moment(o.created_at).format("YYYY-MM-DD") <= moment(newVal).format("YYYY-MM-DD"); });
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

