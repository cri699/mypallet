import axios, { AxiosResponse } from 'axios'; // Import Axios for HTTP requests and its response type
import { TransportType, TransportUnit } from "@/Models/TransportUnit"; // Import models for type safety

class TransportUnitService {
    /**
     * Fetch transport units from the API.
     *
     * @param {TransportType} type - The type of transport units to fetch (e.g., truck, trailer).
     * @param {string} searchQuery - The search query string for filtering transport units.
     * @returns {Promise<TransportUnit[]>} A promise that resolves to an array of transport units.
     */
    async fetchTransportUnits(type: TransportType, searchQuery: string): Promise<TransportUnit[]> {
        // Send a GET request to the API with type and search query as parameters
        const response: AxiosResponse<TransportUnit[]> = await axios.get(`/api/transport-units?type=${type}&search=${searchQuery}`);
        return response.data; // Return the data from the response
    }

    /**
     * Create a new transport unit via the API.
     *
     * @param {TransportUnit} transportUnit - The transport unit object to create.
     * @returns {Promise<void>} A promise that resolves when the transport unit is created.
     */
    async createTransportUnits(transportUnit: TransportUnit): Promise<void> {
        // Send a POST request to the API with the transport unit as the payload
        await axios.post('/api/transport-units', transportUnit);
    }
}

// Export an instance of the service for use in other parts of the application
export default new TransportUnitService();
