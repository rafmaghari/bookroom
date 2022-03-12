import Vue from 'vue';
import VueRouter from "vue-router";
import store from '../store'

Vue.use(VueRouter);

const Login = () => import('../pages/Login.vue' /* webpackChunkName: "resource/js/pages/login" */)
const Register = () => import('../pages/Register.vue' /* webpackChunkName: "resource/js/pages/register" */)

const Dashboard = () => import('../pages/Dashboard.vue' /* webpackChunkName: "resource/js/pages/dashboard" */)
const MyBookings = () => import('../pages/MyBooking' /* webpackChunkName: "resource/js/pages/myBooking" */)
const BookRoom = () => import('../pages/BookRoom' /* webpackChunkName: "resource/js/pages/bookRoom" */)

const Routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta:{
            middleware:"guest"
        },
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta:{
            middleware:"guest"
        },
    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: Dashboard,
        meta:{
            middleware:"auth"
        },
    },
    {
        name: "MyBookings",
        path: "/my-bookings",
        component: MyBookings,
        meta:{
            middleware:"auth"
        },
    },
    {
        name: "BookRoom",
        path: "/book-room",
        component: BookRoom,
        meta:{
            middleware:"auth"
        },
    }
]

const router = new VueRouter({
    mode: 'history',
    routes: Routes
})

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} - ${process.env.MIX_APP_NAME}`
    if(to.meta.middleware==="guest"){
        if(store.state.auth.authenticated){
            next({name:"dashboard"})
        }
        next()
    }else{
        if(store.state.auth.authenticated){
            next()
        }else{
            next({name:"login"})
        }
    }
})

export default router
