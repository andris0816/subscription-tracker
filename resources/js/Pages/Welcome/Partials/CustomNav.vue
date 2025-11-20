<script setup lang="ts">
    import {Link} from "@inertiajs/vue3";

    defineProps<{
        canLogin: boolean;
        canRegister: boolean;
    }>();
</script>

<template>
    <div class="relative w-full px-6 flex justify-end">
        <header class="grid grid-cols-2 items-center gap-2 lg:grid-cols-3">
            <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                <template>
                    <Link
                        :href="route('login')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] "
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
    </div>
</template>

<style scoped>

</style>
