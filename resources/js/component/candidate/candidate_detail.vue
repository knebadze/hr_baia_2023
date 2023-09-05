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
                                        <h3 style="color: white">{{ data.status[`name_${getLang}`] }}</h3>
                                        <div class="twm-media">
                                            <img :src="'/images/user-avatar/'+data.user.avatar" alt="#">
                                        </div>
                                        <div class="twm-mid-content">

                                            <h4 class="twm-job-title">{{ data.user[`name_${getLang}`] }} </h4>

                                            <p style="margin-bottom: 0px; text-decoration: underline">{{ data.get_work_information.map(i => i.category[`name_${getLang}`]).join(', ') }}</p>
                                            <p style="margin-top: 10px;" class="twm-candidate-address"><i class="feather-map-pin"></i>{{ data[`address_${getLang}`] }}</p>

                                        </div>
                                    </div>
                                    <div class="twm-candi-self-bottom">
                                        <!-- <a href="javascript:;" class="site-button outline-white">Hire Me Now</a> -->
                                        <!-- <a href="javascript:;" class="site-button secondry">Download CV</a> -->
                                    </div>
                                </div>
                            </div>

                            <div v-if="data.characteristic">
                                <h4 class="twm-s-title">მახასიათებლები</h4>
                                <div class="tw-sidebar-tags-wrap">
                                    <div class="tagcloud">
                                        <a v-for="(item, index) in data.characteristic" :key="index" href="javascript:void(0)">{{ item[`name_${getLang}`] }}</a>

                                    </div>
                                </div>
                            </div>
                            <h4 class="twm-s-title">ოჯახში მუშაობის გამოცდილება</h4>
                            <div class="twm-timing-list-wrap">
                                <div class="twm-timing-list">
                                    <div class="twm-time-list-discription">
                                        <p>მიმუშავია {{ data.family_work_experience.families_worked_count }} ოჯახში.
                                            {{ (category.length > 1)?'პოზიციებზე:':'პოზიციაზე' }} <b v-for="(item, index) in category" :key="index">{{ item }}</b>,
                                           მაქვს ოჯახში მუშაობის სტაჟი: {{ data.family_work_experience.work_experience[`name_${getLang}`] }}, აქედან ყველაზე ხანგრძლივად ერთ ოჯახში მუშაობის სტაჟი: {{ data.family_work_experience.longest[`name_${getLang}`] }}.

                                        </p>
                                        <p>
                                            მევალებოდა: {{ data.family_work_experience.get_family_work_duty.map(i => i.duty[`name_${getLang}`]).join(', ') }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <h4 class="twm-s-title">ზოგადი სამუშაო გამოცდილება</h4>
                            <div class="twm-timing-list-wrap">

                                <div class="twm-timing-list" v-for="(item, index) in data.general_work_experience" :key="index">
                                    <div class="twm-time-list-date">{{ item[`name_${getLang}`] }}</div>
                                    <div class="twm-time-list-title">{{ item.pivot[`object_${getLang}`] }}</div>
                                    <div class="twm-time-list-position">{{ item.pivot[`position_${getLang}`] }}</div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 rightSidebar">
                        <div class="side-bar-2">

                            <div class="twm-s-map mb-5">
                                <h4 class="section-head-small mb-4">Location</h4>
                                <div class="twm-s-map-iframe">
                                    <location_map :markerPosition="[data.longitude, data.latitude]"></location_map>
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
                                                <div class="twm-s-info-discription">{{ data.user.gender[`name_${getLang}`]}}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-money-bill-wave"></i>
                                                <span class="twm-title">ეროვნება</span>
                                                <div class="twm-s-info-discription">{{ data.nationality[`name_${getLang}`] }}</div>
                                            </div>
                                        </li>


                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-plus"></i>
                                                <span class="twm-title">მოქალაქეობა</span>
                                                <div class="twm-s-info-discription">{{ data.citizenship.map(i => i[`name_${getLang}`]).join(', ') }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-cross"></i>
                                                <span class="twm-title">რელიგია</span>
                                                <div class="twm-s-info-discription">{{ data.religion[`name_${getLang}`] }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-book-reader"></i>
                                                <span class="twm-title">განათლება</span>
                                                <div class="twm-s-info-discription">{{ data.education[`name_${getLang}`] }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-globe"></i>
                                                <span class="twm-title">უცხო ენები</span>
                                                <div class="twm-s-info-discription">{{ data.get_language.map(i => i.language[`name_${getLang}`]+ ' - '+ i.level[`name_${getLang}`] ).join(', ') }} </div>
                                            </div>
                                        </li>
                                        <li v-if="data.professions.length > 0">
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-graduation-cap"></i>
                                                <span class="twm-title">პროფესია</span>
                                                <div class="twm-s-info-discription">{{ data.professions.map(i => i[`name_${getLang}`]).join(', ') }}</div>
                                            </div>
                                        </li>
                                        <li v-if="data.specialty.length > 0">
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-briefcase"></i>
                                                <span class="twm-title">სპეციალობა</span>
                                                <div class="twm-s-info-discription">{{ data.specialty.map(i => i[`name_${getLang}`]).join(', ') }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-marker"></i>
                                                <span class="twm-title">რეკომენდაცია</span>
                                                <div class="twm-s-info-discription">{{ (data.recommendation == 0)?'არა':'კი' }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <!-- <div class="twm-s-info-inner">
                                                <i class="fas fa-file"></i>
                                                <span class="twm-title">მახასიათებლები</span>
                                                <div class="twm-s-info-discription">{{ data.characteristic.map(i => i[`name_${getLang}`]).join(', ') }}</div>
                                            </div> -->
                                        </li>
                                    </ul>

                                </div>
                            </div>


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
        // this.categoryName
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        category(){
            var duty = this.data.family_work_experience.get_family_work_duty
            var arr = duty.map(i => i.duty.category[`name_${this.getLang}`])
            return _.uniq(arr)
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
