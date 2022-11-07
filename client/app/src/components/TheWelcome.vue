<script setup>
import WelcomeItem from './WelcomeItem.vue'
import DocumentationIcon from './icons/IconDocumentation.vue'
import ToolingIcon from './icons/IconTooling.vue'
import EcosystemIcon from './icons/IconEcosystem.vue'
import CommunityIcon from './icons/IconCommunity.vue'
import SupportIcon from './icons/IconSupport.vue'
</script>

<template>

    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="grid max-w-screen-lg gap-8 row-gap-5 md:row-gap-8 sm:mx-auto lg:grid-cols-2">
            <div class="transition duration-300 transform bg-white rounded shadow-sm hover:-translate-y-1 hover:shadow md:text-center">
                <div class="relative">
                    <img class="object-cover w-full h-64 rounded-t lg:h-80 xl:h-96" src="@/assets/lostbear.png" alt="" />
                    <div class="absolute inset-0 bg-gray-800 bg-opacity-25"></div>
                </div>
                <div class="px-6 py-8 border border-t-0 rounded-b sm:px-8">
                    <h5 class="mb-2 text-xl font-bold leading-none sm:text-2xl">
                        Lost
                    </h5>
                    <p class="mb-5 text-gray-700">
                        Want to find something ? Let's post to find them. <br>
                        When you post here, People can help you to find.
                        Because we are family :)
                    </p>
                </div>
            </div>
            <div class="transition duration-300 transform bg-white rounded shadow-sm hover:-translate-y-1 hover:shadow md:text-center">
                <div class="relative">
                    <img class="object-cover w-full h-64 rounded-t lg:h-80 xl:h-96" src="@/assets/found.png" alt="" />
                    <div class="absolute inset-0 bg-gray-800 bg-opacity-25"></div>
                </div>
                <div class="px-6 py-8 border border-t-0 rounded-b sm:px-8">
                    <h5 class="mb-2 text-xl font-bold leading-none sm:text-2xl">
                        Found
                    </h5>
                    <p class="mb-5 text-gray-700">
                        You found something lost? Let's post to find them.
                        Every time you return lost things to owner, you will get 100 point.
                        Keep it to promote your badge :)

                    </p>
                </div>
            </div>
        </div>
        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="grid gap-10 row-gap-8 lg:grid-cols-5">
                <div>
                    <div class="flex">
                        <h6 class="mr-2 text-4xl font-bold md:text-5xl text-deep-purple-accent-400">
                            {{this.users.length}}
                        </h6>
                        <div class="flex items-center justify-center rounded-full bg-teal-accent-400 w-7 h-7">
                            <svg class="text-teal-900 w-7 h-7" stroke="currentColor" viewBox="0 0 52 52">
                                <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                            </svg>
                        </div>
                    </div>
                    <p class="mb-2 font-bold md:text-lg">Users</p>
                    <p class="text-gray-700">
                        Number of all user in this platform. <br>
                        Let's register to join with us.
                    </p>
                </div>

                <div>
                    <div class="flex">
                        <h6 class="mr-2 text-4xl font-bold md:text-5xl text-deep-purple-accent-400">
                            {{this.posts.length}}
                        </h6>
                        <div class="flex items-center justify-center rounded-full bg-teal-accent-400 w-7 h-7">
                            <svg class="text-teal-900 w-7 h-7" stroke="currentColor" viewBox="0 0 52 52">
                                <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                            </svg>
                        </div>
                    </div>
                    <p class="mb-2 font-bold md:text-lg">All Posts</p>
                    <p class="text-gray-700">
                        Number of all posts in this platform. <br>
                        Let's post for found and lost.
                    </p>
                </div>

                <div>
                    <div class="flex">

                        <h6 class="mr-2 text-4xl font-bold md:text-5xl text-deep-purple-accent-400" >
                            {{this.lostCount}}
                        </h6>
                        <div class="flex items-center justify-center rounded-full bg-teal-accent-400 w-7 h-7">
                            <svg class="text-teal-900 w-7 h-7" stroke="currentColor" viewBox="0 0 52 52">
                                <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                            </svg>
                        </div>
                    </div>
                    <p class="mb-2 font-bold md:text-lg">Losts</p>
                    <p class="text-gray-700">
                        Number of lost posts in this platform.
                        Let's post for lost.
                    </p>
                </div>

                <div>
                    <div class="flex">

                        <h6 class="mr-2 text-4xl font-bold md:text-5xl text-deep-purple-accent-400" >
                            {{this.findCount}}
                        </h6>
                        <div class="flex items-center justify-center rounded-full bg-teal-accent-400 w-7 h-7">
                            <svg class="text-teal-900 w-7 h-7" stroke="currentColor" viewBox="0 0 52 52">
                                <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                            </svg>
                        </div>
                    </div>
                    <p class="mb-2 font-bold md:text-lg">Founds</p>
                    <p class="text-gray-700">
                        Number of found posts in this platform.
                        Let's post for found.
                    </p>
                </div>

                <div>
                    <div class="flex">

                        <h6 class="mr-2 text-4xl font-bold md:text-5xl text-deep-purple-accent-400" >
                            {{this.doneCount}}
                        </h6>
                        <div class="flex items-center justify-center rounded-full bg-teal-accent-400 w-7 h-7">
                            <svg class="text-teal-900 w-7 h-7" stroke="currentColor" viewBox="0 0 52 52">
                                <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                            </svg>
                        </div>
                    </div>
                    <p class="mb-2 font-bold md:text-lg">Done</p>
                    <p class="text-gray-700">
                        Number of done posts in this platform.
                        We help people to find something lost.
                    </p>
                </div>

<!--                <div id="hide">-->
<!--                    {{ this.lostCount=0 }}-->
<!--                    {{ this.findCount=0}}-->
<!--                    {{ this.doneCount=0}}-->
<!--                    <div v-for="post in this.posts">-->
<!--                        <div v-if="post.is_lost == 1">-->
<!--                            {{ this.lostCount++ }}-->
<!--                        </div>-->
<!--                        <div v-else-if="post.is_lost == 0">-->
<!--                            {{ this.findCount++ }}-->
<!--                        </div>-->
<!--                        <div v-if="post.is_done == 1">-->
<!--                            {{ this.doneCount++ }}-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

            </div>
        </div>
    </div>



</template>

<script>

import { useAuthStore } from '@/stores/auth.js'
import  {Form, Field, ErrorMessage } from 'vee-validate';
import axios from "axios";
import SocketioService from '@/services/socketio.js'

export default {

    components:{
        Form,
        Field,
        ErrorMessage,
    },
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },
    data() {
        return {
            users: [],
            posts: [],
            lostCount : 0,
            findCount : 0,
            doneCount : 0,
        }
    },
    created() {
        SocketioService.setupSocketConnection()
    },
    methods: {
        validateUser() {
            this.user.duplicatedUser = false;
            for (let i = 0; i < this.users.length; i++) {
                // console.log(this.users[i].email)
                if (this.user.email == this.users[i].email) {
                    this.user.duplicatedUser = true;
                    return "Email is duplicate";
                }
            }
            return true;

        },
    },
    mounted() {
        axios.get('http://localhost/api/users', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('jwt_token')}`
            }
        })
            .then(async (resp) => {
                this.users = await resp.data.data;
            })
            .catch((err) =>{
                console.log(err.data)
            }),
        axios.get('http://localhost/api/posts')
            .then(async (resp) => {
                this.posts = await resp.data.data;
                console.log(this.posts)

                this.lostCount = 0;
                this.findCount = 0;
                this.doneCount = 0;
                for (let i = 0; i < this.posts.length; i++) {
                    if (this.posts[i].is_lost == 1) {
                        this.lostCount++;
                    }
                    if (this.posts[i].is_lost == 0) {
                        this.findCount++;
                    }
                    if (this.posts[i].is_done == 1) {
                        this.doneCount++;
                    }
                }
            })
            .catch((err) =>{
                console.log(err.data)
            })

        }

}
</script>

<style scoped>
    .hide {
        visibility: hidden !important;
    }
</style>
