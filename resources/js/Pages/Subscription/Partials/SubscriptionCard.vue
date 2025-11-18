<script setup lang="ts">
import {Subscription} from "@/types/subscription.interface";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {useRenewalCountdown, useRenewalStatus} from "@/composables/useRenewalCountdown";
import Badge from "@/Components/Badge.vue";

const props = defineProps<{ subscription: Subscription }>();
const emit = defineEmits<{
    edit: [Subscription];
    delete: [Subscription];
}>();

const {daysLeft, renewingSoon, expired} = useRenewalStatus(props.subscription.renewal_date);

const { timeUntil } = useRenewalCountdown(props.subscription.renewal_date);
</script>

<template>
    <div class="text-card-foreground flex flex-col gap-6 rounded-xl border bg-white shadow-sm hover:shadow-md transition-shadow" data-slot="card">
        <div
            class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 pb-3"
            data-slot="card-header"
        >
            <div class="flex items-start justify-between pb-3">
                <div class="flex-1">
                    <h2>{{ subscription.name }}</h2>
                    <div class="flex items-center gap-2 mt-3">
                        <Badge v-if="renewingSoon" variant="renewing soon">
                            Renewing Soon ({{ daysLeft }} days)
                        </Badge>
                        <Badge :variant="subscription.billing_cycle">
                            {{ subscription.billing_cycle }}
                        </Badge>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 [&:last-child]:pb-6 pb-4 space-y-3" data-slot="card-content">
            <div class="flex items-center text-gray-700">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-dollar-sign h-4 w-4 mr-2 text-gray-400"
                    aria-hidden="true"
                >
                    <line x1="12" x2="12" y1="2" y2="22"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
                <span>{{ subscription.price }}</span>
                <span>/ {{ subscription.billing_cycle }}</span>
            </div>
            <div class="flex items-center text-gray-700">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-calendar h-4 w-4 mr-2 text-gray-400"
                    aria-hidden="true"
                >
                    <path d="M8 2v4"></path>
                    <path d="M16 2v4"></path>
                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                    <path d="M3 10h18"></path>
                </svg>
                <span>Renews: {{ subscription.renewal_date }}</span>
            </div>
            <div class="flex items-center text-gray-700">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-refresh-cw h-4 w-4 mr-2 text-gray-400"
                    aria-hidden="true"
                >
                    <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                    <path d="M21 3v5h-5"></path>
                    <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                    <path d="M8 16H3v5"></path>
                </svg>
                <span>{{ timeUntil }}</span>
            </div>
            <a
                class="flex items-center text-gray-600 hover:text-gray-900 transition-colors text-sm"
                :href="subscription.cancel_url"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-external-link h-3 w-3 mr-1"
                    aria-hidden="true"
                >
                    <path d="M15 3h6v6"></path>
                    <path d="M10 14 21 3"></path>
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                </svg>
                Cancel subscription
            </a>
        </div>
        <div
            class="items-center px-6 pb-6 [.border-t]:pt-6 pt-4 border-t border-gray-100 flex gap-2 mb-4 justify-between"
            data-slot="card-footer"
        >
            <SecondaryButton @click="$emit('edit', subscription)">Edit</SecondaryButton>

            <DangerButton @click="$emit('delete', subscription)">Delete</DangerButton>
        </div>
    </div>

</template>

<style scoped>

</style>
