<template lang="">
<div class="card-body">
    <div class="row ">
        <div class="col-md-4">
            <dl class="row">
                <dt class="col-sm-4">ID:</dt>
                <dd class="col-sm-8">{{ item.code }}</dd>
                <dt class="col-sm-4">კატეგორია:</dt>
                <dd class="col-sm-8"><span :class="`badge bg-${item.category.color} p-1`" >{{ item.category.name_ka }}</span></dd>
                <dt class="col-sm-4">გრაფიკი:</dt>
                <dd class="col-sm-8">{{ item.work_schedule.name_ka }}</dd>
            </dl>
        </div>

        <div class="col-md-4">
            <dl class="row">
                <dt class="col-sm-4">დამსაქმებელი:</dt>
                <dd class="col-sm-8">{{ item.employer.name_ka }}</dd>
                <dt class="col-sm-4">ნომერი:</dt>
                <dd class="col-sm-8">{{ item.employer.number }}</dd>
                <dt class="col-sm-4">სტატუსი:</dt>
                <dd class="col-sm-8"><span :class="`badge bg-${item.status.color} p-1`" >{{ item.status.name_ka }}</span></dd>
            </dl>
        </div>
        <div class="col-md-4">
            <dl class="row">
                <dt class="col-sm-4">ანაზღაურება:</dt>
                <dd class="col-sm-8">{{ `${item.payment} - ${item.currency.icon}` }}</dd>
                <dt class="col-sm-4">საჭიროება:</dt>
                <dd class="col-sm-8">{{ item.start_date }}</dd>
            </dl>
        </div>

    </div>

            <hr>
    <div class="row">
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-sm-4">HR:</dt>
                <dd class="col-sm-8">{{ item.hr.user.name_ka }}</dd>
                <dt class="col-sm-4">სათაური:</dt>
                <dd class="col-sm-8">{{ item.title_ka }}</dd>
                <dt class="col-sm-4">სამუშაო დღეები:</dt>
                <dd class="col-sm-8">{{ item.additional_schedule_ka }}</dd>
                <div class="row col-12" v-if="item.vacancy_for_who_need.length > 0">
                    <dt class="col-sm-4">ვისთვის ესაჭიროება:</dt>
                    <dd class="col-sm-8"><span> {{ item.vacancy_for_who_need.map(i => i.name_ka).join(', ') }}</span> </dd>
                </div>
                <div class="row col-12" v-if="item.vacancy_benefit.length > 0">
                    <dt class="col-sm-4">ბენეფიტები:</dt>
                    <dd class="col-sm-8"><span >{{ item.vacancy_benefit.map(i => i.name_ka).join(', ') }}</span> </dd>
                </div>
                <div class="row col-12" v-if="item.stay_night == 1 || item.go_vacation == 1 || item.work_additional_hours == 1">
                    <dt class="col-sm-4">უნდა შეეძლოს:</dt>
                    <dd class="col-sm-8">
                        <span v-if="item.stay_night == 1"> ღამე დარჩენა, </span>
                        <span v-if="item.go_vacation  == 1"> არდადეგებზე გაყოლა, </span>
                        <span v-if="item.work_additional_hours == 1"> დამატებითი საათები მუშაობა, </span>
                    </dd>
                </div>

                <div class="row col-12" v-if="item.vacancy_duty.length > 0">
                    <dt class="col-sm-4">მოვალეობები:</dt>
                    <dd class="col-sm-8"><span>{{ item.vacancy_duty.map(i => i.name_ka).join(', ') }}</span> </dd>
                </div>
                <div class="row col-12" v-if="item.demand && item.demand.additional_name_ka">
                    <dt class="col-sm-4">დამატებითი მოვალეობები:</dt>
                    <dd class="col-sm-8">{{ item.demand.additional_name_ka }} </dd>
                </div>
                <div class="row col-12" v-if="item.vacancy_driving_license.length > 0">
                    <dt class="col-sm-4">მართვის მოწმობა:</dt>
                    <dd class="col-sm-8"><span v-for="(i, index) in item.vacancy_driving_license" :key="index" class="badge badge-primary">{{ i.name+', '}}</span> </dd>
                </div>
                <div class="row col-12" v-if="(item.hr_id == hr_id || roleId == 1) && item.deposit">
                    <div class="row col-12 border-top">
                        <dt class="col-sm-4">კანდიდატისგან უნდა ჩაირიცხოს:</dt>
                        <dd class="col-sm-8"> {{ item.deposit.candidate_initial_amount }}</dd>
                    </div>
                    <div class="row col-12 border-top" v-if="item.deposit.must_be_enrolled_candidate_date">
                        <dt class="col-sm-4">კანდიდატისგან უნდა ჩაირიცხოს თარიღი:</dt>
                        <dd class="col-sm-8"> {{ item.deposit.must_be_enrolled_candidate_date }}</dd>
                    </div>
                    <div class="row col-12 border-top" v-if="item.deposit.enrolled_candidate">
                        <dt class="col-sm-4">კანდიდატისგან ჩაირიცხა:</dt>
                        <dd class="col-sm-8"> {{ item.deposit.enrolled_candidate }}</dd>
                    </div>
                    <div class="row col-12 border-top" v-if="item.deposit.enrolled_candidate_date">
                        <dt class="col-sm-4">კანდიდატისგან ჩაირიცხა თარიღი:</dt>
                        <dd class="col-sm-8"> {{ item.deposit.enrolled_candidate_date }}</dd>
                    </div>
                </div>

            </dl>
        </div>
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-sm-4">დამატების თარიღი:</dt>
                <dd class="col-sm-8">{{ item.created_at }}</dd>
                <dt class="col-sm-4">განახლების თარიღი:</dt>
                <dd class="col-sm-8">{{ item.updated_at }}</dd>
                <div class="row col-12" v-if="item.interview_date">
                    <dt class="col-sm-4">გასაუბრების თარიღი:</dt>
                <dd class="col-sm-8">{{ item.interview_date }}</dd>
                </div>

                <div class="row col-12" v-if="item.interview_place">
                    <dt class="col-sm-4">გასაუბრების ადგილი:</dt>
                    <dd class="col-sm-8">{{ item.interview_place.name_ka }}</dd>
                </div>

                <div class="row col-12" v-if="item.term">
                    <dt class="col-sm-4">ვადა:</dt>
                    <dd class="col-sm-8">{{ item.term.name_ka }}</dd>
                </div>

                <div class="row col-12" v-if="item.demand">
                    <div class="row col-12" v-if="item.demand.education">
                        <dt class="col-sm-4">განათლება:</dt>
                        <dd class="col-sm-8">{{ item.demand.education.name_ka }} </dd>
                    </div>
                    <div class="row col-12" v-if="item.demand.specialty">
                        <dt class="col-sm-4">პროფესია:</dt>
                        <dd class="col-sm-8">{{ item.demand.specialty.name_ka }} </dd>
                    </div>
                    <div class="row col-12" v-if="item.demand.language">
                        <dt class="col-sm-4">უცხო ენა:</dt>
                        <dd class="col-sm-8">{{ item.demand.language.name_ka+' -' }} {{ (item.demand.language_level)?item.demand.language_level.name_ka:''}}</dd>
                    </div>
                    <div class="row col-12" v-if="item.demand.min_age || item.demand.max_age">
                        <dt class="col-sm-4">ასაკი:</dt>
                        <dd class="col-sm-8">{{ item.demand.min_age+' - '+ item.demand.max_age}}</dd>
                    </div>
                </div>

                <div class="row col-12" v-if="item.characteristic.length > 0">
                    <dt class="col-sm-4">მახასიათებლები:</dt>
                    <dd class="col-sm-8"><span>{{ item.characteristic.map(i => i.name_ka).join(', ')  }}</span> </dd>
                </div>
                <div class="row col-12" v-if="(item.hr_id == hr_id || roleId == 1) && item.deposit">
                    <div class="row col-12 border-top">
                        <dt class="col-sm-4 ">დამსაქმებლისგან უნდა ჩაირიცხოს:</dt>
                        <dd class="col-sm-8"> {{ item.deposit.employer_initial_amount }}</dd>
                    </div>
                    <div class="row col-12 border-top" v-if="item.deposit.must_be_enrolled_employer_date">
                        <dt class="col-sm-4">დამსაქმებლისგან უნდა ჩაირიცხოს თარიღი:</dt>
                        <dd class="col-sm-8"> {{ item.deposit.must_be_enrolled_employer_date }}</dd>
                    </div>
                    <div class="row col-12 border-top" v-if="item.deposit.enrolled_employer">
                        <dt class="col-sm-4">დამსაქმებლისგან ჩაირიცხა:</dt>
                        <dd class="col-sm-8"> {{ item.deposit.enrolled_employer }}</dd>
                    </div>
                    <div class="row col-12 border-top" v-if="item.deposit.enrolled_employer_date">
                        <dt class="col-sm-4">დამსაქმებლისგან ჩაირიცხა თარიღი:</dt>
                        <dd class="col-sm-8"> {{ item.deposit.enrolled_employer_date }}</dd>
                    </div>
                </div>



            </dl>
        </div>
    </div>

</div>
</template>
<script>
export default {
    props:{
        item: Object,
        hr_id: Number,
        roleId: Number
    },
    setup(props) {

    }
}
</script>
<style lang="">

</style>
