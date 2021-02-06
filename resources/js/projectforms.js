import Vue from 'vue';
import ProjectFormsTable from './components/ProjectFormsTable'
import ProjectDataTable from './components/ProjectDataTable'
import ProjectNutrientsTable from './components/ProjectNutrientsTable'

import VueEcho from 'vue-echo-laravel';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

Vue.mixin(require('./trans'))

Vue.use(VueEcho, {
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: process.env.MIX_PUSHER_PROXY_PORT,
    wssPort: process.env.MIX_PUSHER_PROXY_PORT,
    disableStats: true,
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});

Vue.use(BootstrapVue)


Vue.component("project-forms-table",ProjectFormsTable)
Vue.component("project-data-table", ProjectDataTable)
Vue.component("project-nutrients-table", ProjectNutrientsTable)
let app = new Vue({
    el: '#vue-app',
});

