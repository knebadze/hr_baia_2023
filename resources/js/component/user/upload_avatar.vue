<template lang="">
    <div class="twm-candidate-profile-pic">
        <img :src="src" alt="" />
        <div class="upload-btn-wrapper">
            <div id="upload-image-grid"></div>
            <button class="site-button button-sm">
                {{ $t("lang.user_page_candidate_left_side_bar_photo_upload") }}
            </button>
            <input
                type="file"
                @change="selectImage"
                id="file-uploader"
                accept=".jpg, .jpeg, .png"
            />
        </div>
    </div>
</template>
<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import axios from 'axios';
import { toast } from 'vue3-toastify';
const props = defineProps({
    auth: Object
});

const avatar = ref(null);
const img = ref(null);
const path = '/storage/';
const src = ref(path + props.auth.avatar);

const photo = computed(() => {
    return img.value != null ? '/storage/' + img.value : '/storage/' + props.auth.avatar;
});

// Custom validation for image type
const isValidImageType = (file) => {
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    return file && allowedTypes.includes(file.type);
};

// Custom validation for image size (e.g., 2MB)
const isValidImageSize = (file, maxSizeMB = 2) => {
    const maxSizeBytes = maxSizeMB * 1024 * 1024;
    return file && file.size <= maxSizeBytes;
};
const selectImage = async (event) => {
    const file = event.target.files[0];

    if (!isValidImageType(file)) {
        toast.error("ფაილის ტიპი არასწორია. გთხოვთ აირჩიოთ JPEG, PNG, GIF, jpg.");
        return;
    }
    if (!isValidImageSize(file)) {
        toast.error(`ფაილის მაქსიმალური ზომა არ უნდა აღემატებოდეს 2MB.`);
        return;
    }
    avatar.value = file;
    const config = {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    };
    let formData = new FormData();
    formData.append('id', props.auth.id);
    formData.append('avatar', avatar.value);

    try {
        const response = await axios.post('/upload_avatar', formData, config);
        if (response.status == 200) {
            img.value = response.data.avatar;
            toast.success("სურათი წარმატებით შეიცვალა", {
                theme: 'colored',
                autoClose: 1000,
            });
        }
    } catch (error) {
        console.error('error', error);
    }
};

watch(img, (newValue) => {
    src.value = path + newValue;
}, { deep: true });

onMounted(() => {
    // Any additional logic to run on component mount
});
</script>
<style lang=""></style>
