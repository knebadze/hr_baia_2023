<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">გრაფიკი</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <p><strong>გრაფიკი:</strong> {{ items.vacancy.work_schedule.name_ka }}</p>
                    <p><strong>სამუშაო დღეები:</strong> {{ items.vacancy.additional_schedule_ka }}</p>
                </div>
                <div class="calendar-container">
                    <FullCalendar :options='calendarOptions' />
                </div>
              </div>
              <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button> -->
              </div>
              </div>
          </div>
      </div>
  </template>
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import FullCalendar from '@fullcalendar/vue3'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import multiMonthPlugin from '@fullcalendar/multimonth'
  export default {
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        props:{
            visible: Boolean,
            item: Number
        },

        data() {
            return {
                showConfirm: false,
                data: {},
                m: {},
                cla: null,
                items:{},
                calendarOptions: {
                    plugins: [multiMonthPlugin],
                    // headerToolbar: {
                    //     left: 'prev,next today',
                    //     center: 'title',
                    //     // right: 'multiMonthYear'
                    // },
                    initialView: 'multiMonthYear',
                    // multiMonthMaxColumns: 1,
                    events: [
                        // { title: 'სამუშაო დღები', start: new Date(), display: 'background' }
                    ],
                    height: 640,
                }
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
                    // console.log('result', result.data);
                    this.items = result.data
                    this.calendarOptions.events = this.event( JSON.parse(result.data.schedule.work_day))
                    this.showConfirm = true
                } catch (error) {
                    console.log(error);
                }

            },
            event(schedule){
                // console.log('schedule', schedule);
                let arr = [];
                schedule.forEach(element => {
                    // console.log(element);
                    // title: this.items.vacancy.code,
                    let obj = {  start: element, display: 'background' }
                    arr.push(obj);
                });
                return arr
            },
            hide(){
                this.showConfirm = false
            },
            // save(){
            //     if (!this.m.hasOwnProperty('reason') || !this.m.hasOwnProperty('reason_info')) {
            //         toast.error('შევსება სავალდებულოა', {
            //             theme: 'colored',
            //             autoClose: 2000,
            //         });
            //         return
            //     }
            //     let currentObj = this
            //     this.$swal({
            //         title: 'ნამდვილად გსურთ სამუშაოს დასრულება?',
            //         html:'ცვლილება ავტომატურად მოხსნის კანდიდატს ვაკანის დასაქმებული სტატუსიდან',
            //         //   showDenyButton: true,
            //         cancelButtonText:'არა',
            //         confirmButtonText: 'კი',
            //         showCancelButton: true,
            //     }).then((result) => {
            //     /* Read more about isConfirmed, isDenied below */
            //     // return
            //         if (result.isConfirmed) {
            //             axios({
            //                 method: "post",
            //                 url: "/end_work",
            //                 data: {'model': this.m},

            //             })
            //             .then(function (response) {
            //                 // console.log(response.data);
            //                 if (response.data.status == 200) {
            //                     if (response.data.data.type == 'e') {
            //                         toast.error(response.data.data.message, {
            //                             theme: 'colored',
            //                             autoClose: 2000,
            //                         });
            //                         currentObj.hide()
            //                     }else{
            //                         toast.success(response.data.data.message, {
            //                             theme: 'colored',
            //                             autoClose: 1000,
            //                         });
            //                     }

            //                 }
            //             })
            //             .catch(function (error) {
            //                 // handle error
            //                 console.log(error);
            //             })

            //         } else if (result.isDenied) {
            //             return
            //         }
            //     });
            // },
            getClassificatory(){
                return axios.post('/get_schedule_info' ,{
                      data: this.item,
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
  <style scoped>
    .modal-body{
        height: 250px;
        overflow-y: auto;
    }
    .calendar-container {
        width: 100%; /* Adjust as needed */
        height: 100px; /* Adjust as needed */
    }
    @media (min-height: 500px) {
        .modal-body { height: 400px; }
    }

    @media (min-height: 800px) {
        .modal-body { height: 700px;  }
    }
  </style>
