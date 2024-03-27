/*
importing these file from admin-lte package as we have installed them through npm and they are all imported here just because of @vite to bundle them in a single file for fast loading
*/

import './bootstrap';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './routes';

const app = createApp({})
const router = createRouter({
    routes: Routes,
    history: createWebHistory()
});

app.use(router);
app.mount("#app");
