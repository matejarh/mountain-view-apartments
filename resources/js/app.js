import './bootstrap';
import '../css/app.css';
import 'animate.css';

import { createApp, h } from 'vue';
import { Link, createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { Translator } from './translator';
import { createPinia } from 'pinia';
import VueSocialSharing from 'vue-social-sharing'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const pinia = createPinia()

/* updateGlobalOptions({
    autoClose: 3000,
    style: {
        opacity: '1',
        userSelect: 'initial',
    },
    position: toast.POSITION.TOP_RIGHT,
    theme: window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? "dark" : "light"

}); */

import.meta.glob([
    '../images/errors/**',
]);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        let app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .component('InertiaLink', Link)
            .use(Translator, props.initialPage.props.translations)
            .use(VueSocialSharing)
            //.use(Globals, )
            .mount(el);
        return app
    },
    progress: {
        color: '#0093c4',
    },
});
