// app.js
import('./bootstrap');
import {createApp} from 'vue/dist/vue.esm-bundler'
import { i18nVue, I18n } from 'laravel-vue-i18n'
import axios from 'axios';

const lang = localStorage.getItem('localLang');
//_______________________VUE ITEM____________________
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css'

import Multiselect from 'vue-multiselect'

import withUUID from "vue-uuid";

//Vue3EasyDataTable
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

import Popper from "vue3-popper";

window.I18n = I18n;
window.toast = toast

const app = createApp({});

// Dynamic imports
const importComponents = async () => {
    const [
        languageSwitcher,
//_________________________USER COMPONENT_________________________
      uploadAvatar,
      changePassword,
      //candidate
      candidateProfile,
      candidateWorkInformation,
      resume,
      candidateList,
      candidateDetail,

      employerProfile,
      postVacancy,
      vacancyList,
      vacancyDetail,
      myVacancy,
//_______________________ADMIN COMPONENT_____________________
      selectionPersonal,
      vacancyPersonal,
      reminderManager,

      modalManager,
      hrTable,
      dailyReminder,
      dailyWork,
      popularVacancy,

      candidatePage,
      candidateUpdate,
      addCandidate,
      reminderPage,
      vacancyPage,
      vacancyDeposit,
      vacancyAttached,
      relevantVacancy,
      adminVacancyTable,
      employerPage,

      enrolledPage,
      mustBeEnrolledPage,
      monthlySalaryPage,
      oldSalaryPage,

      busyCandidate,
      categoryCarousel

      // ... Other component imports ...
    ] = await Promise.all([
      import('./component/languageSwitcher.vue'),

      import('./component/user/upload_avatar.vue'),
      import('./component/user/change_password.vue'),

      import('./component/candidate/page/candidate_profile.vue'),
      import('./component/candidate/page/candidate_work_information.vue'),
      import('./component/candidate/resume.vue'),
      import('./component/candidate/candidate_list.vue'),
      import('./component/candidate/candidate_detail.vue'),

      import('./component/employer/employer_profile.vue'),
      import('./component/employer/post_vacancy.vue'),
      import('./component/employer/vacancy_list.vue'),
      import('./component/employer/vacancy_detail.vue'),
      import('./component/employer/my_vacancy.vue'),

      import('./component/hr/page/selection_personal.vue'),
      import('./component/admin/vacancy/page/vacancy_personal.vue'),
      import('./component/hr/component/reminderManager.vue'),

      import('./component/modal/modalManager.vue'),
      import('./component/admin/hr/hr_table.vue'),
      import('./component/admin/dashboard/dailyReminder.vue'),
      import('./component/admin/dashboard/hr_daily_work.vue'),
      import('./component/admin/dashboard/popular_vacancy.vue'),

      import('./component/admin/candidate/page/candidate_page.vue'),
      import('./component/admin/candidate/page/candidate_update_page.vue'),
      import('./component/admin/candidate/page/add_candidate.vue'),
      import('./component/admin/reminder/page/reminder_page.vue'),
      import('./component/admin/vacancy/page/vacancy_page.vue'),
      import('./component/admin/vacancy/page/vacancy_deposit.vue'),
      import('./component/admin/candidate/page/vacancy_attached.vue'),
      import('./component/admin/candidate/page/relevant_vacancy.vue'),
      import('./component/admin/vacancy/component/admin_vacancy_table.vue'),
      import('./component/admin/employer/page/employer_page.vue'),
      import('./component/admin/enrollment/page/enrolled_page.vue'),
      import('./component/admin/enrollment/page/must_be_enrolled_page.vue'),
      import('./component/admin/salary/page/monthly_salary_page.vue'),
      import('./component/admin/salary/page/old_salary_page.vue'),

      import('./component/page/busy_candidate.vue'),

      import('./component/welcome/category_carousel.vue')


      // ... Other dynamic imports ...
    ]);

    app.component('language-switcher', languageSwitcher.default)

    //___________________USER COMPONENT_____________________
    //user
    app.component('upload-avatar', uploadAvatar.default)
    app.component('change-password', changePassword.default)
    //candidate
    app.component('candidate-profile', candidateProfile.default)
    app.component('candidate-work-information', candidateWorkInformation.default)
    app.component('resume-vue', resume.default)
    app.component('candidate-list', candidateList.default)
    app.component('candidate-detail', candidateDetail.default)

    //employer
    app.component('employer-profile', employerProfile.default)
    app.component('post-vacancy', postVacancy.default)
    app.component('vacancy-list', vacancyList.default)
    app.component('vacancy-detail', vacancyDetail.default)
    app.component('my-vacancy', myVacancy.default)

    // HR

    app.component('selection-personal', selectionPersonal.default)
    app.component('vacancy-personal', vacancyPersonal.default)
    app.component('reminder-manager', reminderManager.default)
    //modal
    app.component('modal-manager', modalManager.default);

    //____________________ADMIN COMPONENT_____________
    app.component('hr-table', hrTable.default)
    // app.component('candidate-table', candidateTable)
    // dashboard
    app.component('daily-reminder',dailyReminder.default)
    app.component('daily-work',dailyWork.default)
    app.component('popular-vacancy',popularVacancy.default)
    // page
    app.component('candidate-page', candidatePage.default)
    app.component('candidate-update', candidateUpdate.default)
    app.component('add-candidate', addCandidate.default)
    app.component('reminder-page', reminderPage.default)
    app.component('vacancy-page', vacancyPage.default)
    app.component('vacancy-deposit', vacancyDeposit.default)
    app.component('vacancy-attached', vacancyAttached.default)
    app.component('relevant-vacancy', relevantVacancy.default)
    app.component('admin-vacancy-table', adminVacancyTable.default)

    app.component('employer-page', employerPage.default)

    app.component('enrolled-page', enrolledPage.default)
    app.component('must-be-enrolled-page', mustBeEnrolledPage.default)
    app.component('monthly-salary-page', monthlySalaryPage.default)
    app.component('old-salary-page', oldSalaryPage.default)


    // __________________PAGE_____________
    app.component('busy-candidate', busyCandidate.default)
    app.component('category-carousel', categoryCarousel.default)


    app.component('multiselect', Multiselect)

    app.component('EasyDataTable', Vue3EasyDataTable);

    app.component("Popper", Popper);
    // ... Register other components ...
  };

  // App setup
  (async () => {
    await importComponents(); // Import components first
    // ... The rest of your setup ...
    app.use(i18nVue
        , {
        lang: lang,
        resolve: lang => import(`../../lang/php_${lang}.json`),
    })
    app.use(VueSweetalert2);
    app.use(withUUID);
    app.mount('#app');
  })();






// import languageSwitcher from './component/languageSwitcher.vue'
// // console.log(i18nVue);


// // import App from './App.vue'
// //_________________________USER COMPONENT_________________________
// //user
// import uploadAvatar from './component/user/upload_avatar.vue'
// import changePassword from './component/user/change_password.vue'
// //candidate
// import candidateProfile from './component/candidate/page/candidate_profile.vue'
// import candidateWorkInformation from './component/candidate/page/candidate_work_information.vue'
// import resume from './component/candidate/resume.vue'
// import candidateList from './component/candidate/candidate_list.vue'
// import candidateDetail from './component/candidate/candidate_detail.vue'

// //employer
// import employerProfile from './component/employer/employer_profile.vue'
// import postVacancy from './component/employer/post_job.vue'
// import jobList from './component/employer/job_list.vue'
// import myVacancy from './component/employer/my_vacancy.vue'

// // HR

// import selectionPersonal from './component/hr/page/selection_personal.vue'
// import vacancyPersonal from './component/admin/vacancy/page/vacancy_personal.vue'
// import reminderManager from "./component/hr/component/reminderManager.vue";
// //modal
// import modalManager from './component/modal/modalManager.vue'
// //_______________________ADMIN COMPONENT_____________________
// import hrTable from './component/admin/hr/hr_table.vue'
// // import candidateTable from './component/admin/candidate/candidate_table.vue'
// // dashboard
// import dailyReminder from './component/admin/dashboard/dailyReminder.vue'

// // page
// import candidatePage from "./component/admin/candidate/page/candidate_page.vue"
// import candidateUpdate from './component/admin/candidate/page/candidate_update_page.vue'
// import addCandidate from './component/admin/candidate/page/add_candidate.vue'
// import reminderPage from './component/admin/reminder/page/reminder_page.vue'
// import vacancyPage from './component/admin/vacancy/page/vacancy_page.vue'
// import vacancyAttached from './component/admin/candidate/page/vacancy_attached.vue'
// import relevantVacancy from './component/admin/candidate/page/relevant_vacancy.vue'
// import employerPage from './component/admin/employer/page/employer_page.vue'



// // ___________________PAGE_____________________
// import busyCandidate from './component/page/busy_candidate.vue'

// //_______________________VUE ITEM____________________
// import VueSweetalert2 from 'vue-sweetalert2';
// import 'sweetalert2/dist/sweetalert2.min.css';

// import { toast } from 'vue3-toastify';
// import 'vue3-toastify/dist/index.css'

// import Multiselect from 'vue-multiselect'
// // import 'vue-multiselect/dist/vue3-multiselect.css'

// import withUUID from "vue-uuid";

// //Vue3EasyDataTable
// import Vue3EasyDataTable from 'vue3-easy-data-table';
// import 'vue3-easy-data-table/dist/style.css';

// import Popper from "vue3-popper";



// const app = createApp({})
// // console.log(app);


// app.component('language-switcher', languageSwitcher)

// //___________________USER COMPONENT_____________________
// //user
// app.component('upload-avatar', uploadAvatar)
// app.component('change-password', changePassword)
// //candidate
// app.component('candidate-profile', candidateProfile)
// app.component('candidate-work-information', candidateWorkInformation)
// app.component('resume-vue', resume)
// app.component('candidate-list', candidateList)
// app.component('candidate-detail', candidateDetail)

// //employer
// app.component('employer-profile', employerProfile)
// app.component('post-job', postVacancy)
// app.component('job-list', jobList)
// app.component('my-vacancy', myVacancy)

// // HR

// app.component('selection-personal', selectionPersonal)
// app.component('vacancy-personal', vacancyPersonal)
// app.component('reminder-manager', reminderManager)
// //modal
// app.component('modal-manager', modalManager);

// //____________________ADMIN COMPONENT_____________
// app.component('hr-table', hrTable)
// // app.component('candidate-table', candidateTable)
// // dashboard
// app.component('daily-reminder',dailyReminder)
// // page
// app.component('candidate-page', candidatePage)
// app.component('candidate-update', candidateUpdate)
// app.component('add-candidate', addCandidate)
// app.component('reminder-page', reminderPage)
// app.component('vacancy-page', vacancyPage)
// app.component('vacancy-attached', vacancyAttached)
// app.component('relevant-vacancy', relevantVacancy)
// app.component('employer-page', employerPage)

// // __________________PAGE_____________
// app.component('busy-candidate', busyCandidate)


// app.component('multiselect', Multiselect)

// app.component('EasyDataTable', Vue3EasyDataTable);

// app.component("Popper", Popper);

// app.use(i18nVue
//     , {
//     lang: lang,
//     resolve: lang => import(`../../lang/php_${lang}.json`),
// })

// window.I18n = I18n;
// window.toast = toast
// // window.initMap = initMap;

// app.use(VueSweetalert2);
// app.use(withUUID);

// app.mount("#app")
