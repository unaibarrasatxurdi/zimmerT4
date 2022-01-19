/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

window.axios.defaults.headers.common = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
};

window.$ = window.jQuery = require('jquery')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('hotel-list', require('./components/hotel/IndexComponent.vue').default);
Vue.component('hotel-list', require('./components/hotel/ListComponent.vue').default);
Vue.component('hotel-details', require('./components/hotel/DetailsComponent.vue').default);
Vue.component('home-search', require('./components/SearchComponent.vue').default);

Vue.component('comentario', require('./components/ComentarioComponent.vue').default);

/** 
 * Vue Filters
 */

Vue.filter('formatDate', function(value) {
    if (value)
      return moment(String(value)).format('MM/DD/YYYY hh:mm');
});

/** 
 * Vue Mixings
 */

Vue.mixin({

    data: () => ({
        hoteles: [],
        ostatzeMotak: []
    }),

    methods: {
        getHoteles: function () {
            const URL = "https://opendata.euskadi.eus/contenidos/ds_recursos_turisticos/hoteles_de_euskadi/opendata/alojamientos.json";
            axios.get(URL).then((response) => {
                let data = new String(response.data).replace("jsonCallback(", "").replace(");", "");
                this.hoteles = JSON.parse(data); 
                for (let i = 0; i < this.hoteles.length; i++) {
                    this.hoteles[i].id = i;
                }
                this.ostatzeMotak = this.getOstatzeMotak();
            });
        },
        getOstatzeMotak: function () {
            return this.hoteles.map((hotel) => hotel.lodgingType).sort().reduce(function (a, b) {
                if (a.slice(-1)[0] !== b) a.push(b);
                    return a;
                }, []
            );
        },
    },
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
