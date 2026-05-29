import { createRouter, createWebHistory } from 'vue-router';
import EnterpriseList from './views/EnterpriseList.vue';
import EnterpriseDetail from './views/EnterpriseDetail.vue';
import EnterpriseForm from './views/EnterpriseForm.vue';

const routes = [
    {
        path: '/',
        redirect: '/enterprise',
    },
    {
        path: '/enterprise',
        name: 'EnterpriseList',
        component: EnterpriseList,
    },
    {
        path: '/enterprise/create',
        name: 'EnterpriseCreate',
        component: EnterpriseForm,
    },
    {
        path: '/enterprise/:id',
        name: 'EnterpriseDetail',
        component: EnterpriseDetail,
    },
    {
        path: '/enterprise/:id/edit',
        name: 'EnterpriseEdit',
        component: EnterpriseForm,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;