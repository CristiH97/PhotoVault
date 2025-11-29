<script setup>
import LogoPanel from '@/components/authentication/LogoPanel.vue'
import LoginRegisterPanel from '@/components/authentication/LoginAndRegisterPanel.vue'
</script>
<template>
  <section class="wrapper">
    <section class="auth-container">
      <div class="left-container">
        <LoginRegisterPanel></LoginRegisterPanel>
      </div>
      <div class="right-container">
        <LogoPanel></LogoPanel>
      </div>
    </section>
  </section>
</template>
<style scoped>
.wrapper {
  width: 100vw;
  height: 100vh;

  display: flex;
  align-items: center;
  justify-content: center;

  background-image: url('@/assets/images/authentication/background.png');
  background-size: cover;
  background-position: center;
}

.auth-container {
  display: flex;
}
.auth-container > * {
  border: 1px solid black;
  background-color: aqua;
  flex: 1;
}

@media (min-aspect-ratio: 21/9) {
  .auth-container {
    background-color: red;
    aspect-ratio: 1.5;
    width: 50%;
  }
  .left-container {
    background-color: red;
  }
}

@media (min-aspect-ratio: 16/10) and (max-aspect-ratio: 21/9) {
  .auth-container {
    background-color: orange;
    aspect-ratio: 1.5;
    width: 50%;
  }
  .left-container {
    background-color: orange;
  }
}
@media (min-aspect-ratio: 4/3) and (max-aspect-ratio: 16/10) {
  .auth-container {
    background-color: yellow;
    aspect-ratio: 1.4;
    width: 55%;
  }
  .left-container {
    background-color: yellow;
  }
}
@media (min-aspect-ratio: 1/1) and (max-aspect-ratio: 4/3) {
  .auth-container {
    background-color: green;
    aspect-ratio: 1.3;
    width: 60%;
  }
  .left-container {
    background-color: green;
  }
}

@media (max-aspect-ratio: 1/1) {
  .auth-container {
    background-color: maroon;
    aspect-ratio: 1.3;
    width: 95%;
  }
  .left-container {
    background-color: maroon;
  }
}
</style>
