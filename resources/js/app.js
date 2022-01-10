require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('hotel-index', require('./components/hotel/IndexComponent.vue').default);
Vue.component('hotel-list', require('./components/hotel/ListComponent.vue').default);
Vue.component('hotel-show', require('./components/hotel/ShowComponent.vue').default);

const app = new Vue({
    el: '#app',
});
