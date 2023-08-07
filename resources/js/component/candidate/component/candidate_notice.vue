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
                            <multiselect v-model="candidateNoticeModel.notice" :options="cla.notices" deselect-label="Can't remove this value" :track-by="`name_${getLang}`" :label="`name_${getLang}`" placeholder="Select one"  :searchable="true" :allow-empty="false">
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
                        @click="addNotice(candidateNoticeModel)"
                        title="დამატება" data-bs-toggle="tooltip" data-bs-placement="top">{{ $t('lang.user_profile_page_references_button_add_info') }}
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
export default {
    props:{
        data: Object,

    },
    data() {
        return {
            m:null,
            cla: null,
            candidateNoticeModel:{
                'notice':'',
            },
            file: null
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
    },
    methods: {
        handleFileChange(event) {
            this.file = event.target.files[0];
        },
        addNotice(item){

            item['file'] = (this.file)?this.file.name:null
            if (this.m.length > 0 && this.m.some((element) => element.notice.id === item.notice.id)) {
                toast.warning("ცნობა უკვე ატვირთულია შესაცვლელად წაშალეთ ძველი ცნობა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            if (this.file != null && this.file.type !== 'application/pdf') {
                toast.error("გთხოვთ ფაილი ატვირთეთ pdf ფორმატში", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }

            if (this.file == null || item.notice == '') {
                toast.error("ყველა ველის შევსება სავალდებულოა", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }

            this.m.push(JSON.parse(JSON.stringify(item)))
            this.add(item)
            this.candidateNoticeModel.notice = '';
            this.candidateNoticeModel.file= ''
        },
        add(item){
            item.user_id = this.data.user_id

            const formData = new FormData();
            formData.append('data', JSON.stringify(item))
            if (this.file) {
                formData.append('file', this.file);
            }
            console.log('item',item);
            let currentObj = this;
            axios.post('/add_candidate_file', formData)
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
        remove(index, id){
            const removed = this.m.splice(index, 1);
            axios({
                method: "post",
                url: "/delete_candidate_info",
                data: {'id':id, 'type': 'notice'},

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
        openPDF(item) {
            const pdfUrl = `/storage/${item}`;
            window.open(pdfUrl, '_blank');
        },
    },
    watch:{

    }
}
</script>
<style lang="">

</style>
