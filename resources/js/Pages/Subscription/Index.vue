<script setup lang="ts">
import { Subscription } from '@/types/subscription.interface';
import CreateSubscriptionModal from "@/Pages/Subscription/CreateSubscriptionModal.vue";
import SubscriptionCard from "@/Pages/Subscription/SubscriptionCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";

interface Props {
    subscriptions: Subscription[];
}

const props = defineProps<Props>();

const handleSubscriptionCreated = (newSubscription: Subscription) => {
    props.subscriptions.unshift(newSubscription);
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Subscriptions" />

        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Subscriptions
            </h2>
        </template>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex items-center justify-end mb-8">
                <CreateSubscriptionModal @created="handleSubscriptionCreated" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <SubscriptionCard v-for="subscription in subscriptions" :subscription="subscription" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
