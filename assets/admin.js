import Vue from 'vue';
import Vuetify from './plugins/vuetify';
import VueRouter from 'vue-router';

import AdminApp from './components/AdminApp';
import router from './routes/routes';

import './styles/admin.css';

Vue.use(Vuetify);
Vue.use(VueRouter);

new Vue({
    el: '#admin',
    components: { AdminApp },
    vuetify: Vuetify,
    router,
    render: (h) => h(AdminApp)
})