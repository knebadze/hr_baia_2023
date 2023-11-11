<template lang="">
    <section class="content ">
    <div class="container-fluid">
        <div id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                  <h4 class="card-title w-100 d-flex justify-content-between">
                    <a class="d-block w-100" data-toggle="collapse"  href="#collapseOne">
                      ფილტრი
                    </a>
                    <i class="fas fa-angle-down float-right"></i>
                  </h4>
                </div>
                <div id="collapseOne" class="collapse" :class="colspan" data-parent="#accordion" >
                    <div class="card-body">
                         <div class="row">
                            <div class=" col-md-12" v-if="roleId == 1">
                                <div class="form-group">
                                    <label>HR</label>
                                    <div class="ls-inputicon-box" >
                                        <multiselect v-model="m.hr" :options="hr" deselect-label="Can't remove this value" track-by="name_ka" label="name_ka" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>ვაკანსისი ID</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" v-model="m.vacancy_id"  type="text" placeholder="907368268">
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6" >
                                <div class="form-group">
                                    <label>სტატუსი</label>
                                    <div class="ls-inputicon-box">
                                        <multiselect v-model="m.status" :options="status" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                            <template slot="singleLabel" slot-scope="{ option }"></template>
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თარიღი (დან)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="date" v-model="m.date_from">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>თარიღი (მდე)</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" type="date" v-model="m.date_to">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-success" @click="find(m)"><i class="fa fa-search"></i> ძებნა</button>
                    </div>
                </div>
              </div>




        </div>
    </div>
  </section>
</template>
<script>
import axios from 'axios';
import { ref, onMounted,computed } from 'vue'
export default {
    props:{
        roleId: Number
    },
    emits:['emitFilterData'],
    setup(props, {emit}) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const m = ref({});
        const colspan = ref('hide');
        const data = ref(null);
        const hr = ref([]);
        const status = ref([
            {
                'id': 0,
                'name': 'გადაცილებული',
            },
            {
                'id': 1,
                'name': 'მიმდინარე',
            },
            {
                'id': 2,
                'name': 'შესრულებული',
            }
        ]);

        onMounted(() => {
            axios({
                method: "post",
                url: '/get_hr_cla',
            })
            .then(function (response) {

                hr.value = response.data
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        });


        const find = (m) =>{
            if (m.date_from && !m.date_to) {
                toast.error("თარიღი (მდე) შევსვება სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            // this.colspan = 'hide'
            m.date = (m.date_from || m.date_to)?[m.date_from, m.date_to]:null
            axios({
                method: "post",
                url: '/vacancy_reminder_filter',
                data: m,

            })
            .then(function (response) {
                sendEmit(response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
        const sendEmit = (item) =>{
            for (let i = 0; i < item.length; i++) {
                item[i]['code'] = item[i].vacancy.code;
                item[i]['hr_name'] = item[i].hr.user.name_ka
            }
            emit('emitFilterData', item)
        }

        return{
            m,
            colspan,
            hr,
            status,
            find
        }
    },
}
</script>
<style lang="">

</style>
