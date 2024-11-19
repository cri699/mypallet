<template>
    <div>
        <input
            v-model="searchQueryModel"
            @input="dashboardStore.fetchTransportUnits"
            placeholder="Search..."
            class="border p-2 mb-4 w-full text-black"
        />

        <ul>
            <li v-for="unit in dashboardStore.getTransportUnits" :key="unit.id" class="p-2">
                {{ unit.name }} ({{ unit.type }})
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { computed, onMounted } from 'vue'; // Import Vue's composables for reactivity and lifecycle hooks
import { useDashboardStore } from "@/Stores/DashboardStore"; // Vue store for managing transport unit data

// Access the dashboard store for managing transport unit data and state
const dashboardStore = useDashboardStore();

/**
 * Computed property for the search query model.
 * - Provides two-way binding with the input field.
 * - Automatically fetches transport units when the search query changes.
 */
const searchQueryModel = computed({
    // Getter: Retrieves the current search query from the store
    get: () => dashboardStore.getSearchQuery,
    // Setter: Updates the search query in the store and triggers a fetch
    set: (newSearchQuery) => dashboardStore.updateSearchQuery(newSearchQuery), // Update the store's search query
});

/**
 * Lifecycle hook: Executes when the component is mounted.
 * - Fetches the list of transport units to ensure data is loaded initially.
 */
onMounted(() => {
    dashboardStore.fetchTransportUnits(); // Fetch transport units on component mount
});
</script>

