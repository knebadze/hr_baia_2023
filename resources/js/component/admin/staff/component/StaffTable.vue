<script setup>
import { ref, onMounted, computed } from "vue";
import switchButton from "../../../inc/Switch.vue";
import AddStaffModal from "../modal/AddStaffModal.vue";
import StaffViewAndUpdate from "../modal/StaffViewAndUpdate.vue";
import _ from "lodash";
import Swal from "sweetalert2";

const props = defineProps({
    data: Object,
    cla: Object,
    type: String,
    role: Number,
    fullPermission: Boolean,
    adminId: Number,
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

const activeCount = computed(() => {
    return props.data.filter((item) => item.is_active == 1).length;
});

const inactiveCount = computed(() => {
    return props.data.filter((item) => item.is_active == 0).length;
});

const deletedCount = computed(() => {
    return props.data.filter((item) => item.is_active == 2).length;
});
const DismissalFromService = (item) => {
    Swal.fire({
        title: "ნამდვილად გსურთ ამორიცხვა?",
        cancelButtonText: "არა",
        confirmButtonText: "კი",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            axios({
                method: "post",
                url: "/staff_dismissal_from_service",
                data: {
                    id: item.id,
                },
            })
                .then(function (response) {
                    if (response.status == 200) {
                        toast.success('წარმატებით შესრულდა', {
                            theme: "colored",
                            autoClose: 1000,
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        } else if (result.isDenied) {
            return;
        }
    });
};
onMounted(() => {});
</script>
<template lang="">
    <div class="card">
        <div class="card-header">
            <h3 class="mr-5 card-title">სულ: {{ data.length }}</h3>
            <h3 class="mr-5 card-title">აქტიური: {{ activeCount }}</h3>
            <h3 class="mr-5 card-title">არა აქტიური: {{ inactiveCount }}</h3>
            <h3 class="card-title">ამორიცხული: {{ deletedCount }}</h3>

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
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.number }}</td>
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
                                :disabled="
                                    !fullPermission && adminId != item.parent_id
                                "
                            /><span v-else class="text-sm text-danger"
                                ><strong>ამორიცხული</strong></span
                            >
                        </td>
                        <td>
                            <button
                                v-if="item.is_active != 2"
                                class="btn btn-info"
                                @click="openViewModal(item)"
                                :disabled="
                                    !fullPermission && adminId != item.parent_id
                                "
                                title="ნახვა/რედაქტირება"
                            >
                                <i class="fa fa-eye"></i> +
                                <i class="fa fa-pen"></i>
                            </button>
                            <button
                                v-if="item.is_active != 2"
                                class="btn btn-danger ml-2"
                                @click="DismissalFromService(item)"
                                :disabled="
                                    !fullPermission && adminId != item.parent_id
                                "
                                title="ამორიცხვა"
                            >
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <AddStaffModal
        :visible="showAddModal"
        :role="role"
        :cla="cla"
    ></AddStaffModal>
    <StaffViewAndUpdate
        :visible="showViewModal"
        :data="viewData"
        :cla="cla"
    ></StaffViewAndUpdate>
</template>

<style lang=""></style>
