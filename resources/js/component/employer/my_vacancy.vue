<template lang="">
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <div class="panel panel-default site-bg-white m-t30">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i>ვაკანსიები</h4>
            </div>
            <div class="panel-body wt-panel-body">

                <div class="p-a20 table-responsive">
                    <table class="table twm-table table-striped table-borderless">
                    <thead>
                        <tr>
                        <!-- <th>სათაური</th> -->
                        <th>პოზიცია</th>
                        <th>სტატუს</th>
                        <th>HR_ის ინფორმაცია</th>
                        <th>დაინტერესება </th>
                        <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!--1-->
                        <tr v-for="(item, index) in data.model.vacancy" :key="index">
                        <!-- <td>5</td> -->
                        <td>{{ item.category[`name_${getLang}`] }}</td>
                        <td><span class="badge bg-primary fs-6">{{ item.status['name'] }}</span></td>
                        <td>{{ item.hrInfo[`name_${getLang}`]+', '+item.hrInfo.number }}</td>
                        <td>0
                            <button type="button" title="დაინტერესებული კანდიდატების ნახვა" data-bs-toggle="tooltip" data-bs-placement="top">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" title="ვაკანსიის ნახვა" data-bs-toggle="tooltip" data-bs-placement="top">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" title="შეხსენება" data-bs-toggle="tooltip" data-bs-placement="top">
                                <i class="fa fa-bell"></i>
                            </button>
                            <button title="წაშლა" data-bs-toggle="tooltip" data-bs-placement="top">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </td>
                        </tr>

                    </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        data: Object
    },
    data() {
        return {

        }
    },
    created() {

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods: {

    },
    mounted(){
        console.log('data', this.data);
    }

}
</script>
<style lang="">

</style>
