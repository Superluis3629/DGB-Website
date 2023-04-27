
import { createWebHistory, createRouter } from "vue-router";

import { useStorage  } from "vue3-storage";
const storage = useStorage()

import Pos from "../pages/Pos.vue";
import Report from "../pages/Report.vue";
import Store from "../pages/Store.vue";
import Transection from "../pages/Transection.vue";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import Compliance from "../pages/Compliance.vue"

export const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
    },
    {
        name: "register",
        path: "/register",
        component: Register,
    },
    {
        name: "store",
        path: "/store",
        component: Store,
    },
    {
        name: "pos",
        path: "/pos",
        component: Pos,
    },
    {
        name: "transection",
        path: "/transection",
        component: Transection,
    },
    {
        name: "report",
        path: "/report",
        component: Report,
    },
    {
        name: "compliance",
        path: "/compliance",
        component: Compliance,
    },
]

const router = createRouter ({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior() {
        window.scrollTo(0,0)
    }
});

router.beforeEach((to, from, next)=>{

    // console.log('Vue isLoggin: '+storage.getStorageSync("vue-isLoggin"))
    // console.log('Laravel isLoggin: '+window.Laravel.isLoggin)

    if(to.path=="/register"){
        next()
    }else{
        if(to.path=="/" && storage.getStorageSync("vue-isLoggin") && !window.Laravel.isLoggin){
            next({
                path:'/login',
                replace: true
            })
        } else if(to.path!="/login" && !storage.getStorageSync("vue-isLoggin") && !window.Laravel.isLoggin){
            next({
                path:'/login',
                replace: true
            })
        } else {
          
            if(to.path=="/login" && storage.getStorageSync("vue-isLoggin") && window.Laravel.isLoggin){
                next({
                    path:'/store',
                    replace: true
                })
            } else {
                next()
            }
        }
    }

    // next()
})  

export default router;
