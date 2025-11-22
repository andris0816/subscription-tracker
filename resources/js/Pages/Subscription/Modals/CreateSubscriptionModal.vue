<script setup lang="ts">

import InputLabel from "@/Components/InputLabel.vue";
import TextInput from '@/Components/TextInput.vue';
import {useForm} from "@inertiajs/vue3";
import {VueDatePicker} from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/dist/main.css';
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref, watch} from "vue";
import {Subscription} from "@/types/subscription.interface";
import {currencies} from "@/types/currency.types";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue'
import InputError from "@/Components/InputError.vue";
import axios from "axios";
import { ValidationErrors } from "@/types/validation-error.interface";

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

const errors = ref<ValidationErrors>({});

const createSubscription = async () => {
    try {
        let response: any;

        if (props.subscription) {
            response = await axios.patch(
                route('subscriptions.update', { subscription: props.subscription.id }),
                form.data()
            );
            emit('updated', response.data.subscription);
        } else {
            response = await axios.post(
                route('subscriptions.store'),
                form.data()
            );
            emit('created', response.data.subscription);
        }

        close();

    } catch (error: any) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors;
            return;
        }

        console.error(error);
    }
};

const close = () => {
    form.reset();
    errors.value = {};
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
                    <InputError :message="errors?.name?.[0]" class="mt-2" />
                </div>
                <div class="mt-4">
                    <InputLabel for="price" value="Price" />
                    <TextInput
                        id="price"
                        type="number"
                        v-model="form.price"
                        class="mt-2 block w-full"
                    />
                    <InputError :message="errors?.price?.[0]" class="mt-2" />
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
                        <InputError :message="errors?.currency?.[0]" class="mt-2" />
                    </div>
                </div>
                <div class="mt-4">
                    <InputLabel for="renewalDate" value="Renewal Date" />
                    <VueDatePicker
                        id="renewalDate"
                        v-model="form.renewal_date"
                        :time-config="{ enableTimePicker: false }"
                        class="mt-2"
                        teleport="body"
                    />
                    <InputError :message="errors?.renewal_date?.[0]" class="mt-2" />
                </div>
                <div class="mt-4">
                    <InputLabel for="billingCycle" value="Billing Cycle" />
                    <TextInput
                        id="billingCycle"
                        type="text"
                        v-model="form.billing_cycle"
                        class="mt-2 block w-full"
                    />
                    <InputError :message="errors?.billing_cycle?.[0]" class="mt-2" />
                </div>
                <div class="mt-4">
                    <InputLabel for="cancelUrl" value="Cancel Url" />
                    <TextInput
                        id="cancelUrl"
                        type="text"
                        v-model="form.cancel_url"
                        class="mt-2 block w-full"
                    />
                    <InputError :message="errors?.cancel_url?.[0]" class="mt-2" />
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
