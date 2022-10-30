<template>
    <ul class="flex items-center hidden space-x-8 lg:flex" v-if="auth && auth.email">
        <!--    Welcome, {{ auth.email }} [{{ auth.point }} Point] | -->
        <li
            class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-deep-purple-accent-400"
        >
            {{ auth.name }}
        </li>

        <li
            class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
        >
            <router-link to="/logout">Sign Out</router-link>
        </li>
    </ul>

    <div v-else
         class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
    >
        <router-link to="/login">Sign In</router-link>
    </div>
</template>

<script>
import {useAuthStore} from '@/stores/auth.js'

export default {
    setup() {
        const auth_store = useAuthStore()
        return {auth_store}
    },
    data() {
        return {
            auth: null
        }
    },
    watch: {
        auth_store: {
            immediate: true,
            deep: true,
            handler(newValue, oldValue) {
                console.log(newValue.getAuth)
                this.auth = this.auth_store.getAuth
            }
        }
    },
    mounted() {
        if (this.auth_store.isAuthen) {
            this.auth = this.auth_store.getAuth
        } else {
            this.auth = null
        }

    }
}
</script>
