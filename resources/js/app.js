// app.js
import('./bootstrap');
import('./register_form')
import {createApp} from 'vue/dist/vue.esm-bundler'
import { i18nVue } from 'laravel-vue-i18n'

const lang = localStorage.getItem('localLang');

import languageSwitcher from './component/languageSwitcher.vue'
// console.log(i18nVue);
import test from './component/test.vue'

// import App from './App.vue'
import howWork from './component/how_work.vue'
//candidate
import candidateProfile from './component/candidate/candidate_profile.vue'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import VueToastr from 'vue-toastr';

import Vue3Toasity from 'vue3-toastify';
import 'vue3-toastify/dist/index.css'
// console.log('Vue3Toasity', Vue3Toasity);

// import "vue-toastr";
// import * as  VueToastr from "../../node_modules/vue-toastr/dist/vue-toastr.es.js";
// import "vue-toastr/dist/style.css";
// console.log('VueToastr', VueToastr );
const app = createApp({})
// console.log(app);


app.component('language-switcher', languageSwitcher)
app.component('test-vue', test)

//candidate
app.component('candidate-profile', candidateProfile)
// const i18n =
// app.use(lang)
app.use(i18nVue
    , {
    lang: lang,
    resolve: lang => import(`../../lang/php_${lang}.json`),
})

app.use(VueSweetalert2);
// app.use(VueToastr);
// app.use(Vue3Toasity)
app.mount("#app")
