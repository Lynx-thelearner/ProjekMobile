<script setup>
import { onMounted, reactive } from 'vue';
import { RouterLink } from 'vue-router';
import axios from 'axios';
import Post from '@/components/Post.vue';

const state = reactive({
    posts: []
})

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost/belajar-api/get-all-data.php');
    console.log(response) 
    state.posts = response.data;
  } catch (error) {
    console.error('Error fetching jobs:', error);
  }
});
</script>
<template>
  <div class="center-container">
    <h1>All Post</h1> 
    <RouterLink :to="`/`" class="btn btn-blue">Log-out</RouterLink>
    <RouterLink :to="`/posts/add`" class="btn btn-green">Add Post</RouterLink>
    <br />
    <br />
    <table id="posts">
        <tr>
            <th>ID</th>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
        <Post v-for="post in state.posts" :key="post.id" :post="post"/>
    </table>
  </div>
</template>

<style>

.center-container {
  max-width: 900px;
  margin: 50px auto;
  padding: 30px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #1e1e2f;
  border-radius: 16px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  text-align: center;
  color: #e0e0e0;
}

h1 {
  font-size: 28px;
  margin-bottom: 20px;
  color: #ffffff;
}

.btn {
  display: inline-block;
  text-decoration: none;
  padding: 10px 16px;
  border-radius: 8px;
  font-weight: bold;
  margin: 5px;
  transition: background-color 0.3s;
}

.btn-blue {
  background-color: #2980b9;
  color: white;
}

.btn-blue:hover {
  background-color: #3498db;
}

.btn-green {
  background-color: #27ae60;
  color: white;
}

.btn-green:hover {
  background-color: #2ecc71;
}

table#posts {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: #2a2a3d;
  color: #f0f0f0;
  border-radius: 8px;
  overflow: hidden;
}

table#posts th, table#posts td {
  border: 1px solid #3a3a4d;
  padding: 12px 10px;
  text-align: center;
}

table#posts th {
  background-color: #33334d;
  color: #ffffff;
}

table#posts tr:nth-child(even) {
  background-color: #2e2e42;
}

table#posts tr:hover {
  background-color: #3c3c59;
}

</style>