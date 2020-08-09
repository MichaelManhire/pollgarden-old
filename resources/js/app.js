/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// Vue.component('ballot-box', {
//     template: `
//     <form class="px-2 sm:px-6" action="" method="POST">
//         <fieldset>
//             <legend class="sr-only">{{ pollTitle }}</legend>
//             <div class="flex items-center" v-for="option in poll.options" v-bind:key="option.id">
//                 <div class="flex-shrink-0 mr-3 text-green-600">
//                     &times;
//                 </div>
//                 <label class="relative flex-grow block py-5 pl-12 pr-4 leading-tight bg-gray-100 rounded-md cursor-pointer hover:bg-gray-200 transition-colors duration-150 ease-in-out fancy-radio-button-wrapper"
//                     v-bind:for="option.id">
//                     <input class="fancy-radio-button"
//                         v-bind:id="option.id"
//                         name="option_id"
//                         type="radio"
//                         v-bind:value="option.id"
//                         required>
//                     <span class="relative z-10 font-medium">{{ option.name }}</span>
//                     <span class="relative z-10 float-right font-bold"></span>
//                     <span class="result-bar js-result-bar"
//                         style="background-color: ; max-width: ;"></span>
//                 </label>
//             </div>
//         </fieldset>

//         <button class="sr-only" type="submit"></button>
//     </form>
//     `,
//     data: function () {
//         return {
//             pollTitle: '',
//         };
//     },
// });

Vue.component('ballot-box', require('./components/BallotBox.vue').default);
Vue.component('ballot-box-option', require('./components/BallotBoxOption.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

// Alpine Components
require('alpinejs');
// require('./components/ballot-box');
require('./components/comment');
