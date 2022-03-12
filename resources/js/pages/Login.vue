<template>
    <BaseLayout>
       <template v-slot:content>
           <section class="px-10">
               <div class="flex items-center justify-center">
                   <div class="w-full max-w-md">
                       <form class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4">
                           <div class="text-gray-800 text-2xl flex justify-center py-2 mb-4">Login</div>
                           <div class="mb-4">
                               <label class="block text-gray-700 text-sm font-normal mb-2"
                                      for="username">
                                   Email
                               </label>
                               <input
                                   class="text-sm shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   name="email"
                                   v-model="form.email"
                                   type="email"
                                   required
                                   autofocus
                                   placeholder="Enter you email..."
                               />
                           </div>
                           <div class="mb-6">
                               <label
                                   class="block text-gray-700 text-sm font-normal mb-2"
                                   for="password"
                               >
                                   Password
                               </label>
                               <input
                                   class="text-sm shadow appearance-none border rounded w-full p-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                   v-model="form.password"
                                   type="password"
                                   placeholder="Password"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                               />
                           </div>
                           <div class="flex items-center justify-between">
                               <button class="px-4 py-2 rounded text-white inline-block shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700" type="submit">Sign In</button>
                               <div class="flex space-x-2">
                                   <p class="text-sm">Don't have an account?</p>
                                   <router-link
                                       :to="'/register'"
                                       class="inline-block align-baseline font-normal text-sm text-blue-500 hover:text-blue-800"
                                   >
                                       Register
                                   </router-link>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
           </section>
       </template>
    </BaseLayout>
</template>
<script>
import BaseLayout from "../layout/BaseLayout";
export default {
    name: "Login",
    components: {BaseLayout},
    data() {
        return {
            form: {
                email: null,
                password: null
            }
        }
    }
}
</script>

<style scoped>

</style>
