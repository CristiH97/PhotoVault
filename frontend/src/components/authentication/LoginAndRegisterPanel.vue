<script setup></script>
<template>
  <section class="login-section-container border">
    <header class="login-register-title">
      <h1>LogIn</h1>
    </header>
    <div class="form-container">
      <form action="" class="login-register-form">
        <label for="username">Username</label>
        <input type="text" id="username" />
        <label for="password">Password</label>
        <input type="password" id="password" />
        <label for="repeat-password">Repeat Password</label>
        <input type="text" id="repeat-password" />
      </form>
    </div>
    <div class="login-register-btn">
      <button>LogIn</button>
    </div>
    <div class="signup-login-prompt">
      <p>Don't have an account yet? Sign up</p>
    </div>
  </section>
</template>
<style scoped>
.login-section-container {
  width: 100%;
  height: 100%;

  display: flex;
  flex-direction: column;

  padding: 10%;
}
.login-register-form {
  display: flex;
  flex-direction: column;
}
</style>
