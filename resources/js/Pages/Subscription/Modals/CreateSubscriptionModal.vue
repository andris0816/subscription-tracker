<script setup lang="ts">

import InputLabel from "@/Components/InputLabel.vue";
import TextInput from '@/Components/TextInput.vue';
import {useForm} from "@inertiajs/vue3";
import {VueDatePicker} from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/dist/main.css';
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {watch} from "vue";
import {Subscription} from "@/types/subscription.interface";
import {currencies} from "@/types/currency.types";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue'
import InputError from "@/Components/InputError.vue";
import axios from "axios";

const props = defineProps<{
    show: boolean,
    subscription: Subscription | null;
}>();

const form = useForm({
    name: '',
    price: '',
    renewal_date: null as Date | null,
    currency: currencies[0],
    billing_cycle: '',
    cancel_url: '',
});

const emit = defineEmits<{
    created: [Subscription];
    updated: [Subscription];
    close: [];
}>();

const createSubscription = async () => {
    if (props.subscription) {
        const response = await axios.patch(
            route('subscriptions.update', { subscription: props.subscription.id }),
            form.data()
        );

        emit('updated', response.data.subscription);

        close();
    } else {
        const response = await axios.post(route('subscriptions.store'), form.data());
        emit('created', response.data.subscription);

        close();
    }
};

const close = () => {
    form.reset();
    form.clearErrors();
    emit('close');
};


watch(() => props.subscription, (newSubscription: Subscription) => {
    if (newSubscription) {
        form.name = newSubscription.name;
        form.price = String(newSubscription.price);
        form.renewal_date = newSubscription.renewal_date;
        form.currency = newSubscription.currency;
        form.billing_cycle = newSubscription.billing_cycle;
        form.cancel_url = newSubscription.cancel_url;
    } else {
        form.reset();
    }
});
</script>

<template>
    <Modal :show="show" @close="$emit('close')">
        <div class="p-6">
            <form @submit.prevent="createSubscription">
                <div>
                    <InputLabel for="name" value="Subscription Name" />
                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
                <div class="mt-4">
                    <InputLabel for="price" value="Price" />
                    <TextInput
                        id="price"
                        type="number"
                        v-model="form.price"
                        class="mt-2 block w-full"
                    />
                    <InputError :message="form.errors.price" class="mt-2" />
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
                        <InputError :message="form.errors.currency" class="mt-2" />
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
                    <InputError :message="form.errors.renewal_date" class="mt-2" />
                </div>
                <div class="mt-4">
                    <InputLabel for="billingCycle" value="Billing Cycle" />
                    <TextInput
                        id="billingCycle"
                        type="text"
                        v-model="form.billing_cycle"
                        class="mt-2 block w-full"
                    />
                    <InputError :message="form.errors.billing_cycle" class="mt-2" />
                </div>
                <div class="mt-4">
                    <InputLabel for="cancelUrl" value="Cancel Url" />
                    <TextInput
                        id="cancelUrl"
                        type="text"
                        v-model="form.cancel_url"
                        class="mt-2 block w-full"
                    />
                    <InputError :message="form.errors.cancel_url" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="$emit('close')">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        type="submit"
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
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
