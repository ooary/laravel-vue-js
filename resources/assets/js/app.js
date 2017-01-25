
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import VeeValidate from 'vee-validate'
// const config = {
//     errorBagName: 'errors', // change if property conflicts.
//     fieldsBagName: 'fields',
//     delay: 0,
//     locale: 'en',
//     dictionary: null,
//     strict: true
// };
// Vue.use(VeeValidate,config);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
Vue.component('example', require('./components/Example.vue'));

Vue.component('indexMatkul',require('./components/master/matkul/index.vue'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');


const app = new Vue({
    el: '#app'
});
