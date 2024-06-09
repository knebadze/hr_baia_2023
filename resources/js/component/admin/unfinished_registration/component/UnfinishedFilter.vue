<script setup>
import { ref } from "vue";
import { useUnfinishedRegistrationStore } from "../../../../store/admin/unfinishedRegistrationStore";
const colspanClass = ref("hide");
const isColspanVisible = ref(true);
const unfinishedRegistrationStore = useUnfinishedRegistrationStore();
const { completed } = unfinishedRegistrationStore;
function toggleCollapse() {
    isColspanVisible.value = !isColspanVisible.value;
}
toggleCollapse("show");
</script>
<template>
    <div id="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title w-100 d-flex justify-content-between">
                    <a
                        class="d-block w-100"
                        @click="toggleCollapse"
                        href="#collapseOne"
                    >
                        ფილტრი
                    </a>
                    <i
                        :class="
                            !isColspanVisible
                                ? 'fas fa-angle-down float-right'
                                : 'fas fa-angle-up float-right'
                        "
                    ></i>
                </h4>
            </div>
            <div
                id="collapseOne"
                class="collapse"
                :class="{ show: isColspanVisible }"
                data-parent="#accordion"
            >
                <div class="card-body">
                    <div class="row">hell</div>
                </div>
            </div>
        </div>
    </div>
</template>
