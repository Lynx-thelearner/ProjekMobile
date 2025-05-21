<script setup>
import axios from 'axios';
import { defineProps } from 'vue';
import { RouterLink, useRouter } from 'vue-router';

const router = useRouter();

const props = defineProps({
    post: Object
});

const deletePost = async (postId) => {
    try {
        const confirm = window.confirm('Are you sure you want to delete this posts?');
        console.log(confirm);
        if(confirm) {
            await axios.delete(`http://localhost/belajar-api/delete-data.php?Student_id=${postId}`);
            router.push('/Posts');
            window.location.reload();
        }
    } catch (error) {
        console.error("Error deleting post: ", error);
    }
}
</script>
<template>
    <tr>
        <td>{{ post.Student_id }}</td>
        <td>{{ post.Student_no }}</td>
        <td>{{ post.Student_name}}</td>
        <td>{{ post.Stude_class}}</td>
        <td>
            <RouterLink :to="`/posts/${post.Student_id}`" class="btn btn-green">O</RouterLink>
            <RouterLink :to="`/posts/edit/${post.Student_id}`"class="btn btn-blue">/</RouterLink>
            <button @click="deletePost(post.Student_id)" class="btn btn-red">X</button>
        </td>
    </tr>
</template>