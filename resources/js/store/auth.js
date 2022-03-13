import axios from 'axios'
import router from '../router'

export default {
    namespaced: true,
    state:{
        authenticated:false,
        user:{},
        is_admin: false
    },
    getters:{
        authenticated(state){
            return state.authenticated
        },
        user(state){
            return state.user
        },
        is_admin(state){
            return state.is_admin
        }
    },
    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },
        SET_USER (state, value) {
            state.user = value
        },
        SET_IS_ADMIN (state, value) {
            state.is_admin = value
        }
    },
    actions:{
        login({commit}){
            axios.defaults.withCredentials =true
            return axios.get('/api/user').then(({data})=>{
                const isAdmin = data.is_admin === 1;
                const routeToPush = isAdmin ? 'Rooms' : 'MyBookings';
                commit('SET_USER',data)
                commit('SET_IS_ADMIN',isAdmin)
                commit('SET_AUTHENTICATED',true)
                router.push({name: routeToPush})
            }).catch(({response:{data}})=>{
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
            })
        },
        logout({commit}){
            commit('SET_USER',{})
            commit('SET_AUTHENTICATED',false)
        }
    }
}
