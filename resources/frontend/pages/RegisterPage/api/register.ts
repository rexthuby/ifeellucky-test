import axios from "axios";
import {backendApiUrl} from "@/shared/consts/config.ts";

export const register = async (user:{username:string,phone_number:string})=>{
    const response = await axios({
        url: '/register',
        method: 'post',
        baseURL: backendApiUrl,
        headers: {'Content-Type': 'application/json'},
        data: user,
    })
    return response
}
