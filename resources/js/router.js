import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        redirect: '/enterprise',
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('./views/Login.vue'),
    },
    {
        path: '/register',
        name: 'Register',
        component: () => import('./views/Register.vue'),
    },
    {
        path: '/enterprise',
        name: 'EnterpriseList',
        component: () => import('./views/EnterpriseList.vue'),
    },
    {
        path: '/enterprise/create',
        name: 'EnterpriseCreate',
        component: () => import('./views/EnterpriseForm.vue'),
    },
    {
        path: '/enterprise/:id',
        name: 'EnterpriseDetail',
        component: () => import('./views/EnterpriseDetail.vue'),
    },
    {
        path: '/enterprise/:id/edit',
        name: 'EnterpriseEdit',
        component: () => import('./views/EnterpriseForm.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;