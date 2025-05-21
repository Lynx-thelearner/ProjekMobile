<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const postId = route.params.id;
const state = reactive({
    post: Object
})

onMounted(async () => {
    try {
        const response = await axios.get(`http://localhost/belajar-api/get-all-data.php?id=${postId}`);
        console.log(response.data)
        state.post = response.data;
    } catch (error) {
        console.log("Error while fetching: ", error);
    }
})


</script>
<template>
    <div class="center-container">
        <h1>{{ state.post.Student_name }}</h1>
        <p>Nomor Siswa: {{ state.post.Student_no }}</p>
        <p>Kelas: {{ state.post.Stude_class }}</p> 
        <RouterLink :to="`/posts`" class="btn btn-green">Return to Posts</RouterLink>
    </div>
</template>