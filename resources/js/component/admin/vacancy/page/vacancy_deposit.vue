<template lang="">
    <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">ჩანართები</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">კანდიდატის ჩარიცხვა</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">დამსაქმებლის ჩარიცხვა</a></li>
                  <li v-if="data.register" class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">რეგისტრაციის ჩარიცხვა</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</template>
<script>
import { ref, computed, } from 'vue';
export default {
    props:{
        data: Object
    },
    setup(props) {
        const m = ref({...props.data.deposit})
        console.log(m.value);

        return {
            m,
        }
    }

}
</script>
<style lang="">

</style>
