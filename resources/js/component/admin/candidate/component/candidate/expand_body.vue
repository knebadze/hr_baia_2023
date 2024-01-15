<template lang="">
     <div class="card-body">
        <div class="row d-flex justify-content-between">
            <div>
                <img :src="'/storage/'+item.user.avatar" alt="#" style="height:100px">
            </div>

            <div>
                <p><i class="fa fa-user mr-1"></i>{{ item.user.name_ka }}</p>
                <p><i class="fa fa-user mr-1"></i>{{ item.age }}</p>
                <p><i class="fa fa-phone mr-1"></i>{{ item.user.number }}</p>
            </div>

            <div>
                <p :class="`rounded-top bg-${item.status.color} `">{{ item.status.name_ka }}</p>
                <p :class="(item.registration_fee == 0)?'rounded-top bg-warning ':'rounded-top bg-success '" >{{ (item.registration_fee == 0)?'გადასახდელი':'გადახდილი' }}</p>
                <!-- <p>{{ item.created_at }}</p> -->
                <span class="text-primary" v-for="(i, index) in item.get_work_information" :key="index" ><u style="cursor: pointer;" @click="openInfoModal('category', item.get_work_information[index])">{{ i.category.name_ka+', ' }}</u></span>
            </div>

        </div>

            <hr>
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">ID:</dt>
                        <dd class="col-sm-8">{{ item.id }}</dd>
                        <div class="row col-12" v-if="item.user.register_log">
                            <dt class="col-sm-4">რეგისტრაციის ტიპი:</dt>
                            <dd class="col-sm-8">{{ (item.user.register_log.type == 1)?'ფასიანი რეგისტრაცია':'უფასო რეგისტრაცია' }} </dd>
                        </div>
                        <dt class="col-sm-4">პირადი ნომერი:</dt>
                        <dd class="col-sm-8">{{ item.personal_number }}</dd>
                        <dt class="col-sm-4">ეროვნება:</dt>
                        <dd class="col-sm-8">{{ item.nationality.name_ka }}</dd>
                        <dt class="col-sm-4">მოქალაქეობა:</dt>
                        <dd class="col-sm-8">{{ item.citizenship.map(i => i.name_ka).join(', ') }}</dd>
                        <dt class="col-sm-4">რელიგია:</dt>
                        <dd class="col-sm-8">{{ item.religion.name_ka }}</dd>
                        <dt class="col-sm-4">ოჯახური მდგომარეობა:</dt>
                        <dd class="col-sm-8">{{ item.marital_status.name_ka }}</dd>
                        <div class="row col-12" v-if="item.children">
                            <dt class="col-sm-4">შვილები:</dt>
                            <dd class="col-sm-8">{{ item.children+' - '+item.children_age }} </dd>
                        </div>
                        <div class="row col-12" v-if="item.spouse">
                            <dt class="col-sm-4">მეუღლე:</dt>
                            <dd class="col-sm-8">{{ item.spouse }} </dd>
                        </div>
                        <dt class="col-sm-4">განათლება:</dt>
                        <dd class="col-sm-8">{{ item.education.name_ka }}</dd>
                        <dt class="col-sm-4">პროფესია:</dt>
                        <dd class="col-sm-8">{{ item.professions.map(i => i.name_ka).join(', ') }}</dd>
                        <dt class="col-sm-4">სპეციალობა:</dt>
                        <dd class="col-sm-8">{{ item.specialty.map(i => i.name_ka).join(', ') }}</dd>
                        <dt class="col-sm-4">უცხო ენა:</dt>
                        <dd class="col-sm-8">{{ item.get_language.map(i => i.language.name_ka+ ' - '+ i.level.name_ka ).join(', ') }}</dd>
                        <div class="row col-12" v-if="item.driving_license">
                            <dt class="col-sm-4">მართვის მოწმობა:</dt>
                            <dd class="col-sm-8">{{ item.driving_license.map(i => i.name).join(', ') }} </dd>
                        </div>
                        <div class="row col-12" v-if="item.allergy">
                            <dt class="col-sm-4">ალერგია:</dt>
                            <dd class="col-sm-8">{{ item.allergy.map(i => i.name_ka).join(', ') }} </dd>
                        </div>
                        <dt class="col-sm-4">სამუშაი გამოცდილება:</dt>
                        <dd class="col-sm-8 text-primary" @click="openInfoModal('general_work', item.general_work_experience)"><u style="cursor: pointer;">{{ (item.general_work_experience == 0)?'არა':'კი' }}</u></dd>
                        <dt class="col-sm-4">ოჯახში მუშაობის გამოცდილება:</dt>
                        <dd class="col-sm-8 text-primary" @click="openInfoModal('family_work', item.family_work_experience)"><u style="cursor: pointer;">{{ (item.family_work_experience == 0)?'არა':'კი' }}</u></dd>


                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">დამატების თარიღი:</dt>
                        <dd class="col-sm-8">{{ item.created_at }}</dd>
                        <dt class="col-sm-4">სიმაღლე:</dt>
                        <dd class="col-sm-8">{{ item.height+' სმ' }}</dd>
                        <dt class="col-sm-4">წონა:</dt>
                        <dd class="col-sm-8">{{ item.weight+ ' კგ' }}</dd>
                        <dt class="col-sm-4">მოწევა:</dt>
                        <dd class="col-sm-8">{{ (item.smoke == 0)?'არა':'კი' }}</dd>
                        <dt class="col-sm-4">ნასამართლეობა:</dt>
                        <dd class="col-sm-8">{{ (item.convection  == 0)?'არა':'კი' }}</dd>
                        <dt class="col-sm-4">საზღვარგარეთ მუშაობა:</dt>
                        <dd class="col-sm-8">{{ (item.work_abroad == 0)?'არა':'კი' }}</dd>
                        <div class="row col-12" v-if="item.characteristic">
                            <dt class="col-sm-4">მახასიათებლები:</dt>
                            <dd class="col-sm-8">{{ item.characteristic.map(i => i.name_ka).join(', ') }} </dd>
                        </div>
                        <dt class="col-sm-4">დაბადების თარიღი:</dt>
                        <dd class="col-sm-8">{{ item.user.date_of_birth }}</dd>
                        <div class="row col-12" v-if="item.medical_info_ka">
                            <dt class="col-sm-4">მახასიათებლები:</dt>
                            <dd class="col-sm-8">{{ item.medical_info_ka }} </dd>
                        </div>

                        <dt class="col-sm-4">რეკომენდაცია:</dt>
                        <dd class="col-sm-8 text-primary" @click="openInfoModal('recommendation', item.recommendation)"><u style="cursor: pointer;">{{ (item.recommendation == 0)?'არა':'კი' }}</u></dd>

                    </dl>
                </div>
            </div>

        </div>
        <info_modal :visible="showInfoModal" :type="modalType" :items="modalItem" />
</template>
<script>
import info_modal from '../../modal/info_modal.vue';
import { ref } from 'vue';
export default {
    components:{
        info_modal
    },
    props:{
        item: Object,
    },
    setup(props) {
        const modalType = ref(null);
        const modalItem = ref(null);
        const showInfoModal = ref(false)

        const openInfoModal =(type, item) =>{
            modalType.value = type
            modalItem.value = item
            showInfoModal.value = !showInfoModal.value
        }
        return {
            openInfoModal,

            modalType,
            modalItem,
            showInfoModal
        }
    }
}
</script>
<style lang="">

</style>
