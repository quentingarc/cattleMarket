// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../components/HomePage.vue';
import AdminPage from '../components/AdminPage.vue';
import ClientPage from '../components/ClientPage.vue';

const routes = [
  { path: '/', component: HomePage },
  { path: '/admin', component: AdminPage },
  { path: '/client', component: ClientPage },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
