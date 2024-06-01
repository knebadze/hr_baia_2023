<template lang="">
    <!-- Modal -->
    <div
        v-if="showConfirm"
        class="modal fade show"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        id="modalMap"
        aria-hidden="true"
        style="display: block"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-xl"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">
                        <i class="fa fa-user"></i> კანდიდატის ინფორმაცია
                    </h6>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="hide()"
                    >
                        X
                    </button>
                </div>
                <div class="modal-body">
                    <expand_body :item="candidate" />
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary mr-3"
                        @click="hide()"
                    >
                        <i class=""></i>გაუქმება
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import expand_body from "../component/candidate/expand_body.vue";
import moment from "moment";
export default {
    components: {
        expand_body,
    },
    props: {
        visible: Boolean,
        candidate_id: Number,
    },
    data() {
        return {
            showConfirm: false,
            candidate: null,
            role_id: null,
            hrId: null,
        };
    },
    created() {
        // this.showConfirm = this.visible
    },
    computed: {
        getLang() {
            return I18n.getSharedInstance().options.lang;
        },
    },
    methods: {
        async show() {
            try {
                let result = await this.getClassificatory();
                this.candidate = result.data.candidate;
                console.log(this.candidate);
                this.candidate.age = this.age(
                    result.data.candidate.user.date_of_birth
                );
                this.role_id = result.data.role_id;
                this.hrId = result.data.hr_id;
                this.showConfirm = true;
            } catch (error) {
                console.log(error);
            }
        },
        getClassificatory() {
            console.log(this.candidate_id);
            return axios.post("/get_candidate_full_info", {
                data: this.candidate_id,
            });
        },
        age(date_of_birth) {
            var dob = moment(date_of_birth);
            return moment().diff(dob, "years");
        },
        hide() {
            this.showConfirm = false;
        },
    },
    watch: {
        visible: function () {
            this.show();
        },
    },
};
</script>
<style scoped>
.modal-body {
    height: 250px;
    overflow-y: auto;
}

@media (min-height: 500px) {
    .modal-body {
        height: 400px;
    }
}

@media (min-height: 800px) {
    .modal-body {
        height: 700px;
    }
}
</style>
