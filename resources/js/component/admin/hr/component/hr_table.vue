<template lang="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">HR - ების სია</h3>

            <div class="card-tools">
                <button type="submit" class="btn btn-primary" @click="openAddModal()">
                    <i class="fas fa-plus"></i> დამატება
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                <th>N</th>
                <th>სახელი გვარი</th>
                <th>კორპ. ნომერი</th>
                <th>შიდა ნომერი</th>
                <th>საკ. ნომერი</th>
                <th>ფილიალი</th>
                <th>სტაჟიორი</th>
                <th >სტატუსი</th>
                <th>ნახვა/რედაქტირება</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in data" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ item.name_ka }}</td>
                <td>{{ item.number }}</td>
                <td>{{ (item.hr)?item.hr.inside_number:'' }}</td>
                <td>{{ item.hr.mobile }}</td>
                <td>{{ item.hr.branch_id == 1?'ჯორჯაძე':'ფშაველა' }}</td>
                <td>{{ item.hr.internship == 1?'კი': 'არა' }}</td>
                <td><Switch v-if="item.is_active != 2"  v-model:checked="item.switch" label="" @click.self="isActiveUpdate(item)"/><span v-else class="text-sm text-danger">ამორიცხული</span></td>
                <td ><button v-if="item.is_active != 2" class="btn btn-info" @click="openViewModal(item)"><i class="fa fa-eye"></i> + <i class="fa fa-pen"></i></button></td>
                </tr>



            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <add_hr :visible="showAddModal" ></add_hr>
    <view_and_update :visible="showViewModal" :data="viewData"></view_and_update>
</template>
<script>
import add_hr from '../modal/add_hr.vue';
import Switch from '../../../inc/Switch.vue'
import view_and_update from '../modal/view_and_update.vue';
import _ from 'lodash';
export default {
    components:{
        add_hr,
        Switch,
        view_and_update
    },
    props:{
        data:Object
    },
    data() {
        return {
            showAddModal:false,
            showViewModal:false,
            viewData:{},
            hr:null
        }
    },
    created(){
        this.hr = {...this.data}
        _.forEach(this.hr, function(value) {
            if (value.is_active == 1) {
                value['switch'] = true
            }else{
                value['switch'] = false
            }
        });
    },
    methods: {
        openAddModal(){
            this.showAddModal = !this.showAddModal
        },
        openViewModal(data){
            this.viewData = data
            this.showViewModal = !this.showViewModal
        },
        isActiveUpdate(item){
            let currentObj = this;
            axios({
                method: "post",
                url: "/hr_is_active_update",
                data: {'id': item.id, 'hr_id':item.hr.id, 'is_active': (item.is_active == 1)?0:1},

            })
            .then(function (response) {
                // handle success
                if (response.status == 200) {
                    // currentObj.candidate_id = response.data.data;
                    toast.success(response.data, {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                    // alert()

                }


            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
    watch:{
        'item.switch': function (newVal, oldVal) {
        }
    }
}
</script>
<style lang="">

</style>
