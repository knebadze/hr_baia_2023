<template lang="">
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_title') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_number') }}</label>
                        <div class="input-group mb-3">
                        <button style="border-style: none;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span :class="`fi fi-${numberCode.iso.toLowerCase()}`"></span>+{{ numberCode.phonecode }}</button>
                        <ul class="dropdown-menu" style=" overflow: hidden; overflow-y: auto; max-height: calc(100vh - 550px);">
                            <li v-for="item in cla.numberCode" @click="chooseNumberCode(item)"><a class="dropdown-item"><span :class="`fi fi-${item.iso.toLowerCase()}`"></span>+{{ item.phonecode }}</a></li>
                        </ul>
                        <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="candidateNumberModel.number" placeholder="555666777" onkeypress="return /[0-9]/i.test(event.key)" >

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_number_owner') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="candidateNumberModel.number_owner" :options="cla.numberOwner" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                            <!-- <span v-if="v$.candidateNumberModel.number_owner.required.$invalid && v$.candidateNumberModel.number_owner.$dirty" style='color:red'>* {{ v$.candidateNumberModel.number_owner.required.$message}}</span> -->
                        </div>

                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="text-right ">
                        <button class="btn btn-success"
                        @click="addNumber(numberCode, candidateNumberModel)"
                        title="Add Number" data-bs-toggle="tooltip"
                        data-bs-placement="top">{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
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
                                    <th>{{ $t('lang.user_profile_page_work_number_code') }}</th>
                                    <th>{{ $t('lang.user_profile_page_number') }}</th>
                                    <th>{{ $t('lang.user_profile_page_number_owner') }}</th>
                                    <th>{{ $t('lang.user_profile_page_work_number_actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in m">
                                    <td>{{ index + 1 }}</td>
                                    <td>+{{ item.number_code.phonecode }}</td>
                                    <td>{{ item.number }}</td>
                                    <td>{{ item.number_owner[`name_${getLang}`] }}</td>
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
import _ from 'lodash';
import { vModelRadio } from 'vue';
export default {
    props:{
        data: Object,

    },
    data() {
        return {
            m:null,
            cla: null,
            numberCode: {},
            candidateNumberModel:{
                'number':'',
                'number_owner':'',
            },
        }
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    created(){
        this.m = this.data.model
        this.cla = this.data.cla
        this.numberCode = _.find(this.cla.numberCode, function(o) { return o.phonecode == 995; });
        // this.m.user_id = this.data.user_id
    },
    methods: {
        // async
        add(item){
            console.log('item',item);
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_candidate",
                data: {'model':item, 'type': 'number', 'user_id': this.data.user_id},

            })
            .then(function (response) {
                console.log(response.data);
                if (response.data.status == 200) {
                    currentObj.m = response.data.data;
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
        },
        chooseNumberCode(item){
            this.numberCode = item;
        },
        addNumber(code, model){
            model['number_code'] = code
            console.log(model);
            if (model.number == '' || model.number_code == '' || model.number_owner == '') {
                toast.error("აუცილებელია ყველა პარამეტრის შევსება", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            this.m.push(JSON.parse(JSON.stringify(model)))
            this.add(model)
            this.candidateNumberModel.number = "";
            this.candidateNumberModel.number_owner = "";
        },
        remove(index, id){
            this.$swal({
                title: 'ნამდვილად გსურთ წაშლა?',
                //   showDenyButton: true,
                cancelButtonText:'არა',
                confirmButtonText: 'კი',
                showCancelButton: true,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const removed = this.m.splice(index, 1);
                    axios({
                        method: "post",
                        url: "/delete_candidate_info",
                        data: {'id':id, 'type': 'number'},

                    })
                    .then(function (response) {
                        // console.log(response.data);
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


        },
    },
    watch:{

    }
}
</script>
<style lang="">

</style>
