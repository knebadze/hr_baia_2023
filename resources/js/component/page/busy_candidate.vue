<template lang="">
    <EasyDataTable
        buttons-pagination
        :headers="headers"
        :items="items"
        table-class-name="customize-table"
        border-cell
        :filter-options="filterOptions"
    >
    <template #item-operation="item">
       <div class="operation-wrapper">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu ropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" @click="candidateModal(item)">კანდიდატი</a>
                <a class="dropdown-item" href="#" @click="vacancyModal(item.vacancy_id)">ვაკანსია</a>
            </div>
        </div>
      </div>
    </template>
    <template #header-candidate="header">
        <div class="filter-column">
            <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showIdFilter=!showIdFilter"></i>
            {{ header.text }}
            <div class="filter-menu filter-sport-menu my-2" v-if="showIdFilter">
                <input v-model="choseId"/>
            </div>
        </div>
    </template>
    <template #header-user_name="header">
        <div class="filter-column">
            <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showUserNameFilter=!showUserNameFilter"></i>
            {{ header.text }}
            <div class="filter-menu filter-sport-menu my-2" v-if="showUserNameFilter">
                <input v-model="choseUserName"/>
            </div>
        </div>
    </template>
    <template #header-vacancy_code="header">
        <div class="filter-column">
            <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showVacancyCodeFilter=!showVacancyCodeFilter"></i>
            {{ header.text }}
            <div class="filter-menu filter-sport-menu my-2" v-if="showVacancyCodeFilter">
                <input v-model="choseVacancyCode"/>
            </div>
        </div>
    </template>
    <template #header-category="header">
        <div class="filter-column">
            <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showCategoryFilter=!showCategoryFilter"></i>
            {{ header.text }}
            <div class="filter-menu filter-sport-menu" v-show="showCategoryFilter">
            <select
                class="favouriteSport-selector"
                v-model="choseCategory"
                name="favouriteSport"
            >
                <option value="ყველა">
                    ყველა
                </option>
                <option v-for="(item, index) in data.classificatory.category" :key="index" :value="item.name_ka">
                    {{ item.name_ka }}
                </option>

            </select>
            </div>
        </div>
    </template>
    <template #header-type="header">
        <div class="filter-column">
            <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showTypeFilter=!showTypeFilter"></i>
            {{ header.text }}
            <div class="filter-menu filter-sport-menu" v-show="showTypeFilter">
            <select
                class="favouriteSport-selector"
                v-model="choseType"
                name="favouriteSport"
            >
                <option value="ყველა">
                    ყველა
                </option>
                <option v-for="(item, index) in data.classificatory.qualifyingType" :key="index" :value="item.name">
                    {{ item.name }}
                </option>

            </select>
            </div>
        </div>
    </template>

    </EasyDataTable>
    <vacancyFullInfoModal :visible="showVacancyModal" :vacancyId="vacancy_id"></vacancyFullInfoModal>
</template>
<script>
import { ref, computed } from "vue";
import moment from 'moment'
import "@vueform/slider/themes/default.css";
import _ from 'lodash'
import vacancyFullInfoModal from '../admin/vacancy/modal/vacancyFullInfoModal.vue'
import candidateFullInfoModal from '../admin/candidate/modal/candidateFullInfoModal.vue'
export default {
    components: {
    //   Slider,
        vacancyFullInfoModal,
        candidateFullInfoModal
    },
    props:{
        data: Object,
    },

    setup(props){
        const headers = ref([
            { text: "კანდიდატის ID", value: "candidate" },
            { text: "სახელი გვარი", value: "user_name"},
            { text: "ვაკანსიის ID", value: "vacancy_code"},
            { text: "კატეგორია", value: "category"},
            { text: "თარიღი", value: "created_at", sortable: true},
            { text: "ტიპი", value: "type"},
            { text: "Operation", value: "operation" },
        ]);
        let data = ref(props.data.qualifying)
        const items = ref(makeData(props.data.qualifying))
        // ref(makeData(props.data.qualifying));
        function makeData(params) {
            var arr = []
            params.forEach(element => {
                var data = {
                    'candidate': element.candidate_id,
                    'user_name': element.candidate.user.name_ka,
                    'vacancy_id':element.vacancy.id,
                    'vacancy_code':element.vacancy.code.toString(),
                    'category': element.vacancy.category.name_ka,
                    'created_at': moment(element.created_at).format("YYYY-MM-DD HH:mm"),
                    'type': element.qualifying_type.name
                }
                arr.push(data)
            });
            return arr
        }
        const showUserNameFilter = ref(false);
        const choseId = ref('');
        const showIdFilter = ref(false);
        const choseUserName = ref('');
        const showVacancyCodeFilter = ref(false);
        const choseVacancyCode = ref('');
        const showCategoryFilter = ref(false);
        const choseCategory = ref('ყველა');
        const showTypeFilter = ref(false);
        const choseType = ref('ყველა');
        const filterOptions = computed(()=> {
            const filterOptionsArray =  [];

            if (choseId.value !== '') {

                filterOptionsArray.push({
                    field: 'candidate',
                    comparison: '=',
                    criteria: Number(choseId.value),
                });

            }
            if (choseUserName.value !== '') {
                filterOptionsArray.push({
                    field: 'user_name',
                    criteria: choseUserName.value,
                    comparison: (value, criteria) => (value != null && criteria != null &&
                    typeof value === 'string' && value.includes(criteria)),

                });

            }
            if (choseVacancyCode.value !== '') {
                filterOptionsArray.push({
                    field: 'vacancy_code',
                    criteria: choseVacancyCode.value,
                    comparison: (value, criteria) => (value != null && criteria != null &&
                    typeof value === 'string' && value.includes(criteria)),
                });

            }
            if (choseCategory.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'category',
                    comparison: '=',
                    criteria: choseCategory.value,
                });
            }
            if (choseType.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'type',
                    comparison: '=',
                    criteria: choseType.value,
                });
            }

            return filterOptionsArray;
        });

        const showVacancyModal = ref(false);
        const vacancy_id = ref(null)


        return {
            headers,
            items,
            filterOptions,
            showIdFilter,
            choseId,
            showUserNameFilter,
            choseUserName,
            showVacancyCodeFilter,
            choseVacancyCode,
            showCategoryFilter,
            choseCategory,
            showTypeFilter,
            choseType,

            showVacancyModal,
            vacancy_id
        };
    },
    methods:{
        vacancyModal(id){
            this.showVacancyModal = !this.showVacancyModal
            this.vacancy_id = id
        }
    }
}
</script>
<style >
    .customize-table {
        --easy-table-border: 1px solid #445269;
        --easy-table-header-font-size: 18px;
        --easy-table-header-height: 50px;
        --easy-table-body-row-font-size: 14px;
        --easy-table-body-row-height: 50px;
        --da0d4328: 400px !important;
    }
</style>

