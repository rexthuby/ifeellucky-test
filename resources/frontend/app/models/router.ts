import {createRouter, createWebHistory, Router} from "vue-router";
import {HomePage} from "@/pages/HomePage/";
import {Page404} from "@/pages/Page404/";
import {type RouteRecordRaw} from 'vue-router'
import {RegisterPage} from "@/pages/RegisterPage/";

const allRoutes: Array<RouteRecordRaw> = [
    {path: '/register', component: RegisterPage, name: 'Register'},
    {path: '/', redirect: {name:'Register'} },
    {path: '/:key', component: HomePage, name: 'Home'},
    {path: '/:pathMatch(.*)*', component: Page404, name: 'NotFound',},
]

const router:Router = createRouter({
    history: createWebHistory(),
    routes: allRoutes,
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || {top: 0};
    },
})

export {router}
