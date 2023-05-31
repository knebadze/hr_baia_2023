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
        <button class="btn btn-info btn-sm">
            <i
                class="fa fa-pen"
                @click="deleteItem(item)"
            ></i>
        </button>
        <button class="btn btn-info btn-sm">
            <i
            class="fa fa-trash"
            @click="editItem(item)"
            ></i>
        </button>
      </div>
    </template>
        <template #expand="item">
            <div style="padding: 15px">
                {{item.player}} won championships in
            </div>
        </template>
        <template #header-country="header">
            <div class="filter-column">
                <i class="fa fa-filter text-secondary" @click.stop="showFavouriteSportFilter=!showFavouriteSportFilter"></i>
                {{ header.text }}
                <div class="filter-menu filter-sport-menu" v-if="showFavouriteSportFilter">
                <select
                    class="favouriteSport-selector"
                    v-model="favouriteSportCriteria"
                    name="favouriteSport"
                >
                    <option value="all">
                        all
                    </option>
                    <option value="USA">
                        usa
                    </option>
                    <option value="Greece">
                        Greece
                    </option>

                </select>
                </div>
            </div>
        </template>
    </EasyDataTable>
</template>
<script>
import { ref, computed } from "vue";
// import { Header, Item, FilterOption } from "vue3-easy-data-table";
export default {

    setup(){
        const headers = ref([
            { text: "PLAYER", value: "player" },
            { text: "TEAM", value: "team"},
            { text: "NUMBER", value: "number"},
            { text: "POSITION", value: "position"},
            { text: "HEIGHT", value: "indicator.height"},
            { text: "WEIGHT (lbs)", value: "indicator.weight", sortable: true},
            { text: "LAST ATTENDED", value: "lastAttended", width: 200},
            { text: "COUNTRY", value: "country"},
            { text: "Operation", value: "operation" },
        ]);
        const items = ref([
            { player: "Stephen Curry", team: "GSW", number: 30, position: 'G', indicator: {"height": '6-2', "weight": 185}, lastAttended: "Davidson", country: "USA"},
            { player: "Lebron James", team: "LAL", number: 6, position: 'F', indicator: {"height": '6-9', "weight": 250}, lastAttended: "St. Vincent-St. Mary HS (OH)", country: "USA"},
            { player: "Kevin Durant", team: "BKN", number: 7, position: 'F', indicator: {"height": '6-10', "weight": 240}, lastAttended: "Texas-Austin", country: "USA"},
            { player: "Giannis Antetokounmpo", team: "MIL", number: 34, position: 'F', indicator: {"height": '6-11', "weight": 242}, lastAttended: "Filathlitikos", country: "Greece"},
        ]);
        const showFavouriteSportFilter = ref(false);
        const favouriteSportCriteria = ref('all');
        const filterOptions = computed(()=> {
        const filterOptionsArray =  [];
            if (favouriteSportCriteria.value !== 'all') {
                filterOptionsArray.push({
                    field: 'country',
                    comparison: '=',
                    criteria: favouriteSportCriteria.value,
                });
            }
            return filterOptionsArray;
        });
        return {
            headers,
            items,
            showFavouriteSportFilter,
            favouriteSportCriteria,
            filterOptions
        };
    }
}
</script>
<style >
    .customize-table {
        --easy-table-border: 1px solid #445269;
        /* --easy-table-row-border: 1px solid #445269; */

        --easy-table-header-font-size: 20px;
         --easy-table-header-height: 50px;
         --easy-table-body-row-font-size: 14px;
         --easy-table-body-row-height: 50px;
        /*--easy-table-header-font-color: #c1cad4;
        --easy-table-header-background-color: #2d3a4f; */

        /* --easy-table-header-item-padding: 10px 15px;

        --easy-table-body-even-row-font-color: #fff;
        --easy-table-body-even-row-background-color: #4c5d7a;

        --easy-table-body-row-font-color: #c0c7d2;
        --easy-table-body-row-background-color: #2d3a4f;
        --easy-table-body-row-height: 50px;
        --easy-table-body-row-font-size: 14px;

        --easy-table-body-row-hover-font-color: #2d3a4f;
        --easy-table-body-row-hover-background-color: #eee;

        --easy-table-body-item-padding: 10px 15px;

        --easy-table-footer-background-color: #2d3a4f;
        --easy-table-footer-font-color: #c0c7d2;
        --easy-table-footer-font-size: 14px;
        --easy-table-footer-padding: 0px 10px;
        --easy-table-footer-height: 50px;

        --easy-table-rows-per-page-selector-width: 70px;
        --easy-table-rows-per-page-selector-option-padding: 10px;
        --easy-table-rows-per-page-selector-z-index: 1;


        --easy-table-scrollbar-track-color: #2d3a4f;
        --easy-table-scrollbar-color: #2d3a4f;
        --easy-table-scrollbar-thumb-color: #4c5d7a;;
        --easy-table-scrollbar-corner-color: #2d3a4f;

        --easy-table-loading-mask-background-color: #2d3a4f; */
    }
</style>
