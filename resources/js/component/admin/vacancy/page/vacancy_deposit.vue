<template lang="">
    <div class="row">
        <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3">ჩანართები</h3>
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                href="#tab_1"
                                data-toggle="tab"
                                >კანდიდატის ჩარიცხვა</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_2" data-toggle="tab"
                                >დამსაქმებლის ჩარიცხვა</a
                            >
                        </li>
                        <li v-if="data.register" class="nav-item">
                            <a class="nav-link" href="#tab_3" data-toggle="tab"
                                >რეგისტრაციის ჩარიცხვა</a
                            >
                        </li>
                    </ul>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <deposit_tab
                                :item="candidateModel"
                                :author="depositAuthor"
                                :enrollment="candidateEnrollment"
                                :status="data.status"
                                :type="'candidate'"
                                :adminViewAndPermission="adminViewAndPermission"
                                :auth="auth"
                                :cancelDepositClassificatory="cancelDepositClassificatory"
                                @redacted="handleRedacted"
                                @save="handleSave"
                                @send="handelSend"
                            ></deposit_tab>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <deposit_tab
                                :item="employerModel"
                                :author="depositAuthor"
                                :enrollment="employerEnrollment"
                                :status="data.status"
                                :type="'employer'"
                                :adminViewAndPermission="adminViewAndPermission"
                                :auth="auth"
                                :cancelDepositClassificatory="cancelDepositClassificatory"
                                @redacted="handleRedacted"
                                @save="handleSave"
                                @send="handelSend"
                            ></deposit_tab>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <component
                                v-if="data.register"
                                :is="registerEnrollmentComponent"
                                :item="componentItem"
                                :adminViewAndPermission="adminViewAndPermission"
                                :auth="auth"
                                :cancelDepositClassificatory="cancelDepositClassificatory"
                            ></component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { markRaw } from "vue";
import { ref, computed } from "vue";
import Swal from "sweetalert2";
import deposit_tab from "../component/deposit_tab.vue";
export default {
    emits: ["redacted", "save"],
    components: {
        deposit_tab,
    },
    props: {
        data: Object,
    },
    setup(props) {
        console.log('props.data',props.data);

        const model = ref({ ...props.data.deposit });
        const depositAuthor = ref(props.data.employer);
        const registerEnrollmentComponent = ref(null);
        const cancelDepositClassificatory = ref(props.data.reasonsCl);
        console.log('cancelDepositClassificatory', cancelDepositClassificatory.value);

        const componentItem = ref(null);
        const adminViewAndPermission = ref({
            ...props.data.adminViewAndPermission,
        });
        const auth = ref({ ...props.data.auth });
        const registerEnrollment = async () => {
            if (!registerEnrollmentComponent.value) {
                let module = await import(
                    "../component/registration_enrollment.vue"
                );
                registerEnrollmentComponent.value = markRaw(module.default);
            }

            componentItem.value = props.data.register;
            componentItem.value.name = depositAuthor.value;
            componentItem.value.vacancy_id = model.value.vacancy_id;
            componentItem.value.hr_parent_id = model.value.hr_parent_id;
        };
        props.data.register ? registerEnrollment() : null;
        const candidateModel = computed(() => {
            const {
                id,
                vacancy_id,
                candidate_initial_amount,
                must_be_enrolled_candidate,
                must_be_enrolled_candidate_date,
                hr_parent_id,
                candidate_cancel_reason_id,
                candidate_cancel_reason
            } = model.value;
            return {
                id,
                vacancy_id,
                initial_amount: candidate_initial_amount,
                must_be_enrolled: must_be_enrolled_candidate,
                must_be_enrolled_date: must_be_enrolled_candidate_date,
                hr_parent_id,
                cancel_reason_id: candidate_cancel_reason_id,
                cancel_reason: candidate_cancel_reason
            };
        });
        const employerModel = computed(() => {
            const {
                id,
                vacancy_id,
                employer_initial_amount,
                must_be_enrolled_employer,
                must_be_enrolled_employer_date,
                hr_parent_id,
                employer_cancel_reason_id,
                employer_cancel_reason
            } = model.value;
            return {
                id,
                vacancy_id,
                initial_amount: employer_initial_amount,
                must_be_enrolled: must_be_enrolled_employer,
                must_be_enrolled_date: must_be_enrolled_employer_date,
                hr_parent_id,
                cancel_reason_id: employer_cancel_reason_id,
                cancel_reason: employer_cancel_reason

            };
        });
        const candidateEnrollment = computed(() => {
            let find = null;
            if (props.data.enrollment) {
                find = _.find(props.data.enrollment, function (o) {
                    return o.who_is_counting == 1;
                });
            }
            return find;
        });

        const employerEnrollment = computed(() => {
            let find = null;
            if (props.data.enrollment) {
                find = _.find(props.data.enrollment, function (o) {
                    return o.who_is_counting == 2;
                });
            }
            return find;
        });

        const handleRedacted = (updatedModel, type) => {
            Swal.fire({
                title: "ნამდვილად გსურთ რედაქტირება?",
                //   showDenyButton: true,
                cancelButtonText: "არა",
                confirmButtonText: "კი",
                showCancelButton: true,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    // return
                    axios
                        .post("/update_vacancy_deposit", {
                            data: { model: updatedModel, type: type },
                        })
                        .then(function (response) {
                            // handle success
                            if (response.status == 200) {
                                toast.success("წარმატებით დარედაქტირდა", {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
                                setTimeout(() => {
                                    document.location.reload();
                                }, 2000);
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    // this.hide()
                } else if (result.isDenied) {
                    return;
                }
            });
        };

        const handleSave = (updatedModel, type) => {
            Swal.fire({
                title: "ნამდვილად გსურთ ვაკანსიის ჩარიცხვის შენახვა?",
                //   showDenyButton: true,
                cancelButtonText: "არა",
                confirmButtonText: "კი",
                showCancelButton: true,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios
                        .post("/save_vacancy_deposit", {
                            data: { model: updatedModel, type: type },
                        })
                        .then(function (response) {
                            // handle success
                            if (response.status == 200) {
                                toast.success("წარმატებით შეინახა", {
                                    theme: "colored",
                                    autoClose: 1000,
                                });
                                setTimeout(() => {
                                    document.location.reload();
                                }, 2000);
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    // this.hide()
                } else if (result.isDenied) {
                    return;
                }
            });
        };
        const handelSend = (formData) => {
            axios
                .post("/vacancy_enrollment", formData)
                .then(function (response) {
                    if (response.status == 200) {
                        toast.success("წარმატებით ჩაირიცხა", {
                            theme: "colored",
                            autoClose: 1000,
                        });
                        setTimeout(() => {
                            document.location.reload();
                        }, 2000);
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        };

        return {
            model,
            candidateModel,
            candidateEnrollment,
            depositAuthor,
            handleRedacted,
            handleSave,
            handelSend,

            employerModel,
            employerEnrollment,

            registerEnrollmentComponent,
            componentItem,
            adminViewAndPermission,
            auth,
            cancelDepositClassificatory
        };
    },
};
</script>
<style lang=""></style>
