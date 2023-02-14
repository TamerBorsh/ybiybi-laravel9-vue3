import './bootstrap';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

//Language
import { i18nVue } from 'laravel-vue-i18n';

// Pagination
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://app_f.tam/api/v1/';
// axios.defaults.baseURL = 'https://translators.fresh-app.com/api/v1/';
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("token")}`;
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]');

// createApp(App).mount("#app");
const app = createApp(App)

app.use(router)

// app.mixin({
//     data: function() {
//       return {
//         get $asset() {
//           return "Can't change me!";
//         }
//       }
//     }
//   })
  

//Language
app.use(i18nVue, {
    resolve: async lang => {
        const langs = import.meta.glob('../../lang/*.json');
        return await langs[`../../lang/${lang}.json`]();
    }
})

app.mount('#app')
