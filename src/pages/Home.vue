<!-- src/views/Login.vue -->
<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const username = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const handleLogin = async () => {
  error.value = ''

  try {
    const response = await fetch('http://localhost/belajar-api/login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ username: username.value, password: password.value })
    })

    const result = await response.json()

    if (result.status === 'OK') {
      // Simpan user ke localStorage atau store
      localStorage.setItem('user', JSON.stringify(result.data))

      // Arahkan ke halaman posts
      router.push('/posts')
    } else {
      error.value = result.msg || 'Login gagal'
    }
  } catch (err) {
    error.value = 'Error: ' + err.message
  }
}
</script>

<template>
  <div class="login-container">
    <h2>Login</h2>
    <p v-if="error" class="error">{{ error }}</p>
    <input v-model="username" type="text" placeholder="Username" />
    <input v-model="password" type="password" placeholder="Password" />
    <button @click="handleLogin">Login</button>
  </div>
</template>

<style scoped>
.login-container {
  max-width: 400px;
  margin: 50px auto;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.error {
  color: red;
}

button {
  background-color: #4c87af;
  color: white;
  padding: 10px;
  border: none;
  cursor: pointer;
} 
</style>
