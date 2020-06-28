require('./bootstrap');
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Vuex from 'vuex'
import Notifications from 'vue-notification'

// assets 
import './assets/vendors/lineawesome/css/line-awesome.min.css'

// includes
import stores from './stores'
import router from './routes'
import mixins from './utils/mixins'

// components
import App from './views/App'

Vue.use(Vuex) 
Vue.use(VueAxios, axios)
Vue.use(Notifications)
Vue.mixin(mixins)

const store = new Vuex.Store({
    modules : stores
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});