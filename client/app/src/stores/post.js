import { defineStore } from 'pinia'
import {categoryAPI, postAPI} from '@/services/api.js'

export const usePostStore = defineStore({
    id: 'post',
    state: () => {
        return {
            posts: [],
            categories: []
        }
    },

    getters: {
        getPosts: (state) => state.posts,
        getCategories: (state) => state.categories,
        getPostByCategoryId: (state) => (id) => {
            return state.posts.filter(post => post.category_id === id)
        },
        getLostPosts: (state) => {
            return state.posts.filter(post => post.is_lost === 1)
        },
        getFoundPosts: (state) => {
            return state.posts.filter(post => post.is_lost === 0)
        }
    },

    actions: {
        async fetch () {
            this.posts = await postAPI.getAll()
            this.categories = await categoryAPI.getAll()
        },

        async add (post) {
            const response = await postAPI.saveNew(post)
            if (response.success) {
                this.posts.push({
                    ...post
                })
                return response.post_id
            }
            return false
        },
        async search(query) {
            console.table("searching...")
            this.posts = await postAPI.search(query)
            // display post count
            console.table("found ", this.posts.length)
        },

        delete (id) {
            this.post = this.rewards.filter(post => post.id !== id)
        }
    }
})

