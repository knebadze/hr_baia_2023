<template lang="">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>სახელი გვარი</th>
                <th>პროფესია</th>
                <th>ტექსტი</th>
                <th>თარიღი</th>
                <th>სტატუსი</th>
                <th>მოქმედება</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in tableItems" :key="index">
                <td>{{ item.id }}</td>
                <td>{{ item.fullName_ka }}</td>
                <td>{{ item.profession_ka }}</td>
                <td>{{ item.text_ka.slice(0, 50) }}...</td>
                <td>{{ item.created_at }}</td>
                <td>
                    <Switch  :checked="item.active" label="" @click.self="isActiveUpdate(item)"/>
                </td>

                <td>
                    <table_cog :item="item"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import { ref } from 'vue';
import moment from 'moment';
import Switch from '../../../inc/Switch.vue';
import table_cog from './table_cog.vue';
export default {
    components:{
        Switch,
        table_cog
    },
    props:{
        items: Object
    },
    setup(props) {
        const tableItems = ref(props.items)
        for (let i = 0; i < props.items.length; i++) {
            // Access the element to update in each object
            tableItems.value[i].created_at = moment(tableItems.value[i].created_at).format("YYYY-MM-DD HH:mm");

            tableItems.value[i].active = tableItems.value[i].active == 1 ? true : false
        };

        const isActiveUpdate = (item) =>{
            // return
            axios({
                method: "post",
                url: "/testimonial_is_active_update",
                data: {'id': item.id,  'active': item.active? 0: 1},

            })
            .then(function (response) {
                // handle success
                if (response.status == 200) {
                    // currentObj.candidate_id = response.data.data;
                    toast.success('წარმატებით შეიცვალა', {
                        theme: 'colored',
                        autoClose: 1000,
                    });

                    // alert()

                }


            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
        return {
            tableItems,
            isActiveUpdate
        }
    }
}
</script>
<style lang="">

</style>
