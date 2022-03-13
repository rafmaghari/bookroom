<template>
    <BaseLayout>
        <section slot="content">
            <div class="mx-32">
                <p class="text-left my-2 text-lg uppercase font-bold">{{ isEditing ? "EDIT BOOKING": "BOOK A ROOM"}}</p>
                <div class="flex flex-col items-center">
                        <div class="shadow-lg w-1/2 p-3">
                            <form @submit.prevent="handleSubmit">
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 my-2">Room</label>
                                    <select name="room_id" id="room_id" class="border border-gray-200 w-full p-2 rounded" v-model="form.room_id" required>
                                        <option value="" disabled selected>Select a room...</option>
                                        <option :value="room.id" v-for="(room, index) in rooms" :key="index">{{room.name}}</option>
                                    </select>
                                </div>
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 mb-2">Start</label>
                                    <input step="1" v-model="form.start" type="datetime-local" class="w-full border-gray-200 border p-2 rounded" name="start" required>
                                </div>
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 mb-2">End</label>
                                    <input v-model="form.end" type="datetime-local" class="w-full border-gray-200 border p-2 rounded" name="end" required>
                                </div>
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 mb-2">Reason</label>
                                    <input v-model="form.reason" type="text" class="w-full border-gray-200 border p-2 rounded" name="reason" required>
                                </div>
                                <div class="flex justify-end mx-3">
                                    <button type="submit" class="p-2 bg-blue-500 text-blue-100 rounded px-5">{{isEditing ? "UPDATE" : "ADD"}}</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </section>
    </BaseLayout>
</template>

<script>
import BaseLayout from "../layout/BaseLayout";
import router from "../router";
export default {
name: "BookRoom",
    components: {BaseLayout},
    data() {
        return {
            rooms: null,
            form: {
                room_id: null,
                start: null,
                end: null,
                reason: null
            },
            isEditing: false
        }
    },
    mounted() {
        const id = this.$route.params.id;
        if (id) {
            this.isEditing = true
            this.getBooking()
        }
        this.fetchRooms()
    },
    methods: {
        handleSubmit() {
            if (this.isEditing) {
                this.updateBooking()
            } else {
                this.book()
            }
        },
        fetchRooms() {
            axios.get('/api/rooms')
                .then(response => {
                    this.rooms = response.data.data
                })
                .catch(e => e.response.data)
        },
        book() {
            axios.post('/api/room-bookings', this.form)
                .then(response => {
                    this.rooms = response.data.data
                    router.push({name:'MyBookings'})
                })
                .catch(e => e.response.data)
        },
        updateBooking() {
            axios.put(`/api/room-bookings/${this.$route.params.id}`, this.form)
                .then(response => {
                    router.push({name:'MyBookings'})
                })
                .catch(e => e.response.data)
        },
        getBooking() {
            axios.get( `/api/room-bookings/${this.$route.params.id}`, this.form)
                .then(response => {
                    const data = response.data.data
                    this.form.room_id = data.room_id
                    this.form.start = data.start
                    this.form.end = data.end
                    this.form.reason = data.reason
                })
                .catch(e => e.response.data)
        }
    }
}
</script>

<style scoped>

</style>
