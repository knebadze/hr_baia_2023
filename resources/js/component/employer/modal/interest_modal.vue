<template lang="">
    <!-- Modal -->
<div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"   style="display:block">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">დაინტერესებული კანდიდატები</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 " style="margin-top:50px;" v-for="(item, index) in interest" :key="index">
                        <div class="twm-candidates-grid-style1 mb-5" style="background-color: #fdfff5;">
                            <div class="twm-media" >
                                <div class="twm-media-pic">
                                <img :src="'/images/user-avatar/'+item.candidate.user.avatar" alt="#">
                                </div>
                            </div>
                            <div class="twm-mid-content" >
                                <a href="#" class="twm-job-title">
                                    <h4>{{ item.candidate.user[`name_${getLang}`] }} </h4>
                                </a>
                                <p><span>{{ item[`name_${getLang}`] }}</span></p>
                                <a href="javascript:;"  @click="gotoDetail(item.candidate.id)" class="twm-view-prifile site-text-primary">{{ $t('lang.company_vacancies_page_middle_leftside_read_more') }}</a>

                                <div class="twm-fot-content">
                                    <div class="twm-left-info">
                                    <p class="twm-candidate-address"><i class="feather-map-pin"></i>{{ item[`address_${getLang}`] }}</p>
                                    <i class="fa fa-clock"> 11:23</i>
                                    </div>
                                    <like_dont_like_candidate v-if="item.employer_answer == null" :id="item.id" @newData="handlerNewData"/>
                                    <!-- <div class="twm-left-info mt-3" v-if="item.employer_answer == null">
                                        <button type="button" class="btn btn-danger" @click="doNotLike(item.id)"> <i class="fa fa-thumbs-down"></i> არ მომწონს</button>
                                        <button type="button" class="btn btn-success" @click="like(item.id)"> <i class="fa fa-thumbs-up"></i> მომწონს</button>

                                    </div> -->
                                    <div class="twm-left-info mt-3" v-if="item.employer_answer == 0">
                                        <span><i class="text-danger fa fa-thumbs-down" style="font-size:25px"></i></span>
                                    </div>
                                    <div class="twm-left-info mt-3" v-if="item.employer_answer == 1">
                                        <span><i class="text-success fa fa-thumbs-up" style="font-size:25px"></i></span>
                                        <!-- <button type="button" class="btn btn-info" @click="like()"> <i class="fa fa-eye"></i> გასაუბრება</button> -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div  class="modal-footer">
                <a type="button" class="btn btn-success"  @click="save()"><i class=""></i>შენახვა</a>
            </div> -->
          </div>
      </div>
  </div>
</template>
<script>
import like_dont_like_candidate from '../components/like_dont_like_candidate.vue'
export default {
    components:{
        like_dont_like_candidate
    },
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
          interest:{}
      }
  },
  created(){


  },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        detailUrl(){
            var url = new URL( location.href)
            return url.origin+'/'+this.getLang+'/candidate-detail'
        }
    },
  methods:{
        async show(){

            try {
                let result = await this.getData();
                this.interest = result.data
                this.showConfirm = true
                this.m.id = this.id
            } catch (error) {

            }

        },
        hide(){
            this.showConfirm = false
        },
        getData(){

            return axios({
                method: "post",
                url: '/get_interest_data',
                data: {'id':this.id},

            })
        },
        gotoDetail(id){
            window.open(this.detailUrl+'/'+id);
        },
        handlerNewData(id, answer){
            let index = this.interest.findIndex(object => {
                return object.id === id;
            });
            this.interest[index]['employer_answer'] = answer
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

