<template lang="">
   <!-- OUR BLOG START -->
   <div class="section-full  p-t120 p-b90 bg-white">
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
                                            <img :src="'/images/job-detail-bg.jpg'" alt="#">
                                            <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                                        </div>


                                        <div class="twm-mid-content">

                                            <div class="twm-media">
                                                <img :src="'/images/jobs-company/pic1.jpg'" alt="#">
                                            </div>

                                            <h4 class="twm-job-title">{{ vacancy.category[`name_${getLang}`] }} <span class="twm-job-post-duration"></span></h4>
                                            <p class="twm-job-address"><i class="feather-map-pin"></i>{{ vacancy.author.address_ka }}</p>
                                            <div class="twm-job-self-mid">
                                                <div class="twm-job-self-mid-left">

                                                    <div class="twm-jobs-amount">{{ vacancy.payment+' '+vacancy.currency.icon }} </div>
                                                </div>
                                                <div class="twm-job-apllication-area">განცხადებას ვადა გასდის:
                                                    <span class="twm-job-apllication-date">{{ vacancy.start_date }}</span>
                                                </div>
                                            </div>

                                            <div class="twm-job-self-bottom">
                                                <button v-if=" !data.staticVacancy" class="site-button" @click="interest(item)">
                                                    დაინტერესება
                                                </button>
                                                <!-- // @auth()
                                                //     @if (count(vacancy.vacancyInterest) && $statusThisVacancy)
                                                //     @else
                                                //         <form method="post" action="/interest_vacancy" enctype="multipart/form-data">
                                                //             {{ csrf_field() }}
                                                //             <input type="hidden" name="id" value="{{ vacancy.id }}">
                                                //             <button class="site-button" type="submit" >
                                                //                 დაინტერესება
                                                //             </button>
                                                //         </form>
                                                //     @endif

                                                // @endauth -->

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- <h4 class="twm-s-title">აღწერა:</h4>
                            <p>ვეძებ {{ vacancy.category[`name_${getLang}`] }}_ს, <span v-for="(item, index) in vacancy.vacancy_for_who_need" :key="index">{{ item[`name_${getLang}`]+', ' }}_სთვის</span></p> -->

                            <h4 class="twm-s-title">სამუშაო დღეები და საათები:</h4>
                            <p>{{ vacancy[`additional_schedule_${getLang}`]  }}</p>

                            <h4 class="twm-s-title">ბენეფიტები:</h4>

                            <span v-for="(item, index) in vacancy.vacancy_benefit" :key="index" class="badge bg-primary " style="margin-right: 5px; font-size:15px">{{ item[`name_${getLang}`]+', '}}</span>



                            <h4 class="twm-s-title">მოთხოვნები:</h4>
                            <ul class="description-list-2">
                                    <li v-for="(item, index) in vacancy.vacancy_duty" :key="index">
                                        <i class="feather-check"></i>
                                        {{ item[`name_${getLang}`]+', '}}
                                    </li>
                            </ul>

                            <!-- // <h4 class="twm-s-title">პასუხისმგებლობა:</h4>
                            // <ul class="description-list-2">
                            //     <li>
                            //         <i class="feather-check"></i>
                            //         შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                            //     </li>
                            //     <li>
                            //         <i class="feather-check"></i>
                            //         შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                            //     </li>
                            //     <li>
                            //         <i class="feather-check"></i>
                            //         შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                            //     </li>
                            //     <li>
                            //         <i class="feather-check"></i>
                            //         შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                            //     </li>
                            //     <li>
                            //         <i class="feather-check"></i>
                            //         შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                            //     </li>
                            //     <li>
                            //         <i class="feather-check"></i>
                            //         შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს
                            //     </li>

                            // </ul> -->

                            <h4 class="twm-s-title">გაზიარება</h4>
                            <div class="twm-social-tags">
                                <a href="#" class="fb-clr">Facebook</a>
                                <a href="#" class="tw-clr">Twitter</a>

                                <a href="#" class="insta-clr">Instagram</a>

                            </div>

                            <h4 class="twm-s-title">მდებარეობა</h4>
                            <div class="twm-m-map mb-5">
                                <div class="twm-m-map-iframe">
                                    <iframe height="310" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.8534521658976!2d-118.2533646842856!3d34.073270780600225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c6fd9829c6f3%3A0x6ecd11bcf4b0c23a!2s1363%20Sunset%20Blvd%2C%20Los%20Angeles%2C%20CA%2090026%2C%20USA!5e0!3m2!1sen!2sin!4v1620815366832!5m2!1sen!2sin"></iframe>
                                </div>
                            </div>

                            <div class="twm-two-part-section">
                                <div class="row">

                                    <div class="col-lg-6 col-md-12">
                                        <h4 class="twm-s-title">ჩვენი სურათები</h4>
                                        <!-- <div class="tw-sidebar-gallery">
                                            <ul>
                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic1.jpg" title="Title 1" data-lcl-author="" data-lcl-thumb="images/gallery/thumb/pic1.jpg">
                                                            <img src="/images/gallery/thumb/pic1.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic2.jpg" title="Title 2" data-lcl-author="" data-lcl-thumb="images/gallery/thumb/pic2.jpg">
                                                            <img src="/images/gallery/thumb/pic2.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb ">
                                                        <a class="elem" href="/images/gallery/pic3.jpg" title="Title 3"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic3.jpg">
                                                            <img src="/images/gallery/thumb/pic3.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic4.jpg" title="Title 4"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic4.jpg">
                                                            <img src="/images/gallery/thumb/pic4.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic5.jpg" title="Title 5"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic5.jpg">
                                                            <img src="/images/gallery/thumb/pic5.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic6.jpg" title="Title 6"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic6.jpg">
                                                            <img src="/images/gallery/thumb/pic6.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic7.jpg" title="Title 7" data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic1.jpg">
                                                            <img src="/images/gallery/thumb/pic7.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic8.jpg" title="Title 8" data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic2.jpg">
                                                            <img src="/images/gallery/thumb/pic8.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb ">
                                                        <a class="elem" href="images/gallery/pic9.jpg" title="Title 9"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic3.jpg">
                                                            <img src="/images/gallery/thumb/pic9.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic10.jpg" title="Title 10"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic4.jpg">
                                                            <img src="/images/gallery/thumb/pic10.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic11.jpg" title="Title 11"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic5.jpg">
                                                            <img src="/images/gallery/thumb/pic11.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="tw-service-gallery-thumb">
                                                        <a class="elem" href="/images/gallery/pic12.jpg" title="Title 12"  data-lcl-author="" data-lcl-thumb="/images/gallery/thumb/pic6.jpg">
                                                            <img src="/images/gallery/thumb/pic12.jpg" alt="">
                                                            <i class="fa fa-file-image"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                            </ul>

                                        </div> -->
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
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 rightSidebar">

                        <div class="side-bar mb-4">
                            <div class="twm-s-info2-wrap mb-5">
                                <div class="twm-s-info2">
                                    <h4 class="section-head-small mb-4">სამუშაო ინფორმაცია</h4>
                                    <ul class="twm-job-hilites">

                                        <li>
                                            <i class="fas fa-eye"></i>
                                            <span class="twm-title">{{ vacancy.view }} ნახვა</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-file-signature"></i>
                                            <span class="twm-title">{{ data.applicants }} აპლიკანტი</span>
                                        </li>
                                    </ul>
                                    <ul class="twm-job-hilites2">

                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span class="twm-title">გამოქვეყნების დრო</span>
                                                <div class="twm-s-info-discription">{{ vacancy.created_at }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span class="twm-title">ლოკაცია</span>
                                                <div class="twm-s-info-discription">{{ vacancy.author[`address_${getLang}`] }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-tie"></i>
                                                <span class="twm-title">სამუშაო დასახელება</span>
                                                <div class="twm-s-info-discription">{{ vacancy[`title_${getLang}`]  }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-tie"></i>
                                                <span class="twm-title">ვისთვის მესაჭიროება</span>
                                                <div class="twm-s-info-discription"><span v-for="(item, index) in vacancy.vacancy_for_who_need" :key="index">{{ item[`name_${getLang}`]+', ' }}_სთვის</span></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-tie"></i>
                                                <span class="twm-title">გრაფიკი</span>
                                                <div class="twm-s-info-discription">{{ vacancy.work_schedule[`name_${getLang}`]  }}</div>
                                            </div>
                                        </li>
                                        <!-- <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-user-tie"></i>
                                                <span class="twm-title">სამუშაო დღეები</span>
                                                <div class="twm-s-info-discription">{{ vacancy[`additional_schedule_${getLang}`]  }}</div>
                                            </div>
                                        </li> -->

                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-suitcase"></i>
                                                <span class="twm-title">განათლება</span>
                                                <div class="twm-s-info-discription">{{ (vacancy.demand.education)?vacancy.demand.education[`name_${getLang}`]:'-' }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-tasks"></i>
                                                <span class="twm-title">სპეციალობა</span>
                                                <div class="twm-s-info-discription">{{ (vacancy.demand.specialty)?vacancy.demand.specialty[`name_${getLang}`]:'-' }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-language"></i>
                                                <span class="twm-title">უცხო ენა</span>
                                                <div class="twm-s-info-discription">{{ (vacancy.demand.language)?vacancy.demand.language[`name_${getLang}`]:'-' }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">
                                                <i class="fas fa-venus-mars"></i>
                                                <span class="twm-title">ასაკი</span>
                                                <div class="twm-s-info-discription">{{ (vacancy.demand.min_age)?vacancy.demand.min_age:'18' }} - {{ (vacancy.demand.max_age)?vacancy.demand.max_age:'60' }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">

                                                <i class="fas fa-money-bill-wave"></i>
                                                <span class="twm-title">ანაზღაურება</span>
                                                <div class="twm-s-info-discription">{{ vacancy.payment+' '+vacancy.currency.icon }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="twm-s-info-inner">

                                                <i class="fas fa-phone"></i>
                                                <span class="twm-title">ნომერი</span>
                                                <div class="twm-s-info-discription">{{ vacancy.hr.user.number }}</div>
                                            </div>
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
  import moment from 'moment'
export default {
    props:{
        data: Object
    },
    data() {
        return {
            vacancy:{},
            auth:null,
            checkInterest: false
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    created() {
        this.vacancy = this.data.vacancy
        this.auth = this.data.auth
        this.vacancy.created_at =  moment(this.data.vacancy.created_at).format("YYYY-MM-DD HH:mm")
        this.vacancy.start_date = moment(this.data.vacancy.start_date).format("YYYY-MM-DD")
        console.log('this.vacancy', this.data.vacancy);
    },
    methods: {
        interest(item){
            if (this.auth != null ) {
                if (this.auth.role_id != 3) {
                    toast.error("თქვენ არ გაქვთ დაინტერესების უფლება", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    return
                }else if(this.auth.role_id == 3  ){
                    if (this.auth.candidate.status_id == 8) {
                        toast.error("თქვენ ჯერ არ გაქვთ დაინტერესების უფლება, გთხოვთ შეავსოთ ინფორმაცია", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    } else if(this.auth.candidate.status_id == 10) {
                        toast.error("არ გაქვთ დაინტერესების უფლება, თქვენ უკვე დასაქმებული ხართ", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        return
                    }

                }else if(this.auth.role_id == 3){

                }
                this.sendInterestAxios(item)

            }else{
                this.$swal(
                    {
                        title: '<p>დაინტერესებამდე სავალდებულოა გაიაროთ ავტორიზაცია!!!</p>',
                        icon: 'info',
                        html:
                            'თუ ჯერ არ ხართ რეგისტრირებული გთხოვთ დარეგისტრირდეთ',
                        showCloseButton: true,
                        showCancelButton: false,
                        showDenyButton: true,
                        focusConfirm: false,
                        confirmButtonText: 'რეგისტრაცია',
                        denyButtonText: 'შესვლა',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.replace(`/${this.getLang}/user/work_information`)
                    }else if (result.isDenied) {
                        alert()
                    }
                })
            }
        },
        sendInterestAxios(item){
            let currentObj = this

            axios({
                method: "post",
                url: '/interest_vacancy',
                data: {'id': item.id, 'check': this.checkInterest},

            })
            .then(function (response) {
                console.log('response.data',response.data);
                if (response.data.status == 200) {
                    let text;
                    if(response.data.data.type == 'w'){
                        currentObj.$swal({
                            title: '<p>თქვენი სამუშაო კატეგორია არ შეესაბამება ვაკანსიის კატეგორიას!!!</p>',
                            icon: 'info',
                            html:
                                'დარწმუნებული ხართ რომ გსურთ ამ ვაკანსიით დაინტერესება?',
                            showCloseButton: true,
                            showCancelButton: true,
                            showDenyButton: true,
                            focusConfirm: false,
                            confirmButtonText: 'კი',
                            denyButtonText: 'კატეგორიის დამატება',
                            cancelButtonText:'გაუქმება'
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                currentObj.checkInterest = true
                                currentObj.sendInterestAxios(item)
                            }else if (result.isDenied) {
                                window.location.replace(`/${currentObj.getLang}/user/work_information`)
                            }
                        })
                    }else if(response.data.data.type == 's'){
                        toast.success('თქვენ გააგზავნეთ დაინტერესება ვაკანისაზე', {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                        var find = currentObj.vacancy.find(element => element.id == item.id);
                        find.vacancy_interest.push(response.data.data.qualifying)
                    }
                }

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
}
</script>
<style lang="">

</style>
