// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import { BootstrapVue } from 'bootstrap-vue'
import App from './App'
import router from './router'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/styles/style.css'
import './assets/styles/colors/green.css'
import VueMqtt from 'vue-mqtt'

import VueCookie from 'vue-cookie'

Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(VueCookie)
Vue.use(VueMqtt, process.env.ROOT_WS)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
