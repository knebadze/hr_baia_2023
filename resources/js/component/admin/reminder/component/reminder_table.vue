<template lang="">
      <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>ვაკანსისი ID</th>
                        <th v-if="role_id == 1">HR</th>
                        <th>შეხსენების მიზეზი</th>
                        <th>თარიღი</th>
                        <th>ტიპი</th>
                        <th>სტატუსი</th>
                        <th>მოქმედება</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in tableData" :key="index">
                        <td>{{ index + 1 }}.</td>
                        <td><u class="text-primary" @click="vacancyModal(item_id)">{{ item.code }}</u> </td>
                        <td v-if="role_id == 1">{{ item.hr_name}}</td>
                        <td>{{ item.reason }}</td>
                        <td>{{ item.date }}</td>
                        <td><span :class="item.main == 0 ?'badge badge-warning':'badge badge-danger'">{{ item.main == 0 ? 'ჩანაწერი': 'ძირითადი' }}</span></td>
                        <td>
                            <span v-if="item.status == 0" class="badge badge-danger">გადაცილებული</span>
                            <span v-if="item.status == 1" class="badge badge-warning">მიმდინარე</span>
                            <span v-if="item.status == 2" class="badge badge-success">შესრულებული</span>
                        </td>
                        <td>
                            <div v-if="role_id == 2 ">
                                <button
                                    type="button"
                                    class="btn btn-info"
                                    @click="item.main == 1 ?check(item): finishNote(item.id)"
                                    title="" v-if="item.status == 1"
                                ><i class="fa fa-check-square"></i> შევასრულე</button>
                            </div>
                            <div v-else>
                                <button
                                     type="button"
                                    class="btn btn-info mr-1"
                                    @click="item.main == 1 ?check(item): finishNote(item.id)"
                                    title="შევასრულე"
                                    v-if="item.status == 1"
                                ><i class="fa fa-check-square"></i> </button>
                                <button type="button" class="btn btn-success" @click="editModal(item)" title="რედაქტირება" ><i class="fa fa-pen"></i> </button>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <filledReminder  :visible="reminderModelShow" :item="modalItem"></filledReminder>
        <vacancyFullInfoModal :visible="vacancyModelShow" :vacancyId="vacancyId"></vacancyFullInfoModal>
        <reminderEdit  :visible="reminderEditModelShow" :item="modalItem"></reminderEdit>
</template>
<script>

import filledReminder from '../modal/filledReminder.vue'
import vacancyFullInfoModal from '../../../modal/vacancyFullInfoModal.vue'
import reminderEdit from '../modal/reminder_edit.vue'
import { ref, computed } from 'vue';
import moment from 'moment'
export default {
    components:{
        filledReminder,
        vacancyFullInfoModal,
        reminderEdit,
    },
    props:{
        items: Object,
        role_id: Number
    },
    setup(props) {
        const tableData = computed(() =>{
            for (let i = 0; i < props.items.length; i++) {
                // Access the element to update in each object
                const currentDateTime = moment();
                let baseDateTime = props.items[i].date;
                // Convert base time to a moment object
                let baseTimeMoment = moment(baseDateTime, "YYYY-MM-DD HH:mm");
                if (currentDateTime.isAfter(baseTimeMoment) ) {
                    // Current time is greater than the base time
                    if (props.items[i].active == 0) {
                        props.items[i]['status'] = 0
                    } else {
                        props.items[i]['status'] = 2
                    }
                } else if (currentDateTime.isBefore(baseTimeMoment) ) {
                    // Current time is less than the base time
                    if (props.items[i].active == 0) {
                        props.items[i]['status'] = 1
                    }else{
                        props.items[i]['status'] = 2
                    }
                }
            }
            return props.items
        })
        const reminderModelShow = ref(false);
        const vacancyModelShow = ref(false);
        const reminderEditModelShow = ref(null);
        const modalItem = ref(null);
        const vacancyId = ref(null);

        const check = (item) =>{
            axios({
                method: "post",
                url: "/check_main_reminder",
                data: {id:item.id, stage:item.main_stage_id, vacancy_id: item.vacancy_id },

            })
            .then(function (response) {
                // console.log(response.data);
                if (response.status == 200) {
                    if (response.data) {
                        remainderShow(item.id, item.vacancy_id)

                    }else{
                         toast.error("დავალება არ შეგისრულებიათ", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                    }

                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };
        const remainderShow = (id, vacancy_id) =>{
            reminderModelShow.value = !reminderModelShow.value
            modalItem.value = {
                id,
                vacancy_id
            }
        };
        const vacancyModal = (id) =>{
            vacancyModelShow.value = !vacancyModelShow.value
            vacancyId.value = id
        };
        const editModal = (item) =>{
            reminderEditModelShow.value = !reminderEditModelShow.value
            modalItem.value = item
        };
        const finishNote = (id) =>{
            axios({
                method: "post",
                url: "/finish_note",
                data: {id:id },

            })
            .then(function (response) {
                // console.log(response.data);
                if (response.status == 200) {
                    if (response.data) {
                        toast.success("წარმატებით შესრულდა", {
                            theme: 'colored',
                            autoClose: 1000,
                        });

                    }else{
                         toast.error("ვერ შესრულდა, სცადეთ მოგვიანებით", {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                    }

                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };



        return {
            tableData,

            reminderModelShow,
            vacancyModelShow,
            reminderEditModelShow,

            modalItem,
            vacancyId,

            check,
            vacancyModal,
            editModal,
            finishNote
        }
    }
}
</script>
<style lang="">

</style>
