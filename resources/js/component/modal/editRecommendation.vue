<template lang="">
          <!-- Modal -->
  <div v-if="showConfirm" class="modal fade show" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" id="modalMap"  style="display:block">
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
                            <multiselect v-model="candidateRecommendationModel.has_recommendation" :options="data.classificator.yesNo" :disabled="true" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <!-- <i class="fs-input-icon fa fa-thumbs-up"></i> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-12 " :class="(candidateRecommendationModel.recommendation == 1)?'':'visually-hidden'" >
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_recomendation_where_from') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="candidateRecommendationModel.recommendation_whom" :options="data.classificator.recommendationFromWhom" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <!-- <i class="fs-input-icon fa fa-industry"></i> -->
                        </div>
                    </div>
                </div>
                <div class="row" v-if="candidateRecommendationModel.has_recommendation.id == 1 ">
                    <div  class="col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_recomendation_name') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="candidateRecommendationModel.name" type="text" placeholder="">
                                <i class="fs-input-icon fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">
                        <div class="form-group">
                            <label>თანამდებობა</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="candidateRecommendationModel.position" type="text" placeholder="">
                                <i class="fs-input-icon fa fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">
                        <div class="form-group">
                            <label>{{ $t('lang.user_profile_page_recomendation_number') }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="candidateRecommendationModel.number" type="text" placeholder="">
                                <i class="fs-input-icon fa fa-phone"></i>
                            </div>
                        </div>
                    </div>
                    <div v-if="candidateRecommendationModel.has_recommendation.id == 1 && candidateRecommendationModel.file" class="col-lg-12 col-md-12">
                        <div class="mb-3 d-flex justify-content-between">
                            <!-- <a href="./helloworld.pdf" target="_blank" class="text-primary">თქვენი ატვირთული ფაილის სანახავად დააჭირეთ აქ</a> -->
                            <a type="button" class="btn btn-primary"  href="./helloworld.pdf" target="_blank"><i class=""></i>ფაილის ნახვა</a>
                            <!-- <iframe src='user-documentation/helloworld.pdf' ></iframe> -->
                            <a type="button" class="btn btn-danger"  @click.prevent="removeFile(candidateRecommendationModel.id)"><i class=""></i>ფაილის წაშლა</a>
                        </div>
                        <div class="w-100 text-center">
                            <p>ან ატვირთეთ ახალი ფაილი</p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group mt-4">
                            <label>ფაილი</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" ref="upload" type="file" @change="recommendationFileUpload" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="candidateRecommendationModel.has_recommendation.id == 2">
                    <div class=" col-md-12" >
                        <div class="form-group">
                            <label>რეცომდაციის არ ქონის მიზეზი</label>
                            <div class="ls-inputicon-box">
                                <multiselect v-model="candidateRecommendationModel.no_reason" :options="data.classificator.noRecommendationReason" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="false" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"></template>
                                </multiselect>
                                <!-- <i class="fs-input-icon fa fa-history"></i> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>დამატაბითი ინფორმაცია</label>
                            <textarea class="form-control" rows="3" v-model="candidateRecommendationModel.no_reason_info" placeholder="ჩაწერეთ იმ შემთხვევაში თუ ასარჩევ ველში ვერ ნახეთ შესაფერისი მიზეზი ან გსურთ დამატებითი ინფორმაციის მოწოდება"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="modal-footer">
                <!-- <a type="button" class="btn btn-primary"  @click.prevent="recommendationFile()"><i class=""></i>ფაილის რედაქტირება</a> -->
                <a type="button" class="btn btn-success"  @click="updateRecommendation()"><i class=""></i>რედაქტირება</a>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
import { uuid } from 'vue-uuid'
export default {
    props:{
        visible: Boolean,
        data: Object
    },
    data() {
        return {
            uuid: uuid.v1(),
            showConfirm: false,
            candidateRecommendationModel:null,
            recommendationFile: null,
            formData:new FormData(),
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
        },
        hide(){
           this.showConfirm = false
        },
        updateRecommendation(){
            let currentObj = this
            axios({
                method: "post",
                url: "/update_recommendation",
                data: this.candidateRecommendationModel,

            })
            .then(function (response) {
                if (response.data.status == 200) {
                    if (currentObj.recommendationFile != null) {
                        currentObj.updateRecommendationFile()
                        return;
                    }
                    toast.success('წარმატებით დარედაქტირდა', {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    currentObj.hide()
                    setTimeout(() => {
                        document.location.reload();
                    }, 1400);

                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        updateRecommendationFile(){
            let currentObj = this;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            axios.post('/update_recommendation_file', this.formData, config)
            .then(function (response) {
                if (response.data.status == 200) {
                    toast.success('წარმატებით დარედაქტირდა', {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    currentObj.hide()
                    setTimeout(() => {
                        document.location.reload();
                    }, 1400);
                }
            })
            .catch(function (error) {
                console.log('error',error);
            // currentObj.output = error;
            });
        },
        removeFile(id){
            this.$swal({
                title: 'ნამდვილად გსურთ ფაილის წაშლა',
                showDenyButton: true,
                // showCancelButton: true,
                confirmButtonText: 'კი',
                denyButtonText: `არა`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('/remove_recommendation_file' ,{
                        id: id
                    })
                    .then((response)=> {
                        if (response.status == 200) {
                            toast.success("წარმატებით წაიშალა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                } else if (result.isDenied) {
                }
            })

        },
        recommendationFileUpload(event){
            this.recommendationFile = event.target.files[0]
            this.formData.append('file', this.recommendationFile)
            this.formData.append('id', this.candidateRecommendationModel.id)

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
