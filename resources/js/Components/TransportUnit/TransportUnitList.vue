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
import { computed, onMounted, watch } from 'vue';
import {useDashboardStore} from "@/Stores/DashboardStore";

const dashboardStore = useDashboardStore();

const searchQueryModel = computed({
    get:() => dashboardStore.getSearchQuery,
    set: (newSearchQuery) => {
        dashboardStore.setSearchQuery(newSearchQuery);
        dashboardStore.fetchTransportUnits();
    }
})

// Fetch transport units on mount and when type changes
onMounted(() => {
    dashboardStore.fetchTransportUnits();
});
</script>
