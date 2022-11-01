<template>
    <div class="relative">
        <img src="https://images.pexels.com/photos/3747463/pexels-photo-3747463.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" class="absolute inset-0 object-cover w-full h-full" alt="" />
        <div class="relative bg-gray-900 bg-opacity-75">
            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="flex flex-col items-center justify-between xl:flex-row">
                    <div class="w-full max-w-xl mb-12 xl:mb-0 xl:pr-16 xl:w-7/12">
                        <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none">
                            The quick, brown fox <br class="hidden md:block" />
                            jumps over a <span class="text-teal-accent-400">lazy dog</span>
                        </h2>
                        <p class="max-w-xl mb-4 text-base text-gray-400 md:text-lg">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan, totam rem aperiam, eaque ipsa quae.
                        </p>
                        <a href="/client/app/public" aria-label="" class="inline-flex items-center font-semibold tracking-wider transition-colors duration-200 text-teal-accent-400 hover:text-teal-accent-700">
                            Learn more
                            <svg class="inline-block w-3 ml-2" fill="currentColor" viewBox="0 0 12 12">
                                <path d="M9.707,5.293l-5-5A1,1,0,0,0,3.293,1.707L7.586,6,3.293,10.293a1,1,0,1,0,1.414,1.414l5-5A1,1,0,0,0,9.707,5.293Z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
                        <div class="bg-white rounded shadow-2xl p-7 sm:p-10">
                            <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                                Sign Up
                            </h3>
                            <form @submit.prevent="saveNewUser">
                                <div class="mb-1 sm:mb-2">
                                    <label for="name" class="inline-block mb-1 font-medium">Name</label>
                                    <input
                                        placeholder="John"
                                        required=""
                                        type="text"
                                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                        id="name"
                                        name="name"
                                        v-model="user.name"
                                    />
                                </div>

                                <div class="mb-1 sm:mb-2">
                                    <label for="email" class="inline-block mb-1 font-medium">E-mail</label>
                                    <input
                                        placeholder="user01@api.example.com"
                                        required=""
                                        type="email"
                                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                        id="email"
                                        name="email"
                                        v-model="user.email"
                                        autocomplete="off"
                                    />
                                </div>

                                <div class="mb-1 sm:mb-2">
                                    <label for="password" class="inline-block mb-1 font-medium">Password</label>
                                    <input
                                        placeholder="Anything more than 7 character"
                                        required=""
                                        type="password"
                                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                        id="password"
                                        name="password"
                                        v-model="user.password"
                                    />
                                </div>

                                <div class="mb-1 sm:mb-2">
                                    <ul class="flex items-center hidden space-x-8 lg:flex">
                                        <li><label for="password" class="inline-block mb-1 font-medium">Confirm Password</label></li>
                                        <li><label v-if="password!=confirm_password"  class="inline-block mb-1 font-medium text-rose-600">
                                            {{this.user.not_match_error}}
                                            Password Not Match
                                        </label></li>

                                    </ul>
                                    <input
                                        placeholder="Please confirm your password"
                                        required=""
                                        type="password"
                                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                        id="confirm_password"
                                        name="confirm_password"
                                        v-model="user.confirm_password"
                                    />
                                </div>

                                <div class="mt-4 mb-2 sm:mb-4">
                                    <svg v-if="disabledButton" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                    </svg>

                                    <button
                                        @click="saveNewUser()"
                                        type="submit"
                                        :disabled="disabledButton"
                                        class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                                        :class="disabledButton ? 'bg-gray-400': 'bg-green-400' "
                                    >

                                        Submit
                                    </button>



                                </div>


                                <p class="text-xs text-gray-600 sm:text-sm">
                                    We respect your privacy. Unsubscribe at any time.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth.js'
import SocketioService from '@/services/socketio.js'

export default {
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },
    data() {
        return {
            user:{
                name: '',
                email: '',
                password: '',
                confirm_password:'',
                disabledButton: false

                // error: null,
            },
            error:[]
        }
    },
    methods: {
        async saveNewUser(){
            if( (this.user.password == this.user.confirm_password) && (this.user.password.length>=7) ){
                this.disabledButton = true
                try {
                    this.error = null  //Bug Below
                    // const response = await this.auth_store.add(this.user)
                    const response = await this.$axios.post('/auth/register', this.user)
                    // this.$router.push('/login/')

                    console.log(response)
                    if (response) {

                        this.$router.push('/login/')
                    }else{
                        this.disabledButton = false

                    }
                } catch (error) {
                    this.not_match_error += 1
                    console.log(error)
                    this.error = error.message
                    this.disabledButton = true

                }
            }
        }
    },

}
</script>
