export interface Candidate {
    id: number;
    name: string;
    last_name?: string;
    description?: string;
    photo_path?: string;
    position: string;
}

export interface Election {
    id: number;
    name: string;
    status: string;
}

export interface Turnout {
    total_voters: number;
    total_votes: number;
    percentage: number;
}

export interface User {
    id: number;
    name: string;
    last_name?: string;
}
