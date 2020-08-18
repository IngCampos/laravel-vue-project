/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Import Functions(Jquery) of SB Admin 2.
require('./sb-admin-2');

// Import Jquery easy for Smooth scrolling of SB Admin 2.
require("jquery-easing");

// Import Sweetalert
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'

//import library for download csv files
import JsonCSV from 'vue-json-csv'

// Libraries for date forms
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
// Set the language in spanish
import 'vue2-datepicker/locale/es';

// import the filters
import {
    dateFilter
} from './filters'

window.Vue = require('vue');

Vue.use(VueSweetalert2);

Vue.filter('date', dateFilter)

Vue.component('downloadCsv', JsonCSV)
Vue.component('datePicker', DatePicker)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
        SuccessMessage(title, text) {
            this.$swal.fire({
                icon: "success",
                title: title,
                text: text
            });
        },
        InfoMessage(title, text) {
            this.$swal.fire({
                icon: "info",
                title: title,
                html: text
            });
        },
        ErrorMessage(text, error) {
            this.$swal.fire({
                icon: "error",
                title: "Oops...",
                text: text,
                footer: error
            });
        },
        ConfirmMessageValue(title, text, footer) {
            return {
                icon: "warning",
                title: title,
                html: text,
                footer: footer,
                showCancelButton: true,
                confirmButtonText: "Yes"
            };
        },
        MixinContent(array) {
            return {
                confirmButtonText: "Next &rarr;",
                showCancelButton: true,
                progressSteps: array
            }
        },
        ShowDate() {
            // Just for bugs, the date is getted by javascript
            var d = new Date()
            return d.getHours() + ":" + d.getMinutes() + " " +
                d.getDate() + "/" + ((d.getMonth() < 10) ? '0' : '') + (d.getMonth() + 1) + "/" + d.getFullYear();
            // Just the year does not have the same format, it shows 4 digits and the others just 2.
        },
        BasicLoading(title) {
            // Just for post, delete and put functions from axios and simple data, no files.
            this.$swal.fire({
                icon: "info",
                title: (title ? title : 'Task in process.'),
                text: "Wait a moment!",
                allowOutsideClick: false,
                allowEscapeKey: true,
            });
            // title is optional
            this.$swal.showLoading();
        },
        FileLoading(content) {
            // Just for post functions from axios and files forms.
            this.$swal.fire({
                title: "Upload file",
                html: content,
                footer: "Wait a moment!",
                allowOutsideClick: false,
                allowEscapeKey: true,
            });
            this.$swal.showLoading();
        },
        SetCurrentDate() {
            axios.get("/date").then(response => {
                this.CurrentDate.setHours(0, 0, 0, 0);
                this.CurrentDate.setFullYear(response.data[0]);
                this.CurrentDate.setMonth(response.data[1] - 1);
                this.CurrentDate.setDate(response.data[2]);
                console.log(this.CurrentDate);
            });
        },
        Strong_password(password) {
            if (password.length >= 8) {
                var upperCase = false;
                var lowCase = false;
                var number = false;
                var strangeCaracter = false;

                for (var i = 0; i < password.length; i++) {
                    if (password.charCodeAt(i) >= 65 && password.charCodeAt(i) <= 90) {
                        upperCase = true;
                    } else if (
                        password.charCodeAt(i) >= 97 &&
                        password.charCodeAt(i) <= 122
                    ) {
                        lowCase = true;
                    } else if (
                        password.charCodeAt(i) >= 48 &&
                        password.charCodeAt(i) <= 57
                    ) {
                        number = true;
                    } else {
                        strangeCaracter = true;
                    }
                }
                if (
                    upperCase == true &&
                    lowCase == true &&
                    strangeCaracter == true &&
                    number == true
                ) {
                    return false;
                }
            }
            return true;
        }
    },
    data() {
        return {
            colors: [
                "success",
                "warning",
                "danger",
                "info",
                "secondary",
                "primary",
                "dark"
            ],
            CurrentDate: new Date()
        };
    },
});
