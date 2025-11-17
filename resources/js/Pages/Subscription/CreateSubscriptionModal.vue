<script setup lang="ts">

import InputLabel from "@/Components/InputLabel.vue";
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from "@inertiajs/vue3";
import {VueDatePicker} from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/dist/main.css'
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";

const form = useForm({
    name: '',
    price: 0,
    renewalDate: null,
    billingCycle: '',
    cancelUrl: '',
});
const createSubscriptionModal = ref(false);

const createSubscription = () => {
    // todo emit bubbling
}

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
            <form method="POST">
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
                    <InputLabel for="renewalDate" value="Renewal Date" />
                    <VueDatePicker
                        id="renewalDate"
                        v-model="form.renewalDate"
                        class="mt-2"
                    />
                </div>
                <div class="mt-4">
                    <InputLabel for="billingCycle" value="Billing Cycle" />
                    <TextInput
                        id="billingCycle"
                        type="text"
                        v-model="form.billingCycle"
                        class="mt-2 block w-full"
                    />
                </div>
                <div class="mt-4">
                    <InputLabel for="cancelUrl" value="Subscription Name" />
                    <TextInput
                        id="cancelUrl"
                        type="text"
                        v-model="form.cancelUrl"
                        class="mt-2 block w-full"
                    />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="createSubscription"
                    >
                        Delete Account
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>

<style scoped>

</style>
