
<script setup>
    import _ from 'lodash';
    import paginate from 'vuejs-paginate-next';
    import candidate_table from '../component/candidate/candidate_table.vue';
    import candidate_filter from '../component/candidate/candidate_filter.vue';
    import { useCandidateStore } from '../../../../store/admin/candidateStore'
    import { defineProps, computed, ref, onMounted, toRefs  } from 'vue';
    // const candidateStore = useCandidateStore();
    const { pagination, candidate } = toRefs(useCandidateStore());
    const props = defineProps({
        data: Object
    });
    const { classificatory:cla, auth } = props.data
    const { role_id, id } = auth
    const tableKey = ref(0)
    const dataType = ref('first');
    const filterParam = ref([]);
    const addCandidateUrl = computed(() =>{
        let url = new URL( location.href)
        return url.origin+'/admin/add_candidate'
    })

    const getData = async (page) => {
        if (dataType.value == 'filter') {
            await filterCandidates(page, filterParam.value)
        }else{
            try {
                await useCandidateStore().fetchCandidates(page);
                tableKey.value += 1;
            } catch (error) {
                console.error('Error fetching candidates:', error);
            }
        }

    };

    const filterCandidates = async (page, filterData) => {
        try {
            await useCandidateStore().filterCandidates(page, filterData);
            tableKey.value += 1;
        } catch (error) {
            console.error('Error filtering candidates:', error);
        }
    };
    const handlerEmitFilterData = (filterData) => {
        dataType.value = 'filter'
        filterParam.value = filterData
        filterCandidates(1, filterData);
    };
    onMounted(async () => {
        await getData();
    });

</script>
<template lang="">
    <div>
        <candidate_filter :cla="cla" @emitFilterData="handlerEmitFilterData" />

        <div class="mb-2 d-flex justify-content-end">
            <a type="button" class="btn btn-success" :href="addCandidateUrl" title="კანდიდატის დამატება"><i class="fa fa-plus"></i> დაამატე კანდიდატი</a>
        </div>
        <candidate_table v-if="candidate.length > 0" :data="candidate" :role_id="role_id" :hrId="id" :key="tableKey" />

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

<style lang="">

</style>
