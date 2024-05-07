<script setup>
import { ref } from "vue";
const props = defineProps({
    v: {
        type: Object,
        required: true,
    },
});
const errors = ref([
    { validation: "required", message: "This field is required." },
    { validation: "numeric", message: "Please enter a valid number." },
    { validation: "maxLength", message: "The number cannot exceed 9 digits." },
]);
</script>
<template>
    <div>
        <span v-if="!v.number.required.$response" style='color:red'>* </span>
    </div>
</template>
