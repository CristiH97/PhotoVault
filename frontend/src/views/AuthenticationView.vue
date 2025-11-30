<script setup>
import LogoPanel from '@/components/authentication/LogoPanel.vue'
import LoginRegisterPanel from '@/components/authentication/LoginAndRegisterPanel.vue'
import { ref } from 'vue'

const swapped = ref(false)

function swapPanels() {
  swapped.value = !swapped.value
}
</script>
<template>
  <section class="wrapper">
    <section class="auth-container" :class="{ swap: swapped }">
      <div class="left-container">
        <LoginRegisterPanel @swap="swapPanels"></LoginRegisterPanel>
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

  border-radius: 1.5rem;
  overflow: hidden;

  box-shadow: 0px 0px 8px 0px rgba(179, 179, 179, 0.5);
}
.auth-container > * {
  background-color: aqua;
  flex: 1 1 0;
  min-width: 0;

  transition: transform 0.4s ease;
}

.swap .left-container {
  transform: translateX(100%);
}

.swap .right-container {
  transform: translateX(-100%);
}

@media (min-aspect-ratio: 21/9) {
  .auth-container {
    aspect-ratio: 1.5;
    width: 50%;
  }
  .left-container {
    background-color: red;
  }
}

@media (min-aspect-ratio: 16/10) and (max-aspect-ratio: 21/9) {
  .auth-container {
    aspect-ratio: 1.5;
    width: 50%;
  }
  .left-container {
    background-color: orange;
  }
}
@media (min-aspect-ratio: 4/3) and (max-aspect-ratio: 16/10) {
  .auth-container {
    aspect-ratio: 1.4;
    width: 55%;
  }
  .left-container {
    background-color: yellow;
  }
}
@media (min-aspect-ratio: 1/1) and (max-aspect-ratio: 4/3) {
  .auth-container {
    aspect-ratio: 1.3;
    width: 60%;
  }
  .left-container {
    background-color: green;
  }
}

@media (max-aspect-ratio: 1/1) {
  .auth-container {
    aspect-ratio: 1.3;
    width: 95%;
  }
  .left-container {
    background-color: maroon;
  }
}
</style>
