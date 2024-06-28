<script setup>
import { ref, onMounted } from "vue";
import switchButton from "../../../inc/Switch.vue";
import AddStaffModal from "../modal/AddStaffModal.vue";
import StaffViewAndUpdate from "../modal/StaffViewAndUpdate.vue";
import _ from "lodash";

const props = defineProps({
    data: Object,
    cla: Object,
    type: String,
    role: Number,
});
const emit = defineEmits(["is_active"]);
const showAddModal = ref(false);
const showViewModal = ref(false);
const viewData = ref({});

const openAddModal = () => {
    showAddModal.value = !showAddModal.value;
};

const openViewModal = (data) => {
    viewData.value = data;
    showViewModal.value = !showViewModal.value;
};

const isActiveUpdate = (item, index) => {
    axios({
        method: "post",
        url: "/staff_is_active_update",
        data: {
            id: item.id,
            hr_id: item.hr_d,
            is_active: item.is_active == 1 ? 0 : 1,
        },
    })
        .then(function (response) {
            emit("is_active", response.data["is_active"], index);
            if (response.status == 200) {
                toast.success(response.data.message, {
                    theme: "colored",
                    autoClose: 1000,
                });
            }
        })
        .catch(function (error) {
            console.log(error);
        });
};

onMounted(() => {});
</script>
<template lang="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">სულ: {{ data.length }}</h3>

            <div class="card-tools">
                <button
                    type="submit"
                    class="btn btn-primary"
                    @click="openAddModal()"
                >
                    <i class="fas fa-plus"></i> დამატება
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>სახელი გვარი</th>
                        <th>კორპ. ნომერი</th>
                        <th>შიდა ნომერი</th>
                        <th>საკ. ნომერი</th>
                        <th>ფილიალი</th>
                        <th>სტაჟიორი</th>
                        <th>სტატუსი</th>
                        <th>ნახვა/რედაქტირება</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.k_mobile }}</td>
                        <td>
                            {{ item.inside_number }}
                        </td>
                        <td>{{ item.mobile }}</td>
                        <td>
                            {{ item.branch_name }}
                        </td>
                        <td>{{ item.internship == 1 ? "კი" : "არა" }}</td>
                        <td>
                            <switchButton
                                v-if="item.is_active != 2"
                                v-model:checked="item.switch"
                                label=""
                                @click.self="isActiveUpdate(item, index)"
                            /><span v-else class="text-sm text-danger"
                                ><strong>ამორიცხული</strong></span
                            >
                        </td>
                        <td>
                            <button
                                v-if="item.is_active != 2"
                                class="btn btn-info"
                                @click="openViewModal(item)"
                            >
                                <i class="fa fa-eye"></i> +
                                <i class="fa fa-pen"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <AddStaffModal :visible="showAddModal" :role="role" :cla="cla"></AddStaffModal>
    <StaffViewAndUpdate
        :visible="showViewModal"
        :data="viewData"
        :cla="cla"
    ></StaffViewAndUpdate>
</template>

<style lang=""></style>
