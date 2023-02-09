import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

//Language
import { i18nVue } from 'laravel-vue-i18n'

// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]');

axios.defaults.baseURL = 'http://app_f.tam/api/v1/';
axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem("token")}`;

// createApp(App).mount("#app");
const app = createApp(App)

app.use(router)

app.use(i18nVue, {
    resolve: async lang => {
        const langs = import.meta.glob('../../lang/*.json');
        return await langs[`../../lang/${lang}.json`]();
    }
})

app.mount('#app')
