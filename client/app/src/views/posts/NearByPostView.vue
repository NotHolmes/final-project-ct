<template>
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="grid gap-5 lg:grid-cols-3 sm:max-w-sm sm:mx-auto lg:max-w-full">
            <post-card v-for="post in posts" :key="post.id"
                           :post="{...post}" :url="`posts/${post.id}`">
            </post-card>
        </div>
    </div>
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
        const success = (position) => {
            const latitude = position.coords.latitude
            const longitude = position.coords.longitude
            console.log(latitude)
            console.log(longitude)
        }
        const error = (err) => {
            console.log(error)
        }
        navigator.geolocation.getCurrentPosition(success, error);
    },
    data() {
        return {
            title: "Posts",
            error: null,
            posts: null,
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
        }
    },
    async mounted() {
        await this.refreshPosts()
    }
}

</script>