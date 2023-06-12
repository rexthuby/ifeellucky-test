<script setup lang="ts">

import {ContentTitle, MainContentWrapper} from "@/entities/MainPageBlocks";
import SimpleForm from "@/shared/ui/forms/SimpleForm.vue";
import FormField from "@/shared/ui/forms/FormField.vue";
import TextInput from "@/shared/ui/inputs/TextInput.vue";
import {computed, reactive, ref} from "vue";
import ColorfulButton from "@/shared/ui/buttons/ColorfulButton.vue";
import * as validationRules from '../lib/RegistrationValidationRules.ts'
import useVuelidate from "@vuelidate/core";
import {register as registerApi} from '../api/register.ts'
import {toast} from "vue3-toastify";
import {useRoute, useRouter} from "vue-router";

const formData: { username: string, phone_number: string } = reactive({
    username: '',
    phone_number: '',
})

const route = useRoute()
const router = useRouter()

const isRegisterAvailable = ref<boolean>(true)
const accessKey = ref<null | string>(null)

const makeDataEmpty = () => {
    formData.username = ''
    formData.phone_number = ''
}

const validatedRules = computed(() => ({
    username: validationRules.usernameRule,
    phone_number: validationRules.numberRule,
}))

const validated = useVuelidate(validatedRules, formData, {$lazy: true})

const register = async () => {
    isRegisterAvailable.value = false

    const isValid = await validated.value.$validate()

    if (!isValid) {
        isRegisterAvailable.value = true
        return
    }

    const response = await registerApi(getPreparedFormData())

    if (response.status != 200) {
        toast.error('Registration error!')
        isRegisterAvailable.value = true
        return
    }

    toast.success('Registration successful')
    accessKey.value = response.data.key
    makeDataEmpty()
    validated.value.$reset()
}

const getPreparedFormData = () => {
    return {
        username: formData.username,
        phone_number: formData.phone_number
    }
}
const getFirstErrorMessage = (valid: any) => {
    return valid.$errors.map(err => err.$message.toString())[0]
}
</script>

<template>
    <MainContentWrapper>
        <ContentTitle title="Registration">
        </ContentTitle>
        <div v-if="accessKey" class="flex justify-center flex-col text-center">
            <div>

            </div>
            <router-link :to="{name:'Home', params:{key:accessKey}}" class="text-blue-200">Link to your home page</router-link>
            <div>Access key: {{accessKey}}</div>
        </div>
        <SimpleForm class="flex flex-col gap-4">
            <FormField label="Username" :warnings="[getFirstErrorMessage(validated.username)]">
                <TextInput v-model="formData.username" placeholder="Username" :required="true"
                           @input="validated.username.$reset()"></TextInput>
            </FormField>
            <FormField label="Phone number" :warnings="[getFirstErrorMessage(validated.phone_number)]">
                <TextInput v-model="formData.phone_number" mode-input="tel" placeholder="Phone number" :required="true"
                           @input="validated.phone_number.$reset()"></TextInput>
            </FormField>
            <div class="flex justify-center">
                <ColorfulButton @click.prevent="register" :isDisable="!isRegisterAvailable">Register me</ColorfulButton>
            </div>
        </SimpleForm>
    </MainContentWrapper>
</template>

<style scoped>

</style>
