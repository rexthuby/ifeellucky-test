import axios from "axios";
import {backendApiUrl} from "@/shared/consts/config.ts";

export const getGameHistory = async (key: string) => {
    const response = await axios({
        url: '/game-history',
        method: 'post',
        baseURL: backendApiUrl,
        headers: {'Content-Type': 'application/json'},
        data: {key: key},
    })

    response.data = response.data.data.map(val => {
        return {
            createdAt: val.created_at,
            winningAmount: val.winning_amount
        }
    })
    return response
}

