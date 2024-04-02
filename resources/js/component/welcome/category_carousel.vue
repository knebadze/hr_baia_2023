<template>
    <div class=" job-categories-carousel owl-btn-left-bottom ">
        <Carousel :itemsToShow="itemsToShow" :autoplay="4000" :wrap-around="true">
        <Slide v-for="slide in items" :key="slide">
            <div class="carousel__item">
                <div class="job-categories-block">
                    <div class="twm-media">
                        <div class="flaticon-dashboard"></div>
                    </div>
                    <div class="twm-content">
                        <div class="twm-jobs-available text-nowrap">{{ `${slide.count} ${text} ` }} </div>
                        <a :href="`${detailUrl}/${JSON.stringify([slide.id])}`">{{ slide[`name_${getLang}`] }}</a>
                    </div>
                </div>
            </div>
        </Slide>

        <template #addons>
            <!-- <Pagination /> -->
        </template>
        </Carousel>


    </div>
    <!-- <div>
        <button @click="next" class="btn btn-primary rounded-circle mx-2"><i class="feather-chevron-left"></i></button>
        <button @click="prev" class="btn btn-primary rounded-circle"><i class="feather-chevron-right"></i></button>
    </div> -->
</template>

  <script>
  import { defineComponent } from 'vue'
  import { Carousel, Pagination, Slide } from 'vue3-carousel'

  import 'vue3-carousel/dist/carousel.css'
  import _ from 'lodash';

  export default defineComponent({
    name: 'Autoplay',
    components: {
      Carousel,
      Slide,
      Pagination,
    },
    props:{
        data: Object,
        type: String
    },
    data() {
        return {
            itemsToShow: 3.95,
            items: null
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        detailUrl(){
            var url = new URL( location.href)
            let rout = this.data.type == 'vacancy'? '/job_search': '/candidate_search'
            return url.origin+'/'+this.getLang+rout
        },
        text(){
            return this.data.type == 'vacancy'?'სამუშაო':'კანდიდატი'
        }
    },
    created() {
        this.items = _.omit(this.data, ['type']);
        const screenWidth = window.screen.width;
        const screenHeight = window.screen.height;
    },
    mounted() {
        // Listen for window resize events
        window.addEventListener('resize', this.handleResize);
        // Initial setup
        this.handleResize();
    },
    beforeDestroy() {
        // Remove the resize event listener when the component is destroyed
        window.removeEventListener('resize', this.handleResize);
    },
    methods: {
        handleResize() {
            // Adjust itemsToShow based on screen width
            if (window.innerWidth < 576) {
                this.itemsToShow = 1; // Set your desired value for small screens
            } else if (window.innerWidth < 768) {
                this.itemsToShow = 2; // Set your desired value for medium screens
            } else if (window.innerWidth < 992){
                this.itemsToShow = 2.5;
            } else if (window.innerWidth < 1200){
                this.itemsToShow = 3;
            } else if(window.innerWidth < 1400){
                this.itemsToShow = 3.95;
            }else {
                this.itemsToShow = 4; // Default value for larger screens
            }
        },
    },
  })
  </script>
  <style scoped>
  .carousel__slide {
    padding: 5px;
  }

  .carousel__viewport {
    perspective: 2000px;
  }

  .carousel__track {
    transform-style: preserve-3d;
  }

  .carousel__slide--sliding {
    transition: 0.5s;
  }

  .carousel__slide {
    opacity: 0.9;
    transform: rotateY(-20deg) scale(0.9);
  }

  .carousel__slide--active ~ .carousel__slide {
    transform: rotateY(20deg) scale(0.9);
  }

  .carousel__slide--prev {
    opacity: 1;
    transform: rotateY(-10deg) scale(0.95);
  }

  .carousel__slide--next {
    opacity: 1;
    transform: rotateY(10deg) scale(0.95);
  }

  .carousel__slide--active {
    opacity: 1;
    transform: rotateY(0) scale(1.1);
  }
  </style>

