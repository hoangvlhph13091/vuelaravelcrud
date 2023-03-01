import {createWebHistory, createRouter} from "vue-router";

const routers =  [
    {
        path: '/',
        name: 'home',
        component: () => import('./components/Posts/indexComponent.vue')
    },
    {
        path: '/create',
        name: 'add',
        component: () => import('./components/Posts/createComponent.vue')
    },
    {
        path: '/edit/:id',
        name: 'edit',
        component: () => import('./components/Posts/editComponent.vue')
    },
    {
        path: '/prod/',
        name: 'prodIndex',
        component: () => import('./components/Products/productIndex.vue')
    },
    {
        path: '/prod/create',
        name: 'prodCreate',
        component: () => import('./components/Products/createProductComponent.vue')
    },
    {
        path: '/prod/import',
        name: 'prodImport',
        component: () => import('./components/Products/importExcel.vue')
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routers,
});

export default router;