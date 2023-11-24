<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>
<script>

import axios from "axios";
import profilePhoto from "@/Components/ProfilePhoto.vue";

const config = {
    headers: {
        'content-type': 'multipart/form-data'
    }
}

export default {
    data() {
        return {
            previewImage: 'http://localhost:8000/defaults/img_avatar.png',
            isImageVisible: false,
            image: null,
        };
    },
    methods: {
        updatePhoto(){
            let data = new FormData();
            data.append('image', this.image);

            axios.post(route('profile.addProfilePhoto'), data, config)
                .then((response) => {
                    console.info(response)
                    window.location.href = route('profile.edit')
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            this.image = event.target.files[0];
            const reader = new FileReader();

            this.isImageVisible = true;

            reader.onload = () => {
                this.previewImage = reader.result;
            };

            reader.readAsDataURL(file);
        },
    },
}
</script>

<template>
    <section>
        <div class="image-preview sm:flex" v-if="previewImage">
            <div>
                <img v-show="isImageVisible" :src="previewImage" alt="Preview">
            </div>
        </div>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Photo</h2>

            <p class="mt-1 text-sm text-gray-600">
                You can change your profile photo from here.
            </p>
        </header>

        <form @submit.prevent="updatePhoto" class="mt-6 space-y-6" enctype="multipart/form-data">

            <div class="sm:flex">
                <label for="file-upload">Choose Image</label>
                <input id="file-upload" type="file" @change="handleFileUpload">
            </div>

            <div class="flex items-center gap-4">
                <primary-button>save</primary-button>
            </div>
        </form>
    </section>
</template>

<style scoped>

/* Style for the file input */
input[type="file"] {
    display: none;
}

/* Style for the file input label */
label {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

label:hover {
    background-color: #45a049;
}

/* Style for the preview image container */
.image-preview {
    width: 200px;
    /* Adjust the width as per your requirement */
    height: 200px;
    /* Adjust the height as per your requirement */
    border-radius: 50%;
    /* Make the container circular */
    overflow: hidden;
    float: right;
}

/* Style for the preview image */
.image-preview img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    /* Ensure the image fills the container without distortion */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
