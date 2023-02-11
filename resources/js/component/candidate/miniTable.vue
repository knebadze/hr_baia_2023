<template lang="">
    <!-- <div class="panel panel-default site-bg-white m-t30"> -->
        <!-- <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0"><i class="far fa-bell"></i>Alerts</h4>
        </div> -->
        <div class="panel-body wt-panel-body">

            <div class="p-a20 table-responsive">
                <table class="table twm-table table-striped table-borderless">
                <thead>
                    <tr>
                    <th v-for="row in tableRow[tableType]">{{ row }}</th>
                    <th>actions</th>
                    </tr>
                </thead>

                <tbody>
                    <!--1-->
                    <tr v-for="(data, index) in tableData">
                    <td v-for="item in data"> {{ item.data }}</td>
                    <td>
                        <button @click="trash(tableType, index)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </td>
                    </tr>



                </tbody>
                </table>
            </div>

        </div>
    <!-- </div> -->
</template>
<script>
export default {
    props:{
        tableType: String,
        tableRow:Object,
        tableData:Object,
    },
    data() {
        return {

        }
    },
    methods:{
        trash(type, index){
            // console.log('type', type);
            // console.log('index', index);
            this.sendMessageToParent(type, index)
        },
        sendMessageToParent(type, index){
            this.$emit('messageFromChild', type, index)
        }
    },
    // watch:{
    //     tableRow: {
    //         handler(newValue, oldValue) {
    //             console.log(this.tableRow);
    //             console.log('tableData', this.tableData);
    //         }
    //     }
    // },
    mounted(){


    }
}
</script>
<style lang="">

</style>
