<template lang="">
     <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_foreign_lang_title') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <div class="d-flex justify-content-between border border-info p-2 mb-2">
                <span>შეგიძლიათ დაამატოთ {{ limit }} უცხო ენა</span>
                <span>{{ m.length }} / {{ limit }}</span>
            </div>
            <p v-if="m.length == 0" class="text-danger">* {{ $t('პირველ რიგში მიუთით მშობლიური ენა') }}</p>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_foreign_lang_language') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="model.language"
                                :options="cla.languages"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                placeholder="Select one"
                                :searchable="true"
                                :allow-empty="false"
                                :disabled="m.length == limit"
                            >
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_foreign_lang_level') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect
                                v-model="model.level"
                                :options="cla.languageLevels"
                                deselect-label="Can't remove this value"
                                :track-by="`name_${getLang}`"
                                :label="`name_${getLang}`"
                                placeholder="Select one"
                                :searchable="true"
                                :allow-empty="false"
                                :disabled="m.length == 0 || m.length == limit"
                            >
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
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
                            :disabled="send || m.length == limit"
                        >{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>
                <div v-if="m.length != 0" >
                    <div class="panel-body wt-panel-body">
                        <div class="p-a20 table-responsive">
                            <table class="table twm-table table-striped table-borderless">
                                <thead>
                                    <tr>
                                    <th>N</th>
                                    <th>{{ $t('lang.user_profile_page_foreign_lang_language_lang') }}</th>
                                    <th>{{ $t('lang.user_profile_page_foreign_lang_language_level') }}</th>
                                    <th>{{ $t('lang.user_profile_page_foreign_lang_language_action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.language[`name_${getLang}`] }}</td>
                                    <td>{{ item.level[`name_${getLang}`] }}</td>
                                    <td>
                                        <button @click="remove(index, item.id)" class="" title="delete" >
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
export default {
    emits: ['validateAndEmit'],
    props: {
        data: Object,
    },
    setup(props, { emit }) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const limit = ref(5);
        const send = ref(false);
        const cla = ref({...props.data.cla})
        const formData = props.data.model.get_language;
        formData.lang = getLang;

        const m = ref(formData);
        const model = ref({
            language: '',
            level:''
        });

        const languageFilter = (id = null) =>{
            let ids = m.value.map(item => item.language_id)
            if (id) {
                ids.push(id)
            }
            cla.value.languages = props.data.cla.languages.filter((element) => !ids.includes(element.id));
        }

        if (m.value.length == 0) {
            model.value.level = props.data.cla.languageLevels.find((element) => element.id == 1);
        }else{
            cla.value.languageLevels = props.data.cla.languageLevels.filter((element) => element.id != 1);
            languageFilter()
        }

        const add = (item) =>{
            send.value = true;
            let data = {...item}
            if (m.value.length == 0 && data.level.id != 1) {
                toast.error("გთხოვთ დაამატოთ მშობლიური ენა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false;
                return
            }
            if (!data.language || !data.level) {
                toast.error("აუცილებელია ორივე პარამეტრის შევსება", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false;
                return
            }
            if (m.value.length > 0 && m.value.some((element) => element.language.id == data.language.id)) {
                toast.info("არჩეული ენა უკვე დაამატეთ", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false;
                return
            }

            if (m.value.length > 0 && m.value.some((element) => data.level.id == 1 && element.level.id == data.level.id)) {
                toast.error("არ შეიძლება ორი მშობლიური ენის დამატება", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                send.value = false;
                return
            }

            validateAndSubmit(data)
            languageFilter(data.language.id)
            if (data.level.id == 1) {
                cla.value.languageLevels = props.data.cla.languageLevels.filter((element) => element.id != 1);
            }
            model.value.language = '';
            model.value.level = '';

        }


        const validateAndSubmit = (item) => {
            axios({
                method: "post",
                url: "/add_candidate",
                data: {'model':item, 'type': 'language', 'user_id': props.data.model.user_id},

            })
            .then(function (response) {
                if (response.data.status == 200) {
                    send.value = false;
                    m.value = response.data.data;
                    toast.success("ინფორმაცია წარმატებით შეინახა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });

                }
            })
            .catch(function (error) {
                // handle error
                send.value = false;
                console.log(error);
            })

        };

        const validateAndEmit = () => {
            const isFormValid = m.value.length > 0;
            emit("validateAndEmit", isFormValid);
        }

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
                    if (m.value.length == 0) {
                        cla.value.languages = props.data.cla.languages;
                        model.value.level = props.data.cla.languageLevels.find((element) => element.id == 1);
                    }else{
                        languageFilter()
                    }
                    axios({
                        method: "post",
                        url: "/delete_candidate_info",
                        data: {id: id, type: 'language'},

                    })
                    .then(function (response) {
                        if (response.data.status == 200) {
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

                } else if (result.isDenied) {
                    return
                }
            });


        }


        return {
            m,
            model,
            cla,
            validateAndSubmit,
            add,
            getLang,
            validateAndEmit,
            send,
            limit,
            remove

        };
    },
    methods: {
    },
};
</script>
