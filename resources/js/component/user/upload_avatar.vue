<template lang="">
<div class="twm-candidate-profile-pic">
    <img :src="src" alt="">
            <div class="upload-btn-wrapper">

                <div id="upload-image-grid"></div>
                <button class="site-button button-sm">{{ $t('lang.user_page_candidate_left_side_bar_photo_upload')}}</button>
                <input type="file" @change="selectImage" id="file-uploader" accept=".jpg, .jpeg, .png">
            </div>
</div>

</template>
<script>
export default {
    props:{
        auth: Object
    },
    data() {
        return {
            avatar: null,
            img: null,
            path: '/images/user-avatar/',
            src: null
        }
    },
    created(){
        this.src = this.path + this.auth.avatar
    },
    computed:{
        photo(){
            // this.avatar =
            if (this.img != null) {
                return '/images/user-avatar/'+this.img;
            }
            return '/images/user-avatar/'+this.auth.avatar;
        }
    },
    methods:{
        selectImage(event){
            // alert()
            this.avatar = event.target.files[0]

            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            let formData = new FormData();
            formData.append('avatar', this.avatar)
            let currentObj = this;
            axios.post('/upload_avatar', formData, config)
            .then(function (response) {
                if (response.status == 200) {
                    currentObj.img = response.data.avatar
                    toast.success("სურათი წარმატებით შეიცვალა", {
                        theme: 'colored',
                        autoClose: 1000,
                    });
                }
            })
            .catch(function (error) {
                console.log('error',error);
            });
        }

    },
    watch: {
        img: {
            handler(newValue, oldValue) {
                this.src = this.path + newValue
            },
            deep: true
        }
    },
    mounted(){
    }
}
</script>
<style lang="">

</style>
