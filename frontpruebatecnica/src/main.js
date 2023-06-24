import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

//importamos nuestras librerias bootstrap y fortawesome
import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap/dist/css/bootstrap.css'


createApp(App).use(store).use(router).mount('#app')

//importamos al final los scripts

import 'bootstrap/dist/js/bootstrap'

