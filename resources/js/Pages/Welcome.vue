<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import WelcomePageContent from "@/Pages/Welcome/Partials/WelcomePageContent.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black h-full">
        <AuthenticatedLayout v-if="$page.props.auth.user">
            <WelcomePageContent />
        </AuthenticatedLayout>
        <GuestLayout v-else>
            <WelcomePageContent />
        </GuestLayout>
    </div>
</template>
