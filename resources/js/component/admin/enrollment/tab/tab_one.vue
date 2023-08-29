<template lang="">
    <!-- <section class="content ">
        <div class="container-fluid"> -->

        <!-- <div>
            <h5><i class="fa fa-info"></i> ინფორმაცია</h5>
            <hr>
        </div> -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ data.info.total_money }}</h3>
                        <p>ჩაირიცხა</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-coins"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ data.info.total_hr_bonus }}</h3>

                        <p>ჰრ_ის ბონუსი</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ data.info.agree_count }}</h3>

                        <p>დადასტურებული</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-check"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ data.info.agree_no_count }}</h3>

                        <p>დასადასტურებელი</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-times"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
        </div>
        <enrolled_table :items="items"></enrolled_table>


    <!-- <div class="mt-2">
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
            >
        </paginate>
    </div> -->

  <!-- </section> -->
</template>
<script>
import Paginate from 'vuejs-paginate-next';
import enrolled_table from '../component/enrolled_table.vue'
export default {
    components:{
        Paginate,
        enrolled_table
    },
    props:{
        data:Object
    },
    data() {
        return {
            colspan: 'hide',
            pagination:{
                current_page: 1,
                last_page: 2,
            },
            getDataType:'first_data',
            items:{}
        }
    },
    computed:{

    },
    created() {
        console.log('data', this.data);
        this.getData()
    },
    methods: {
        getData(){
            if (this.getDataType == 'first_data') {
                this.firstData()
            } else if (this.getDataType == 'filter') {
                this.filter(this.m)
            }

        },
        firstData(){

            this.pagination = {
                    'current_page':this.data.items.current_page,
                    'last_page': this.data.items.last_page
                }
            this.items = this.data.items.data
        },
        filterMeth(type,m){
            this.getDataType = type
            if (this.getDataType == 'filter') {
                this.filter(m)
            }
        },
        filter(m){

        }
    },
    watch:{

    },
}
</script>
<style lang="">

</style>
