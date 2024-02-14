<template lang="">
    <div class="table-responsive">
        <table class="table twm-table table-striped table-border">
            <thead>
                <tr>
                    <th>
                        <div class="form-check" style="margin-top: -20px">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" v-model="allChecked">
                        </div>
                    </th>
                    <th>ID</th>
                    <th>შემკვეთი</th>
                    <th>კატეგორია</th>
                    <th>სტატუსი</th>
                    <!-- <th>ტიპი</th> -->
                    <th>დამატების თარიღი</th>
                </tr>
            </thead>

            <tbody>

                <tr v-if="items.length > 0" v-for="(item, index) in items" :key="index">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2" value="Jack" v-model="checkedRow">
                        </div>
                    </td>
                    <td><u class="text-primary" @click="openModal(item.id)">{{ item.code }}</u></td>
                    <td>{{ item.employer.name_ka }}</td>
                    <td>{{ item.category.name_ka }}</td>
                    <td>{{ item.status.name_ka }}</td>
                    <!-- <td>{{ item.qualifying_type.name }}</td> -->
                    <td>{{ item.created_at }}</td>
                    <!-- <td>
                        <button class="btn btn-info" @click="showModal(item)" title="დამატება" >
                            <i class="fa fa-plus"></i>
                        </button>
                    </td> -->
                </tr>
                <tr v-else>
                    <td colspan='6' class="text-center"> ვაკანსია ვერ მოიძებნა!!!</td>
                </tr>
            </tbody>
        </table>
    </div>
    <vacancyFullInfoModal :visible="modalShow" :vacancyId="vacancy_id"/>
</template>
<script>
import vacancyFullInfoModal from '../../../vacancy/modal/vacancyFullInfoModal.vue';
import { ref } from 'vue';
export default {
    components:{
        vacancyFullInfoModal
    },
    props:{
        items: Object
    },
    setup(props) {
        const modalShow = ref(false);
        const vacancy_id = ref(null);

        const openModal = (id) =>{
            modalShow.value = !modalShow.value
            vacancy_id.value = id
        }
        return{
            modalShow,
            vacancy_id,
            openModal
        }
    }
}
</script>
<style lang="">

</style>
