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
                <!-- <a class="dropdown-item" href="#" @click="vacancyUpdateModal(item)">რედაქტირება</a>
                <a class="dropdown-item" href="#" @click="statusChange(item)">სტატუსის შეცვლა</a>
                <a v-if="item.status.id == 2" class="dropdown-item" :href="personalSelectionUrl+'/'+item.id" >კადრების შერჩევა</a>
                <a v-if="item.status.id > 1" class="dropdown-item" :href="vacancyPersonalUrl+'/'+item.id" >შერჩეული კადრები</a>
                <a v-if="item.hr_id == hr_id" class="dropdown-item" href="#" @click="vacancyReminderModal(item)">შეხსენება</a>
                <a v-if="item.hr_id == hr_id" class="dropdown-item" href="#" @click="vacancyDepositModal(item)">დეპოზიტი</a> -->

                <!-- <a class="dropdown-item" href="#">გამეორება</a> -->
            </div>
        </div>
      </div>
    </template>
    <template #header-id="header">
        <div class="filter-column">
            <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showIdFilter=!showIdFilter"></i>
            {{ header.text }}
            <div class="filter-menu filter-sport-menu my-2" v-show="showIdFilter">
                <input v-model="choseId"/>
            </div>
        </div>
    </template>
    <template #header-candidate_id="header">
        <div class="filter-column">
            <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showCandidateIdFilter=!showCandidateIdFilter"></i>
            {{ header.text }}
            <div class="filter-menu filter-sport-menu my-2" v-show="showCandidateIdFilter">
                <input v-model="choseCandidateId"/>
            </div>
        </div>
    </template>
    <template #header-user_name="header">
        <div class="filter-column">
            <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showUserNameFilter=!showUserNameFilter"></i>
            {{ header.text }}
            <div class="filter-menu filter-sport-menu my-2" v-show="showUserNameFilter">
                <input v-model="choseUserName"/>
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

    </EasyDataTable>
    <!-- {{ statusChangeModal }} -->
    <!-- <changeStatus :visible="statusChangeModal" :item="statusItem"></changeStatus> -->
</template>
<script>
import { ref, computed } from "vue";
import moment from 'moment'
// import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css";
import _ from 'lodash'
// import changeStatus from "../modal/changeStatus.vue";
export default {
    components: {
    //   Slider,
    },
    props:{
        data: Object
    },

    setup(props){


        console.log('data',props.data.qualifying);
        const headers = ref([
            { text: "id", value: "id" },
            { text: "კანდიდატის ID", value: "candidate_id" },
            { text: "სახელი გვარი", value: "user_name"},
            { text: "ვაკანსიის ID", value: "vacancy_code"},
            { text: "კატეგორია", value: "category"},
            { text: "თარიღი", value: "created_at", sortable: true},
            { text: "ტიპი", value: "type"},
            { text: "Operation", value: "operation" },
        ]);
        let data = ref(props.data.qualifying)
        const items = ref(makeData(props.data.qualifying));
        function makeData(params) {
            var arr = []
            // console.log('params',params);
            params.forEach(element => {
                // console.log(element.candidate.id);
                var data = {
                    'id':element.id,
                    'candidate_id': element.candidate.id,
                    'user_name': element.candidate.user.name_ka,
                    'vacancy_code':element.vacancy.code,
                    'category': element.vacancy.category.name_ka,
                    'created_at': moment(element.created_at).format("YYYY-MM-DD HH:mm"),
                    'type': element.qualifying_type.name
                }
                arr.push(data)
            });
            return arr
        }

        const showCategoryFilter = ref(false);
        const showCandidateIdFilter = ref(false);
        const showUserNameFilter = ref(false);

        const showIdFilter = ref(false);
        const choseId = ref('');

        const choseCategory = ref('ყველა');
        const choseCandidateId = ref('');
        const choseUserName = ref('')
        const filterOptions = computed(()=> {
            const filterOptionsArray =  [];
            if (choseCategory.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'category',
                    comparison: '=',
                    criteria: choseCategory.value,
                });

            }
            if (choseCandidateId.value !== '') {
                filterOptionsArray.push({
                    field: 'candidate_id',
                    comparison: '=',
                    criteria: choseCandidateId.value,
                });

            }

            if (choseUserName.value !== '') {
                filterOptionsArray.push({
                    field: 'user_name',
                    comparison: '=',
                    criteria: choseUserName.value,
                });

            }

            if (choseId.value !== '') {
                filterOptionsArray.push({
                    field: 'id',
                    comparison: '=',
                    criteria: choseId.value,
                });

            }

            return filterOptionsArray;
        });



        return {
            headers,
            items,
            showCategoryFilter,
            choseCategory,
            showCandidateIdFilter,
            choseCandidateId,
            showUserNameFilter,
            choseUserName,
            filterOptions,
            choseId,
            showIdFilter
        };
    },
    methods:{
        // statusChange(item) {
        //     this.statusChangeModal = !this.statusChangeModal
        //     this.statusItem = item
        // },
    }
}
</script>
<style >
    .my-vacancy-row  {
        --easy-table-body-row-background-color: #f8b1b1;
        --easy-table-body-row-font-color: #070707;
    }
    .customize-table {
        --easy-table-border: 1px solid #445269;
        --easy-table-header-font-size: 18px;
        --easy-table-header-height: 50px;
        --easy-table-body-row-font-size: 14px;
        --easy-table-body-row-height: 50px;
    }
</style>

