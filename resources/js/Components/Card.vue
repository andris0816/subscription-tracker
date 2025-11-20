<script setup lang="ts">

</script>

<template>
    <div
        class="flex flex-col gap-6 rounded-xl bg-white shadow-md border border-gray-200"
        :class="$attrs.class"
        data-slot="card"
    >
        <slot />
    </div>
</template>

<style scoped>

</style>
