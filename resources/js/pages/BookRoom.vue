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
                                    <div class="flex space-x-2">
                                        <div class="flex space-x-2 w-full">
                                            <input type="date" class="w-1/2 border-gray-200 border p-2 rounded" name="start_start" required v-model="form.start_date"/>
                                            <div class="py-1 px-3 flex space-x-2 w-1/2 border border-gray-200 rounded">
                                                <select name="hours" id="start_hours" class="py-2 px-3 w-1/2" v-model="form.start_hour" required>
                                                    <option :value="hour" v-for="(hour,index) in hoursInDay" :key="index">{{hour}}</option>
                                                </select>
                                                <select name="minute" id="start_minute" class="py-2 px-3 w-1/2" v-model="form.start_minute" required>
                                                    <option :value="minute" v-for="(minute,index) in minuteByThirty" :key="index">{{minute}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 mb-2">End</label>
                                    <div class="flex space-x-2">
                                        <div class="flex space-x-2 w-full">
                                            <input type="date" class="w-1/2 border-gray-200 border p-2 rounded" name="start_start" required v-model="form.end_date"/>
                                            <div class="py-1 px-3 flex space-x-2 w-1/2 border border-gray-200 rounded">
                                                <select name="hours" id="hours" class="py-2 px-3 w-1/2" v-model="form.end_hour" required>
                                                    <option :value="hour" v-for="(hour,index) in hoursInDay" :key="index">{{hour}}</option>
                                                </select>
                                                <select name="minute" id="minutes" class="py-2 px-3 w-1/2" v-model="form.end_minute" required>
                                                    <option :value="minute" v-for="(minute,index) in minuteByThirty" :key="index">{{minute}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
            roomBooking: [],
            form: {
                room_id: null,
                start: null,
                start_date: null,
                start_hour: null,
                start_minute: null,
                end: null,
                end_date: null,
                end_hour: null,
                end_minute: null,
                reason: null
            },
            isEditing: false,
            hoursInDay: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
            minuteByThirty: ["00", "30"]
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
            this.form.start = `${this.form.start_date} ${this.form.start_hour}:${this.form.start_minute}`
            this.form.end =  `${this.form.end_date} ${this.form.end_hour}:${this.form.end_minute}`
            axios.post('/api/room-bookings', this.form)
                .then(response => {
                    this.rooms = response.data.data
                    router.push({name:'MyBookings'})
                })
                .catch(e => {
                    alert(e.response.data.message.message)
                })
        },
        updateBooking() {
            this.form.start = `${this.form.start_date} ${this.form.start_hour}:${this.form.start_minute}`
            this.form.end =  `${this.form.end_date} ${this.form.end_hour}:${this.form.end_minute}`
            axios.put(`/api/room-bookings/${this.$route.params.id}`, this.form)
                .then(response => {
                    router.push({name:'MyBookings'})
                })
                .catch(e => {
                    alert(e.response.data.message.message)
                })
        },
        checkRoomBooking() {
            axios.post(`/api/room-booking-by-date/`, this.form)
                .then(response => {
                    this.roomBooking = response.data.data
                })
                .catch(e => {
                    alert(e.response.data.message.message)
                })
        },
        getBooking() {
            axios.get( `/api/room-bookings/${this.$route.params.id}`, this.form)
                .then(response => {
                    const data = response.data.data
                    this.form.room_id = data.room_id
                    this.form.start = data.start
                    this.form.end = data.end
                    this.form.reason = data.reason
                    const start = this.splitDateTime(data.start)
                    this.form.start_date = start['date']
                    this.form.start_hour = start['hour']
                    this.form.start_minute = start['minute']

                    const end = this.splitDateTime(data.end)
                    this.form.end_date = end['date']
                    this.form.end_hour = end['hour']
                    this.form.end_minute = end['minute']
                })
                .catch(e => e.response.data)
        },
        splitDateTime(dateTime) {
            const splitDateTime = dateTime.split(" ");
            const time = splitDateTime[1].split(":");
            return  {
                'date': splitDateTime[0],
                'hour': time[0],
                'minute': time[1]
            }

        }
    }
}
</script>

<style scoped>

</style>
