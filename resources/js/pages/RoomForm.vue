<template>
    <BaseLayout>
        <section slot="content">
            <div class="mx-32">
                <p class="text-left my-2 text-lg uppercase font-bold">{{ isEditing ? "EDIT ROOM": "ADD ROOM"}}</p>
                <div class="flex flex-col items-center">
                    <div class="shadow-lg w-1/2 p-3">
                        <form @submit.prevent="handleSubmit">
                            <div class="flex flex-col p-3">
                                <label class="text-sm text-gray-400 mb-2">Name</label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    class="w-full border-gray-200 border p-2 rounded"
                                    name="name"
                                    placeholder="Enter room name..."
                                    required
                                >
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
    name: "RoomForm",
    components: {BaseLayout},
    data() {
        return {
            form: {
                name: null
            },
            isEditing: false,
            roomId: null
        }
    },
    mounted() {
        this.roomId = this.$route.params.id;
        if (this.roomId) {
            this.isEditing = true
            this.getRoom()
        }
    },
    methods: {
        handleSubmit() {
            if (this.isEditing) {
                this.update()
            } else {
                this.add()
            }
        },
        add() {
            axios.post('/api/rooms', this.form)
                .then(response => {
                   router.push({name: "Rooms"})
                })
                .catch(err => console.log(err))
        },
        update() {
            axios.put(`/api/rooms/${this.roomId}`, this.form)
                .then(response => {
                    router.push({name: "Rooms"})
                })
                .catch(err => console.log(err))
        },
        getRoom() {
            axios.get(`/api/rooms/${this.roomId}`)
                 .then(response => {
                     this.form = response.data.data
                 })
                 .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>

</style>
