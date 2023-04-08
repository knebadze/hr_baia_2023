<template lang="">
    <div class="section-full  p-t120 p-b90 bg-white">
        <div class="container">

            <!-- BLOG SECTION START -->
            <div class="section-content">
                <div class="row d-flex justify-content-center">

                    <div class="col-lg-8 col-md-12">

                        <!-- Candidate detail START -->
                        <div class="cabdidate-de-info">
                            <div class="twm-candi-self-wrap overlay-wraper" :style="{'backgroundImage':'url('+backgroundImage+')'}">
                                <div class="overlay-main site-bg-primary opacity-01"></div>
                                <div class="twm-candi-self-info">
                                    <div class="twm-candi-self-top">
                                        <!-- <div class="twm-candi-fee">$20 / Day</div> -->
                                        <div class="twm-media">
                                            <img :src="'/images/user-avatar/'+data.candidate.user.avatar" alt="#">
                                        </div>
                                        <div class="twm-mid-content">

                                            <h4 class="twm-job-title">{{ data.candidate.user[`name_${getLang}`] }} </h4>

                                            <p v-for="(i, index) in data.candidate.work_information" :key="index">{{ i[`name_${getLang}`]+', ' }}</p>
                                            <p class="twm-candidate-address"><i class="feather-map-pin"></i>{{ data.candidate[`address_${getLang}`] }}</p>

                                        </div>
                                    </div>
                                    <div class="twm-candi-self-bottom">
                                        <!-- <a href="javascript:;" class="site-button outline-white">Hire Me Now</a> -->
                                        <!-- <a href="javascript:;" class="site-button secondry">Download CV</a> -->
                                    </div>
                                </div>
                            </div>
                            <!-- <h4 class="twm-s-title">About Me</h4> -->
                            <!-- <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? </p> -->
                            <!-- <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi.</p> -->
                            <div v-if="data.skill">
                                <h4 class="twm-s-title">უნარები</h4>
                                <div class="tw-sidebar-tags-wrap">
                                    <div class="tagcloud">
                                        <a v-for="(item, index) in data.skill" :key="index" href="javascript:void(0)">{{ item.skill[`name_${getLang}`] }}</a>

                                    </div>
                                </div>
                            </div>
                            <h4 class="twm-s-title">ზოგადი სამუშაო გამოცდილება</h4>
                            <div class="twm-timing-list-wrap">

                                <div class="twm-timing-list" v-for="(item, index) in data.candidate.general_work_experience" :key="index">
                                    <div class="twm-time-list-date">{{ item[`name_${getLang}`] }}</div>
                                    <div class="twm-time-list-title">{{ item.pivot[`object_${getLang}`] }}</div>
                                    <div class="twm-time-list-position">{{ item.pivot[`position_${getLang}`] }}</div>
                                    <hr>
                                </div>
                            </div>
                            <h4 class="twm-s-title">ოჯახში მუშაობის გამოცდილება</h4>
                            <div class="twm-timing-list-wrap">
                                <div class="twm-timing-list">
                                    <!-- <div class="twm-time-list-date">2004 to 2006</div>
                                    <div class="twm-time-list-title">BCA - Bachelor of Computer Applications</div>
                                    <div class="twm-time-list-position">International University</div> -->
                                    <div class="twm-time-list-discription">
                                        <p>მიმუშავია {{ data.candidate.family_work_experience.families_worked_count }} ოჯახში.
                                            {{ (categoryName.length > 1)?'პოზიციებზე:':'პოზიციაზე' }} <b v-for="(item, index) in categoryName" :key="index">{{ item.skill.categoryName[`name_${getLang}`]+', ' }}</b>
                                           მაქვს ოჯახში მუშაობის სტაჟი: {{ data.candidate.family_work_experience.work_experience[`name_${getLang}`] }}, აქედან ყველაზე ხანგრძლივად ერთ ოჯახში მუშაობის სტაჟი: {{ data.candidate.family_work_experience.longest[`name_${getLang}`] }}.
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div v-for="(item, index) in data.workInformation" :key="index">
                                <div v-if="item.category.type == 2 && item.no_family_has_work_experience.length > 0">
                                    <h4 class="twm-s-title">{{ item.category[`name_${getLang}`] }}_ის სამუშაო გამოცდილება</h4>
                                    <div class="twm-timing-list-wrap">

                                        <div class="twm-timing-list" v-for="(i, index) in item.no_family_has_work_experience" :key="index">
                                            <div class="twm-time-list-date">{{ i[`name_${getLang}`] }}</div>
                                            <div class="twm-time-list-title">{{ i.pivot[`object_${getLang}`] }}</div>
                                            <!-- <div class="twm-time-list-position">{{ item.pivot[`position_${getLang}`] }}</div> -->
                                            <hr>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 rightSidebar">
                        <div class="side-bar-2">

                            <div class="twm-s-map mb-5">
                                <h4 class="section-head-small mb-4">Location</h4>
                                <div class="twm-s-map-iframe">
                                    <location_map :markerPosition="[data.candidate.longitude, data.candidate.latitude]"></location_map>
                                    <!-- <iframe height="270" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.8534521658976!2d-118.2533646842856!3d34.073270780600225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c6fd9829c6f3%3A0x6ecd11bcf4b0c23a!2s1363%20Sunset%20Blvd%2C%20Los%20Angeles%2C%20CA%2090026%2C%20USA!5e0!3m2!1sen!2sin!4v1620815366832!5m2!1sen!2sin"></iframe> -->
                                </div>
                            </div>
                            <div class="twm-s-info-wrap mb-5">

                                <h4 class="section-head-small mb-4">Profile Info</h4>
                                <div class="twm-s-info">

                                    <ul>
                                        <!-- <li>
                                            <div class="twm-s-info-inner">
                                                <button type="button" class="btn btn-info">Info</button>
                                            </div>
                                        </li> -->
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-venus-mars"></i>
                                                <span class="twm-title">Gender</span>
                                                <div class="twm-s-info-discription">{{ (data.candidate.user.gender_id == 1)?data.classificatory.gender[0][`name_${getLang}`]:(data.candidate.user.gender_id == 2)?data.classificatory.gender[1][`name_${getLang}`]:'' }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-money-bill-wave"></i>
                                                <span class="twm-title">ეროვნება</span>
                                                <div class="twm-s-info-discription">{{ data.candidate.nationality[`name_${getLang}`] }}</div>
                                            </div>
                                        </li>


                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-mobile-alt"></i>
                                                <span class="twm-title">მოქალაქეობა</span>
                                                <div class="twm-s-info-discription"><span v-for="(item, index) in data.candidate.citizenship" :key="index">{{ item[`name_${getLang}`]+', ' }}</span></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-at"></i>
                                                <span class="twm-title">რელიგია</span>
                                                <div class="twm-s-info-discription">{{ data.candidate.religion[`name_${getLang}`] }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-book-reader"></i>
                                                <span class="twm-title">განათლება</span>
                                                <div class="twm-s-info-discription">{{ data.candidate.education[`name_${getLang}`] }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span class="twm-title">უცხო ენები</span>
                                                <div class="twm-s-info-discription"><span v-for="(item, index) in language" :key="index">{{ item[`name_${getLang}`]+' - '+item.language_level[`name_${getLang}`]+', ' }}</span>  </div>
                                            </div>
                                        </li>
                                        <li v-if="data.candidate.professions.length > 0">
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-book-reader"></i>
                                                <span class="twm-title">პროფესია</span>
                                                <div class="twm-s-info-discription"><span v-for="(item, index) in data.candidate.professions" :key="index">{{ item[`name_${getLang}`]+', ' }}</span></div>
                                            </div>
                                        </li>
                                        <li v-if="data.candidate.specialty.length > 0">
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-book-reader"></i>
                                                <span class="twm-title">სპეციალობა</span>
                                                <div class="twm-s-info-discription"><span v-for="(item, index) in data.candidate.specialty" :key="index">{{ item[`name_${getLang}`]+', ' }}</span></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-clock"></i>
                                                <span class="twm-title">რეკომენდაცია</span>
                                                <div class="twm-s-info-discription">{{ hasRecommendation[`name_${getLang}`] }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-book-reader"></i>
                                                <span class="twm-title">მახასიათებლები</span>
                                                <div class="twm-s-info-discription"><span v-for="(item, index) in data.candidate.characteristic" :key="index">{{ item[`name_${getLang}`]+', ' }}</span></div>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                            <!-- <div class="twm-s-contact-wrap mb-5">
                                <h4 class="section-head-small mb-4">Contact us</h4>
                                <div class="twm-s-contact">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="username" type="text" required class="form-control" placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="email" type="text" class="form-control" required placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="phone" type="text" class="form-control" required placeholder="Phone">
                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <textarea name="message" class="form-control" rows="3" placeholder="Message"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="site-button">Submit Now</button>
                                        </div>

                                    </div>

                                </div>
                            </div> -->


                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>
</template>
<script>
import _ from 'lodash'
import location_map from '../map/location_map.vue'
export default {
    components:{
        location_map
    },
    props:{
        data:Object
    },
    data() {
        return {
            backgroundImage: '/images/candidates/candidate-bg.jpg',

        }
    },
    created(){
this.categoryName
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        language(){
            var classificatory = this.data.classificatory.languageLevels
            _.forEach(this.data.candidate.languages, function(value) {

               value['language_level'] = _.find(classificatory, function(o) { return o.id == value.pivot.language_level_id; });
            });
            return this.data.candidate.languages
        },
        hasRecommendation(){
            var recommendation = this.data.candidate.recommendation[0].pivot.recommendation
            var classificatory = this.data.classificatory.yesNo
            return _.find(classificatory, function(o) { return o.id == recommendation; });
        },
        categoryName(){
            var skill = this.data.skill
            var arr = []
            var array = []
            _.forEach(skill, function(value) {
                if(!arr.includes(value.skill.categoryName.id)){
                    arr.push(value.skill.categoryName.id)
                    if(value.skill.categoryName.id)array.push(_.find(skill, function(o) { return o.skill.categoryName.id == value.skill.categoryName.id; }))
                }
            });
            return array
        }
    },
    methods: {

    },
    mounted() {
        console.log('data', this.data);
    },
}
</script>
<style lang="">

</style>
