<template>
    <BaseLayout>
        <section slot="content">
            <div class="mx-32">
                <p class="text-left my-2 text-lg uppercase font-bold">Book Room</p>
                <div class="flex flex-col items-center">
                        <div class="shadow-lg w-1/2 p-3">
                            <form @submit.prevent="handleSubmit">
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 my-2">Room</label>
                                    <select name="room_id" id="room_id" class="border border-gray-200 w-full p-2 rounded" required>
                                        <option value="1">ONE</option>
                                        <option value="1">TWO</option>
                                        <option value="1">THREE</option>
                                    </select>
                                </div>
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 mb-2">Start</label>
                                    <input type="datetime-local" class="w-full border-gray-200 border p-2 rounded" name="start" required>
                                </div>
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 mb-2">End</label>
                                    <input type="datetime-local" class="w-full border-gray-200 border p-2 rounded" name="end" required>
                                </div>
                                <div class="flex flex-col p-3">
                                    <label class="text-sm text-gray-400 mb-2">Reason</label>
                                    <input type="text" class="w-full border-gray-200 border p-2 rounded" name="reason" required>
                                </div>
                                <div class="flex justify-end mx-3">
                                    <button type="submit" class="p-2 bg-blue-500 text-blue-100 rounded px-5">BOOK</button>
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
export default {
name: "BookRoom",
    components: {BaseLayout},
    methods: {
        handleSubmit(e) {
            console.log("here")
        }
    }
}
</script>

<style scoped>

</style>
