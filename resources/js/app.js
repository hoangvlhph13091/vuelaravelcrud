import {createApp} from 'vue';

import App from './App.vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import router from './router';

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.config.globalProperties.$baseurl = window.location.origin+'/api/';
app.use(VueAxios, axios);
app.use(router);
app.mount('#app');