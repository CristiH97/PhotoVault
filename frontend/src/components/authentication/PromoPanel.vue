<script setup>
/**
 * Promotional Panel Component
 *
 * Displays the application logo, key feature highlights, and sample photos.
 *
 */

import image1 from '@/assets/images/authentication/image1.png'
import image2 from '@/assets/images/authentication/image2.png'
import image3 from '@/assets/images/authentication/image3.png'
import image4 from '@/assets/images/authentication/image4.png'
import logo from '@/assets/images/logo/logo.png'
import { Icon } from '@iconify/vue'
</script>
<template>
  <section class="section-container">
    <header class="logo-container">
      <figure id="logo">
        <img :src="logo" id="logo-img" alt="logo" />
        <p>Upload, download, and organize your photos effortlessly</p>
      </figure>
    </header>
    <div class="list-container">
      <ul class="list">
        <li class="list-item">
          <Icon icon="mingcute:lock-line" class="icon-attr" />
          <p>Secure your memories</p>
        </li>
        <li class="list-item">
          <Icon icon="mingcute:world-2-line" class="icon-attr" />
          <p>Access anytime, anywhere</p>
        </li>
        <li class="list-item">
          <Icon icon="mingcute:share-2-line" class="icon-attr" />
          <p>Share with friends</p>
        </li>
      </ul>
    </div>
    <div class="photos-container">
      <img :src="image1" alt="Image 1" />
      <img :src="image2" alt="Image 2" />
      <img :src="image3" alt="Image 3" />
      <img :src="image4" alt="Image 4" />
    </div>
  </section>
</template>

<style scoped>
.section-container {
  width: 100%;
  height: 100%;
  background-color: var(--background-color);
  display: flex;
  flex-direction: column;
}
.logo-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  padding-block: 4%;
}
#logo {
  display: flex;
  align-items: center;
  flex-direction: column;
  gap: 2vh;
  width: 100%;
}
#logo-img {
  width: 57%;
}
#logo > p {
  text-align: center;
  font-family: 'Comic Relief', system-ui;
  font-weight: 400;
  font-style: normal;
  color: #636363;
  font-size: 0.9vw;
  width: 85%;
}

.list-container {
  font-family: 'Poppins', system-ui;
  font-weight: 300;
  font-style: normal;
  font-size: 0.8vw;

  padding-block: 0.9rem;
}
.list-item {
  display: flex;
  align-items: center;
  gap: 0.3rem;
}
.icon-attr {
  font-size: 1.5em;
  color: var(--blue);
}
.list {
  display: flex;
  flex-direction: column;
  gap: 0.9vh;
  padding-inline: 2vw;
}

.photos-container {
  position: relative;
  display: flex;
  width: 100%;
  flex: 1;
}
.photos-container img {
  width: 30%;

  position: absolute;

  z-index: 1;
}

/* Individual image positioning and rotation */

.photos-container img:nth-child(1) {
  left: 5%;
  transform: rotate(5deg);
  top: 7%;
}
.photos-container img:nth-child(2) {
  left: 25%;
  top: 20%;
}
.photos-container img:nth-child(3) {
  left: 50%;
  transform: rotate(-5deg);
  top: 10%;
}
.photos-container img:nth-child(4) {
  left: 65%;
  top: -30%;
  transform: rotate(5deg);
  z-index: 0;
}

/* === Responsive: Wide Screens (Landscape tablets / small desktops) === */
@media (min-aspect-ratio: 4/3) and (max-aspect-ratio: 16/10) {
  .photos-container img:nth-child(1) {
    top: 5%;
  }
  .photos-container img:nth-child(2) {
    top: 14%;
  }
  .photos-container img:nth-child(3) {
    top: 5%;
  }
  .photos-container img:nth-child(4) {
    top: -23%;
  }

  .photos-container img {
    width: 33%;
  }
  .list-container {
    font-size: 1vw;
    padding-block: 0.8rem;
  }
  .list {
    gap: 0.8vh;
  }

  #logo > p {
    font-size: 1vw;
  }
}

/* === Responsive: Medium Screens === */
@media (min-aspect-ratio: 1/1) and (max-aspect-ratio: 4/3) {
  .photos-container img:nth-child(1) {
    left: 3%;
    top: 13%;
  }
  .photos-container img:nth-child(2) {
    left: 23%;
    top: 23%;
  }
  .photos-container img:nth-child(3) {
    left: 48%;
    top: 18%;
  }
  .photos-container img:nth-child(4) {
    left: 63%;
    top: -12%;
  }
  .photos-container img {
    width: 34%;
  }
  .list-container {
    font-size: 1.15vw;
    padding-top: 0.5rem;
  }
  .list {
    gap: 0.8vh;
  }

  #logo > p {
    font-size: 1.15vw;
  }
}

/* === Responsive: Mobile / Square Screens === */
@media (max-aspect-ratio: 1/1) {
  .photos-container img {
    width: 34%;
  }
  .list-container {
    font-size: 1.7vw;
    padding-top: 0.5rem;
  }
  .list {
    gap: 0.5vh;
  }

  #logo > p {
    font-size: 1.7vw;
  }

  #logo {
    gap: 1vh;
  }
  .photos-container img:nth-child(1) {
    left: 3%;
    top: 13%;
  }
  .photos-container img:nth-child(2) {
    left: 23%;
    top: 23%;
  }
  .photos-container img:nth-child(3) {
    left: 48%;
    top: 18%;
  }
  .photos-container img:nth-child(4) {
    left: 63%;
    top: -12%;
  }
  .list {
    padding-inline: 2.5vw;
  }
}
</style>
