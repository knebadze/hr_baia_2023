<template lang="">
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
                    <td v-for="n in (Object.keys(data).length)"> {{ data[`row_${n}`] }}</td>
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
            const removed = this.tableData.splice(index, 1);
            this.sendMessageToParent(this.tableData, type)
        },
        sendMessageToParent(newData, type){
            this.$emit('messageFromChild', newData, type)
        }
    },
    watch:{
        tableData: {
            handler(newValue, oldValue) {
            }
        }
    },
    mounted(){


    }
}
</script>
<style lang="">

</style>
