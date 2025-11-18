<script setup lang="ts">
import {computed} from "vue";

const props = defineProps<{
    variant: string;
}>();

const styles: Record<string, string> = {
    yearly: "bg-purple-100 text-purple-800",
    monthly: "bg-blue-100 text-blue-800",
    weekly: "bg-green-100 text-green-800",
    daily: "bg-orange-100 text-orange-800",

    "renewing soon": "bg-yellow-100 text-yellow-800",
    expired: "bg-red-100 text-red-800",

    default: "bg-gray-100 text-gray-800",
};

const colorClasses = computed(() => {
    const key = props.variant.toLowerCase().trim();
    return styles[key] ?? styles.default;
});
</script>

<template>
    <span data-slot="badge"
          class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-sm font-black w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden border-transparent [a&amp;]:hover:bg-secondary/90"
          :class="colorClasses"
    >
        <slot />
    </span>
</template>

<style scoped>

</style>
