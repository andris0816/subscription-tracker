<script setup lang="ts">

defineProps<{
    href: string;
}>();
</script>

<template>
    <a
        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 "
        :href="href"
    >
        <slot />
    </a>
</template>
