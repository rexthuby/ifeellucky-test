import {numeric, maxLength, minLength, required} from "@vuelidate/validators";

export const usernameRule = {
    required,
    minLength: minLength(3),
    maxLength: maxLength(20)
};

export const numberRule = {
    required,
    numeric,
    minLength: minLength(9),
    maxLength: maxLength(14)
}
