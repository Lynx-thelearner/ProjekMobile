<template>
    <div class="container">
      <RouterLink to="/posts" class="btn btn-green back-btn">← Kembali ke Daftar Siswa</RouterLink>
  
      <div class="form-card">
        <h2>Tambah Data Siswa</h2>
        <form @submit.prevent="handleSubmit">
          <input v-model="form.student_no" placeholder="Nomor Induk Siswa" class="form-input" />
          <input v-model="form.student_name" placeholder="Nama Siswa" class="form-input" />
          <input v-model="form.student_class" placeholder="Kelas" class="form-input" />
          <button type="submit" class="btn btn-green">Simpan</button>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { reactive } from 'vue';
  import router from '@/router';
  
  const form = reactive({
    student_no: '',
    student_name: '',
    student_class: ''
  });
  
  const handleSubmit = async () => {
    const newPost = {
      Student_no: form.student_no,
      Student_name: form.student_name,
      Stude_class: form.student_class
    };
    try {
      const response = await axios.post('http://localhost/belajar-api/insert-data.php', newPost);
      console.log(response.data);
      router.push('/posts');
    } catch (error) {
      console.error("Error on posting data:", error);
    }
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 600px;
    margin: 30px auto;
    padding: 20px;
  }
  
  .form-card {
    background: #1e1e2f;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  }
  
  .form-card h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #eeeeee;
  }
  
  .form-input {
    display: block;
    width: 100%;
    margin-bottom: 15px;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
  }
  
  .btn {
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
  }
  
  .btn-green {
    background-color: #2e7d32;
    color: white;
  }
  
  .back-btn {
    margin-bottom: 20px;
    display: inline-block;
  }
  </style>
  