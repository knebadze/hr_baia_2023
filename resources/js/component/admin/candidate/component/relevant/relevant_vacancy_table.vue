<template lang="">
    <div class="table-responsive">
        <div class="d-flex justify-content-end" v-if="checkedRow.length > 0">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    გაგზავნა
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" @click="sendVacancies(1)">ნომერზე</a>
                    <a class="dropdown-item" href="#" @click="sendVacancies(2)">მაილზე</a>
                    <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </div>
        </div>
        
        <table class="table twm-table table-striped table-border">
            <thead>
                <tr>
                    <th>
                        <div class="form-check" style="margin-top: -20px">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="exampleCheck1" 
                                v-model="allChecked"
                                @change="toggleAll"
                            >
                        </div>
                    </th>
                    <th>ID</th>
                    <th>შემკვეთი</th>
                    <th>კატეგორია</th>
                    <th>ანაზღაურება</th>
                    <th>გრაფიკი</th>
                    <th>მისამართი</th>
                    <th>სტატუსი</th>
                    <!-- <th>ტიპი</th> -->
                    <th>დამატების თარიღი</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="items.length > 0" v-for="(item, index) in items" :key="index">
                    <td>
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                :id="'checkbox-' + index" 
                                :value="item.code" 
                                @change="handleCheckboxChange(item)"
                                :checked="checkedRow.includes(item.code)"
                            >
                        </div>
                    </td>
                    <td><u class="text-primary" @click="openModal(item.id)">{{ item.code }}</u></td>
                    <td>{{ item.employer.name_ka }}</td>
                    <td>{{ item.category.name_ka }}</td>
                    <td>{{ item.payment }}</td>
                    <td>{{ item.work_schedule.name_ka }}</td>
                    <td>{{ item.employer.address_ka }}</td>
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
import Swal from "sweetalert2";
import { ref, computed } from 'vue';
export default {
    components:{
        vacancyFullInfoModal
    },
    props:{
        items: Object,
        candidate: Object
    },
    setup(props) {
        const modalShow = ref(false);
        const vacancy_id = ref(null);
        const checkedRow = ref([]);
        const allChecked = ref(false)
        const openModal = (id) =>{
            modalShow.value = !modalShow.value
            vacancy_id.value = id
        }

        const handleCheckboxChange = (item) => {
            const index = checkedRow.value.indexOf(item.code);
            if (index > -1) {
                // If item is already in the array, remove it
                checkedRow.value.splice(index, 1);
            } else {
                // If item is not in the array, add it
                checkedRow.value.push(item.code);
            }
        };

        const toggleAll = () => {
            if (allChecked.value) {
                checkedRow.value = props.items.map(item => item.code);
            } else {
                checkedRow.value = [];
            }
        };
        const sendVacancies = (type) => {
            let typeText = 'ნომერზე'
            let to = props.candidate.number
            if(type == 2){
                typeText = 'მაილზე'
                to = props.candidate.email
            }
            console.log(checkedRow.value);
            Swal.fire({
                title: `ნამდვილად გსურთ ვაკანსიების გაგზავნა ${typeText}?`,
                cancelButtonText: "არა",
                confirmButtonText: "დიახ",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/send_vacancy_to_candidate', {
                        to: to,
                        ids: checkedRow.value,
                        type: type
                    })
                    .then(response => {
                        console.log('Vacancy sent successfully:', response);
                    })
                    .catch(error => {
                        console.error('Error sending vacancy:', error);
                    });
                } else if (result.isDismissed) {
                    return;
                }
            });
        }
        return{
            modalShow,
            vacancy_id,
            checkedRow,
            allChecked,
            openModal,
            handleCheckboxChange,
            toggleAll,
            sendVacancies
        }
    }
}
</script>
<style lang="">

</style>
