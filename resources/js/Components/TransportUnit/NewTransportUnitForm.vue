<template>
    <div class="mb-4">
        <input
            v-model="name"
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
import {ref} from 'vue'; // Import `ref` to create reactive variables
import {useDashboardStore} from "@/Stores/DashboardStore";
import {TransportUnit} from "@/Models/TransportUnit"; // Vue store for managing dashboard state

// Access the dashboard store for managing transport unit actions
const dashboardStore = useDashboardStore();

// Reactive form object to capture input data for the transport unit
const name = ref<string>("");

// Reactive object to store validation error messages
const errors = ref<Record<string, string | string[]>>({});

/**
 * Handles the creation of a new transport unit.
 * - Sends the form data to the store.
 * - Resets the form and errors on success.
 * - Emits the 'created' event to notify the parent component.
 */
const createTransportUnit = () => {
    // Create transportUnit Object for creation
    const transportUnit: TransportUnit = {
        name: name.value,
        type: dashboardStore.getType
    }

    // Attempt to create the transport unit via the store
    dashboardStore.createTransportUnit(transportUnit)
        .then(() => {
            errors.value = {}; // Clear errors on success

            // Reset the name field
            name.value = '';
        })
        .catch((error: any) => {
            if (error.response && error.response.status === 422) {
                // Handle validation errors from the backend
                errors.value = error.response.data.errors;
            } else {
                // Log unexpected errors
                console.error('An unexpected error occurred:', error);
            }
        });
};
</script>

