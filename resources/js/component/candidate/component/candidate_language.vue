<template lang="">
     <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">{{ $t('lang.user_profile_page_foreign_lang_title') }}</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30 ">
            <p class="text-danger">* {{ $t('lang.user_profile_page_foreign_lang_language_comiitment') }}</p>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_foreign_lang_language') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="model.language" :options="cla.languages" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>{{ $t('lang.user_profile_page_foreign_lang_level') }}</label>
                        <div class="ls-inputicon-box">
                            <multiselect v-model="model.level" :options="cla.languageLevels" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
                                <template slot="singleLabel" slot-scope="{ option }"></template>
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="text-right ">
                        <button class="btn btn-success"
                        @click.prevent="addLanguage(model)"
                        title="დამატება" data-bs-toggle="tooltip"
                        data-bs-placement="top">{{ $t('lang.user_profile_page_foreign_lang_button_add_info') }}
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
export default {
    props:{
        data: Object,

    },
    data() {
        return {
            m:null,
            cla: null,
            model:{
                'language': '',
                'level':''
            }
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
        // this.m.user_id = this.data.user_id
        console.log('this.m,,,', this.m);
    },
    methods: {
        // async
        add(item){
            console.log('item',item);
            let currentObj = this;
            axios({
                method: "post",
                url: "/add_candidate",
                data: {'model':item, 'type': 'language', 'user_id': this.data.user_id},

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
        upsert(array, data, keyName) {
            try {
                const i = array.findIndex(_element => _element[keyName].id === data[keyName].id);
                if (i > -1) array[i] = { ...data }; // (2)
                else array.push(JSON.parse(JSON.stringify(data)));
            } catch (e) {
                array.splice(0, array.length)
                array.push(data);
            }
        },
        addLanguage(item){
            if (this.m.length == 0 && item.level.id != 1) {
                toast.error("გთხოვთ დაამატოთ მშობლიური ენა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            if (!item.language || !item.level) {
                toast.error("აუცილებელია ორივე პარამეტრის შევსება", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            if (this.m.length > 0 && this.m.some((element) => element.language.id === item.language.id)) {
                toast.warning("არჩეული ენა უკვე დაამატეთ", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            this.add(item)
            // this.upsert(this.m, {
            //     'language': item.language,
            //     'level': item.level,
            // }, "language");
            this.model.language = '';
            this.model.level = '';

        },
        remove(index, id){
            const removed = this.m.splice(index, 1);
            axios({
                method: "post",
                url: "/delete_candidate_info",
                data: {'id':id, 'type': 'language'},

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

        },
    },
    watch:{

    }
}
</script>
<style lang="">

</style>
