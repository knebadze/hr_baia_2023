<template lang="">
    <Upload_avatar v-if="role_id != 3 && stepIndex == 0" :auth="componentData.model" :key="stepIndex"></Upload_avatar>
     <div class=" m-b30 employerPageBorder" :class="data.role_id == 3? 'col-xl-9 col-lg-8 col-md-12':'col-xl-12 col-lg-12 col-md-12'">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <!-- <form-wizard @on-complete="onComplete"
                      :start-index="1"
                      step-size="xs"  color="#094899">
                <tab-content v-for="(item, index) in stepComponents" :key="index" icon="">
                    My first tab content
                </tab-content>

            </form-wizard> -->
            <form-wizard color="#094899"  step-size="xs" :start-index="Number(startIndex)">
                <!-- Access WizardStep Component directly with all props  -->
                <template v-slot:step="props">
                    <wizard-step
                        :tab="props.tab"
                        :transition="props.transition"
                        :index="props.index"
                        @click="navigateTo(props)"
                    >
                    <!-- props.navigateToTab(props.index) -->
                        <small style="color: blue; font-size: 12px; margin: auto 1px">
                            {{ props.index + 1 }}
                            <!-- <i :class={{ props.index }}></i> -->
                        </small>
                    </wizard-step>
                </template>

                <!-- title slot  -->
                <!-- <template #title>
                    <div><h3>Custom Slot Title</h3></div>
                </template> -->
                <!-- <tab-content v-for="(item, index) in stepComponents" :key="index" :before-change="beforeTabSwitch">
                    {{ index }}
                    <section class="form-wizard-sample-card">
                        <component  :is="activeComponent" v-if="activeComponent"  :data="componentData" :ref="item.ref" @validateAndEmit="handleFormValidation" ></component>
                    </section>

                </tab-content> -->

                <tab-content icon="fa fa-user" >
                    <section class="form-wizard-sample-card">
                        <main_info v-if="stepIndex == 0" :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation" />
                    </section>
                </tab-content>
                <tab-content icon="fa fa-user"  >
                    <section class="form-wizard-sample-card" >
                        <candidate_information v-if="stepIndex == 1"  :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>
                <tab-content icon="fa fa-map" >
                    <section class="form-wizard-sample-card">
                        <candidate_address v-if="stepIndex == 2"  :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>
                <tab-content icon="fa fa-language" >
                    <section class="form-wizard-sample-card">
                        <candidate_language v-if="stepIndex == 3"  :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>
                <tab-content icon="fa fa-phone" >
                    <section class="form-wizard-sample-card">
                        <additional_number v-if="stepIndex == 4" :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>
                <tab-content icon="fa fa-user" >
                    <section class="form-wizard-sample-card">
                        <general_work_Information v-if="stepIndex == 5"  :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>
                <tab-content icon="fa fa-dollar-sign" >
                    <section class="form-wizard-sample-card">
                        <work_information v-if="stepIndex == 6" :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>
                <tab-content icon="fa fa-users" >
                    <section class="form-wizard-sample-card">
                        <family_work_experience v-if="stepIndex == 7" :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>
                <tab-content icon="fa fa-user" >
                    <section class="form-wizard-sample-card">
                        <candidate_recommendation v-if="stepIndex == 8" :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>
                <tab-content icon="fa fa-list-alt">
                    <section class="form-wizard-sample-card">
                        <candidate_notice v-if="stepIndex == 9" :data="componentData" ref="childRefComponent" @validateAndEmit="handleFormValidation"/>
                    </section>
                </tab-content>

                <template v-slot:footer="props">
                    <div class="wizard-footer-left">
                        <button
                        v-if="props.activeTabIndex > 0 "
                            :style="props.fillButtonStyle"
                            @click="prevStep(props)"
                            class="site-button"
                        >
                            უკან დაბრუნება
                        </button>
                    </div>
                    <div class="wizard-footer-right">
                        <button
                            v-if="!props.isLastStep"
                            @click="nextStep(props)"
                            class="site-button"
                            :style="props.fillButtonStyle"
                        >
                            შემდეგი
                        </button>

                        <button
                            v-else-if="startIndex != 9"
                            @click="confirmMethod"
                            class="site-button"
                            :style="props.fillButtonStyle"
                        >
                            {{ props.isLastStep ? "დავასრულე" : "შემდეგი" }}
                        </button>
                    </div>
                </template>
            </form-wizard>
        </div>
     </div>
</template>
<script>
    import { ref, computed} from 'vue';
    import { I18n } from 'laravel-vue-i18n';
    import main_info from '../component/main_info.vue';
    import candidate_information from '../component/candidate_information.vue';
    import candidate_address from '../component/candidate_address.vue';
    import candidate_language from '../component/candidate_language.vue';
    import general_work_Information from '../component/general_work_Information.vue';
    import additional_number from '../component/additional_number.vue';
    import candidate_notice from '../component/candidate_notice.vue';

    import work_information from '../component/work_information.vue'
    import family_work_experience from '../component/family_work_experience.vue'
    import candidate_recommendation from '../component/candidate_recommendation.vue'
    import Swal from 'sweetalert2';
    import Upload_avatar from '../../user/upload_avatar.vue';
export default {
    // emits: ['validateAndEmit'],
    components:{
        main_info,
        candidate_information,
        candidate_address,
        candidate_language,
        general_work_Information,
        additional_number,
        candidate_notice,
        work_information,
        family_work_experience,
        candidate_recommendation,
        Upload_avatar
    },
    props: {
        data: Object,
        role_id: Number
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        console.log(props.data.model);
        const stepComponents = computed(() => {
            return [
                { component:'main_info', icon: 'fa fa-user' },
                {component:'candidate_information',  icon: 'fa fa-user'},
                {component:'candidate_address',  icon: 'fa fa-map'},
                {component:'candidate_language',  icon: 'fa fa-language'},
                {component:'additional_number',  icon: 'fa fa-phone'},
                {component:'general_work_Information',  icon: 'fa fa-user'},
                {component:'work_information',  icon: 'fa fa-dollar-sign'},
                {component:'family_work_experience',  icon: 'fa fa-user'},
                {component:'candidate_recommendation', icon: 'fa fa-user'},
                {component:'candidate_notice', icon: 'fa fa-list-alt'},

            ]
        });

        const startIndex = ref(props.data.model.stage);
        const stepIndex = ref(startIndex.value);
        const activeComponent = ref(null);
        const componentData = ref({});
        const isValid = ref(false);
        const mainInfoComponent = ref(null);
        const childRefComponent = ref(null);
        const userId = ref(props.data.model.user_id)
        const state = ref(0)

        let stepProps = null



        const changeComponent = (model = {...props.data.model}) => {
            // let module = await import(`../component/${stepComponents.value[stepIndex].component}.vue`);
            // activeComponent.value = markRaw(module.default);
            componentData.value = {
                model: model,
                cla: {...props.data.classificatory}
            }
        };
        changeComponent();


        const handleFormValidation = async (valid, formData, type, saveButton) => {

            try{
                if (valid) {
                    if(saveButton &&  formData) {
                        let submit = await submitForm(formData, type);

                        if (submit.status === 200) {

                            toast.success("ინფორმაცია წარმატებით შეინახა", {
                                theme: 'colored',
                                autoClose: 1500,
                            });
                        }
                    }
                    action()
                }else {
                    toast.error("შეავსეთ სავალდებულო ველები", {
                        theme: 'colored',
                        autoClose: 2000,
                    });
                }


            } catch(err) {
                console.log(err);
            }

            isValid.value = valid
        };

        const nextStep = async (props) => {
            stepProps = props;
            state.value = 1;
            childRefComponent.value.validateAndEmit()

        }

        const prevStep = (props) => {
            state.value = 0
            stepProps = props;
            action()
        };

        const findModel = async (step, candidate_id = null) => {
            try {
                return await axios({
                    method: "post",
                    url: "/find_candidate_model",
                    data: {stage: step, user_id: userId.value, candidate_id: candidate_id },
                })
            } catch (error) {
                console.log('error', error);
                console.error(error);
                throw error; // Rethrow the error to be caught in the caller (nextStep)
            }
        };

        const submitForm = async (data, type) => {

            data['lang'] = getLang.value;
            try {
                return await axios.post("/add_candidate", {
                    model: data,
                    type: type,
                });
            } catch (error) {
                console.log('error', error);
                console.error(error);
                throw error; // Rethrow the error to be caught in the caller (nextStep)
            }
        };

        const action = async (setIndex = null) => {
            try {
                let index = setIndex !== null? setIndex :state.value == 1 ? stepIndex.value + 1 : stepIndex.value - 1;

                let find = await findModel(index);
                console.log('find', find);
                changeComponent(find.data.data);

                if (setIndex === null) {
                    if(state.value == 1) {
                        stepProps.nextTab()

                    } else {
                        stepProps.prevTab()
                    }
                }
                stepIndex.value = index
                window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
            } catch (error) {
                console.log('error', error);
                console.error(error);
                throw error; // Rethrow the error to be caught in the caller (nextStep)
            }

        }
        const confirmMethod = () => {
            if (props.data.role_id != 3) {
                let url = new URL( location.href)
                window.location.replace(`${url.origin}/admin/candidate`);
                return
            }
            Swal.fire(
                {
                    title: '<p>გილოცავთ თქვენ დაასრულეთ ინფორმაციის შევსება</p>',
                    icon: 'info',
                    html:
                        '',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: 'რეზიუმეს ნახვა',
                    cancelButtonText: 'ვაკანსიების ნახვა',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.replace(`/${getLang.value}/user/myrezume`)
                }else if (result.dismiss === "cancel") {
                    window.location.replace(`/${getLang.value}/job`)
                }
            })
        }

        const navigateTo = async (props) =>{
            if (startIndex.value  >= props.index) {
                action(props.index)
                props.navigateToTab(props.index)
            }
        }

        return {
            getLang,
            stepComponents,
            stepIndex,
            startIndex,
            componentData,
            activeComponent,
            handleFormValidation,
            mainInfoComponent,
            childRefComponent,
            nextStep,
            prevStep,
            confirmMethod,
            navigateTo
        };
    },
};
</script>


