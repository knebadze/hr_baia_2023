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
                                            <img :src="`/storage/${data.user.avatar}`" alt="#">
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
                                    <div v-if="data.family_work_experience.experience == 1" class="twm-time-list-discription">
                                        <p>მიმუშავია {{ data.family_work_experience.families_worked_count }} ოჯახში.
                                            {{ (category.length > 1)?'პოზიციებზე:':'პოზიციაზე' }} <b v-for="(item, index) in category" :key="index">{{ item }}</b>,
                                           მაქვს ოჯახში მუშაობის სტაჟი: {{ data.family_work_experience.work_experience[`name_${getLang}`] }}, აქედან ყველაზე ხანგრძლივად ერთ ოჯახში მუშაობის სტაჟი: {{ data.family_work_experience.longest[`name_${getLang}`] }}.

                                        </p>
                                        <p>
                                            მევალებოდა: {{ data.family_work_experience.get_family_work_duty.map(i => i.duty[`name_${getLang}`]).join(', ') }}
                                        </p>
                                    </div>
                                    <p v-else-if="data.family_work_experience.experience == 2">არ ქონის მიზეზი: {{ data.family_work_experience.no_reason[`name_${getLang}`] }}</p>
                                </div>

                            </div>
                            <h4 class="twm-s-title">ზოგადი სამუშაო გამოცდილება</h4>
                            <div class="twm-timing-list-wrap">

                                <div v-if="data.general_work_experience.length > 0" class="twm-timing-list" v-for="(item, index) in data.general_work_experience" :key="index">
                                    <div class="twm-time-list-date">{{ item[`name_${getLang}`] }}</div>
                                    <div class="twm-time-list-title">{{ item.pivot[`object_${getLang}`] }}</div>
                                    <div class="twm-time-list-position">{{ item.pivot[`position_${getLang}`] }}</div>
                                    <hr>
                                </div>
                                <p v-else>არ ქონის მიზეზი: </p>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 rightSidebar">
                        <div class="side-bar-2">

                            <div class="twm-s-map mb-5">
                                <!-- <h4 class="section-head-small mb-4">Location</h4> -->
                                <div class="twm-s-map-iframe">
                                    <location_map :markerPosition="mapData" />

                                </div>
                            </div>
                            <div class="twm-s-info-wrap mb-5">

                                <h4 class="section-head-small mb-4">Profile Info</h4>
                                <div class="twm-s-info">

                                    <ul>
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
                                    </ul>

                                </div>
                            </div>


                        </div>


                    </div>

                </div>

            </div>
            <like_dont_like_candidate v-if="showButton" :id="data.qualifying_candidate[0].id"/>
        </div>

    </div>
</template>
<script>
import _ from 'lodash'
import location_map from '../map/location_map.vue'
import { ref, computed } from 'vue';
import like_dont_like_candidate from '../employer/components/like_dont_like_candidate.vue';
export default {
    components:{
        location_map,
        like_dont_like_candidate
    },
    props:{
        data:Object
    },
    setup(props) {
        const item = ref(props.data)
        const spliceName = (item) =>{
            let nameParts = item.split(' ');

            return nameParts[0];
        };
        item.value.user.name_ka = spliceName(item.value.user.name_ka);
        item.value.user.name_en = spliceName(item.value.user.name_en);
        item.value.user.name_ru = spliceName(item.value.user.name_ru);

        console.log(props.data);
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const backgroundImage = ref('/images/candidates/candidate-bg.jpg');
        const category = computed(() =>{
            let duty = props.data.family_work_experience.get_family_work_duty
            var arr = duty.map(i => i.duty.category[`name_${getLang.value}`])
            return _.uniq(arr)
        });
        const mapData = [props.data.longitude, props.data.latitude]


        const showButton = computed(() => {
            let url = new URL(location.href)
            let pathName = url.pathname;
            let extractedPart = pathName.match(/\/employer\/photo_questionnaire/);
            return extractedPart ? extractedPart[0] : null;

        });

        return {
            backgroundImage,
            getLang,
            category,
            mapData,
            showButton,
            item
        }
    },
}
</script>
<style lang="">

</style>
