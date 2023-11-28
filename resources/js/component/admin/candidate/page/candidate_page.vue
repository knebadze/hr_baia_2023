<template lang="">
    <div>
        <candidate_filter :cla="cla" @emitFilterData="handlerEmitFilterData" />

        <div class="mb-2 d-flex justify-content-end">
            <a type="button" class="btn btn-success" :href="addCandidateUrl" title="კანდიდატის დამატება"><i class="fa fa-plus"></i> დაამატე კანდიდატი</a>
        </div>

        <candidate_table :data="candidate" :role_id="data.role_id" :hrId="data.hr_id" :key="tableKey" />

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
<script>
import _ from 'lodash';
import Paginate from 'vuejs-paginate-next';
import candidate_table from '../component/candidate/candidate_table.vue';
import candidate_filter from '../component/candidate/candidate_filter.vue';
export default {
    components:{
        paginate: Paginate,
        candidate_table,
        candidate_filter
    },
    props:{
        data:Object,
    },
    data() {
        return {
            candidate:[],
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            getDataType:'first_data',
            category:null,
            modalData:{},
            m:{},
            cla: {},
            tableKey: 0

        }
    },
    created(){
        this.getData()
    },
    computed:{
        addCandidateUrl(){
            let url = new URL( location.href)
            return url.origin+'/admin/add_candidate'

        }
    },
    methods: {
        async getData(){
            if (this.getDataType == 'first_data') {
                await this.firstData()
            }

        },
        async firstData(){
            this.candidate = this.data.candidate.data
            this.cla = this.data.classificatory
            this.pagination = {
                'current_page':this.data.candidate.current_page,
                'last_page': this.data.candidate.last_page
            }

        },
        handlerEmitFilterData(item){
            this.getDataType = 'filter'
            this.candidate = item.candidate
            this.pagination = item.pagination
            this.tableKey ++
        },

    },
    mounted(){

    }
}
</script>
<style lang="">

</style>
