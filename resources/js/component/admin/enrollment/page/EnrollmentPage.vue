<script setup>
    import { ref, defineProps } from 'vue';
    import enrolled_tab from '../tab/enrolled_tab.vue';
    import must_be_enrolled_tab from '../tab/must_be_enrolled_tab.vue';
    const props = defineProps({
        data: Object,
    })
    const role_id = ref(props.data.role_id)
</script>
<template>
    <section class="content">
        <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <enrolled_tab :data="data" :role_id="role_id"></enrolled_tab>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <must_be_enrolled_tab :role_id="role_id"></must_be_enrolled_tab>
                    </div>
                </div>

        </div>
    </section>
</template>
