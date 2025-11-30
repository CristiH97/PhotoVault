<script setup>
import { ref } from 'vue'
import { defineEmits } from 'vue'

const isRegister = ref(false)
const emit = defineEmits(['swap'])

function swapPanels() {
  emit('swap')
  setTimeout(() => {
    isRegister.value = !isRegister.value
  }, 100)
}
</script>
<template>
  <section class="login-section-container">
    <header class="login-register-title">
      <p>{{ isRegister ? 'SignUp' : 'LogIn' }}</p>
    </header>
    <div class="form-container">
      <form action="" class="login-register-form">
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
          <input type="text" id="repeat-password" />
        </div>
      </form>
    </div>
    <div class="login-register-btn">
      <button>{{ isRegister ? 'SignUp' : 'LogIn' }}</button>
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
}
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
}

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
}
</style>
