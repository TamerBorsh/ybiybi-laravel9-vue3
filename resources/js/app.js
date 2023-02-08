import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

//Language
import { i18nVue } from 'laravel-vue-i18n'

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
