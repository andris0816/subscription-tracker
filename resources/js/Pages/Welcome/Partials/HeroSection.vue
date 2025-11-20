<script setup lang="ts">

import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
</script>

<template>
    <div class="bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
            <div class="text-center">
                <h1 class="text-gray-900 mb-6 text-4xl">Track Your Subscriptions</h1>
                <p class="text-gray-600 mb-10 max-w-2xl mx-auto">Keep all your recurring payments organized. Get renewal reminders and never pay for services you don't use.</p>
                <PrimaryButtonLink
                    :href="$page.props.auth.user ? route('subscriptions.index') : route('login')"
                >
                    Get Started
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
                        class="lucide lucide-arrow-right h-4 w-4"
                        aria-hidden="true"
                    >
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </PrimaryButtonLink>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
