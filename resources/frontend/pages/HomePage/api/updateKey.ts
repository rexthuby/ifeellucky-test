import axios from "axios";
import {backendApiUrl} from "@/shared/consts/config.ts";

export const updateKey = async (key: string) => {
    const response = await axios({
        url: '/access-key',
        method: 'put',
        baseURL: backendApiUrl,
        headers: {'Content-Type': 'application/json'},
        data: {key: key},
    })
    return response
}
