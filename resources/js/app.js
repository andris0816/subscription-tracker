import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { VueDatePicker } from '@vuepic/vue-datepicker';
import Vue3Toastify, { type ToastContainerOptions } from 'vue3-toastify';
import '@vuepic/vue-datepicker/dist/main.css';
import 'vue3-toastify/dist/index.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(
                Vue3Toastify,
                {
                    autoClose: 3000,
                    position: "top-right",
                } as ToastContainerOptions,
            )
            .use(ZiggyVue)
            .component('VueDatePicker', VueDatePicker)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
