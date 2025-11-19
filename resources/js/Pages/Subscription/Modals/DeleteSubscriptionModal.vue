<script setup lang="ts">
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {ref} from "vue";
import {Subscription} from "@/types/subscription.interface";
import axios from "axios";
import {ValidationErrors} from "@/types/validation-error.interface";

const props = defineProps<{
    show: boolean,
    subscription: Subscription | null;
}>();

const deleteSubscriptionModal = ref(false);

const emit = defineEmits<{
    deleted: [id: number];
    close: [];
}>();
const errors = ref<ValidationErrors>({});

const deleteSubscription = async () => {
    try {
        const response = await axios.delete(
            route('subscriptions.destroy',
                props.subscription.id
            )
        );

        emit('deleted', response.data.deletedId);
        emit('close');
    } catch (error: any) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors;
            return;
        }

        console.error(error);
    }
};
</script>

<template>
    <section class="space-y-6">
        <Modal :show="show" @close="$emit('close')">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900"
                >
                    Are you sure you want to delete this subscription?
                </h2>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="$emit('close')">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        @click="deleteSubscription"
                    >
                        Delete Subscription
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
