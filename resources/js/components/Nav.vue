<template>
    <nav class="font-sans flex flex-col text-center text-blue-100 content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full bg-gray-900 mb-10">
        <div class="mb-2 sm:mb-0 flex flex-row">
            <div>
                <a href="/home" class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">BooKRoom</a><br>
                <span class="text-xs text-grey-dark">Book a room for your important meetings.</span>
            </div>
        </div>

        <div class="sm:mb-0 self-center text-sm">
            <a href="#" class="text-md no-underline text-gray-100 hover:text-gray-300 ml-2 px-1">My Bookings</a>
            <a href="#" class="text-md no-underline text-gray-100 hover:text-gray-300 ml-2 px-1">Book A Room</a>
        </div>
    </nav>
</template>

<script>
export default {
    name: "NavBar"
}
</script>

<style scoped>

</style>
