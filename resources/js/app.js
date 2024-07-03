/*
importing these file from admin-lte package as we have installed them through npm and they are all imported here just because of @vite to bundle them in a single file for fast loading
*/

import './bootstrap';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

// Importing the Login component
import Login from './pages/auth/login.vue';

// Importing Vue and Vue Router
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createRouter, createWebHistory } from 'vue-router';

// Importing application routes
import Routes from './routes';

// Creating the Vue application instance
const app = createApp({});

// Setting up the router with routes and history mode
const router = createRouter({
    history: createWebHistory(),
    routes: Routes
});

// Using the router in the Vue application
app.use(router);

// Registering the Login component globally
app.component('Login', Login);

// Mounting the application to the DOM element with id "app"
app.mount("#app");
