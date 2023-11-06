<template lang="">

    <div  class="row">
        <label for="">{{ `${label} ასაკი` }} </label>
        <div  :class="divClass"  v-for="(item, index) in childe" :key="index">
            <div class="form-group ">

                <div class="ls-inputicon-box">
                    <input class="form-control" @input="rule(children_age[index], index)" v-model="children_age[index]" type="number" placeholder="" onkeypress="return /[0-9,]/i.test(event.key)">
                </div>

            </div>

        </div>
        <!-- <div v-if="index + 1 != childe" class="col-xl-2 col-lg-2 col-md-2 my-3 text-center">
                <span>და</span>
            </div> -->
        <!-- </div> -->



    </div>
</template>
<script>
import { ref, computed, watch } from 'vue';
export default {
    emits: ['childrenAgeEmit'],
    props:{
        childe: Number,
        age: String,
    },
    setup(props, {emit}) {
        console.log('props',props);

        const divClass = computed(() =>{
            let className = '';
            props.childe == 1 ?className = 'col-xl-12 col-lg-12 col-md-12': className= 'col-xl-3 col-lg-3 col-md-6'
            return className;
        })

        const label = ref(props.childe == 1? 'შვილის': 'შვილების')

        const ageArray = computed(() => {
            let arr = []
            if (props.age) {
                arr = props.age.split(', ');
            }
            return arr

        });
        const children_age = ref(ageArray.value)
        const rule = (item, index) => {
            const numberAsString = item.toString();
            if (numberAsString.length > 0 && numberAsString.length < 3) {
                children_age.value[index] = item
                if (item < 0) {
                    children_age.value[index] = 0
                }
                if (item > 40) {
                    children_age.value[index] = 40
                }
            }else if(numberAsString.length ){
                children_age.value[index] = 0
            }
        }

        watch(children_age.value, (newVal) => {
            if (newVal.length == props.childe) {
                let emitData = newVal.map(i => i).join(', ')
                emit("childrenAgeEmit", emitData);
            }
        });

        return {
            children_age,
            divClass,
            label,
            rule
        }
    }
}
</script>
<style lang="">

</style>
