<template>
    <img :src=url :alt=$page.props.auth.user.name>
</template>

<script>
import axios from "axios";

export default {
    data(){
        return{
            url : '',
        }
    },
    created(){
        axios.get(route('getAvatar'))
            .then(response => response.data == null ? this.url = 'http://localhost:8000/defaults/img_avatar.png' : this.url = response.data);
    },
    updated() {
        axios.get(route('getAvatar'))
            .then(response => response.data == null ? this.url = 'http://localhost:8000/defaults/img_avatar.png' : this.url = response.data);
    }
}

</script>

<style scoped>

</style>
