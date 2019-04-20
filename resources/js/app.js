require('./foundation');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en';
import Vuelidate from 'vuelidate';
import vSelect from 'vue-select'

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(ElementUI, { locale });
Vue.use(Vuelidate);
Vue.component('v-select', vSelect)

import App from './components/App';
import router from './routes';

const app = new Vue({
    el: '#app',
    components: {App},
    router
});
