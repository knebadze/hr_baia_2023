<template lang="">
   <div>
    <div class="row">
        <div class="col-md-2">
            <div class="input-group input-group-sm mb-3">
                <!-- <label> შეხსენების დრო </label> -->
                <input class="form-control" v-model="c_id" type="text" placeholder="კანდიდატის ID" @input="cIdEvent(c_id)" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group input-group-sm mb-3">
                <!-- <label> შეხსენების დრო </label> -->
                <input class="form-control" v-model="c_name"  type="text" placeholder="სახელი გვარი" @input="cNameEvent(c_name)">
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group input-group-sm mb-3">
                <!-- <label> შეხსენების დრო </label> -->
                <input class="form-control" v-model="v_id"  type="text" placeholder="ვაცანსიის ID" @input="vIdEvent(v_id)">
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group input-group-sm mb-3">
                <!-- <label> შეხსენების დრო </label> -->
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>კატეგორია...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group input-group-sm mb-3">
                <!-- <label> შეხსენების დრო </label> -->
                <input class="form-control"  type="date" placeholder="თარიღი" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group input-group-sm mb-3">
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>ტიპი...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">კანდიდატების სია ({{ count }})</h3>

        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
                </button>
            </div>
            </div>
        </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 600px;">
        <table class="table table-head-fixed text-wrap">
            <thead>
            <tr>
                <th>N</th>
                <th>
                    კანდიდატის ID
                </th>
                <th>სახელი გვარი</th>
                <th>ვაკანსიის ID</th>
                <th>კატეგორია</th>
                <th>თარიღი <i class="fa fa-sort" style="cursor: pointer;"></i></th>
                <th>ტიპი</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in arr" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ item.candidate.id }}</td>
                <td>{{ item.candidate.user.name_ka }}</td>
                <td>{{ item.vacancy.code }}</td>
                <td>{{ item.vacancy.category.name_ka }}</td>
                <td>{{ item.created_at }}</td>
                <td>{{ item.qualifying_type.name }} </td>
            </tr>

            </tbody>
        </table>
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
        </div> -->
    </div>
    <!-- /.card -->


  </div>
</template>
<script>
export default {
    props:{
        data: Object
    },
    data() {
        return {
            arr: null,
            count:0,
            c_id:'',
            c_name:'',
            v_id:''
        }
    },
    computed:{

    },

    created(){
        this.arr = this.data
        this.count = this.arr.length

    },
    methods:{
        cIdEvent(search) {
            let last = []
            if (this.arr.length != 0) {
                last = this.arr
            }

            if (search.length > 0) {
                this.arr = _.filter(this.arr, function(o) { return o.candidate_id == search });
                // this.arr = this.arr.filter(obj => obj.candidate_id.includes(search));
            }else{
                if(this.arr.length == 0 && last.length == 0){
                    this.arr = this.data
                }else{
                    this.arr = last
                }
            }
            this.count = this.arr.length
        },
        cNameEvent(search) {
            let last = []
            if (this.arr.length != 0) {
                last = this.arr
            }

            if (search.length > 0) {
                this.arr = this.arr.filter(obj => obj.candidate.user.name_ka.includes(search));
            }else{
                if(this.arr.length == 0 && last.length == 0){
                    this.arr = this.data
                }else{
                    this.arr = last
                }
            }
            this.count = this.arr.length
        },
        vIdEvent(search){
            let last = []
            if (this.arr.length != 0) {

                last = this.arr
                console.log('last',last);
            }

            if (search.length > 0 && this.arr.length == 0) {
                console.log('if last', last);
                this.arr = last
            }else if (search.length > 0) {
                console.log('if else', this.arr);
                // this.arr = _.filter(this.arr, function(o) { return o.vacancy.code == search });
                this.arr = this.arr.filter(obj => obj.vacancy.code.toString().includes(search));
                console.log('if else', this.arr);
            }else{
                if(this.arr.length == 0 && last.length == 0){
                    console.log('else if');
                    this.arr = this.data
                }else{
                    console.log('else else');
                    this.arr = last
                }
            }
            this.count = this.arr.length
        },
        hidePopover() {
            this.isPopoverVisible = false;
        }
    },
    mounted() {
        console.log('this.data', this.data);
    },
}
</script>

<style>
.hoverable {
  display: inline-block;
  position: relative;
}

.popover {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 999;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  padding: 10px;
  display: none;
}

.hoverable:hover .popover {
  display: block;
}
</style>
