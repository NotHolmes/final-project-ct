<template>

    <div class="relative inline-flex">
        <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
        <select v-model="selectedCategory" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5
  pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
        <option :value="null">All</option>
        <option v-for="category in categories" :value="category.id">
            {{ category.name }}
        </option>
    </select>
        <span>{{selectedCategory}}</span>
    </div>

        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="grid gap-5 lg:grid-cols-3 sm:max-w-sm sm:mx-auto lg:max-w-full">
                <post-card v-for="post in posts" :key="post.id"
                           :post="{...post}" :url="`posts/${post.id}`">
                </post-card>
            </div>
        </div>

<!--    <section class="text-gray-600 body-font relative">-->
<!--        <div class="absolute inset-0 bg-gray-300">-->
<!--            <GMapMap-->
<!--                :center="{lat: 13.556, lng: 100.8}"-->
<!--                :zoom="13"-->
<!--                map-type-id="terrain"-->
<!--                style="width: 100vw; height: 900px"-->
<!--            >-->
<!--            </GMapMap>-->
<!--        </div>-->
<!--    </section>-->

 </template>

<script>

import PostCard from '@/components/posts/PostCard.vue'
import { usePostStore } from '@/stores/post.js'
import { useAuthStore } from '@/stores/auth.js'
import SocketioService from '@/services/socketio.js'


export default {
    setup() {
        const post_store = usePostStore()
        const auth_store = useAuthStore()
        return { post_store, auth_store }
    },
    created() {
        SocketioService.setupSocketConnection()
        SocketioService.getSocket().on('posts.index',
                              this.refreshSocketPosts)
        SocketioService.getSocket().on('categories.index',
                              this.refreshSocketCategories)
    },
    data() {
        return {
            title: "Posts",
            error: null,
            posts: null,
            categories: null,
            selectedCategory: "All",
        }
    },
    watch: {
        selectedCategory: function (newVal, oldVal) {
            if(newVal === null) {
                this.posts = this.post_store.posts
            } else {
                this.posts = this.post_store.getPostByCategoryId(newVal)          }
        }
    },
    components: {
        PostCard
    },
    methods: {
        selectPost(post) {
            console.table(post)
            this.$router.push(`posts/${post.id}`)
        },
        async refreshSocketPosts(data) {
            if (data.refresh) {
                await this.refreshPosts()
            }
        },
        async refreshPosts() {
            try {
                await this.post_store.fetch()
                this.posts = this.post_store.getPosts
            } catch (error) {
                this.error = error
            }
        },
        async refreshSocketCategories(data) {
            if (data.refresh) {
                await this.refreshCategories()
            }
        },
        async refreshCategories() {
            try {
                await this.post_store.fetch()
                this.categories = this.post_store.getCategories
            } catch (error) {
                this.error = error
            }
        },
    },
    async mounted() {
        await this.refreshPosts()
        await this.refreshCategories()
    }
}

</script>

<style>

</style>
