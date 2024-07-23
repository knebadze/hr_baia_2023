<script setup>
import { reactive, ref } from "vue";
import vacancyFullInfoModal from "../vacancy/modal/vacancyFullInfoModal.vue";

const m = reactive({
    code: null,
    number: null,
    name: null,
});
const vacancies = ref([]);
const count = ref(0);
const filter = async () => {
    const result = await axios.post("/vacancy_dashboard_filter", m);
    const { data } = result;
    if (result.status == 200) {
        vacancies.value = data.vacancy.data;
    }
};
const vacancyFullInfoModalShow = ref(false);
const vacancyId = ref(null);
const openVacancyFullInfoModal = (id) => {
    vacancyId.value = id;
    vacancyFullInfoModalShow.value = !vacancyFullInfoModalShow.value;
};
const repeat = (item) =>{
    window.location.replace(
        `${location.origin}/ka/post_job/${item.id}/${item.code}`
    );
}
</script>
<template>
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header">
            <h3 class="card-title">ვაკანსიის ძებნა</h3>

            <div class="card-tools">
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                >
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row p-2">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="code">ID</label>
                        <input
                            type="text"
                            class="form-control"
                            id="code"
                            v-model="m.code"
                            onkeypress="return /[0-9]/i.test(event.key)"
                        />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="number">ნომერი</label>
                        <input
                            type="text"
                            class="form-control"
                            id="number"
                            v-model="m.number"
                            onkeypress="return /[0-9]/i.test(event.key)"
                        />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="name">სახელი გვარი</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            v-model="m.name"
                        />
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-success" @click="filter">
                        ძებნა
                    </button>
                </div>
            </div>
            <hr v-if="vacancies.length > 0"/>
            <div class="table-responsive" v-if="vacancies.length">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>დამსაქმებელი</th>
                            <th>ნომერი</th>
                            <th>კატეგორია</th>
                            <th>სტატუსი</th>
                            <th>HR</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in vacancies" :key="index">
                            <td>
                                <u
                                    @click="openVacancyFullInfoModal(item.id)"
                                    class="text-primary"
                                    role="button"
                                    >{{ item.code }}</u
                                >
                            </td>
                            <td>{{ item.employer.name_ka }}</td>
                            <td>{{ item.employer.number }}</td>
                            <td>
                                <span
                                    :class="`badge bg-${item.category.color} p-1`"
                                    >{{ item.category.name_ka }}</span
                                >
                            </td>
                            <td>
                                <span
                                    :class="`badge bg-${item.status.color} p-1`"
                                    >{{ item.status.name_ka }}</span
                                >
                            </td>
                            <td>{{ item.hr.name_ka }}</td>
                            <td>
                                <button class="btn btn-info" @click="repeat(item)" title="გამეორება"><i class="fa fa-recycle"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <vacancyFullInfoModal
            :visible="vacancyFullInfoModalShow"
            :vacancyId="vacancyId"
        ></vacancyFullInfoModal>
    </div>
</template>
