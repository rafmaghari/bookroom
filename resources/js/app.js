import router from "./router";


window.Vue = require('vue').default;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app', require('./pages/App').default);
Vue.component('Nav', require('./components/Nav').default);

const app = new Vue({
    el: '#app',
    router: router
});
