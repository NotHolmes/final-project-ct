<template>
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">

        <span v-if="posts_num">
        <div class="grid gap-5 lg:grid-cols-3 sm:max-w-sm sm:mx-auto lg:max-w-full">
            <post-card v-for="post in posts" :key="post.id"
                       :post="{...post}" :url="`posts/${post.id}`">
            </post-card>
        </div>
            </span>
        <div v-else>
            {{message}}
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
    },
    data() {
        return {
            title: "Posts",
            error: null,
            posts: null,
            latitude: null,
            longitude: null,
            message: "",
            posts_num: null
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
                var longitude = this.longitude
                var latitude = this.latitude
                function calDistance(lat, long) {
                    var dlong = long - longitude
                    var dlat = lat - latitude
                    var c = Math.sqrt(Math.pow(dlong, 2) + Math.pow(dlat, 2))
                    var km = c / (1 / 108.4)
                    var m = km * 1000
                    console.log(m)
                    return m <= 500
                }
                this.posts = this.posts.filter(function (post) {
                    return calDistance(post.latitude, post.longitude)
                })
                this.posts = this.posts.filter(function (post) {
                    return post.is_lost && ! post.is_done
                })
                this.posts_num = this.posts.length
                if (this.posts.length == 0) {
                    this.message = "No lost item that near you within 500 meters!"
                }
            } catch (error) {
                this.error = error
            }
        },
        getLatiLong(closure) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    this.latitude = position.coords.latitude
                    this.longitude = position.coords.longitude
                    console.log(this.latitude)
                    console.log(this.longitude)
                    closure()
                }, (error) => {
                    if (error.code = 1) {
                        this.error = "Please allow location access."
                    }
                })
            }
        }
    },
    async mounted() {
        this.getLatiLong(() => {
            this.refreshPosts()
        })
    }
}

</script>
