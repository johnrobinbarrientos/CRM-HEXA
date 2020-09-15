require('./bootstrap');
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Vuex from 'vuex'
import Notifications from 'vue-notification'

import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';


// CSS 
import './assets/vendors/lineawesome/css/line-awesome.min.css'
//import './assets/themes/css/dashlite.css?ver=1.6.0'
//import './assets/themes/css/skins/theme-blue.css?ver=1.6.0'
//import './assets/css/custom.css'
// import './assets/css/fonts.css'


// JS
//import './assets/themes/js/bundle.js?ver=1.6.0'
//import './assets/js/custom.js?ver=1.6.0'
// import './assets/themes/js/scripts.js?ver=1.6.0'
// import './assets/themes/js/charts/chart-crypto.js?ver=1.6.0'

// includes
import stores from './stores'
import router from './routes'
import customs from './utils/customs'
import mixins from './utils/mixins'

// components
import App from './views/App'

window.TOKEN_KEY = 'KX-HEXA'

window.API_URL = '//'+ window.location.host +'/api'

if (window.location.host === 'suite.hexa.ph') {
    window.API_URL = 'https://'+ window.location.host +'/api'
}

Vue.use(datePicker)
Vue.use(Vuex) 
Vue.use(VueAxios, axios)
Vue.use(Notifications)
Vue.mixin(customs)
Vue.mixin(mixins)
Vue.mixin(require('./assets'));

window.swal = require('sweetalert2')

const store = new Vuex.Store({
    modules : stores
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});