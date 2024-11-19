import {defineStore} from 'pinia'; // Pinia is a state management library for Vue
import {computed, reactive} from 'vue'; // Vue's composables for reactivity and computed properties
import {TransportType, TransportUnit} from "@/Models/TransportUnit"; // Models for transport unit and type
import transportUnitService from "@/Services/TransportUnitService"; // Service for interacting with the transport unit API

// Interface defining the structure of the dashboard state
interface DashboardState {
    transportUnits: TransportUnit[]; // List of transport units
    searchQuery: string; // Current search query
    type: TransportType; // Selected transport type
}

// Default initial state for the dashboard
const defaultDashboardState: DashboardState = {
    transportUnits: [], // No transport units initially
    searchQuery: "", // Empty search query
    type: TransportType.TRUCK // Default type is set to 'TRUCK'
};

// Define the Pinia store
export const useDashboardStore = defineStore('dashboard', () => {
    // Reactive state
    const state = reactive<DashboardState>(defaultDashboardState);

    // Actions
    /**
     * Fetch transport units from the server.
     * - Uses the current type and search query in the state.
     */
    const fetchTransportUnits = async (): Promise<void> => {
        try {
            // Fetch data using the service and update state
            state.transportUnits = await transportUnitService.fetchTransportUnits(
                state.type,
                state.searchQuery
            );
        } catch (error) {
            console.error('Error fetching transport units:', error);
        }
    };

    /**
     * Create a new transport unit.
     * - Sends data to the server via the service.
     * @param {TransportUnit} transportUnit - The transport unit to create.
     * @throws Re-throws errors for handling in components.
     */
    const createTransportUnit = async (transportUnit: TransportUnit): Promise<void> => {
        try {
            await transportUnitService.createTransportUnits(transportUnit);
            await fetchTransportUnits();
        } catch (error) {
            console.error('Failed to create transport unit:', error);
            throw error; // Re-throw for error handling in UI
        }
    };

    /**
     * Set the current transport type in the state.
     * @param {TransportType} type - The type to set.
     */
    const updateType = async (type: TransportType): Promise<void> =>  {
        state.type = type;
        await fetchTransportUnits();
    };

    /**
     * Set the current search query in the state.
     * @param {string} searchQuery - The search query to set.
     */
    const updateSearchQuery = async (searchQuery: string): Promise<void> => {
        state.searchQuery = searchQuery;
        await fetchTransportUnits(); // Fetch transport units based on the new query
    };

    // Getters
    // Computed properties for accessing state
    const getTransportUnits = computed((): TransportUnit[] => state.transportUnits); // List of transport units
    const getType = computed((): TransportType => state.type,); // Current transport type
    const getSearchQuery = computed((): string => state.searchQuery); // Current search query


    // Return store actions and computed properties
    return {
        fetchTransportUnits,
        createTransportUnit,
        getTransportUnits,
        getType,
        getSearchQuery,
        updateType,
        updateSearchQuery,
    };
});
