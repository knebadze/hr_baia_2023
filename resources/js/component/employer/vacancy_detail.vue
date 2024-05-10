<template lang="">
    <!-- OUR BLOG START -->
    <div class="section-full p-t120 p-b90 bg-white">
        <div class="container">
            <!-- BLOG SECTION START -->
            <div class="section-content">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <!-- Candidate detail START -->
                        <div class="cabdidate-de-info">
                            <div class="twm-job-self-wrap">
                                <div class="twm-job-self-info">
                                    <div class="twm-job-self-top">
                                        <div class="twm-media-bg">
                                            <img
                                                :src="'/images/candidates/candidate-bg2.jpg'"
                                                alt="#"
                                            />
                                            <div
                                                class="twm-jobs-category green"
                                            >
                                                <span class="twm-bg-green">{{
                                                    vacancy.category[
                                                        `name_${getLang}`
                                                    ]
                                                }}</span>
                                            </div>
                                        </div>

                                        <div class="twm-mid-content">
                                            <!-- <div class="twm-media">
                                                <img :src="'/images/jobs-company/pic1.jpg'" alt="#">
                                            </div> -->

                                            <!-- <h4 class="twm-job-title">
                                                {{
                                                    vacancy.category[
                                                        `name_${getLang}`
                                                    ]
                                                }}
                                                <span
                                                    class="twm-job-post-duration"
                                                ></span>
                                            </h4> -->
                                            <div
                                                class="row d-flex align-items-center"
                                            >
                                                <div class="col-md-6">
                                                    <p
                                                        class="twm-job-apllication-area"
                                                    >
                                                        განცხადებას ვადა გასდის:
                                                        <span
                                                            class="twm-job-apllication-date text-danger"
                                                            >{{
                                                                vacancy.start_date
                                                            }}</span
                                                        >
                                                    </p>
                                                </div>
                                                <div
                                                    class="col-md-6 interest-button"
                                                >
                                                    <interest_button
                                                        v-if="
                                                            !data.staticVacancy
                                                        "
                                                        :item="vacancy"
                                                        :auth="auth"
                                                        @emitReceiveChild="
                                                            handlerUpdateData
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            ></div>
                                            <div>
                                                <p class="twm-job-address">
                                                    <i
                                                        class="feather-map-pin"
                                                    ></i
                                                    >მდებარეობა:{{
                                                        vacancy.author
                                                            .address_ka
                                                    }}
                                                </p>
                                            </div>

                                            <div class="twm-job-self-mid">
                                                <div
                                                    class="twm-job-self-mid-left"
                                                >
                                                    <div
                                                        class="twm-job-address"
                                                    >
                                                        <span>
                                                            <i
                                                                class="fas fa-money-bill-wave"
                                                            ></i>
                                                            ანაზღაურება:
                                                            {{
                                                                vacancy.payment +
                                                                " " +
                                                                vacancy.currency
                                                                    .icon
                                                            }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="twm-job-apllication-area"
                                                >
                                                    <!-- განცხადებას ვადა გასდის:
                                                    <span
                                                        class="twm-job-apllication-date"
                                                        >{{
                                                            vacancy.start_date
                                                        }}</span
                                                    > -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <h4 class="twm-s-title">აღწერა:</h4>
                            <p>ვეძებ {{ vacancy.category[`name_${getLang}`] }}_ს, <span v-for="(item, index) in vacancy.vacancy_for_who_need" :key="index">{{ item[`name_${getLang}`]+', ' }}_სთვის</span></p> -->

                            <div
                                v-if="vacancy[`additional_schedule_${getLang}`]"
                            >
                                <h4 class="twm-s-title">
                                    სამუშაო დღეები და საათები:
                                </h4>
                                <p>
                                    {{
                                        vacancy[
                                            `additional_schedule_${getLang}`
                                        ]
                                    }}
                                </p>
                            </div>

                            <div v-if="vacancy.vacancy_benefit.length">
                                <h4 class="twm-s-title">ბენეფიტები:</h4>

                                <span
                                    v-for="(
                                        item, index
                                    ) in vacancy.vacancy_benefit"
                                    :key="index"
                                    class="badge bg-primary"
                                    style="margin-right: 5px; font-size: 15px"
                                    >{{ item[`name_${getLang}`] + ", " }}</span
                                >
                            </div>

                            <div v-if="vacancy.vacancy_duty.length">
                                <h4 class="twm-s-title">მოთხოვნები:</h4>
                                <ul class="description-list-2">
                                    <li
                                        v-for="(
                                            item, index
                                        ) in vacancy.vacancy_duty"
                                        :key="index"
                                    >
                                        <i class="feather-check"></i>
                                        {{ item[`name_${getLang}`] + ", " }}
                                    </li>
                                </ul>
                            </div>

                            <!-- გამოჩნდება როცა გაზიარება გვექნება -->
                            <!-- <h4 class="twm-s-title">გაზიარება</h4>
                            <div class="twm-social-tags">
                                <a href="#" class="fb-clr">Facebook</a>
                                <a href="#" class="tw-clr">Twitter</a>

                                <a href="#" class="insta-clr">Instagram</a>

                            </div> -->

                            <!-- გამოჩნდება როცა რუკა გვექნება -->
                            <h4
                                v-if="vacancy.author.map_link"
                                class="twm-s-title"
                            >
                                <a
                                    class="text-primary"
                                    :href="vacancy.author.map_link"
                                    target="_blank"
                                    ><u>მდებარეობა</u></a
                                >
                            </h4>
                            <!-- <div class="twm-m-map mb-5">
                                <div class="twm-m-map-iframe">
                                    <iframe height="310" src="https://goo.gl/maps/Ht2qbkj3ba3pwNHo6"></iframe>
                                </div>
                            </div> -->

                            <!-- <div class="twm-two-part-section">
                                <div class="row">

                                    <div class="col-lg-6 col-md-12">
                                        <h4 class="twm-s-title">ჩვენი სურათები</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <h4 class="twm-s-title">ვიდეო</h4>
                                        <div class="video-section-first" style="background-image: url(images/video-bg.jpg);">
                                            <a href="https://www.youtube.com/watch?v=c1XNqw2gSbU" class="mfp-video play-now-video">
                                                <i class="icon feather-play"></i>
                                                <span class="ripple"></span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 rightSidebar">
                        <div class="side-bar mb-4">
                            <div class="twm-s-info2-wrap mb-5">
                                <div class="twm-s-info2">
                                    <h4 class="section-head-small mb-4">
                                        დეტალური ინფორმაცია
                                    </h4>
                                    <ul class="twm-job-hilites">
                                        <li>
                                            <i class="fas fa-eye"></i>
                                            <span class="twm-title"
                                                >{{ vacancy.view }} ნახვა</span
                                            >
                                        </li>
                                        <li>
                                            <i
                                                class="fas fa-file-signature"
                                            ></i>
                                            <span class="twm-title"
                                                >{{
                                                    data.applicants
                                                }}
                                                აპლიკანტი</span
                                            >
                                        </li>
                                    </ul>
                                    <ul class="twm-job-hilites2">
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i
                                                    class="fas fa-calendar-alt"
                                                ></i>
                                                <span class="twm-title"
                                                    >გამოქვეყნების დრო</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    {{ vacancy.created_at }}
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i
                                                    class="fas fa-map-marker-alt"
                                                ></i>
                                                <span class="twm-title"
                                                    >ლოკაცია</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    {{
                                                        vacancy.author[
                                                            `address_${getLang}`
                                                        ]
                                                    }}
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-tie"></i>
                                                <span class="twm-title"
                                                    >სამუშაო დასახელება</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    {{
                                                        vacancy[
                                                            `title_${getLang}`
                                                        ]
                                                    }}
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-tie"></i>
                                                <span class="twm-title"
                                                    >ვისთვის მესაჭიროება</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    <span
                                                        v-for="(
                                                            item, index
                                                        ) in vacancy.vacancy_for_who_need"
                                                        :key="index"
                                                        >{{
                                                            item[
                                                                `name_${getLang}`
                                                            ] + ", "
                                                        }}_სთვის</span
                                                    >
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-tie"></i>
                                                <span class="twm-title"
                                                    >გრაფიკი</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    {{
                                                        vacancy.work_schedule[
                                                            `name_${getLang}`
                                                        ]
                                                    }}
                                                </div>
                                            </div>
                                        </li>
                                        <!-- <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-tie"></i>
                                                <span class="twm-title">სამუშაო დღეები</span>
                                                <div class="twm-s-info-discription">{{ vacancy[`additional_schedule_${getLang}`]  }}</div>
                                            </div>
                                        </li> -->

                                        <li v-if="vacancy.demand">
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-suitcase"></i>
                                                <span class="twm-title"
                                                    >განათლება</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    {{
                                                        vacancy.demand.education
                                                            ? vacancy.demand
                                                                  .education[
                                                                  `name_${getLang}`
                                                              ]
                                                            : "-"
                                                    }}
                                                </div>
                                            </div>
                                        </li>
                                        <li v-if="vacancy.demand">
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-tasks"></i>
                                                <span class="twm-title"
                                                    >სპეციალობა</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    {{
                                                        vacancy.demand.specialty
                                                            ? vacancy.demand
                                                                  .specialty[
                                                                  `name_${getLang}`
                                                              ]
                                                            : "-"
                                                    }}
                                                </div>
                                            </div>
                                        </li>
                                        <li v-if="vacancy.demand">
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-language"></i>
                                                <span class="twm-title"
                                                    >უცხო ენა</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    {{
                                                        vacancy.demand.language
                                                            ? vacancy.demand
                                                                  .language[
                                                                  `name_${getLang}`
                                                              ]
                                                            : "-"
                                                    }}
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <!-- <div class="twm-s-info-inner">
                                                <i class="fas fa-venus-mars"></i>
                                                <span class="twm-title">ასაკი</span>
                                                <div class="twm-s-info-discription">{{ (vacancy.demand.min_age)?vacancy.demand.min_age:'18' }} - {{ (vacancy.demand.max_age)?vacancy.demand.max_age:'60' }}</div>
                                            </div> -->
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i
                                                    class="fas fa-money-bill-wave"
                                                ></i>
                                                <span class="twm-title"
                                                    >ანაზღაურება</span
                                                >
                                                <div
                                                    class="twm-s-info-discription"
                                                >
                                                    {{
                                                        vacancy.payment +
                                                        " " +
                                                        vacancy.currency.icon
                                                    }}
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <!-- <div class="twm-s-info-inner">
                                                <i class="fas fa-phone"></i>
                                                <span class="twm-title">ნომერი</span>
                                                <div class="twm-s-info-discription">{{ vacancy.hr.user.number }}</div>
                                            </div> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- //  <div class="widget tw-sidebar-tags-wrap">
                            //     <h4 class="section-head-small mb-4">სამუშაო გამოცდილებები</h4>

                            //     <div class="tagcloud">
                            //         <button style="margin-right: 1%; margin-bottom: 1%;" class="btn btn-secondary">მოლარე</button>
                            //         <button style="margin-right: 1%; margin-bottom: 1%;" class="btn btn-secondary">მენეჯერი</button>
                            //     </div>
                            // </div> --}} -->
                        </div>

                        <!-- //  <div class="twm-advertisment" style="background-image:url(images/add-bg.jpg);">
                        //     <div class="overlay"></div>
                        //     <h4 class="twm-title">Recruiting?</h4>
                        //     <p>Get Best Matched Jobs On your <br>
                        //      Email. Add Resume NOW!</p>
                        //      <a href="javascript:;" class="site-button white">Read More</a>
                        // </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //  OUR BLOG END -->
</template>
<script>
import moment from "moment";
import interest_button from "./components/interest_button.vue";
export default {
    components: {
        interest_button,
    },
    props: {
        data: Object,
    },
    data() {
        return {
            vacancy: {},
            auth: null,
            // checkInterest: false
        };
    },
    computed: {
        getLang() {
            return I18n.getSharedInstance().options.lang;
        },
    },
    created() {
        this.vacancy = this.data.vacancy;
        this.auth = this.data.auth;
        this.vacancy.created_at = moment(this.data.vacancy.created_at).format(
            "YYYY-MM-DD HH:mm"
        );
        this.vacancy.start_date = moment(this.data.vacancy.start_date).format(
            "YYYY-MM-DD"
        );
    },
    methods: {
        handlerUpdateData(id, response) {
            this.vacancy.vacancy_interest.push(response.data.qualifying);
        },
    },
};
</script>
<style scope>
.interest-button {
    display: flex;
    justify-content: flex-end;
}
@media (max-width: 767px) {
    .interest-button {
        justify-content: start;
        margin-bottom: 2vh;
    }
}
</style>
