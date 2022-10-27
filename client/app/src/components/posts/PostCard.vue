<template>
    <!--  <div class="block p-2 mt-4 border-2 border-blue-700 rounded">-->
    <!--    <h3 class="text-xl">{{ reward.name }}</h3>-->
    <!--    <p class="text-4xl">{{ reward.point }} point</p>-->

    <!--    <div class="text-xl">-->
    <!--      <slot name="total_amount"></slot>-->
    <!--    </div>-->

    <!--    <div class="">-->
    <!--      <slot></slot>-->
    <!--    </div>-->

    <!--    <div class="grid grid-cols-2">-->
    <!--      <button @click="onClickButton()"-->
    <!--      class="p-2 mx-4 bg-blue-200 border-2 border-blue-400 rounded-xl">-->
    <!--        Redeem-->
    <!--      </button>-->
    <!--      <div class="grid grid-cols-2">-->
    <!--        <button @click="onClickLike()"-->
    <!--        class="p-2 mx-4 bg-yellow-200 border-2 border-blue-400 rounded-xl">-->
    <!--          {{ likeCount }} Likes-->
    <!--        </button>-->

    <!--        <button @click="onClickCounter()"-->
    <!--        class="p-2 mx-8 bg-green-200 border-2 border-blue-400 rounded-xl">-->
    <!--          {{ counter_store.counter }} |-->
    <!--          {{ counter_store.doubleCount }}-->
    <!--        </button> -->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <div class="overflow-hidden transition-shadow duration-300 bg-white rounded">
        <a href="/" aria-label="Article"><img v-bind:src="post.image" class="object-cover w-full h-64 rounded" alt="" /></a>
        <div class="py-5">
            <p class="mb-2 text-xs font-semibold text-gray-600 uppercase">
                {{ formatDate(post.published_at)}}
            </p>
            <a href="/" aria-label="Article" class="inline-block mb-3 text-black transition-colors duration-200 hover:text-deep-purple-accent-700"><p class="text-2xl font-bold leading-5">
                {{ post.title }}</p>
            </a>
            <p class="mb-4 text-gray-700">
                {{  post.description }}
            </p>
            <div class="flex space-x-4">
                <a href="/" aria-label="Likes" class="flex items-start text-gray-800 transition-colors duration-200 hover:text-deep-purple-accent-700 group">
                    <div class="mr-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            class="w-5 h-5 text-gray-600 transition-colors duration-200 group-hover:text-deep-purple-accent-700"
                        >
                            <polyline points="6 23 1 23 1 12 6 12" fill="none" stroke-miterlimit="10"></polyline>
                            <path d="M6,12,9,1H9a3,3,0,0,1,3,3v6h7.5a3,3,0,0,1,2.965,3.456l-1.077,7A3,3,0,0,1,18.426,23H6Z" fill="none" stroke="currentColor" stroke-miterlimit="10"></path>
                        </svg>
                    </div>
                    <p class="font-semibold">7.4K</p>
                </a>
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
                    <p class="font-semibold">81</p>
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
