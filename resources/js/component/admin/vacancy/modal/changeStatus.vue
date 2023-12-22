<template lang="">
    <!-- Modal -->
    <div v-if="showConfirm && data" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">სტატუსის შეცვლა</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()">X</button>
              </div>
              <div class="modal-body ">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <p v-if="!item.title_en" class="text-center text-danger"><strong>შეავსეთ ვაკანსიის სათაური!!! </strong></p>
                    <div class="form-group">
                        <label>{{ $t('სტატუსი') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="m.status"
                                :options="cla"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                :placeholder="$t('lang.employer_add_job_select')"
                                :searchable="true"
                                :allow-empty="false"
                                :disabled="!item.title_en"
                            >
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" v-if="m.status.id == 7">
                    <div class="form-group">
                        <label> სადამდე </label>
                        <input class="form-control" v-model="m.suspended_date" type="date" placeholder="" :min="minData" rows="3">
                    </div>
                </div>
                <div class="col-md-12" v-if="m.status.id == 5 || m.status.id == 7">
                    <div class="form-group">
                        <label> სტატუსის შეცვლის მიზეზი </label>
                        <textarea class="form-control" v-model="m.status_change_reason" type="text" placeholder="" rows="3"></textarea>
                    </div>
                </div>

                <div v-if="m.status.id == 6">
                    <hr>
                    <h6><i class="fa fa-hourglass-start"></i> შეხსენება</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> შეხსენების დრო </label>
                                <input class="form-control" v-model="reminder.date" type="datetime-local" placeholder="" rows="3" :min="minData" :max="maxDate">
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="data.history.length > 0">
                    <hr>
                    <h6><i class="fa fa-list"></i> ისტორია</h6>
                    <hr>
                    <div class="row">
                        <div v-for="(item, index) in data.history" :key="index" class="col-md-5 ml-1 border">
                            <p v-if="item.column_name == 'status'" class=''><strong>შეცვლის თარიღი: </strong><span>{{ changeFormat(item.created_at) }}</span></p>
                            <p v-if="item.column_name == 'status'"  class=''><strong>ძველი სტატუსი: </strong><span>{{ JSON.parse(item.old_value).name_ka }}</span></p>
                        </div>
                    </div>

                </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" @click.prevent="save()" ><i class=""></i>შენახვა</button>
              </div>
              </div>
          </div>
      </div>
      <addPersonalWasEmployed :visible="showModal" :item="modalItem" @emitSave="handlerWasEmployed"/>
  </template>
    <script>
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';
    import moment from 'moment'
    import { ref, computed, watch, onMounted } from 'vue'
    import addPersonalWasEmployed from './addPersonalWasEmployed.vue'
    export default {
        components:{
            addPersonalWasEmployed
        },
        props:{
            visible: Boolean,
            item: Object
        },
        setup(props) {

            const getLang = computed(() => {
                return I18n.getSharedInstance().options.lang;
            });
            const showConfirm = ref(false);
            const data = ref({});
            const m = ref({});
            const cla = ref(null);
            const reminder = ref({});
            const maxDate = ref( null);
            const minData = ref( null);
            const currentDate = moment();
            const showModal = ref(false);
            const modalItem = ref(null);

            const show = async () => {
                try {
                    let result = await getClassificatory();
                    data.value = result.data
                    m.value = makeModel(props.item)
                    cla.value = makeCla(props.item.status.id)
                    maxDate.value = getMaxDate(props.item)
                    minData.value = currentDate.format('YYYY-MM-DD HH:mm')
                    showConfirm.value = true
                } catch (error) {
                    console.log(error);
                }

            };

            const hide = () => {
                showConfirm.value = false
            };

            const  getClassificatory = () => {
                return axios.post('/get_status_change_info' ,{
                      data: props.item.id,
                  })

            };

            const  makeModel = (item) => {
                let newItem = {}
                newItem.id = item.id
                newItem.status = item.status
                newItem.status_change_reason = item.status_change_reason

                return {...newItem}
            };

            const getMaxDate = (item) => {
                return moment(item.start_date).subtract(1, 'weeks').format('YYYY-MM-DD HH:mm');
            };

            const makeCla = (id) => {
                let status = []
                const excludeMap = {
                    1: [3],
                    2: [2],
                    3: [2, 3, 5, 6, 7],
                    6: [ 3 ],
                    7: [ 3 ]
                };

                if (excludeMap.hasOwnProperty(id)) {
                    status = data.value.status.filter(item => !excludeMap[id].includes(item.id));
                }

                return status
            };

            const forItem = (item) => {
                let editedFields = {}
                for (const field in item) {
                    if ( item[field] !== props.item[field] ) {
                            editedFields[field] = props.item[field]
                    }
                }
                return editedFields
            };

            const statusInput = () => m.value.status;
            watch(statusInput, (newVal) => {
                if (newVal.id == 7) {
                    const dateInThreeWeeks = currentDate.clone().add(3, 'weeks');
                    minData.value = dateInThreeWeeks.format('YYYY-MM-DD')
                }
                if (newVal.id == 3) {
                    openModal()
                }

            });

            const openModal = () =>{
                showModal.value = !showModal.value
                modalItem.value = props.item
            };

            const handlerWasEmployed = (item = false) =>{
                if (item) {
                    save()
                }

            }

            const save = () =>{
                // return
                if (m.value.status.id == 6) {
                    m.value['reminder'] = reminder.value
                }

                let editedFields = forItem(m.value)
                axios.post('/update_vacancy_status' ,{
                    data: {'model':m.value, 'edit': editedFields},
                })
                .then(function (response) {
                    // handle success
                    if (response.status == 200 && response.data.data[0].type == 's') {

                        toast.success(response.data.data[0].message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        setTimeout(() => {
                            document.location.reload();
                        }, 2000);
                    }else if(response.status == 200 && response.data.data[0].type == 'e'){
                        toast.error(response.data.data[0].message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });


                    }else if(response.status == 200 && response.data.data[0].type == 'w'){
                        toast.error(response.data.data[0].message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        openModal()

                    }

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            };

            const changeFormat = (time) => {
                return moment(time).format("YYYY-MM-DD HH:mm")
            };


            return {
                showConfirm,
                m,
                cla,
                data,
                reminder,
                maxDate,
                minData,

                show,
                hide,
                save,
                changeFormat,
                getLang,

                showModal,
                modalItem,
                handlerWasEmployed
            }
        },
        watch:{
            visible: function(){
                this.show()
            }
        }
    }
  </script>
  <style lang="">

  </style>
