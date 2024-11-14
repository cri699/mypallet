export interface TransportUnit {
    id?: number;
    name: string;
    type: TransportType;
}

export enum TransportType {
    TRUCK = 'truck',
    TRAILER = 'trailer'
}
