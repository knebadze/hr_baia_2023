<template lang="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">HR - ების სია</h3>

            <div class="card-tools">
                <button type="submit" class="btn btn-primary" @click="openAddModal()">
                    <i class="fas fa-plus"></i> დამატება
                </button>
            <!-- <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
                </div>
            </div> -->
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                <th>ID</th>
                <th>User</th>
                <th>Date</th>
                <th>Status</th>
                <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>183</td>
                <td>John Doe</td>
                <td>11-7-2014</td>
                <td><span class="tag tag-success">Approved</span></td>
                <td>Bacon ipsum dolor </td>
                </tr>



            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <add_hr :visible="showAddModal" ></add_hr>
</template>
<script>
import add_hr from './modal/add_hr.vue';
export default {
    components:{
        add_hr
    },
    props:{

    },
    data() {
        return {
            showAddModal:false
        }
    },
    methods: {
        openAddModal(){
            this.showAddModal = !this.showAddModal
        }
    },
}
</script>
<style lang="">

</style>
