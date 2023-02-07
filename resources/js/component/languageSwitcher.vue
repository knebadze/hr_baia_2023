<template>
   <li class="has-child"><a href="javascript:;"><img src="../../../public/images/language.png"> </a>
        <ul class="sub-menu">
            <li><a :href="linkKa"><img src="../../../public/images/geo.png"> ქართული</a></li>
            <li><a :href="linkEn"><img src="../../../public/images/eng.png"> English</a></li>
            <li><a :href="linkRu"><img src="../../../public/images/rus.png"> Русский</a></li>
        </ul>
    </li>
  </template>

  <script>
// import { loadLanguageAsync } from 'laravel-vue-i18n';
  export default {
    props: ['locale', 'link-ka', 'link-en', 'link-ru'],
    data() {
      return {
      }
    },
    methods: {

        // loadLanguageAsync(lang){
        //     console.log(lang);
        // },

    }

  }
  </script>

  <style >

  </style>
