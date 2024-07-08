<script setup>
import { ref, onMounted } from 'vue';
import { useUnfinishedRegistrationStore } from '../../../../store/admin/unfinishedRegistrationStore';
import _ from 'lodash';
import paginate from 'vuejs-paginate-next';
import { storeToRefs } from 'pinia';
import UnfinishedTable from '../component/UnfinishedTable.vue';
import UnfinishedFilter from '../component/UnfinishedFilter.vue';

const unfinishedRegistrationStore = useUnfinishedRegistrationStore();
const { pagination, unfinishedRegistration, count, role_id, cla, option } = storeToRefs(unfinishedRegistrationStore);
const { getData } = unfinishedRegistrationStore;

onMounted(async() => {
    await getData();
});
</script>
<template>
    <div>
        <UnfinishedFilter :cla="cla" :role_id="role_id" />

        <div class="mb-2">
            <p>სულ: {{ count }}</p>
        </div>
        <UnfinishedTable :items="unfinishedRegistration" :role_id="role_id" :option="option"/>

        <div class="mt-2">
            <paginate
                v-model="pagination.current_page"
                :page-count="pagination.last_page"
                :page-range="3"
                :margin-pages="2"
                :click-handler="getData"
                :prev-text="'უკან'"
                :next-text="'წინ'"
                :container-class="'pagination'"
                :page-class="'page-item'"
            />
        </div>

    </div>
</template>
