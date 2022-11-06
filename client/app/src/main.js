import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from 'axios'

import App from './App.vue'
import router from './router'
// import './assets/main.css'
import './assets/index.css'
import 'flowbite';
import VueGoogleMaps from '@fawmi/vue-google-maps'

const app = createApp(App)

const axiosInstance = axios.create({
  baseURL: 'http://localhost/api'
})



axios.defaults.headers.common = {
    'Authorization': 'Bearer ' + localStorage.getItem('jwt_token'),
};

app.config.globalProperties.$axios = { ...axiosInstance }

app.use(createPinia())
app.use(router)
app.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCJEZGsrOXlrN_fj3Momn49r2y6clRUugk',
        libraries: 'places', // This is required if you use the Autocomplete plugin
    }
})

app.mount('#app')
