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

                        <div class="flex space-x-4 mb-4">
                            <button v-for="([key, value]) in transportTypes" @click="onClickType(value)" :class="{ 'text-blue-500': isTypeSelected(value) }">
                                {{ capitalizeFirstLetter(value) }}
                            </button>
                        </div>

                        <TransportUnitList />
                        <NewTransportUnitForm @created="dashboardStore.fetchTransportUnits" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TransportUnitList from '@/Components/TransportUnit/TransportUnitList.vue';
import NewTransportUnitForm from '@/Components/TransportUnit/NewTransportUnitForm.vue';
import {computed} from 'vue';
import {TransportType} from "@/Models/TransportUnit";
import {capitalizeFirstLetter} from "@/Utils/utils";
import {useDashboardStore} from "@/Stores/DashboardStore";

const transportTypes = computed(() => Object.entries(TransportType));
const dashboardStore = useDashboardStore();

function onClickType(type: TransportType) {
    dashboardStore.setType(type)
    dashboardStore.fetchTransportUnits();
}

function isTypeSelected(type: TransportType): boolean {
    return dashboardStore.getType === type;
}

</script>
