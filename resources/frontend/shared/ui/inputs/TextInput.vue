<script setup lang="ts">
import {computed, type PropType} from "vue";
import InputIcon from "./InputIcon.vue";

const props = defineProps({
    name: {
        type: String,
        default: null
    },
    iconSvgPath: {
        type: String,
        default: null
    },
    inputType: {
        type: String,
        validator(value: unknown): boolean {
            return ['text', 'textarea'].includes(value)
        },
        default: "text",
    },
    modelValue: {
        type: String,
        required: true,
    },
    placeholder: {
        type: String,
        default: null,
    },
    required: {
        type: Boolean,
        default: null,
    },
    maxlength: {
        type: String,
        default: null,
    },
    modeInput: {
        type: String,
        validator(value: unknown): boolean {
            return ["text", "none", "tel", "url", "email", "numeric", "decimal"].includes(value)
        },
        required: false,
        default: 'text',
    },
});

const emit = defineEmits(["update:modelValue", "setRef"]);

const computedValue = computed({
    get: () => props.modelValue,
    set: (value) => {
        emit("update:modelValue", value);
    },
});

const inputElClass = computed(() => {
    return [
        "px-3 py-2 max-w-full focus:ring focus:outline-none border-gray-700 rounded w-full border",
        "dark:placeholder-gray-400 bg-white dark:bg-slate-800",
        props.inputType === "textarea" ? "h-24" : "h-12",
        props.iconSvgPath ? 'pl-10' : '',
    ];
});

const controlIconH = computed(() =>
    props.inputType === "textarea" ? "h-full" : "h-12"
);

</script>

<template>
    <div class="relative">
    <textarea
        v-if="inputType === 'textarea'"
        v-model="computedValue"
        :class="inputElClass"
        :name="name"
        :maxlength="maxlength"
        :placeholder="placeholder"
        :required="required"
    />
        <input
            v-else-if="inputType === 'text'"
            v-model="computedValue"
            :name="name"
            :maxlength="maxlength"
            :inputmode="modeInput"
            :required="required"
            :placeholder="placeholder"
            :class="inputElClass"
        />
        <InputIcon v-if="iconSvgPath" :box-height-class="controlIconH" :svg-path="iconSvgPath"/>
    </div>
</template>
