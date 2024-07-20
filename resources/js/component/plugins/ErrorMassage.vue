<script setup>
import { ref } from "vue";
import { errorMessage } from "../../plugins/vuelidate/validationMessages";
const props = defineProps({
   
    name: {
        type: String,
        required: true,
    },
});

</script>
<template>
    <div>
        <span  style='color:red'>* {{ errorMessage(name) }}</span>
    </div>
</template>
