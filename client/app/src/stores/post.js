import { defineStore } from 'pinia'
import { postAPI } from '@/services/api.js'

export const usePostStore = defineStore({
    id: 'post',
    state: () => {
        return {
            posts: []
        }
    },

    getters: {
        getPosts: (state) => state.posts,
    },

    actions: {
        async fetch () {
            this.posts = await postAPI.getAll()
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

        delete (id) {
            this.post = this.rewards.filter(post => post.id !== id)
        }
    }
})

