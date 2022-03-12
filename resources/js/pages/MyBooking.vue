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
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">OPTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Mark
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Otto
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @mdo
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <button class="py-2 rounded px-4 bg-gray-500 text-gray-100">Edit</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Jacob
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Thornton
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @fat
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <button class="py-2 rounded px-4 bg-gray-500 text-gray-100">Edit</button>
                                        </td>
                                    </tr>
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
    components: {BaseLayout}
}
</script>

<style scoped>

</style>
