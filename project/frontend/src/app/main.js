import '@/assets/main.scss'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import VueMask, {VueMaskDirective} from 'v-mask'

import App from './App.vue'
import router from '../router/index.js'

const app = createApp(App);

app
    .use(createPinia())
    .use(router)
    .directive('mask', VueMaskDirective)
    .mount('#app')
