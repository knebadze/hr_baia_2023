<script setup>
import moment from "moment";
import { useUnfinishedRegistrationStore } from "../../../../store/admin/unfinishedRegistrationStore";
const unfinishedRegistrationStore = useUnfinishedRegistrationStore();
const { completed } = unfinishedRegistrationStore;
const props = defineProps({
    items: Object,
    role_id: Number,
});
const textClass = (date) => {
    const currentDate = moment();
    const itemDate = moment(date);
    const diffDays = currentDate.diff(itemDate, "days");
    return diffDays > 1;
};
const completedRegistration = (id) => {
    let url = new URL(location.href);
    window.location.replace(
        `${url.origin}/ka/user/userProfile?user=${id}`
    );
};
</script>
<template>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>#</th>
                <th>მომხმარებელი</th>
                <th>ნომერი</th>
                <th>ავტორი</th>
                <th v-if="role_id == 1">დაეწერა</th>
                <th>სტატუსი</th>
                <th>თარიღი</th>
                <th>მოქმედება</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in items" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ item.user }}</td>
                <td>{{ item.user_number }}</td>
                <td>{{ item.author }}</td>
                <td v-if="role_id == 1">{{ item.assigned }}</td>
                <td>
                    <span :class="`badge badge-${item.status_color}`">{{
                        item.status
                    }}</span>
                </td>
                <td :class="{ 'text-danger': textClass(item.created_at) }">
                    {{ item.created_at }}
                </td>
                <td>
                    <div class="dropdown">
                        <button
                            class="btn btn-primary dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="fa fa-cog"></i>
                        </button>
                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="dropdownMenuButton"
                        >
                            <a
                                class="dropdown-item"
                                href="#"
                                @click="completedRegistration(item.user_id)"
                                >დასრულება</a
                            >
                            <a
                                class="dropdown-item"
                                href="#"
                                @click="completed(item.id)"
                                >შევასრულე</a
                            >
                            <a
                                v-if="role_id == 1"
                                class="dropdown-item"
                                href="#"
                                @click="candidateDelete(item.id)"
                                >გადაწერა</a
                            >
                            <a
                                v-if="role_id == 1"
                                class="dropdown-item"
                                href="#"
                                @click="candidateDelete(item.id)"
                                >წაშლა</a
                            >
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
