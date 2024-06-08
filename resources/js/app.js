// app.js
import("./bootstrap");
import { createApp } from "vue/dist/vue.esm-bundler";
import { createPinia } from "pinia";
import { i18nVue, I18n } from "laravel-vue-i18n";
import axios from "axios";

const lang = localStorage.getItem("localLang");
//_______________________VUE ITEM____________________

import "sweetalert2/dist/sweetalert2.min.css";
import VueSweetalert2 from "vue-sweetalert2"; // Import VueSweetalert2

import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

import Multiselect from "vue-multiselect";

import withUUID from "vue-uuid";

//Vue3EasyDataTable
import Vue3EasyDataTable from "vue3-easy-data-table";
import "vue3-easy-data-table/dist/style.css";

import Popper from "vue3-popper";
import * as Vue3FormWizard from "../../node_modules/vue3-form-wizard/dist/vue3-form-wizard.es.js";
// import Vue3FormWizard from 'vue3-form-wizard'
import "vue3-form-wizard/dist/style.css";

window.I18n = I18n;
window.toast = toast;
// window.swal = VueSweetalert2

const app = createApp({});
const pinia = createPinia();
// Dynamic imports
const importComponents = async () => {
    const [
        languageSwitcher,
        //_________________________USER COMPONENT_________________________
        uploadAvatar,
        changePassword,
        //candidate
        candidateProfile,
        resume,
        GuestCandidatePage,
        candidateList,
        candidateDetail,

        postVacancyPage,
        vacancyListPage,
        vacancyDetail,
        myVacancy,
        showUpdateVacancy,
        comingSoon,
        //_______________________ADMIN COMPONENT_____________________
        selectionPersonal,
        vacancyPersonal,
        reminderManager,

        modalManager,
        hrPage,
        dailyReminder,
        hrDailyWork,
        administratorDailyWork,

        AdministratorPage,

        candidatePage,
        candidateUpdate,
        addCandidate,
        reminderPage,
        vacancyPage,
        vacancyDeposit,
        vacancyAttached,
        relevantVacancy,
        vacancyTable,
        //   adminVacancyTable,
        employerPage,

        enrollmentPage,
        //   enrolledPage,
        //   mustBeEnrolledPage,
        monthlySalaryPage,
        oldSalaryPage,

        busyCandidate,
        categoryCarousel,
        testimonialCarousel,
        subscribeInput,
        popularVacancy,

        testimonialPage,
        smsTemplate,
        globalVariablePage,

        // ... Other component imports ...
    ] = await Promise.all([
        import("./component/languageSwitcher.vue"),

        import("./component/user/upload_avatar.vue"),
        import("./component/user/change_password.vue"),

        import("./component/candidate/page/candidate_profile.vue"),
        import("./component/candidate/resume.vue"),
        import("./component/candidate/page/GuestCandidatePage.vue"),
        import("./component/candidate/candidate_list.vue"),
        import("./component/candidate/candidate_detail.vue"),

        import("./component/employer/page/post_vacancy_page.vue"),
        import("./component/employer/page/vacancy_list_page.vue"),
        import("./component/employer/vacancy_detail.vue"),
        import("./component/employer/page/my_vacancy.vue"),
        import("./component/employer/page/show_update_vacancy.vue"),
        import("./component/page/ComingSoon.vue"),

        import("./component/admin/vacancy/page/selection_personal.vue"),
        import("./component/admin/vacancy/page/vacancy_personal.vue"),
        import("./component/admin/dashboard/reminderManager.vue"),

        import("./component/modal/modalManager.vue"),
        import("./component/admin/staff/hr/page/hr_page.vue"),
        import("./component/admin/dashboard/dailyReminder.vue"),
        import("./component/admin/dashboard/hr_daily_work.vue"),
        import("./component/admin/dashboard/AdministratorDailyWork.vue"),

        import("./component/admin/staff/administrator/page/AdministratorPage.vue"),

        import("./component/admin/candidate/page/candidate_page.vue"),
        import("./component/admin/candidate/page/candidate_update_page.vue"),
        import("./component/admin/candidate/page/add_candidate.vue"),
        import("./component/admin/reminder/page/reminder_page.vue"),
        import("./component/admin/vacancy/page/vacancy_page.vue"),
        import("./component/admin/vacancy/page/vacancy_deposit.vue"),
        import("./component/admin/candidate/page/vacancy_attached.vue"),
        import("./component/admin/candidate/page/relevant_vacancy.vue"),
        import("./component/admin/vacancy/component/table/vacancy_table.vue"),
        //   import('./component/admin/vacancy/component/admin_vacancy_table.vue'),
        import("./component/admin/employer/page/employer_page.vue"),

        import("./component/admin/enrollment/page/EnrollmentPage.vue"),
        //   import('./component/admin/enrollment/page/enrolled_page.vue'),
        //   import('./component/admin/enrollment/page/must_be_enrolled_page.vue'),
        import("./component/admin/salary/page/monthly_salary_page.vue"),
        import("./component/admin/salary/page/old_salary_page.vue"),

        import("./component/page/busy_candidate.vue"),

        import("./component/welcome/category_carousel.vue"),
        import("./component/welcome/testimonial_carousel.vue"),
        import("./component/welcome/subscribe_input.vue"),
        import("./component/welcome/popular_vacancy.vue"),

        import("./component/admin/testimonial/page/testimonial_page.vue"),
        import("./component/admin/sms_template/page/sms_template.vue"),
        import(
            "./component/admin/global_variable/page/global_variable_page.vue"
        ),

        // ... Other dynamic imports ...
    ]);

    app.component("language-switcher", languageSwitcher.default);

    //___________________USER COMPONENT_____________________
    //user
    app.component("upload-avatar", uploadAvatar.default);
    app.component("change-password", changePassword.default);
    //candidate
    app.component("candidate-profile", candidateProfile.default);
    app.component("resume-vue", resume.default);
    app.component("guest-candidate-page", GuestCandidatePage.default);
    app.component("candidate-list", candidateList.default);
    app.component("candidate-detail", candidateDetail.default);

    //employer
    app.component("post-vacancy-page", postVacancyPage.default);
    app.component("vacancy-list-page", vacancyListPage.default);
    app.component("vacancy-detail", vacancyDetail.default);
    app.component("my-vacancy", myVacancy.default);
    app.component("show-update-vacancy", showUpdateVacancy.default);
    app.component("coming-soon", comingSoon.default);
    // HR

    app.component("selection-personal", selectionPersonal.default);
    app.component("vacancy-personal", vacancyPersonal.default);
    app.component("reminder-manager", reminderManager.default);
    //modal
    app.component("modal-manager", modalManager.default);

    //____________________ADMIN COMPONENT_____________
    app.component("hr-page", hrPage.default);
    // app.component('candidate-table', candidateTable)
    // dashboard
    app.component("daily-reminder", dailyReminder.default);
    app.component("hr-daily-work", hrDailyWork.default);
    app.component("administrator-daily-work", administratorDailyWork.default);

    app.component("administrator-page", AdministratorPage.default);
    // page
    app.component("candidate-page", candidatePage.default);
    app.component("candidate-update", candidateUpdate.default);
    app.component("add-candidate", addCandidate.default);
    app.component("reminder-page", reminderPage.default);
    app.component("vacancy-page", vacancyPage.default);
    app.component("vacancy-deposit", vacancyDeposit.default);
    app.component("vacancy-attached", vacancyAttached.default);
    app.component("relevant-vacancy", relevantVacancy.default);
    app.component("vacancy-table", vacancyTable.default);
    // app.component('admin-vacancy-table', adminVacancyTable.default)

    app.component("employer-page", employerPage.default);

    app.component("enrollment-page", enrollmentPage.default);
    // app.component('enrolled-page', enrolledPage.default)
    // app.component('must-be-enrolled-page', mustBeEnrolledPage.default)
    app.component("monthly-salary-page", monthlySalaryPage.default);
    app.component("old-salary-page", oldSalaryPage.default);

    // __________________PAGE_____________
    app.component("busy-candidate", busyCandidate.default);
    app.component("category-carousel", categoryCarousel.default);
    app.component("testimonial-carousel", testimonialCarousel.default);
    app.component("subscribe-input", subscribeInput.default);
    app.component("popular-vacancy", popularVacancy.default);

    app.component("testimonial-page", testimonialPage.default);
    app.component("sms-template", smsTemplate.default);
    app.component("global-variable", globalVariablePage.default);

    app.component("multiselect", Multiselect);

    app.component("EasyDataTable", Vue3EasyDataTable);

    app.component("Popper", Popper);
    // ... Register other components ...
};

// App setup
(async () => {
    await importComponents(); // Import components first
    // ... The rest of your setup ...
    app.use(i18nVue, {
        lang: lang,
        resolve: (lang) => import(`../../lang/php_${lang}.json`),
    });
    app.use(VueSweetalert2);
    app.use(withUUID);
    app.use(Vue3FormWizard.default);
    app.use(pinia);
    app.mount("#app");
})();
