require('./bootstrap');
require('vue');
import Alpine from 'alpinejs';
import Vue from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
window.Alpine = Alpine;

Alpine.start();

// blade component register here 
Vue.component('categories-table',require('./components/categoriesTable.vue').default);
Vue.component('login-form',require('./components/loginForm.vue').default);
Vue.component('nav-bar',require('./components/navbar.vue').default);
Vue.component('side-bar',require('./components/sidebar.vue').default);
Vue.component('footer-body',require('./components/footer.vue').default);
Vue.component('dashboard-layout',require('./components/dashboard.vue').default);
Vue.component('category-create',require('./components/category.vue').default);
// .. end blade component registration
window.onload = function () {
    var main = new Vue({
        el: '#app',
        data: {
            currentActivity: 'home'
        },
        "types": [
            "vue-sweetalert2"
          ],

    });
}