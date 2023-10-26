<template lang="">
    <div>
        <!-- <div v-if="candidateEnrollment" class="alert alert-info alert-dismissible">
            <h5><i class="icon fas fa-info"></i> შეტყობინება!</h5>
            ამ ვაკანსიაზე თქვენ ელოდებით თანხის <u>{{ ( candidateEnrollment.type == 0)?'არასრული':'სრული' }}</u> ჩარიცხვის დადასტურებას.
            <ul>
                <li>დასადასტურებელი თანხა: {{ candidateEnrollment.money }} ლარი</li>
            </ul>
        </div> -->
        <div class="row py-3 border border-success">
            <!-- <div class="row"></div> -->

            <div class="row col-md-12" v-if="m.must_be_enrolled_candidate != 0">
                <div class=" col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>კანდიდატისგან  <span class="text-danger">სულ </span>უნდა ჩაირიცხოს</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m.candidate_initial_amount" type="number" placeholder="0" >
                        </div>
                    </div>
                </div>
                <div class=" col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>კანდიდატისგან უნდა ჩაირიცხოს თარიღი</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m.must_be_enrolled_candidate_date" type="date" >
                        </div>
                    </div>
                </div>
                <div class=" col-md-12">
                    <div class="form-group">
                        <label>ჩასარიცხი დარჩა</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" v-model="m.must_be_enrolled_candidate" type="number" placeholder="0" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" >
                    <button v-if="hasDeposit" type="button" class="btn btn-success float-right" @click.prevent="save()" ><i class=""></i>შენახვა</button>
                    <button v-else-if="!candidateEnrollment" type="button" class="btn btn-success float-right" @click.prevent="redacted()" ><i class=""></i>რედაქტირების შენახვა</button>
                </div>
                <div class="row col-md-12" v-if="m.must_be_enrolled_candidate != null">
                    <div class=" col-md-12 border-top border-bottom"><h5 class="mt-2 text-danger text-center">მიმდინარე ჩარიცხვა</h5></div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>ამჟამინდელი ჩარიცხვის თანხა  </label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="enrollmentCandidate.money" type="number" placeholder="0" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>თანხა ჩარიცხა  </label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" v-model="enrollmentCandidate.name" type="text" placeholder="0" >
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">
                        <div class="form-group">
                            <label>ქვითარი </label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" type="file" ref="fileInput" @change="handleFileChange">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button v-if="!candidateEnrollment" type="button" class="btn btn-primary float-right" @click.prevent="counting(1)" ><i class=""></i>ჩარიცხვა</button>
                    </div>
                </div>

            </div>
            <div v-else class=" col-md-12">
                <div class="form-group">
                    <label>კანდიდატისგან სულ ჩაირიცხა</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" v-model="m.candidate_initial_amount" type="number" placeholder="0" disabled>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import { ref, computed, } from 'vue';
export default {
    props:{

    },
    setup(props) {

    }

}
</script>
<style lang="">

</style>
