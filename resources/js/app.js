require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('about-component', require('./components/AboutComponent.vue').default);

const app = new Vue({
    el: '#app',
});
