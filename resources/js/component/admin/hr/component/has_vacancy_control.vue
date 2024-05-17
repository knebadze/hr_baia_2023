<template lang="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ჰრ_ისთვის ვაკანსის მიცემის კონტროლი</h3>

            <div class="card-tools">
                <!-- <button type="submit" class="btn btn-primary" @click="openAddModal()">
                    <i class="fas fa-plus"></i> დამატება
                </button> -->
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
            <table class="table table-hover text-nowrap w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>სახელი გვარი</th>
                        <th>ვაკანსია მიიღო</th>
                        <th>გადაეწერა</th>
                        <th>სტატუსი</th>
                        <!-- <th>მოქმედება</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(item, index) in tableData"
                        :key="index"
                        :style="{ 'background-color': item.backgroundColor }"
                    >
                        <td>{{ item.id }}</td>
                        <td>{{ item.hr_name }}</td>
                        <td>{{ item.has_vacancy == 0 ? "არა" : "კი" }}</td>
                        <td>{{ item.re_write }}</td>
                        <td>
                            <span :class="getStatus(item.is_active).class">{{
                                getStatus(item.is_active).name
                            }}</span>
                        </td>
                        <!-- <td></td> -->
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <div
                    v-for="(item, index) in color"
                    :key="index"
                    class="mt-2 d-flex justify-content-between"
                >
                    <div
                        :style="{
                            'background-color': item,
                            height: '20px',
                            width: '20px',
                        }"
                    ></div>
                    <p>
                        {{
                            index == "other"
                                ? "სხვა"
                                : index == "is_no_active"
                                ? "არა აქტიური"
                                : index == "delete"
                                ? "ამორიცხული"
                                : index == "has_vacancy"
                                ? "მიიღო ვაკანსია"
                                : index == "is_in_line"
                                ? "რიგშია"
                                : "გადაეწერა"
                        }}
                    </p>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</template>
<script>
import { ref, computed } from "vue";
export default {
    props: {
        items: Object,
    },
    setup(props) {
        const data = ref(props.items);
        const color = ref({
            other: "#ddeedf",
            is_no_active: "#efbfc6",
            delete: "#85929E",
            has_vacancy: "#7dd87d",
            is_in_line: "#f8da5b",
            les_re_write: "#c51350",
        });
        const tableData = computed(() => {
            let smallestObject = _.minBy(
                _.filter(data.value, { is_active: 1 }),
                "re_write"
            );
            let smallestObjectWithHasZero = _.chain(data.value)
                .filter({ has_vacancy: 0, is_active: 1 })
                .minBy("id")
                .value();
            for (let i = 0; i < data.value.length; i++) {
                const currentItem = data.value[i];
                currentItem["backgroundColor"] = color.value.other;
                if (currentItem.is_active == 0) {
                    currentItem["backgroundColor"] = color.value.is_no_active;
                } else if (currentItem.is_active == 2) {
                    currentItem["backgroundColor"] = color.value.delete;
                } else if (currentItem.has_vacancy == 1) {
                    currentItem["backgroundColor"] = color.value.has_vacancy;
                }
                if (
                    currentItem.re_write < 0 &&
                    currentItem.id == smallestObject.id
                ) {
                    currentItem["backgroundColor"] = color.value.is_in_line;
                }
                if (
                    smallestObject.re_write == 0 &&
                    currentItem.id == smallestObjectWithHasZero.id
                ) {
                    currentItem["backgroundColor"] = color.value.is_in_line;
                }
                if (currentItem.re_write > 0) {
                    currentItem["backgroundColor"] = color.value.les_re_write;
                }
            }
            return data.value;
        });

        const getStatus = (id) => {
            if (id == 0) {
                return { class: "badge bg-danger p-1", name: "არააქტიური" };
            } else if (id == 1) {
                return { class: "badge bg-success p-1", name: "აქტიური" };
            } else {
                return { class: "badge bg-indigo p-1", name: "ამორიცხული" };
            }
        };
        return {
            tableData,
            color,
            getStatus,
        };
    },
};
</script>
<style lang=""></style>
