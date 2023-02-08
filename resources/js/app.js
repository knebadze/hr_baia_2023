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
const app = createApp({})
// console.log(app);

app.component('language-switcher', languageSwitcher)
app.component('test-vue', test)
app.use(i18nVue
    , {
    lang: lang,
    resolve: lang => import(`../../lang/php_${lang}.json`),
})
app.mount("#app")
