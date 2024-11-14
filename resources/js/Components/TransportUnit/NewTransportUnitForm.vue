<template>
    <div class="mb-4">
        <input
            v-model="form.name"
            placeholder="Name"
            class="border p-2 mb-2 text-black"
        />
        <span v-if="errors.name" class="text-red-500">{{ errors.name }}</span>

        <span v-if="errors.type" class="text-red-500">{{ errors.type }}</span>

        <button @click="createTransportUnit" class="px-4 py-2 bg-blue-500 text-white">
            Add Transport Unit
        </button>
    </div>
</template>

<script setup lang="ts">
import {computed, ref} from 'vue';
import {TransportType, TransportUnit} from "@/Models/TransportUnit";
import {useDashboardStore} from "@/Stores/DashboardStore";

const dashboardStore = useDashboardStore();

const emit = defineEmits(['created']);

const form = ref<TransportUnit>({ name: '', type: dashboardStore.getType });
const errors = ref<Record<string, string | string[]>>({});

const createTransportUnit = () => {
  form.value = {
    ...form.value,
    type:dashboardStore.getType
  }
    dashboardStore.createTransportUnit(form.value)
        .then(() => {
            errors.value = {};

            // Reset form on success
            form.value = { name: '', type: dashboardStore.getType };

            // Emit an event to notify the parent component (e.g., Dashboard.vue) of the creation
            emit('created');
        })
        .catch((error: any) => {
            if (error.response && error.response.status === 422) {
                // Handle validation errors
                errors.value = error.response.data.errors;
            } else {
                console.error('An unexpected error occurred:', error);
            }
        });
};
</script>
