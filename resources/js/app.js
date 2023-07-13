// app.js
import('./bootstrap');
// import('./register_form')
import {createApp} from 'vue/dist/vue.esm-bundler'
import { i18nVue, I18n } from 'laravel-vue-i18n'

const lang = localStorage.getItem('localLang');

import languageSwitcher from './component/languageSwitcher.vue'
// console.log(i18nVue);
import test from './component/test.vue'

// import App from './App.vue'
//_________________________USER COMPONENT_________________________
//user
import uploadAvatar from './component/user/upload_avatar.vue'
import changePassword from './component/user/change_password.vue'
//candidate
import candidateProfile from './component/candidate/candidate_profile.vue'
import candidateWorkInformation from './component/candidate/candidate_work_information.vue'
import resume from './component/candidate/resume.vue'
import candidateList from './component/candidate/candidate_list.vue'
import candidateDetail from './component/candidate/candidate_detail.vue'

//employer
import employerProfile from './component/employer/employer_profile.vue'
import postJob from './component/employer/post_job.vue'
import jobList from './component/employer/job_list.vue'
import myVacancy from './component/employer/my_vacancy.vue'

// HR
import hrVacancy from './component/hr/page/hr_vacancy.vue'
import selectionPersonal from './component/hr/page/selection_personal.vue'
import vacancyPersonal from './component/hr/page/vacancy_personal.vue'
//modal
import modalManager from './component/modal/modalManager.vue'
//_______________________ADMIN COMPONENT_____________________
import hrTable from './component/admin/hr/hr_table.vue'
import candidateTable from './component/admin/candidate/candidate_table.vue'

//_______________________VUE ITEM____________________
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css'

import Multiselect from 'vue-multiselect'
// import 'vue-multiselect/dist/vue3-multiselect.css'

import withUUID from "vue-uuid";

//Vue3EasyDataTable
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';



const app = createApp({})
// console.log(app);


app.component('language-switcher', languageSwitcher)
app.component('test-vue', test)
//___________________USER COMPONENT_____________________
//user
app.component('upload-avatar', uploadAvatar)
app.component('change-password', changePassword)
//candidate
app.component('candidate-profile', candidateProfile)
app.component('candidate-work-information', candidateWorkInformation)
app.component('resume-vue', resume)
app.component('candidate-list', candidateList)
app.component('candidate-detail', candidateDetail)

//employer
app.component('employer-profile', employerProfile)
app.component('post-job', postJob)
app.component('job-list', jobList)
app.component('my-vacancy', myVacancy)

// HR
app.component('hr-vacancy', hrVacancy)
app.component('selection-personal', selectionPersonal)
app.component('vacancy-personal', vacancyPersonal)
//modal
app.component('modal-manager', modalManager);

//____________________ADMIN COMPONENT_____________
app.component('hr-table', hrTable)
app.component('candidate-table', candidateTable)


app.component('multiselect', Multiselect)

app.component('EasyDataTable', Vue3EasyDataTable);

app.use(i18nVue
    , {
    lang: lang,
    resolve: lang => import(`../../lang/php_${lang}.json`),
})

window.I18n = I18n;
window.toast = toast
// window.initMap = initMap;

app.use(VueSweetalert2);
app.use(withUUID);

app.mount("#app")
