<script setup>
/**
 * Authentication Form Component
 *
 * Handles user login and registration within a single UI.
 *
 * Responsibilities:
 * - Toggle between login and registration modes
 * - Validate user input (e.g., password confirmation)
 * - Call authentication API endpoints
 * - Store authentication token and configure API client
 * - Redirect authenticated users to the dashboard
 *
 * Emits:
 * - 'swap': triggers UI panel transition animation
 */

import { ref } from 'vue'
import { defineEmits } from 'vue'
import { login, register } from '@/api/authApi'
import { useRouter } from 'vue-router'
import apiClient from '@/api/apiClient'

const isRegister = ref(false)
const invalidCreds = ref(false)
const emit = defineEmits(['swap'])
const router = useRouter()
const passwordMismatch = ref(false)

function swapPanels() {
  emit('swap')

  // Delay state switch to allow animation to complete
  setTimeout(() => {
    isRegister.value = !isRegister.value
    invalidCreds.value = false
    passwordMismatch.value = false
  }, 100)
}

async function handleLogin() {
  try {
    let username = document.getElementById('username').value
    let password = document.getElementById('password').value

    const res = await login({ username, password })

    setAuthToken(res.token)

    router.push({ name: 'dashboard' })
  } catch (err) {
    console.error('Invalid username or password', err)
    invalidCreds.value = true
  }
}

async function handleRegister() {
  try {
    let name = document.getElementById('name').value
    let username = document.getElementById('username').value
    let password = document.getElementById('password').value
    let passwordConfirmation = document.getElementById('repeat-password').value

    // Ensure passwords match before sending request
    if (password !== passwordConfirmation) {
      passwordMismatch.value = true
      return
    }

    const res = await register({
      name,
      username,
      password,
      password_confirmation: passwordConfirmation,
    })

    setAuthToken(res.token)

    router.push({ name: 'dashboard' })
  } catch (err) {
    console.error('Invalid username or password', err)
    invalidCreds.value = true
  }

  function setAuthToken(token) {
    // Store JWT token for persistent authentication
    localStorage.setItem('token', token)

    // Set token for all future API requests
    apiClient.defaults.headers.Authorization = `Bearer ${token}`
  }
}
</script>
<template>
  <section class="login-section-container">
    <header class="login-register-title">
      <p>{{ isRegister ? 'SignUp' : 'LogIn' }}</p>
      <div class="invalid-credentials" v-if="invalidCreds">
        <p>Invalid username or password</p>
      </div>
      <div class="invalid-credentials" v-if="passwordMismatch">
        <p>Passwords do not match</p>
      </div>
    </header>
    <div class="form-container">
      <form action="" class="login-register-form" :class="{ signupForm: isRegister }">
        <div class="name" v-if="isRegister">
          <label for="name">Name</label>
          <input type="text" id="name" />
        </div>
        <div class="username">
          <label for="username">Username</label>
          <input type="text" id="username" />
        </div>
        <div class="password">
          <label for="password">Password</label>
          <input type="password" id="password" />
        </div>
        <div class="repeat-password" :class="{ hide: !isRegister }">
          <label for="repeat-password">Repeat Password</label>
          <input type="password" id="repeat-password" />
        </div>
      </form>
    </div>
    <div class="login-register-btn">
      <button @click="isRegister ? handleRegister() : handleLogin()">
        {{ isRegister ? 'SignUp' : 'LogIn' }}
      </button>
    </div>
    <div class="signup-login-prompt">
      <p v-if="!isRegister">
        Don't have an account yet?
        <a @click="swapPanels" class="blue">Sign up</a>
      </p>
      <p v-else>
        Already have an account?
        <a @click="swapPanels" class="blue">LogIn</a>
      </p>
    </div>
  </section>
</template>

<style scoped>
.login-section-container {
  width: 100%;
  height: 100%;

  padding-block: 12%;
  padding-inline: 15%;

  position: relative;
  display: flex;
  flex-direction: column;
  gap: 1.5vw;

  font-family: 'Space Grotesk', system-ui;
  font-weight: 400;
  font-style: normal;
  font-size: 1rem;

  background-color: white;
}
.login-register-title {
  font-size: 1.5vw;
}
.login-register-form {
  color: #636363;
  font-size: 1.2vw;

  display: flex;
  flex-direction: column;
  gap: 1vw;

  padding-bottom: 0.5rem;
}
.login-register-form > * {
  display: flex;
  flex-direction: column;
  gap: 0.7rem;
}

/* Utility class to hide elements (used for conditional UI states) */
.hide {
  display: none;
}

input {
  width: 75%;
  border-radius: 0.4rem;
  border: none;

  box-shadow: 0px 0px 3.5px 0px rgba(43, 43, 43, 0.5);

  padding-inline: 0.5rem;
}
label {
  font-size: 0.9vw;
}
.login-register-btn > button {
  width: 32%;
  aspect-ratio: 3;

  border: none;
  border-radius: 0.5rem;

  font-weight: 300;
  color: white;
  font-size: 1.1vw;

  background-color: var(--maroon);
  cursor: pointer;
}
.signup-login-prompt {
  font-size: 0.8vw;
  color: black;
}
a {
  cursor: pointer;
}

.blue {
  color: blue;
}

/* Error message styling */
.invalid-credentials {
  position: absolute;
  color: red;
  font-size: 0.7vw;
}

.signupForm > * {
  gap: 0.4vw;
}
.signupForm {
  gap: 0.5vw;
}

/* === Responsive: Wide Screens (Landscape tablets / small desktops) === */
@media (min-aspect-ratio: 4/3) and (max-aspect-ratio: 16/10) {
  input {
    font-size: 1.3vw;
  }
  .login-section-container {
    gap: 2vw;
  }
  .login-register-title {
    font-size: 1.8vw;
  }
  label {
    font-size: 1.1vw;
  }
  .login-register-btn > button {
    width: 35%;
  }
  .invalid-credentials {
    font-size: 0.9vw;
  }
}

/* === Responsive: Medium Screens === */
@media (min-aspect-ratio: 1/1) and (max-aspect-ratio: 4/3) {
  .login-register-title {
    font-size: 2.2vw;
  }
  input {
    font-size: 1.5vw;
  }
  .login-section-container {
    gap: 3vw;
  }

  label {
    font-size: 1.35vw;
  }
  .login-register-btn > button {
    width: 40%;
    font-size: 1.3vw;
  }
  .signup-login-prompt {
    font-size: 1vw;
  }
  .invalid-credentials {
    margin-top: 2%;
    font-size: 1.1vw;
  }
}

/* === Responsive: Mobile / Square Screens === */
@media (max-aspect-ratio: 1/1) {
  .login-register-title {
    font-size: 3.3vw;
  }
  input {
    font-size: 2vw;
  }
  .login-section-container {
    gap: 5vw;
  }
  .login-register-form {
    gap: 2vw;
  }

  label {
    font-size: 1.7vw;
  }
  .login-register-btn > button {
    width: 40%;
    font-size: 1.9vw;
  }
  .signup-login-prompt {
    font-size: 1.5vw;
  }
  .login-register-form > * {
    gap: 0.4rem;
  }
  .invalid-credentials {
    margin-top: 3%;
    font-size: 1.2vw;
  }
}
</style>
