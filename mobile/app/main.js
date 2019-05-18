import Vue from 'nativescript-vue'
// import App from './components/App'
import router from './router'

Vue.prototype.$router = router

Vue.prototype.$goto = function (to, options) {
  this.$navigateTo(this.$router[to], options)
}

// Prints Vue logs when --env.production is *NOT* set while building
Vue.config.silent = (TNS_ENV === 'production')

// new Vue({
//   render: h => h('frame', [h(App)])
// }).$start()

new Vue({ 
  render: h => h('frame', [h(router['home'])])
}).$start()