import Vue from 'vue';
import ProjectFormsTable from './components/ProjectFormsTable'
import ProjectDataTable from './components/ProjectDataTable'

import VueEcho from 'vue-echo-laravel';

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


Vue.component("project-forms-table",ProjectFormsTable)
Vue.component("project-data-table", ProjectDataTable)

let app = new Vue({
    el: '#vue-app',
});

