<template>
    <div class="w-full">
        <Nav />
        <main>
            <slot name="content"></slot>
        </main>
    </div>
</template>

<script>
export default {
    name: "BaseLayout"
}
</script>

<style scoped>

</style>
