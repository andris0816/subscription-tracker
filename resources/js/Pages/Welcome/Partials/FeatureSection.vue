<script setup lang="ts">

import Card from "@/Components/Card.vue";
</script>

<template>
    <div class="max-w-5xl mx-auto py-20 px-4 sm:px-6 md:px-8">
        <div class="grid grid-cols-3 sm:grid-cols-1 md:grid-cols-2 gap-8 py-8">
            <Card>
                <div
                    class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6"
                    data-slot="card-header"
                >
                    <div class="w-10 h-10 bg-gray-200 rounded-lg flex justify-center items-center">
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
                            class="lucide lucide-bell h-5 w-5 text-gray-900"
                            aria-hidden="true">
                            <path d="M10.268 21a2 2 0 0 0 3.464 0"></path>
                            <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"></path>
                        </svg>
                    </div>
                    <h3 class="text-gray-900">Never Miss a Renewal</h3>
                </div>
                <div class="px-6 [&:last-child]:pb-6 font-medium" data-slot="card-content">
                    <p class="text-gray-600">Get reminders before your subscriptions renew.</p>
                </div>
            </Card>
            <Card>
                <div
                    class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6"
                    data-slot="card-header"
                >
                    <div class="w-10 h-10 bg-gray-200 rounded-lg flex justify-center items-center">
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
                            class="lucide lucide-credit-card h-5 w-5 text-gray-900"
                            aria-hidden="true"
                        >
                            <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                            <line x1="2" x2="22" y1="10" y2="10"></line>
                        </svg>
                    </div>
                    <h3 class="text-gray-900 font-medium">Track All Costs</h3>
                </div>
                <div class="px-6 [&:last-child]:pb-6" data-slot="card-content">
                    <p class="text-gray-600">See all your subscription costs in one place.</p>
                </div>
            </Card>
            <Card>
                <div
                    class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6"
                    data-slot="card-header"
                >
                    <div class="w-10 h-10 bg-gray-200 rounded-lg flex justify-center items-center">
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
                            class="lucide lucide-calendar h-5 w-5 text-gray-900"
                            aria-hidden="true"
                        >
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                    </div>
                    <h3 class="text-gray-900 font-medium">Reduce Spending</h3>
                </div>
                <div class="px-6 [&:last-child]:pb-6" data-slot="card-content">
                    <p class="text-gray-600">Easily cancel subscriptions you no longer need.</p>
                </div>
            </Card>
            <Card>
                <div
                    class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6"
                    data-slot="card-header"
                >
                    <div class="w-10 h-10 bg-gray-200 rounded-lg flex justify-center items-center">
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
                            class="lucide lucide-bell h-5 w-5 text-gray-900"
                            aria-hidden="true">
                            <path d="M10.268 21a2 2 0 0 0 3.464 0"></path>
                            <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"></path>
                        </svg>
                    </div>
                    <h3 class="text-gray-900 font-medium">Manage Billing Cycles</h3>
                </div>
                <div class="px-6 [&:last-child]:pb-6" data-slot="card-content">
                    <p class="text-gray-600">Track weekly, monthly, quarterly, and yearly billing.</p>
                </div>
            </Card>
        </div>
    </div>
</template>

<style scoped>

</style>
