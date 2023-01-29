// app.js
require('./bootstrap');

import {createApp} from 'vue'

// import App from './App.vue'
import logIn from "./component/modal/log_in.vue";
import howWork from './component/how_work.vue'
const app = createApp({})

app.component('log-in', logIn);
app.component('how-work', howWork)
app.mount("#app")
