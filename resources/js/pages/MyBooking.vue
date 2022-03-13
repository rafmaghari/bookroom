<template>
    <BaseLayout>
        <section slot="content">
            <div class="mx-32">
                <p class="text-left my-2 text-lg uppercase font-bold">My Bookings</p>
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-center">
                                    <thead class="border-b bg-gray-50">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">#</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">ROOM</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">START</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">END</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">REASON</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">OPTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-if="bookings.length > 0">
                                        <tr class="bg-white border-b" v-for="(booking, index) in bookings" :key="index">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{index + 1}}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{booking.room.name}}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{booking.start}}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{booking.end}}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{booking.reason}}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <router-link :to="`/book-room/${booking.id}`" class="py-2 rounded px-4 bg-gray-500 text-gray-100">Edit</router-link>
                                                <button @click="deleteBooking(booking.id)" class="py-2 rounded px-4 bg-red-500 text-red-100">Delete</button>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="6" class="text-3xl text-center p-3">NO BOOKING YET</td>
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
    name: "MyBooking",
    components: {BaseLayout},
    data() {
        return {
            bookings: []
        }
    },
    mounted() {
        this.fetchMyBookings();
    },
    methods: {
        fetchMyBookings () {
           axios.get('/api/my-bookings')
            .then(response => {
                this.bookings = response.data.data
            })
            .catch(e => e.response.data)
        },
        deleteBooking(id) {
            if (window.confirm("Are you sure, you want to delete to record?")) {
                axios.delete(`/api/room-bookings/${id}`)
                .then(_ => this.fetchMyBookings())
                .catch(error => console.log(error))
            }
        }
    }
}
</script>

<style scoped>

</style>
