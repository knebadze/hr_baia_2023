<script setup>
import { ref, watch } from "vue";
const props = defineProps({
    classificatory: Object,
});
const emit = defineEmits(["search"]);
const search_number_code = ref(null);
const cla = ref({});
cla.value = _.cloneDeep(props.classificatory);
watch(search_number_code, (newVal, oldVal) => {
    if (newVal === null) {
        emit("search", props.classificatory);
        return;

    }
    const filterCla =  _.filter(cla.value, (item) => {
        return item.phonecode.toString().includes(newVal);
    });
    emit("search", filterCla);
});
</script>
<template>
    <input
        class="m-1 border-0"
        placeholder="ძებნა.."
        style="
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px,
                rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        "
        v-model="search_number_code"
        autofocus
        onkeypress="return /[0-9]/i.test(event.key)"
        maxLength="4"
        type="text"
    />
</template>
