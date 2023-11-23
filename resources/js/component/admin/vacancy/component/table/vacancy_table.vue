<template lang="">

    <EasyDataTable
        v-model:items-selected="itemsSelected"
        buttons-pagination
        :headers="headers"
        :items="items"
        table-class-name="customize-table"
        :body-row-class-name="bodyRowClassNameFunction"
        border-cell
        :filter-options="filterOptions"
    >
        <template #item-operation="item">
            <div class="operation-wrapper">
                <table_cog :item="item" :key="item.id" :hr_id="hr_id" :roleId="roleId"></table_cog>
            </div>

        </template>
        <template #item-category="item">

        <span :class="`badge bg-${item.category.color} p-1`" >{{ item.category.name_ka }}</span>
    </template>
        <template #item-status="item">

        <span :class="`badge bg-${item.status.color} p-1`" >{{ item.status.name_ka }}</span>
    </template>
        <template #expand="item">
            <!-- {{ item }} -->
              <!-- /.card-header -->
              <div class="card-header">
                <expand_body :item="item" :hr_id="hr_id" :roleId="roleId"/>
              </div>

              <!-- /.card-body -->
        </template>
        <template #header-status.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showStatusFilter=!showStatusFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showStatusFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="choseStatus"
                    name="favouriteSport"
                >
                    <option value="ყველა">
                        ყველა
                    </option>
                    <option v-for="(item, index) in data.classificatory.status" :key="index" :value="item.name_ka">
                        {{ item.name_ka }}
                    </option>

                </select>
                </div>
            </div>
        </template>
        <template #header-category.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showCategoryFilter=!showCategoryFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showCategoryFilter">
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
        <template #header-work_schedule.name_ka="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showScheduleFilter=!showScheduleFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showScheduleFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="choseSchedule"
                    name="favouriteSport"
                >
                    <option value="ყველა">
                        ყველა
                    </option>
                    <option v-for="(item, index) in cla" :key="index" :value="item.name_ka">
                        {{ item.name_ka }}
                    </option>

                </select>
                </div>
            </div>
        </template>
        <template #header-payment="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showPaymentFilter=!showPaymentFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu my-2" v-if="showPaymentFilter">
                    <Slider v-model="chosePayment" :max=3000 class="slider"/>
                </div>
            </div>
        </template>
        <template #header-id="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" style="font-size:15px;" @click.stop="showIdFilter=!showIdFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu my-2" v-if="showIdFilter">
                    <input v-model="choseId"/>
                </div>
            </div>
        </template>
    </EasyDataTable>
    <!-- {{ statusChangeModal }} -->

</template>
<script>
import { ref, computed } from "vue";
import moment from 'moment'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css";
import Switch from '../../../../inc/Switch.vue';
import _ from 'lodash'
import table_cog from "./table_cog.vue";
import expand_body from "./expand_body.vue";
export default {
    components: {
        Slider,
        Switch,
        table_cog,
        expand_body
    },
    props:{
        data: Object,
        hrId: Number,
        classificatory: Object,
        roleId: Number
    },

    setup(props){
        console.log(props);
        var url = new URL( location.href)
        const itemsSelected = ref([]);

        let vacancyId = ref(null)
        var statusItem = ref()
        var item = ref()
        var depositItem =ref()
        let m = ref({'payment': [50, 4000], 'age':[18, 65]})
        let colspan = ref('hide')
        let hr_id = ref(props.hrId)
        let myVacancy = ref(false)
        let cla = ref(props.classificatory)


        const headers = ref([
            { text: "id", value: "code" },
            { text: "კატეგორია", value: "category" },
            { text: "გრაფიკი", value: "work_schedule.name_ka"},
            { text: "დამსაქმებელი", value: "employer.name_ka"},
            { text: "ნომერი", value: "employer.number"},
            { text: "სტატუსი", value: "status"},
            { text: "ანაზღაურება", value: "payment", sortable: true},
            { text: "საჭიროება", value: "start_date", sortable: true},
            { text: "Operation", value: "operation" },
        ]);
        let data = ref(props.data)

        const items = ref(data)

        const bodyRowClassNameFunction = ( item, number) => {
            if (item.hr_id == hr_id.value) return 'my-vacancy-row';
            return '';
        };
        const showStatusFilter = ref(false);
        const showCategoryFilter = ref(false);
        const showScheduleFilter = ref(false);
        const showPaymentFilter = ref(false);
        const showIdFilter = ref(false);
        const choseStatus = ref('ყველა');
        const choseCategory = ref('ყველა');
        const choseSchedule = ref('ყველა');
        const chosePayment = ref([50, 3000]);
        const choseId = ref('');

        const filterOptions = computed(()=> {
            const filterOptionsArray =  [];
            if (choseStatus.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'status.name_ka',
                    comparison: '=',
                    criteria: choseStatus.value,
                });
            }
            if (choseCategory.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'category.name_ka',
                    comparison: '=',
                    criteria: choseCategory.value,
                });

            }
            if (choseSchedule.value !== 'ყველა') {
                filterOptionsArray.push({
                    field: 'work_schedule.name_ka',
                    comparison: '=',
                    criteria: choseSchedule.value,
                });

            }
            if (showPaymentFilter) {
                filterOptionsArray.push({
                    field: 'payment',
                    comparison: 'between',
                    criteria: chosePayment.value,
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




        const myVacancySwitch = () =>{
            if (!myVacancy.value) {
               data.value =  _.sortBy(_.filter(props.data.vacancy, function(o) { return o.hr_id == hr_id.value; }), [function(o) { return o.start_date; }]);
            }else{
                data.value = props.data.vacancy
            }
        };

        const find = (m) =>{
            (m.created_at_from || m.created_at_to)?m['created_at'] = [m.created_at_from, m.created_at_to]:'';
            (m.start_date_from || m.start_date_to)?m['start_date'] = [m.start_date_from, m.start_date_to]:'';
            (m.interview_date_from || m.interview_date_to)?m['interview_date'] = [m.interview_date_from, m.interview_date_to]:''

            axios({
                method: "post",
                url: '/admin_vacancy_filter',
                data: m,

            })
            .then(function (response) {
                items.value = response.data.data
                if (response.status == 200) {
                    // items.value = response.data.data
                    // toast.success("წარმატებით შესრულდა", {
                    //     theme: 'colored',
                    //     autoClose: 1000,
                    // });
                    // setTimeout(() => {
                    //     document.location.reload();
                    // }, 2000);
                }



            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };




        return {
            headers,
            items,
            itemsSelected,
            showStatusFilter,
            choseStatus,
            showCategoryFilter,
            choseCategory,
            showScheduleFilter,
            choseSchedule,
            showPaymentFilter,
            chosePayment,
            showIdFilter,
            choseId,
            filterOptions,


            item,
            vacancyId,

            colspan,
            hr_id,
            myVacancy,
            myVacancySwitch,
            bodyRowClassNameFunction,
            m,
            cla,
            find,

        };
    },
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
