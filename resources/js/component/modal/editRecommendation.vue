<template lang="">
          <!-- Modal -->
  <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  aria-hidden="true" style="display:block">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">რეკომენდაციის ჩასწორება</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide()"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_recomendation_from') }}</label>
                        <div class="ls-inputicon-box">
                            <select class="form-select form-select-lg border-0 rounded " style="background-color: #f0f6fe;"  v-model="candidateRecommendationModel.recommendation">
                                <option :value="1">წარმოვადგენ</option>
                                <option :value="2">ვერ წარმოვადგენ</option>
                            </select>
                            <!-- <i class="fs-input-icon fa fa-thumbs-up"></i> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-12 " :class="(candidateRecommendationModel.recommendation == 1)?'':'visually-hidden'" >
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_recomendation_where_from') }}</label>
                        <div class="ls-inputicon-box">
                            <select class="form-select form-select-lg border-0 rounded " style="background-color: #f0f6fe;"  v-model="candidateRecommendationModel.recommendation_from_whom_id" >
                                <option v-for="recommendationFrom in data.classificator.recommendationFromWhom " :value="recommendationFrom.id">{{ recommendationFrom[`name_${getLang}`] }}</option>
                            </select>
                            <!-- <i class="fs-input-icon fa fa-industry"></i> -->
                        </div>
                    </div>
                </div>
                <div v-if="candidateRecommendationModel.recommendation == 1 " class="col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_recomendation_name') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="candidateRecommendationModel.name" type="text" placeholder="">
                            <i class="fs-input-icon fa fa-star"></i>
                        </div>
                    </div>
                </div>
                <div v-if="candidateRecommendationModel.recommendation_from_whom_id == 2 " class=" col-md-12">
                    <div class="form-group">
                        <label>თანამდებობა</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="candidateRecommendationModel.position" type="text" placeholder="">
                            <i class="fs-input-icon fa fa-user"></i>
                        </div>
                    </div>
                </div>
                <div v-if="candidateRecommendationModel.recommendation == 1" class=" col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_recomendation_number') }}</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="candidateRecommendationModel.number" type="text" placeholder="">
                            <i class="fs-input-icon fa fa-phone"></i>
                        </div>
                    </div>
                </div>
                <div v-if="candidateRecommendationModel.recommendation == 1" class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>ფაილი</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" ref="upload" type="file" @change="recommendationFileUpload" placeholder="">
                        </div>
                    </div>
                    <div>
                        <a href="./helloworld.pdf" target="_blank" class="text-primary">თქვენი ატვირთული ფაილის სანახავად დააჭირეთ აქ</a>
                        <!-- <iframe src='user-documentation/helloworld.pdf' ></iframe> -->
                    </div>
                </div>
                <div class=" col-md-12" :class="(candidateRecommendationModel.recommendation == 2)?'':'visually-hidden'">
                    <div class="form-group">
                        <label>რეცომდაციის არ ქონის მიზეზი</label>
                        <div class="ls-inputicon-box">
                            <select class="form-select form-select-lg border-0 rounded " style="background-color: #f0f6fe;"  v-model="candidateRecommendationModel.no_reason_id" >
                                <option v-for="recommendation in data.classificator.noRecommendationReason" :value="recommendation.id">{{ recommendation[`name_${getLang}`] }}</option>
                            </select>
                            <!-- <i class="fs-input-icon fa fa-history"></i> -->
                        </div>
                    </div>
                </div>
                <div v-if="candidateRecommendationModel.recommendation == 2" class="col-md-12">
                    <div class="form-group">
                        <label>დამატაბითი ინფორმაცია</label>
                        <textarea class="form-control" rows="3" v-model="candidateRecommendationModel.no_reason_info" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება"></textarea>
                    </div>
                </div>
            </div>
            <div  class="modal-footer">
                <a type="button" class="btn btn-success"  @click="updateRecommendation(candidateRecommendationModel)"><i class=""></i>შენახვა</a>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        visible: Boolean,
        data: Object
    },
    data() {
        return {
            showConfirm: false,
            candidateRecommendationModel:null,
            recommendationFile:{}
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
            this.showConfirm = true
            this.candidateRecommendationModel = this.data.item
            console.log('this.candidateRecommendationModel',this.candidateRecommendationModel);
            console.log('this.data',this.data);
        },
        hide(){
           this.showConfirm = false
        },
        updateRecommendation(){

        },
        recommendationFileUpload(event){
            this.recommendationFile = event.target.files[0]
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
