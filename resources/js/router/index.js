import Vue from 'vue';
import VueRouter from "vue-router";

Vue.use(VueRouter);

const Login = () => import('../pages/Login.vue' /* webpackChunkName: "resource/js/pages/login" */)
const Register = () => import('../pages/Register.vue' /* webpackChunkName: "resource/js/pages/register" */)

const Routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
    },
    {
        name: "register",
        path: "/register",
        component: Register,
    }
]

const router = new VueRouter({
    mode: 'history',
    routes: Routes
})

export default router
