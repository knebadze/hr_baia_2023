<template lang="">
    <div class="col-md-12 m-b30" v-if="items">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
                <!--Basic Information-->
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i>თქვენი ვაკანსია</h4>
                </div>
                <div class="panel-body wt-panel-body m-b30 ">
                    <div class="twm-D_table p-a20 table-responsive">
                        <table id="" class="table table-bordered twm-bookmark-list-wrap">
                            <thead>
                                <tr>
                                    <th>კატეგორია</th>
                                    <th>გრაფიკი</th>
                                    <th>ანაზღაურება</th>
                                    <th>სტატუსი</th>
                                    <th>დაინტერესდნენ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--1-->
                                <tr v-for="(item, index) in items" :key="index">
                                    <td>{{ item.category[`name_${getLang}`] }}</td>

                                    <td>
                                        <span class="text-clr-green2">{{ item.work_schedule[`name_${getLang}`] }}</span>
                                    </td>
                                    <td>{{ `${item.payment} ${item.currency.icon}` }}</td>
                                    <td><div class="twm-jobs-category"><span class="twm-bg-green">{{ item.status[`name_${getLang}`] }}</span></div></td>
                                    <td class="d-flex justify-content-between">
                                        <a href="javascript:;" class="site-text-primary">{{  item.vacancy_interest.length }}</a>
                                        <button v-if="item.vacancy_interest.length > 0" class="btn btn-info btn-sm" @click="showInterest(item.id)">
                                            <i class="fa fa-eye text-white"></i>
                                        </button>
                                    </td>

                                    <td>
                                        <div class="twm-table-controls">
                                            <ul class="twm-DT-controls-icon list-unstyled">
                                                <li>
                                                    <a :href="`/${getLang}/show_vacancy/${item.code}`">
                                                        <span class="fa fa-eye"></span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <button title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <span class="far fa-trash-alt"></span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <interest_modal :visible="showInterestModal" :id="vacancyId" />
</template>
<script>
import interest_modal from '../../modal/interest_modal.vue';
import { ref, computed } from 'vue';
export default {
    components:{
        interest_modal
    },
    props:{
        items: Object
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        const showInterestModal = ref(false);
        const vacancyId = ref(null)
        const showInterest = (id) => {
            showInterestModal.value = !showInterestModal.value
            vacancyId.value = id
        }
        return {
            showInterestModal,
            vacancyId,
            getLang,
            showInterest
        }
    }
}
</script>
<style lang="">

</style>
