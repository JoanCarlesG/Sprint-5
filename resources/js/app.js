import './bootstrap';
import '../css/app.css'; // Import Bootstrap CSS

import { createApp } from 'vue';
//import main Vue file
import App from '../src/App.vue';
import router from "./routes";

createApp(App)
    .use(router)
    .mount('#app');

// //import Axios
// import VueAxios from 'vue-axios';
// import axios from 'axios';

// //import router and configure
// import VueRouter from 'vue-router';
// import { routes } from './routes';
// import Vue from 'vue';
// Vue.use(VueRouter);
// Vue.use(VueAxios, axios);

// const router = new VueRouter({
//     mode: 'history',
//     routes: routes
// });

// const app = new Vue({
//     el: '#app',
//     router: router,
//     render: h => h(App)
// });