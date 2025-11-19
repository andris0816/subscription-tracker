<script setup lang="ts">
import { Subscription } from '@/types/subscription.interface';
import CreateSubscriptionModal from "@/Pages/Subscription/Modals/CreateSubscriptionModal.vue";
import SubscriptionCard from "@/Pages/Subscription/Partials/SubscriptionCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DeleteSubscriptionModal from "@/Pages/Subscription/Modals/DeleteSubscriptionModal.vue";
import {toast} from "@/utils/toast";

interface Props {
    subscriptions: Subscription[];
}

const props = defineProps<Props>();
const subscriptionsRef = ref<Subscription[]>(props.subscriptions);
const showCreateEditModal = ref(false);
const showDeleteModal = ref(false);
const selectedSubscription = ref<Subscription | null>(null);

const handleCreated = (subscription: Subscription) => {
    subscriptionsRef.value.unshift(subscription);
    showCreateEditModal.value = false;
    toast.success("Subscription Created Successfully!")
}

const handleUpdated = (subscription: Subscription) => {
    subscriptionsRef.value = subscriptionsRef.value.map(s =>
        s.id === subscription.id ? subscription : s
    );
    showCreateEditModal.value = false;
    toast.success("Subscription Updated Successfully!")
}

const handleDeleted = (id: number) => {
    subscriptionsRef.value = subscriptionsRef.value.filter(s => s.id !== id);
    selectedSubscription.value = null;
    toast.success("Subscription Deleted Successfully!")
}

const openCreateModal = () => {
    selectedSubscription.value = null;
    showCreateEditModal.value = true;
}

const openEditModal = (subscription: Subscription) => {
    selectedSubscription.value = subscription;
    showCreateEditModal.value = true;
}

const openDeleteModal = (subscription: Subscription) => {
    selectedSubscription.value = subscription;
    showDeleteModal.value = true;
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
                <PrimaryButton @click="openCreateModal">Create Subscription</PrimaryButton>

                <CreateSubscriptionModal
                    :show="showCreateEditModal"
                    :subscription="selectedSubscription"
                    @created="handleCreated"
                    @updated="handleUpdated"
                    @close="showCreateEditModal = false"
                />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <SubscriptionCard
                    v-for="subscription in subscriptionsRef"
                    :key="subscription.id"
                    :subscription="subscription"
                    @edit="openEditModal"
                    @delete="openDeleteModal"
                />

                <DeleteSubscriptionModal
                    :show="showDeleteModal"
                    :subscription="selectedSubscription"
                    @deleted="handleDeleted"
                    @close="showDeleteModal = false"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
