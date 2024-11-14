import {defineStore} from 'pinia';
import {computed, reactive} from 'vue';
import {TransportType, TransportUnit} from "@/Models/TransportUnit";
import transportUnitService from "@/Services/TransportUnitService";

interface DashboardState {
    transportUnits: TransportUnit[];
    searchQuery: string;
    type: TransportType;
}

const defaultDashboardState: DashboardState = {
    transportUnits: [],
    searchQuery: "",
    type: TransportType.TRUCK
}

export const useDashboardStore = defineStore('dashboard', () => {
    // State
    const state = reactive<DashboardState>(defaultDashboardState);

    // Actions
    const fetchTransportUnits = async () => {
        try {
            const transportUnits:TransportUnit[] = await transportUnitService.fetchTransportUnits(state.type, state.searchQuery);
            state.transportUnits = transportUnits;
        } catch (error) {
            console.error('Error fetching transport units:', error);
        }
    };

    const createTransportUnit = async (transportUnit: TransportUnit) => {
        try {
            console.log(transportUnit);
            const transportUnits:TransportUnit[] = await transportUnitService.createTransportUnits(transportUnit);
            //transportUnits.value.push(response.data);
        } catch (error) {
            console.error('Failed to create transport unit:', error);
            throw error; // Re-throw error for handling in components
        }
    };

    const getTransportUnits = computed(():TransportUnit[] => state.transportUnits);
    const getType = computed(():TransportType => state.type);
    const getSearchQuery = computed((): string => state.searchQuery);

    const setType = async (type: TransportType): Promise<void> => {
        state.type = type;
    }

    const setSearchQuery = async (searchQuery: string): Promise<void> => {
        state.searchQuery = searchQuery;
    }

    return {
        fetchTransportUnits,
        createTransportUnit,
        getTransportUnits,
        getType,
        getSearchQuery,
        setType,
        setSearchQuery,
    };
});
