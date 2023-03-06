// app.js
import('./bootstrap');
import('./register_form')
import {createApp} from 'vue/dist/vue.esm-bundler'
import { i18nVue, I18n } from 'laravel-vue-i18n'

const lang = localStorage.getItem('localLang');

import languageSwitcher from './component/languageSwitcher.vue'
// console.log(i18nVue);
import test from './component/test.vue'

// import App from './App.vue'
import howWork from './component/how_work.vue'
//user
import uploadAvatar from './component/user/upload_avatar.vue'
//candidate
import candidateProfile from './component/candidate/candidate_profile.vue'
import candidateWorkInformation from './component/candidate/candidate_work_information.vue'
import resume from './component/candidate/resume.vue'
import candidateList from './component/candidate/candidate_list.vue'

//employer
import employerProfile from './component/employer/employer_profile.vue'

//modal
import modalManager from './component/modal/modalManager.vue'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css'

import Multiselect from 'vue-multiselect'
// import 'vue-multiselect/dist/vue3-multiselect.css'

import withUUID from "vue-uuid";


const app = createApp({})
// console.log(app);


app.component('language-switcher', languageSwitcher)
app.component('test-vue', test)

app.component('upload-avatar', uploadAvatar)
//candidate
app.component('candidate-profile', candidateProfile)
app.component('candidate-work-information', candidateWorkInformation)
app.component('resume-vue', resume)
app.component('candidate-list', candidateList)

//employer
app.component('employer-profile', employerProfile)


//modal
app.component('modal-manager', modalManager);
app.component('multiselect', Multiselect)

app.use(i18nVue
    , {
    lang: lang,
    resolve: lang => import(`../../lang/php_${lang}.json`),
})

window.I18n = I18n;
window.toast = toast

app.use(VueSweetalert2);
app.use(withUUID);

app.mount("#app")
