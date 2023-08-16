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
import candidateProfile from './component/candidate/page/candidate_profile.vue'
import candidateWorkInformation from './component/candidate/page/candidate_work_information.vue'
import resume from './component/candidate/resume.vue'
import candidateList from './component/candidate/candidate_list.vue'
import candidateDetail from './component/candidate/candidate_detail.vue'

//employer
import employerProfile from './component/employer/employer_profile.vue'
import postJob from './component/employer/post_job.vue'
import jobList from './component/employer/job_list.vue'
import myVacancy from './component/employer/my_vacancy.vue'

// HR

import selectionPersonal from './component/hr/page/selection_personal.vue'
import vacancyPersonal from './component/admin/vacancy/page/vacancy_personal.vue'
import reminderManager from "./component/hr/component/reminderManager.vue";
//modal
import modalManager from './component/modal/modalManager.vue'
//_______________________ADMIN COMPONENT_____________________
import hrTable from './component/admin/hr/hr_table.vue'
// import candidateTable from './component/admin/candidate/candidate_table.vue'
// dashboard
import dailyReminder from './component/admin/dashboard/dailyReminder.vue'

// page
import candidatePage from "./component/admin/candidate/page/candidate_page.vue"
import candidateUpdate from './component/admin/candidate/page/candidate_update_page.vue'
import addCandidate from './component/admin/candidate/page/add_candidate.vue'
import reminderPage from './component/admin/reminder/page/reminder_page.vue'
import vacancyPage from './component/admin/vacancy/page/vacancy_page.vue'
import vacancyAttached from './component/admin/candidate/page/vacancy_attached.vue'
import relevantVacancy from './component/admin/candidate/page/relevant_vacancy.vue'



// ___________________PAGE_____________________
import busyCandidate from './component/page/busy_candidate.vue'

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

import Popper from "vue3-popper";



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

app.component('selection-personal', selectionPersonal)
app.component('vacancy-personal', vacancyPersonal)
app.component('reminder-manager', reminderManager)
//modal
app.component('modal-manager', modalManager);

//____________________ADMIN COMPONENT_____________
app.component('hr-table', hrTable)
// app.component('candidate-table', candidateTable)
// dashboard
app.component('daily-reminder',dailyReminder)
// page
app.component('candidate-page', candidatePage)
app.component('candidate-update', candidateUpdate)
app.component('add-candidate', addCandidate)
app.component('reminder-page', reminderPage)
app.component('vacancy-page', vacancyPage)
app.component('vacancy-attached', vacancyAttached)
app.component('relevant-vacancy', relevantVacancy)

// __________________PAGE_____________
app.component('busy-candidate', busyCandidate)


app.component('multiselect', Multiselect)

app.component('EasyDataTable', Vue3EasyDataTable);

app.component("Popper", Popper);

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
