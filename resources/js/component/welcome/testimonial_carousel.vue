<template>
    <!-- <div class=" owl-carousel twm-testimonial-1-carousel owl-btn-bottom-center"> -->
        <Carousel v-bind="settings" :itemsToShow="itemsToShow" :autoplay="4000" :wrap-around="true">
            <Slide v-for="slide in items" :key="slide">
                <div class="carousel__item item">
                    <div class="twm-testimonial-1">
                        <div class="twm-testimonial-1-content">
                            <div class="twm-testi-media">
                                <img :src="`/storage/${slide.image_path}`" alt="#">
                            </div>
                            <div class="twm-testi-content">
                                <div class="twm-quote">
                                    <img src="images/quote-dark.png" alt="">
                                </div>
                                <div class="twm-testi-info">{{ slide[`text_${getLang}`] }}</div>
                                <div class="twm-testi-detail">
                                    <div class="twm-testi-name"> {{ slide[`fullName_${getLang}`] }}</div>
                                    <div class="twm-testi-position">{{ slide[`profession_${getLang}`]  }}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </Slide>

            <template #addons>
                <!-- <Pagination /> -->
            </template>
        </Carousel>


    <!-- </div> -->
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
    name: 'testimonial_carousel',
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
            itemsToShow: 1.9,
            items: null
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
        settings() {
            return{
                snapAlign: 'center',
            }
        }
    },
    created() {
        this.items = this.data;
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
                this.itemsToShow = 1; // Set your desired value for medium screens
            } else if (window.innerWidth < 992){
                this.itemsToShow = 1;
            } else if (window.innerWidth < 1200){
                this.itemsToShow = 1;
            } else if(window.innerWidth < 1400){
                this.itemsToShow = 1.5;
            }else {
                this.itemsToShow = 1.5; // Default value for larger screens
            }
        },
    },
  })
  </script>
  <style scoped>


  /* .carousel__slide {
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
  } */
  </style>

