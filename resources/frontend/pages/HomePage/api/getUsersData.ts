import axios from "axios";
import {backendApiUrl} from "@/shared/consts/config.ts";

export const getUsersData = async (key: string) => {
    const response = await axios({
        url: '/access-key',
        method: 'post',
        baseURL: backendApiUrl,
        headers: {'Content-Type': 'application/json'},
        data: {key: key},
    })
    return response
}
