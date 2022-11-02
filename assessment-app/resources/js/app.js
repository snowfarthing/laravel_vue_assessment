require('./bootstrap');

import { createApp } from 'vue'
import Welcome from './components/Welcome'

const app = createApp({})

app.component('Welcome', Welcome)

app.mount('#app')
