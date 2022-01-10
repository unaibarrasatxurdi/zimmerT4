require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('hoteles', require('./components/HotelesComponent.vue').default);

const app = new Vue({
    el: '#app',
});
