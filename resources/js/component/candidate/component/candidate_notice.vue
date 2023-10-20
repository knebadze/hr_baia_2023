<template lang="">
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_references_title') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_references_name_notice') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="model.notice" :options="cla.notices" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_references_file') }} (PDF ფორმატში)</label>
                        <div class="ls-inputicon-box">
                            <input type="file" class="form-control" ref="fileInput" @change="handleFileChange" :placeholder="$t('lang.user_profile_page_medical_please_info')"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="text-right ">
                        <button class="btn btn-success"
                            @click.prevent="add(model)"
                            title="დამატება"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            :disabled="send"
                        >{{ $t('lang.user_profile_page_references_button_add_info') }}
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>
                <div v-if="m.length != 0" class="col-lg-12 col-md-12">
                    <div class="panel-body wt-panel-body">
                        <div class="p-a20 table-responsive">
                            <table class="table twm-table table-striped table-borderless">
                                <thead>
                                    <tr>
                                    <th>N</th>
                                    <th>{{ $t('lang.user_profile_page_references_reference') }}</th>
                                    <th>{{ $t('lang.user_profile_page_references_file') }}</th>
                                    <th>{{ $t('lang.user_profile_page_references_action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.notice[`name_${getLang}`] }}</td>
                                    <td> <a v-on:click="openPDF(item.file_path)" ><u class="text-primary">{{ item.file }}</u></a> </td>
                                    <td>
                                        <button @click="remove(index, item.id)" title="delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import { ref, computed, watch } from 'vue';
import { I18n } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
// import { useVuelidate } from '@vuelidate/core';
// import { required, numeric, maxLength } from '@vuelidate/validators';
export default {
    emits: ['validateAndEmit'],
    props: {
        data: Object,
    },
    setup(props, { emit }) {
        const send = ref(false)
        const file = ref(null);
        const showNoRecommendation = ref(false);
        const cla = ref(_.cloneDeep(props.data.cla))
        console.log(cla.value);
        const formData = {notice: ''};

        const m = ref(props.data.model)

        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });


        formData.lang = getLang;
        formData.user_id = props.data.user_id
        const model = ref(formData)

        const filterNotice = () =>{
            let ids = m.value.map(item => item.notice_id)
            cla.value.notices = props.data.cla.notices.filter((element) => !ids.includes(element.id));
        }
        if (m.value.length > 0) {
            filterNotice()
        }

        const handleFileChange = (event) => {
            file.value = event.target.files[0];
            model.value.file_name = file.value.name
        };

        const openPDF = (item) => {
            const pdfUrl = `/storage/${item}`;
            window.open(pdfUrl, '_blank');
        };

        const add = (item) =>{
            send.value = true
            let data = {...item}
            data['file'] = (file.value)?file.value.name:null
            if (m.value.length > 0 && data.notice.id != 6 && m.value.some((element) => element.notice.id === item.notice.id)) {
                toast.warning("ცნობა უკვე ატვირთულია შესაცვლელად წაშალეთ ძველი ცნობა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false
                return
            }
            if (file.value != null && file.value.type !== 'application/pdf') {
                toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false
                return
            }
            if (!file.value || data.notice == '') {
                toast.error("ყველა ველის შევსება სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false
                return
            }

            data.candidate_id = props.data.candidate_id
            const sendFormData = new FormData();
            sendFormData.append('data', JSON.stringify(data))
            if (file.value) {
                sendFormData.append('file', file.value);
            }
            validateAndSubmit(sendFormData, data)

        }
        const validateAndSubmit = (formData, data) => {

            axios.post('/add_candidate_file', formData)
            .then(function (response) {
                if (response.data.status == 200) {
                    m.value = response.data.data
                    filterNotice()
                    model.value.notice = "";
                    model.value.file = "";
                    send.value = false
                    toast.success("ინფორმაცია წარმატებით შეინახა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        };
        const validateAndEmit = () => {
            const isFormValid = true ;
            emit("validateAndEmit", isFormValid);
        };

        const remove = (index, id) =>{
            Swal.fire({
                title: 'ნამდვილად გსურთ წაშლა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const removed = m.value.splice(index, 1);
                    filterNotice()
                    axios({
                        method: "post",
                        url: "/delete_candidate_info",
                        data: {id: id, type: 'notice'},

                    })
                    .then(function (response) {
                        if (response.status == 200) {
                            toast.success("წარმატებით წაიშალა", {
                                theme: 'colored',
                                autoClose: 1000,
                            });
                        }

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    // this.hide()

                } else if (result.isDenied) {
                    return
                }
            });
        }

        return {
            m,
            model,
            cla,
            // v,
            validateAndSubmit,
            add,
            getLang,
            validateAndEmit,
            // chooseNumberCode,
            handleFileChange,
            showNoRecommendation,
            openPDF,
            send,
            remove

        };
    },
    methods: {

    },
};
</script>
<style lang="">

</style>
