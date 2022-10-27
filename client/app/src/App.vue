<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Profile from '@/components/profile/Profile.vue'
import Navbar from '@/components/Navbar.vue'
</script>

<template>
  <header>
<!--    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />-->

<!--    <div class="wrapper">-->
<!--      <HelloWorld msg="You did it!" />-->

<!--    </div>-->
      <nav>
          <Navbar></Navbar>
      </nav>

      <!--      <nav class="flex">-->
      <!--        <RouterLink to="/">Home</RouterLink>-->
      <!--        <RouterLink to="/about">About</RouterLink>-->
      <!--        <RouterLink to="/rewards">Rewards</RouterLink>-->
      <!--          <RouterLink to="/posts">Posts</RouterLink>-->
      <!--        <Profile></Profile>-->
      <!--      </nav>-->
  </header>


    <!--    display current route-->
  <RouterView />
    <!--    display current route-->
</template>

<style scoped>

</style>
