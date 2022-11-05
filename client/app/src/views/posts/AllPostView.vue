<template>
        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">

            <div class="relative text-lg bg-transparent text-gray-800 mb-10">

                <div class="absolute right-11 top-1 inline-flex">
                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                    <select v-model="selectedCategory" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none border-transparent focus:border-transparent focus:ring-0">
                        <option :value="null">All Categories</option>
                                <option v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                    </select>
                </div>

                <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
                    <input v-model="query" class="bg-transparent border-none mr-3 px-2 leading-tight focus:outline-none w-4/5 outline-none border-transparent focus:border-transparent focus:ring-0" type="text" placeholder="Search">
                    <button type="submit" class="absolute right-0 top-2 mt-3 mr-4">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
          <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
      </svg>
                    </button>
                </div>

            </div>

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
            query: null,
            selectedCategory: "All Categories",
        }
    },
    watch: {
        selectedCategory: function (newVal, oldVal) {
            if(newVal === null) {
                this.posts = this.post_store.posts
            } else {
                this.posts = this.post_store.getPostByCategoryId(newVal)          }
        },
        query: function(newVal, oldVal){
            if(newVal === null || newVal === "")
                this.refreshPosts()
            else
                this.searchPosts();
        }
    },
    components: {
        PostCard
    },
    methods: {
        async searchPosts() {
            await this.post_store.search(this.query)
            this.posts = this.post_store.getPosts
        },

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
