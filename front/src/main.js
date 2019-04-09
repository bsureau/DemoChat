import '@babel/polyfill'
import Vue from 'vue'
import './plugins/vuetify'
import App from './App.vue'
import router from './router'
import Axios from 'axios'

const serverName = 'demochat.local'
Vue.config.productionTip = false

Vue.prototype.$axios = Axios
Vue.prototype.$axios.defaults.baseURL= 'http://localhost:8000'

new Vue({
  serverName,
  router,
  render: h => h(App)
}).$mount('#app')

