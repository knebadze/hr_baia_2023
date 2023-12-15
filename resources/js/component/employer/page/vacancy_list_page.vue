<template lang="">
    <div class="section-full p-t120  p-b90 site-bg-white">


        <div class="container">
            <div class="row">
                <vacancy_user_filter :cla="data.classificatory" @emitFilterData="handleFilterData"></vacancy_user_filter>
                <div class="col-lg-8 col-md-12">
                    <vacancy :items="vacancy" :auth="auth"></vacancy>
                    <div class="pagination-outer">
                        <div class="pagination-style1">
                            <paginate
                                v-model="pagination.current_page"
                                :page-count="pagination.last_page"
                                :page-range="3"
                                :margin-pages="2"
                                :click-handler="getData"
                                :prev-text="'<<'"
                                :next-text="'>>'"
                                :container-class="'pagination'"
                                :page-class="'page-item'"
                                >
                            </paginate>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>

import Paginate from 'vuejs-paginate-next';
import axios from 'axios';
import _ from 'lodash'
import { ref, computed } from 'vue';

import vacancy_user_filter from '../components/list/vacancy_user_filter.vue';
import vacancy from '../components/list/vacancy_list.vue';
export default {
    components:{
        vacancy_user_filter,
        Paginate,
        vacancy
    },
    props:{
        data:Object
    },
    setup(props) {
        const getLang = computed(() => {
            return I18n.getSharedInstance().options.lang;
        });
        let getDataType = 'first_data'
        const pagination = ref({});
        const vacancy = ref(null)
        const staticVacancy = ref(null)
        const auth = ref(null)

        const firstData = () =>{

            pagination.value = {
                'current_page': props.data.vacancy.current_page,
                'last_page': props.data.vacancy.last_page
            };
            vacancy.value = props.data.vacancy.data;
            staticVacancy.value = props.data.vacancy.data;
            auth.value = props.data.auth;
        };

        const handleFilterData = (item) =>{
            getDataType = item ? 'filter':'first_data'
            getData(item)
        };

        const filter = (newVal) =>{
            axios({
                    method: "post",
                    url: '/vacancy_filter?page=' + pagination.value.current_page,
                    data: newVal,

                })
                .then(function (response) {
                    pagination.value = {
                            current_page: response.data.vacancy.current_page,
                            last_page: response.data.vacancy.last_page
                        }
                        vacancy.value = response.data.vacancy.data

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        };

        const getData = (item = null) =>{
            if (getDataType == 'first_data') {
                firstData()
            } else if (getDataType == 'filter') {
                filter(item)
            }
        };

        getData()

        return{
            getLang,
            pagination,
            vacancy,
            staticVacancy,
            auth,
            handleFilterData,
            getData
        }
    }
}
</script>
<style lang="">

</style>
