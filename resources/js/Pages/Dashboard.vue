<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Manage Transport Units</h3>

                        <div class="flex border-b border-gray-200">
                            <div
                                    v-for="([key, value]) in transportTypes"
                                    :key="key"
                                    @click="onClickType(value)"
                                    :class="[
                                        'cursor-pointer px-4 py-2 text-sm font-medium transition-colors duration-300',
                                        isTypeSelected(value)
                                            ? 'text-blue-500 border-b-2 border-blue-500'
                                            : 'text-gray-500 hover:text-gray-700 hover:border-gray-300'
                                    ]"
                            >
                                {{ capitalizeFirstLetter(value) }}
                            </div>
                        </div>

                        <TransportUnitList/>

                        <NewTransportUnitForm/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'; // Layout for authenticated users
import { Head } from '@inertiajs/vue3'; // Inertia.js Head component for setting page metadata
import TransportUnitList from '@/Components/TransportUnit/TransportUnitList.vue'; // Component for displaying a list of transport units
import NewTransportUnitForm from '@/Components/TransportUnit/NewTransportUnitForm.vue'; // Component for creating a new transport unit
import { computed } from 'vue'; // Vue composable for creating reactive computed properties
import { TransportType } from "@/Models/TransportUnit"; // Enum-like object defining transport types
import { capitalizeFirstLetter } from "@/Utils/utils"; // Utility function for capitalizing strings
import { useDashboardStore } from "@/Stores/DashboardStore"; // Vue store for managing dashboard state

// Computed property that transforms the `TransportType` object into an array of key-value pairs
const transportTypes = computed(() => Object.entries(TransportType));

// Reference to the dashboard store for state management
const dashboardStore = useDashboardStore();

/**
 * Handles clicking on a transport type button.
 * Updates the selected type in the store and fetches the transport units.
 *
 * @param {TransportType} type - The transport type selected by the user.
 */
function onClickType(type: TransportType) {
    dashboardStore.updateType(type); // Sets the selected type in the store
}

/**
 * Determines whether a specific transport type is currently selected.
 *
 * @param {TransportType} type - The transport type to check.
 * @returns {boolean} True if the transport type is selected, false otherwise.
 */
function isTypeSelected(type: TransportType): boolean {
    return dashboardStore.getType === type; // Compares the current type in the store with the given type
}

</script>
