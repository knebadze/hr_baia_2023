<template lang="">
    <div class="card-body">
        <div class="row d-flex justify-content-between">
            <div>
                <img
                    :src="'/storage/' + item.user.avatar"
                    alt="#"
                    style="height: 100px"
                />
            </div>

            <div>
                <p><i class="fa fa-user mr-1"></i>{{ item.user.name_ka }}</p>
                <p><i class="fa fa-user mr-1"></i>{{ item.age }}</p>
                <p><i class="fa fa-phone mr-1"></i>{{ item.user.number }}</p>
            </div>

            <div>
                <p :class="`px-2 rounded-top bg-${item.status.color} `">
                    {{ item.status.name_ka }}
                </p>
                <p
                    :class="
                        item.registration_fee == 0
                            ? 'rounded-top bg-warning '
                            : 'rounded-top bg-success '
                    "
                    class="px-2"
                >
                    {{
                        item.registration_fee == 0 ? "გადასახდელი" : "გადახდილი"
                    }}
                </p>
                <!-- <p>{{ item.created_at }}</p> -->
                <span
                    class="text-primary"
                    v-for="(i, index) in item.get_work_information"
                    :key="index"
                    ><u
                        style="cursor: pointer"
                        @click="
                            openInfoModal(
                                'category',
                                item.get_work_information[index]
                            )
                        "
                        >{{ i.category.name_ka + ", " }}</u
                    ></span
                >
            </div>
        </div>

        <hr />
        <div class="row">
            <div class="col-md-6">
                <dl class="row">
                    <dt class="col-sm-4">ID:</dt>
                    <dd class="col-sm-8">{{ item.id }}</dd>
                    <div class="row col-12" v-if="item.user.register_log">
                        <dt class="col-sm-4">რეგისტრაციის ტიპი:</dt>
                        <dd class="col-sm-8">
                            {{
                                item.user.register_log.type == 1
                                    ? "ფასიანი რეგისტრაცია"
                                    : "უფასო რეგისტრაცია"
                            }}
                        </dd>
                        <dt class="col-sm-4">დაარეგისტრირა:</dt>
                        <dd class="col-sm-8">
                            {{ item.user.register_log.creator.name_ka }}
                        </dd>
                    </div>
                    <dt class="col-sm-4">პირადი ნომერი:</dt>
                    <dd
                        class="col-sm-8"
                        :class="{ 'text-danger': !item.personal_number }"
                    >
                        {{
                            item.personal_number
                                ? item.personal_number
                                : "უცნობია"
                        }}
                    </dd>
                    <dt class="col-sm-4">მისამართი:</dt>
                    <dd class="col-sm-8">
                        {{ `${item.address_ka} ${item.street_ka}` }}
                    </dd>
                    <dt class="col-sm-4">მაილი:</dt>
                    <dd class="col-sm-8">
                        {{ item.user.email }}
                    </dd>
                    <dt class="col-sm-4">ეროვნება:</dt>
                    <dd class="col-sm-8">{{ item.nationality.name_ka }}</dd>
                    <dt class="col-sm-4">მოქალაქეობა:</dt>
                    <dd class="col-sm-8">
                        {{ item.citizenship.map((i) => i.name_ka).join(", ") }}
                    </dd>
                    <dt class="col-sm-4">რელიგია:</dt>
                    <dd class="col-sm-8">{{ item.religion.name_ka }}</dd>
                    <dt class="col-sm-4">ოჯახური მდგომარეობა:</dt>
                    <dd class="col-sm-8">{{ item.marital_status.name_ka }}</dd>
                    <div class="row col-12" v-if="item.children">
                        <dt class="col-sm-4">შვილები:</dt>
                        <dd class="col-sm-8">
                            {{ item.children + " - " + item.children_age }}
                        </dd>
                    </div>
                    <div class="row col-12" v-if="item.spouse">
                        <dt class="col-sm-4">მეუღლე:</dt>
                        <dd class="col-sm-8">{{ item.spouse }}</dd>
                    </div>
                    <dt class="col-sm-4">განათლება:</dt>
                    <dd class="col-sm-8">{{ item.education.name_ka }}</dd>
                    <dt class="col-sm-4">პროფესია:</dt>
                    <dd class="col-sm-8">
                        {{ item.professions.map((i) => i.name_ka).join(", ") }}
                    </dd>
                    <dt class="col-sm-4">სპეციალობა:</dt>
                    <dd class="col-sm-8">
                        {{ item.specialty.map((i) => i.name_ka).join(", ") }}
                    </dd>
                    <dt class="col-sm-4">უცხო ენა:</dt>
                    <dd class="col-sm-8">
                        {{
                            item.get_language
                                .map(
                                    (i) =>
                                        i.language.name_ka +
                                        " - " +
                                        i.level.name_ka
                                )
                                .join(", ")
                        }}
                    </dd>
                    <div class="row col-12" v-if="item.driving_license">
                        <dt class="col-sm-4">მართვის მოწმობა:</dt>
                        <dd class="col-sm-8">
                            {{
                                item.driving_license.length > 0
                                    ? item.driving_license
                                          .map((i) => i.name)
                                          .join(", ")
                                    : "არ აქვს"
                            }}
                        </dd>
                    </div>
                    <div class="row col-12" v-if="item.allergy">
                        <dt class="col-sm-4">ალერგია:</dt>
                        <dd class="col-sm-8">
                            {{
                                item.allergy.length > 0
                                    ? item.allergy
                                          .map((i) => i.name_ka)
                                          .join(", ")
                                    : "არცერთზე"
                            }}
                        </dd>
                    </div>
                    <div class="row col-12">
                        <dt class="col-sm-4">facebook:</dt>
                        <dd class="col-sm-8">
                            <a
                                v-if="item.fb_link"
                                class="text-primary"
                                :href="item.fb_link"
                                target="_blank"
                                ><u>ეწვიეთ ლინკს</u></a
                            >
                            <span v-else>არ აქვს</span>
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="col-md-6">
                <dl class="row">
                    <dt class="col-sm-4">დამატების თარიღი:</dt>
                    <dd class="col-sm-8">{{ item.created_at }}</dd>
                    <dt class="col-sm-4">სიმაღლე:</dt>
                    <dd class="col-sm-8">{{ item.height + " სმ" }}</dd>
                    <dt class="col-sm-4">წონა:</dt>
                    <dd class="col-sm-8">{{ item.weight + " კგ" }}</dd>
                    <dt class="col-sm-4">მწეველი:</dt>
                    <dd class="col-sm-8">
                        {{ item.smoke == 0 ? "არა" : "კი" }}
                    </dd>
                    <dt class="col-sm-4">ნასამართლეობა:</dt>
                    <dd class="col-sm-8">
                        {{ item.convection == 0 ? "არა" : "კი" }}
                    </dd>
                    <dt class="col-sm-4">საზღვარგარეთ მუშაობა:</dt>
                    <dd class="col-sm-8">
                        {{ item.work_abroad == 0 ? "არა" : "კი" }}
                    </dd>
                    <div class="row col-12" v-if="item.characteristic">
                        <dt class="col-sm-4">მახასიათებლები:</dt>
                        <dd class="col-sm-8">
                            {{
                                item.characteristic
                                    .map((i) => i.name_ka)
                                    .join(", ")
                            }}
                        </dd>
                    </div>
                    <dt class="col-sm-4">დაბადების თარიღი:</dt>
                    <dd class="col-sm-8">{{ item.user.date_of_birth }}</dd>
                    <div class="row col-12" v-if="item.medical_info_ka">
                        <dt class="col-sm-4">სამედიცინო:</dt>
                        <dd class="col-sm-8">{{ item.medical_info_ka }}</dd>
                    </div>

                    <dt class="col-sm-4">რეკომენდაცია:</dt>
                    <dd
                        class="col-sm-8"
                        :class="
                            item.recommendation.length > 0
                                ? 'text-primary'
                                : 'text-danger'
                        "
                        @click="
                            openInfoModal('recommendation', item.recommendation)
                        "
                    >
                        <u style="cursor: pointer">{{
                            item.recommendation.length > 0
                                ? item.recommendation[0].has_recommendation == 0
                                    ? "არა"
                                    : "კი"
                                : "ინფორმაცია ვერ მოიძებნა"
                        }}</u>
                    </dd>
                    <div class="col-12 d-flex align-items-center p-0">
                        <dt class="col-sm-4">სამუშაი გამოცდილება:</dt>
                        <dd
                            class="col-sm-8"
                            :class="
                                item.general_work_experience.length > 0
                                    ? 'text-primary'
                                    : 'text-danger'
                            "
                            @click="
                                item.general_work_experience.length > 0 &&
                                    openInfoModal(
                                        'general_work',
                                        item.general_work_experience
                                    )
                            "
                        >
                            <u style="cursor: pointer">{{
                                item.general_work_experience.length > 0
                                    ? item.general_work_experience == 0
                                        ? "არა"
                                        : "კი"
                                    : "ინფორმაცია ვერ მოიძებნა"
                            }}</u>
                        </dd>
                    </div>
                    <div class="col-12 d-flex align-items-center p-0">
                        <dt class="col-sm-4">ოჯახში მუშაობის გამოცდილება:</dt>
                        <dd
                            class="col-sm-8"
                            :class="
                                item.family_work_experience
                                    ? 'text-primary'
                                    : 'text-danger'
                            "
                            @click="
                                item.family_work_experience &&
                                    openInfoModal(
                                        'family_work',
                                        item.family_work_experience
                                    )
                            "
                        >
                            <u style="cursor: pointer">{{
                                item.family_work_experience.experience == 2
                                    ? "არა"
                                    : item.family_work_experience === null
                                    ? "ინფორმაცია ვერ მოიძებნა"
                                    : "კი"
                            }}</u>
                        </dd>
                    </div>
                    <div class="col-12 d-flex align-items-center p-0">
                        <dt class="col-sm-4">დამატებით ნომრები:</dt>
                        <dd class="col-sm-8">
                            {{
                                item.number && item.number.length > 0
                                    ? item.number
                                          .map(
                                              (i) =>
                                                  `${i.number_owner.name_ka} - ${i.number}`
                                          )
                                          .join(", ")
                                    : "ინფორმაცია ვერ მოიძებნა"
                            }}
                        </dd>
                    </div>
                    <div
                        class="col-12 d-flex align-items-center p-0"
                        v-if="item.status_id == 12"
                    >
                        <dt class="col-sm-4">შავსიაში დამატების მიზეზი:</dt>
                        <dd class="col-sm-8">
                            {{
                                `${item.user.blacklist.ground.name_ka}, ${item.user.blacklist.comment}`
                            }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div
                class="col-12 border-top"
                v-if="filteredQualifyingCandidates.length"
            >
                <dl>
                    <div v-for="(item, index) in filteredQualifyingCandidates" :key="index">
                        <dt class="col-4">აქტიურია ვაკანსიებში:</dt>
                        <dd class="col-8">
                            <span class="" @click="openVacancyFullModal(item.vacancy.id)">{{ item.vacancy.code }}</span> - 
                            {{ item.qualifying_type.name }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
    <info_modal :visible="showInfoModal" :type="modalType" :items="modalItem" />
    <!-- <vacancyFullInfoModal :visible="modalVacancyFullShow" :vacancyId="vacancy_id" /> -->
</template>
<script>
import { ref, computed } from "vue";
import info_modal from "../../modal/info_modal.vue";
// import vacancy_full_info_modal from "../../../vacancy/modal/vacancyFullInfoModal.vue";

export default {
    components: {
        info_modal,
        // vacancy_full_info_modal
    },
    props: {
        item: Object,
    },
    setup(props) {
        console.log(props.item);
        const modalType = ref(null);
        const modalItem = ref(null);
        const showInfoModal = ref(false);
        const openInfoModal = (type, item) => {
            modalType.value = type;
            modalItem.value = item;
            showInfoModal.value = !showInfoModal.value;
        };
        const modalVacancyFullShow = ref(false);
        const vacancy_id = ref(null);
        const openVacancyFullModal = (id) => {
            modalVacancyFullShow.value = !modalVacancyFullShow.value;
            vacancy_id.value = id;
        };
        const filteredQualifyingCandidates = computed(() => {
            return props.item.qualifying_candidate.filter((candidate) => {
                return (
                    [5, 6, 7, 8].includes(candidate.qualifying_type_id) &&
                    (candidate.status_id === 17 || candidate.status_id === null)
                );
            });
        });

        return {
            openInfoModal,
            modalType,
            modalItem,
            showInfoModal,
            filteredQualifyingCandidates,
            modalVacancyFullShow,
            vacancy_id,
            openVacancyFullModal
        };
    },
};
</script>
<style lang=""></style>
