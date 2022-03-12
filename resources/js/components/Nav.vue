<template>
    <nav class="font-sans flex flex-col text-center text-blue-100 content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full bg-gray-900 mb-10">
        <div class="mb-2 sm:mb-0 flex flex-row">
            <div>
                <a href="/home" class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">BooKRoom</a><br>
                <span class="text-xs text-grey-dark">Book a room for your important meetings.</span>
            </div>
        </div>

        <div class="sm:mb-0 self-center text-sm" v-if="authenticated">
            <router-link :to="'my-bookings'" class="text-md no-underline text-gray-100 hover:text-gray-300 ml-2 px-1">My Bookings</router-link>
            <router-link :to="'/book-room'" class="text-md no-underline text-gray-100 hover:text-gray-300 ml-2 px-1">Book A Room</router-link>
            <button @click="logout" class="text-md underline text-gray-100 hover:text-gray-300 ml-2 px-1">Logout</button>
        </div>
    </nav>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name: "NavBar",
    data() {
       return {
           user: this.$store.getters["auth/user"],
           authenticated: this.$store.getters["auth/authenticated"]
       }
    },
    methods: {
        ...mapActions({
            signOut:"auth/logout"
        }),
        async logout(){
            await axios.post('/logout').then(({data})=>{
                this.signOut()
                this.$router.push({name:"login"})
            })
        },
    }
}
</script>

<style scoped>

</style>
