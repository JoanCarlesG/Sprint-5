import './bootstrap';
import '../css/app.css'; // Import Bootstrap CSS

import { createApp } from 'vue';
//import main Vue file
import App from '../src/App.vue';
//import router
import router from "./routes";

createApp(App)
    .use(router)
    .mount('#app');

