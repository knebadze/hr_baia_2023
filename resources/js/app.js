// app.js
import('./bootstrap');

import {createApp} from 'vue/dist/vue.esm-bundler'

// import App from './App.vue'
import howWork from './component/how_work.vue'
const app = createApp({})
// console.log(app);


// app.component('how-work', howWork)
app.mount("#app")
