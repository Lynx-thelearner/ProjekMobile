<template>
    <div class="edit-container">
      <RouterLink to="/posts" class="btn btn-green">← Kembali ke Daftar Siswa</RouterLink>
  
      <h1>Edit Data Siswa</h1>
      <form @submit.prevent="handleSubmit">
        <input v-model="form.Student_no" placeholder="Nomor Induk Siswa" class="form-input" />
        <input v-model="form.Student_name" placeholder="Nama Siswa" class="form-input" />
        <input v-model="form.Stude_class" placeholder="Kelas" class="form-input" />
        <button type="submit" class="btn btn-green">Simpan Perubahan</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { onMounted, reactive } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  const route = useRoute();
  const router = useRouter();
  const postId = route.params.id;
  
  const form = reactive({
    Student_id: '',
    Student_no: '',
    Student_name: '',
    Stude_class: ''
  });
  
  onMounted(async () => {
    try {
      const response = await axios.get(`http://localhost/belajar-api/get-all-data.php?id=${postId}`);
      form.Student_id = response.data.Student_id;
      form.Student_no = response.data.Student_no;
      form.Student_name = response.data.Student_name;
      form.Stude_class = response.data.Stude_class;
    } catch (error) {
      console.log("Error fetching post", error);
    }
  });
  
  const handleSubmit = async () => {
    const updatePost = { ...form };
    try {
      const response = await axios.put(`http://localhost/belajar-api/update-data.php`, updatePost, {
        headers: { "Content-Type": "application/json" }
      });
      console.log(response.data);
      router.push(`/posts/${form.Student_id}`);
    } catch (error) {
      console.error("Error updating post", error);
    }
  };
  </script>
  
  <style scoped>
  .edit-container {
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
  
  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 20px;
  }
  
  .form-input {
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #3a3a4d;
    background-color: #2a2a3d;
    color: #f0f0f0;
    font-size: 16px;
  }
  
  .form-input::placeholder {
    color: #aaa;
  }
  
  .btn {
    display: inline-block;
    text-decoration: none;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: bold;
    margin: 5px;
    transition: background-color 0.3s;
    cursor: pointer;
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
  </style>
  