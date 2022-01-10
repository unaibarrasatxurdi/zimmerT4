require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('hotel-index', require('./components/HotelIndexComponent.vue').default);
Vue.component('hotel-list', require('./components/HotelListComponent.vue').default);
Vue.component('hotel-show', require('./components/HotelShowComponent.vue').default);

const app = new Vue({
    el: '#app',
});
