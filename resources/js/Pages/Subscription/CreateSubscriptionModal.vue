<script setup lang="ts">

import InputLabel from "@/Components/InputLabel.vue";
import TextInput from '@/Components/TextInput.vue';
import {useForm, usePage} from "@inertiajs/vue3";
import {VueDatePicker} from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/dist/main.css';
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import {Subscription} from "@/types/subscription.interface";
import {currencies, type Currency} from "@/types/currency.types";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue'

const form = useForm({
    name: '',
    price: 0,
    renewal_date: null,
    currency: currencies[0],
    billing_cycle: '',
    cancel_url: '',
});
const createSubscriptionModal = ref(false);

const emit = defineEmits<{
    (e: 'created', newSubscription: Subscription): void
}>();



const createSubscription = () => {
    form.post(route('subscription.store'), {
        onSuccess: () => {
            const props = usePage().props as { newSubscription?: Subscription };

            if (props.newSubscription) {
                emit('created', props.newSubscription);
            }

            closeModal();
        },
    });
};


const closeModal = () => {
    createSubscriptionModal.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <PrimaryButton @click="createSubscriptionModal = true">Create Subscription</PrimaryButton>

    <Modal :show="createSubscriptionModal" @close="closeModal">
        <div class="p-6">
            <form @submit.prevent="createSubscription" method="POST">
                <div>
                    <InputLabel for="name" value="Subscription Name" />
                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        class="mt-1 block w-full"
                    />
                </div>
                <div class="mt-4">
                    <InputLabel for="price" value="Price" />
                    <TextInput
                        id="price"
                        type="number"
                        v-model="form.price"
                        class="mt-2 block w-full"
                    />
                </div>
                <div class="mt-4">
                    <InputLabel for="currency" value="Currency" />
                    <div class="relative">
                        <Listbox v-model="form.currency">
                            <ListboxButton class="border rounded px-3 py-2 w-full text-left">
                                {{ form.currency }}
                            </ListboxButton>

                            <ListboxOptions class="absolute z-[9999] mt-1 w-full border rounded shadow bg-white">
                                <ListboxOption
                                    v-for="(currency, index) in currencies"
                                    class="px-3 py-2 cursor-pointer hover:bg-blue-100"
                                    :key="index"
                                    :value="currency as string"
                                >
                                    {{ currency }}
                                </ListboxOption>
                            </ListboxOptions>
                        </Listbox>
                    </div>
                </div>
                <div class="mt-4">
                    <InputLabel for="renewalDate" value="Renewal Date" />
                    <VueDatePicker
                        id="renewalDate"
                        v-model="form.renewal_date"
                        class="mt-2"
                        teleport="body"
                    />
                </div>
                <div class="mt-4">
                    <InputLabel for="billingCycle" value="Billing Cycle" />
                    <TextInput
                        id="billingCycle"
                        type="text"
                        v-model="form.billing_cycle"
                        class="mt-2 block w-full"
                    />
                </div>
                <div class="mt-4">
                    <InputLabel for="cancelUrl" value="Cancel Url" />
                    <TextInput
                        id="cancelUrl"
                        type="text"
                        v-model="form.cancel_url"
                        class="mt-2 block w-full"
                    />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        type="submit"
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="createSubscription"
                    >
                        Add Subscription
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>

<style scoped>

</style>
