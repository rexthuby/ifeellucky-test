import {createApp} from 'vue'
import App from '../ui/App.vue'
import {router} from "./router.ts";
import Vue3Toastify, { type ToastContainerOptions } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const app = createApp(App)
app.use(router)
app.use(
    Vue3Toastify,
    {
        autoClose: 8000,
        style: {
            opacity: '1',
            userSelect: 'initial',
        },
    } as ToastContainerOptions,
)
app.mount("#app")
