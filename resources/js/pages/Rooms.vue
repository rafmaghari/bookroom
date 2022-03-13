<template>
    <BaseLayout>
        <section slot="content">
            <div class="mx-32">
                <div class="flex justify-between">
                    <p class="text-left my-2 text-lg uppercase font-bold">ROOMS</p>
                    <router-link to="/room-form" class="px-4 py-1 bg-blue-500 text-blue-100 text-sm rounded flex items-center">ADD ROOM</router-link>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-center">
                                    <thead class="border-b bg-gray-50">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">#</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">NAME</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">OPTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-if="rooms.length > 0">
                                        <tr class="bg-white border-b" v-for="(room, index) in rooms" :key="index">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{index + 1}}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{room.name}}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <router-link :to="`/room-form/${room.id}`" class="py-2 rounded px-4 bg-gray-500 text-gray-100">Edit</router-link>
                                                    <button @click="deleteRoom(room.id)" class="py-2 rounded px-4 bg-red-500 text-red-100">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="6" class="text-3xl text-center p-3">NO ROOMS</td>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </BaseLayout>
</template>

<script>
import BaseLayout from "../layout/BaseLayout";
export default {
name: "Rooms",
    components: {BaseLayout},
    data() {
        return {
            rooms: []
        }
    },
    mounted() {
        this.fetchRooms()
    },
    methods: {
        fetchRooms() {
            axios.get('/api/rooms')
                .then(response => {
                    this.rooms = response.data.data
                })
                .catch(e => e.response.data)
        },
        deleteRoom(id) {
           if(window.confirm("Are you sure, you want to delete this record?")) {
               axios.delete(`/api/rooms/${id}`)
               .then(response => this.fetchRooms())
               .catch(error => console.log(error))
           }
        }
    }
}
</script>

<style scoped>

</style>
