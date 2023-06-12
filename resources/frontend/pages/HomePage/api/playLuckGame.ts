import axios from "axios";
import {backendApiUrl} from "@/shared/consts/config.ts";

export const playLuckGame = async (key: string) => {
    const response = await axios({
        url: '/lucky-game',
        method: 'post',
        baseURL: backendApiUrl,
        headers: {'Content-Type': 'application/json'},
        data: {key: key},
    })
    return response
}

