<template lang="">
 <form @submit.prevent="submitForm">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">ka</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" v-model="m.template_ka" ></textarea>
                <div class="character-count">{{ characterCountKa }}/70</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="ka" value="ka" v-model="m.active" />
                <label class="form-check-label" for="ka">აქტიური</label>
            </div>
                <hr>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">ka_lt</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" v-model="m.template_ka_lt"></textarea>
                <div class="character-count">{{ characterCountKaLt }}/160</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="ka_lt" value="ka_lt" v-model="m.active" />
                <label class="form-check-label" for="ka_lt">აქტიური</label>
            </div>
                <hr>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">en</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" v-model="m.template_en"></textarea>
                <div class="character-count">{{ characterCountEn }}/160</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="en" value="en" v-model="m.active" />
                <label class="form-check-label" for="en">აქტიური</label>
            </div>
                <hr>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">ru</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" v-model="m.template_ru"></textarea>
                <div class="character-count">{{ characterCountRu }}/160</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="ru" value="ru" v-model="m.active" />
                <label class="form-check-label" for="ru">აქტიური</label>
            </div>
                <hr>
        </div>
    </div>


</form>

</template>
<script>
import { ref, defineComponent, watchEffect} from 'vue';
export default defineComponent({
    props:{
        item: Object
    },
    emits:['formEmit'],
    setup(props, { emit }) {
        const m = ref({...props.item});
        const characterCountKa = ref(0);
        const characterCountKaLt = ref(0);
        const characterCountEn = ref(0);
        const characterCountRu = ref(0);


        watchEffect(() => {
            characterCountKa.value = m.value.template_ka.length;
            characterCountKaLt.value = m.value.template_ka_lt ? m.value.template_ka_lt.length : 0;
            characterCountEn.value = m.value.template_en ? m.value.template_en.length: 0;
            characterCountRu.value = m.value.template_ru? m.value.template_ru.length: 0;
        });

        const submitForm = () => {
            // Perform form submission and emit the updated data
            emit("formEmit", m.value);
        }



        return {
            m,
            submitForm,
            characterCountKa,
            characterCountKaLt,
            characterCountEn,
            characterCountRu,
        }
    }
})
</script>
<style lang="">

</style>
