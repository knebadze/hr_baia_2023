<template lang="">
        <div class="twm-candidate-profile-pic">

            <img :src="photo">
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
            avatar:null
        }
    },
    computed:{
        photo(){
            return '../../../../public/images/user-avatar/1677509801.download.png';
        }
    },
    methods:{
        selectImage(event){
            // alert()
            this.avatar = event.target.files[0]
            console.log('this.avatar', this.avatar);

            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            let formData = new FormData();
            formData.append('avatar', this.avatar)
            axios.post('/upload_avatar', formData, config)
            .then(function (response) {
                console.log('response',response.data);
                if (response.data.status == 200) {
                    toast.success("ცნობები წარმატებით დაემატა", {
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
    mounted(){
        console.log('this.auth',this.auth);
    }
}
</script>
<style lang="">

</style>
