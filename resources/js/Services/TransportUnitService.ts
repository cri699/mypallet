import axios, {AxiosResponse} from 'axios';
import {TransportType, TransportUnit} from "@/Models/TransportUnit";

class TransportUnitService {
    // Fetch transport units by type
    async fetchTransportUnits(type: TransportType, searchQuery: string): Promise<TransportUnit[]> {
        const response: AxiosResponse<TransportUnit[]> = await axios.get(`/api/transport-units?type=${type}&search=${searchQuery}`);
        return response.data;
    }

    async createTransportUnits(transportUnit: TransportUnit) {
        await axios.post('/api/transport-units', transportUnit);
    }
}

export default new TransportUnitService();
