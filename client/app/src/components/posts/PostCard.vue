<template>
    <div class="overflow-hidden transition-shadow duration-300 bg-white rounded">
        <a @click="onClickButton()" aria-label="Article"><img v-bind:src="post.image" class="cursor-pointer object-cover w-full h-64 rounded" alt="" /></a>
        <div class="py-5">
            <p class="mb-2 text-xs font-semibold text-gray-600 uppercase">
                {{ formatDate(post.datetime)}}
            </p>
            <a @click="onClickButton()" aria-label="Article" class="cursor-pointer inline-block mb-3 text-black transition-colors duration-200 hover:text-deep-purple-accent-700"><p class="text-2xl font-bold leading-5">
                {{ post.title }}</p>
            </a>
            <p class="mb-4 text-gray-700">
                {{  post.description }}
            </p>
            <div class="flex space-x-4">
                <a href="/" aria-label="Comments" class="flex items-start text-gray-800 transition-colors duration-200 hover:text-deep-purple-accent-700 group">
                    <div class="mr-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5 text-gray-600 transition-colors duration-200 group-hover:text-deep-purple-accent-700"
                        >
                            <polyline points="23 5 23 18 19 18 19 22 13 18 12 18" fill="none" stroke-miterlimit="10"></polyline>
                            <polygon points="19 2 1 2 1 14 5 14 5 19 12 14 19 14 19 2" fill="none" stroke="currentColor" stroke-miterlimit="10"></polygon>
                        </svg>
                    </div>
                    <div v-if="post.is_lost">
                        <p v-if="parseInt(post.is_done)" class="font-semibold">Founded</p>
                        <p v-else class="font-semibold">Searching</p>
                    </div>
                    <div v-else>
                        <p v-if="parseInt(post.is_done)" class="font-semibold">Returned</p>
                        <p v-else class="font-semibold">Looking for owner</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import { useCounterStore } from '@/stores/counter.js'
export default {
    setup() {
        const counter_store = useCounterStore()
        return { counter_store }
    },
    data() {
        return {
            likeCount: 0
        }
    },
    props: {
        post: Object,
        url: {
            type: String,
            default: ''
        }
    },
    methods: {
        onClickButton() {
            if (this.url !== '') {
                this.$router.push(this.url)
            }
        },
        formatDate(dateString) {
            const date = new Date(dateString)
            return new Intl.DateTimeFormat('en-US', {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            }).format(date)
        }
    }
}
</script>

<style scoped>
.my-color {
    @apply text-orange-500 text-lg;
}
</style>
