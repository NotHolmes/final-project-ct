<template>
    <div>
        <h1 class="text-9xl" id="text_head">This is my profile</h1>
        <img center src="@/assets/travis.jpg" sizes="75%">
        <div>
            <h1 class="text-2xl">Travis Scott</h1>
        </div>
<!--        <MyProfile></MyProfile>-->
    </div>
</template>

<script>
import MyProfile from '@/components/profile/MyProfile.vue'
export default {
    name:"MyProfileVue",
    components: {MyProfile}
}
</script>

<style>
#text_head{
    text-align: center;
    /*color: blue;*/
}
</style>
