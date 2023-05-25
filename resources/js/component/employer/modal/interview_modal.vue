<template lang="">
    <!-- Modal -->
<div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">გასაუბრების დანიშვნა</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('გასაუბრების თარიღი') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.date"  type="date"  >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('გასაუბრების დრო') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="m.time"  type="time"  >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>{{ $t('გასაუბრების ადგილი') }}</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="m.place" :options="interviewPlace" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" :placeholder="$t('lang.employer_add_job_select')"  :searchable="true" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="modal-footer">
                <a type="button" class="btn btn-success"  @click="save()"><i class=""></i>შენახვა</a>
            </div>
          </div>
      </div>
  </div>
</template>
<script>

export default {
  props:{
      visible: Boolean,
      id: Number
  },
  data() {
      return {
          showConfirm: false,
          m:{
            'date':'',
            'time':'',
            'place':'',
            'id':''
          },
          interviewPlace:{}
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
        async show(){

            try {
                let result = await this.getClassificatory();
                this.interviewPlace = result.data
                this.showConfirm = true
                this.m.id = this.id
            } catch (error) {

            }

        },
        hide(){
            this.showConfirm = false
        },
        getClassificatory(){
           return  axios.post('/get_interview_classificatory' ,{


            })
        },
        save(){
            axios({
                    method: "post",
                    url: '/like_candidate',
                    data: this.m,

                })
                .then(function (response) {
                    // if (response.status == 200) {
                    //     var index = currentObj.interest.findIndex(object => {
                    //         return object.user_id === id;
                    //     });
                    //     currentObj.interest[index]['employer_answer'] = 0
                    // }

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
  }

}
</script>
<style lang="">

</style>

