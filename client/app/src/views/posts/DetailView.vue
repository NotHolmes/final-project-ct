<template>
<!--<div v-if=post>lat = {{ post.latitude }} lng = {{ post.longitude }} {{this.markers}}</div>-->

    <section class="text-gray-600 body-font relative">
        <div class="absolute inset-0 bg-gray-300">
            <GMapMap
                :center="{lat: this.lat, lng: this.lng}"
                :zoom="16"
                map-type-id="terrain"
                style="width: 100vw; height: 900px"
            >
                <GMapMarker
                    v-for="(marker, index) in markers"
                    :key="index"
                    :position="marker.position"
                    :clickable="true"
                    :draggable="true"
                    @click="center=marker.position"
                    :disableDefaultUI="true"></GMapMarker>
                <GMapCircle
                    :radius="100"
                    :center="{ lat: this.lat, lng: this.lng}"
                    :options="circleOptions"
                />
            </GMapMap>
        </div>

        <div class="container px-5 py-24 mx-auto flex" v-if=post>
            <div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
                <div aria-label="View Item" class="inline-block overflow-hidden duration-300 transform bg-white rounded shadow-sm hover:-translate-y-2">
                    <div class="flex flex-col h-full">
                        <img v-bind:src="post.image" class="object-cover w-full h-48" alt="" />
                        <div class="flex-grow border border-t-0 rounded-b">
                            <div class="p-5">
                                <h6 class="mb-2 font-semibold leading-5">{{ post.title }}</h6>
                                <h5 class="mb-2 leading-5">Color : {{ post.color }}</h5>
                                <h5 class="mb-2 leading-5">Brand : {{ post.brand }}</h5>
                                <h5 v-if="post.is_lost" class="mb-2 leading-5"> Lost time : {{ formatDate(post.datetime) }}</h5>
                                <h5 v-else class="mb-2 leading-5"> Found time : {{ formatDate(post.datetime) }}</h5>
                                <p class="mb-2 text-sm text-gray-900">
                                    {{ post.description }}
                                </p>
                                <h4 v-if="post.reward !== 0 && post.reward !== null" class="mb-5 text-xs leading-5"> Reward : {{post.reward}} baht</h4>
                                <button v-if="parseInt(post.user_id) !== parseInt(auth_store.auth.id)"
                                    class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                                >
                                    Contact

                                </button>
                                <span v-if="parseInt(post.is_lost)" @click="resetModal()">
                                    <button v-if="parseInt(post.user_id) === parseInt(auth_store.auth.id)"
                                        class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                    >
                                        I found it
                                    </button>
                                    <button v-if="parseInt(post.user_id) === parseInt(auth_store.auth.id)"
                                            class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                            @click="showModal()"
                                    >
                                        Someone found it
                                    </button>
                                    <button v-if="parseInt(post.user_id) !== parseInt(auth_store.auth.id)"
                                            class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                            @click="showModal()"
                                    >
                                        Return
                                    </button>
                                </span>
                                <span v-else @click="resetModal()">
                                    <button v-if="parseInt(post.user_id) === parseInt(auth_store.auth.id)"
                                            class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                    >
                                        I returned it
                                    </button>
                                    <button v-if="parseInt(post.user_id) !== parseInt(auth_store.auth.id)"
                                            class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                    >
                                        This is my item
                                    </button>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="app" class="h-full w-full flex items-center justify-center">
            <transition name="fade">

                <div v-show="show_modal" class="fixed inset-0 z-30">

                    <!--       background -->
                    <div v-show="show_modal" @click="showModal()" class="bg-filter bg-white opacity-25 fixed inset-0 w-full h-full z-20">
                    </div>
                    <!--          -->
                    <main class="flex flex-col items-center justify-center h-full w-full">
                        <transition name="fade-up-down">
                            <div v-show="show_modal" class="modal-wrapper inline-block flex items-center z-30">
                                <div class="modal max-w-md mx-auto xl:max-w-5xl lg:max-w-5xl md:max-w-2xl bg-white max-h-screen shadow-lg flex-row rounded relative">


                                    <div class="modal-header p-5 bg-deep-purple-accent-400 text-gray-900 rounded-t">
                                        <h5 class="text-white text-2xl uppercase">Confirmation</h5>
                                    </div>


<!--                                    <div class="flex">-->
<!--                                        <input type="checkbox" id="choose-me" class="peer hidden" />-->
<!--                                        <label for="choose-me" class="select-none cursor-pointer rounded-lg border- border-gray-500 bg-black-->
<!--   py-3 px-6 font-bold text-gray-200 transition-colors duration-200 ease-in-out peer-checked:bg-gray-200 peer-checked:text-gray-900 peer-checked:border-black-200 " @click=""> Check me </label>-->
<!--                                    </div>-->


                                    <div class="modal-body p-5 w-full h-full overflow-y-auto ">
                                        <p class="text-justify" >
                                            {{ confirm_word }}
                                        </p>
                                        <span v-if="founder_use_site">
                                            <div class="my-6">
                                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                                                <input v-model="founder_username" type="text" id="username" name="username" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Username" required=""/>
<!--                                                v-bind:rules="[validateNull]" <ErrorMessage class="text-red-500" name="title"></ErrorMessage>-->
                                            </div>
                                        </span>
                                    </div>

                                    <span>{{this.founder_username}}</span>
                                    <span>{{this.founder}}</span>

                                    <div class="modal-footer py-3 px-5 border0-t text-right">
                                        <button v-if="!this.done && !this.founder_use_site"
                                            class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                            @click="handleYes">Yes
                                        </button>
                                        <button v-if="!this.done && !this.founder_use_site"
                                            class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-orange-400 hover:bg-orange-700 focus:shadow-outline focus:outline-none"
                                            @click="handleNo">No
                                        </button>
                                        <button v-if="!this.done && this.founder_use_site"
                                                class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                                @click="handleSubmitUsername()">Submit
                                        </button>
                                        <button v-if="!this.done && this.founder_use_site"
                                                class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-orange-400 hover:bg-orange-700 focus:shadow-outline focus:outline-none"
                                                @click="showModal()">No thanks
                                        </button>
                                        <button v-if="!this.done"
                                            class="inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-red-400 hover:bg-red-700 focus:shadow-outline focus:outline-none"
                                            @click="showModal()">Cancel
                                        </button>
                                        <button v-if="this.done"
                                            class="inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-blue-400 hover:bg-blue-700 focus:shadow-outline focus:outline-none"
                                            @click="showModal()">Done
                                        </button>

                                    </div>

                                </div>
                            </div>
                        </transition>
                    </main>
                </div>
            </transition>
        </div>

    </section>

</template>

<script>

import { useAuthStore } from '@/stores/auth.js'

export default {
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },

    data() {
        return {
            founder:null,
            founder_username: '',
            founder_use_site: false,
            done: false,
            confirm_word: 'Are they a user of this website?',
            show_modal: false,
            post: null,
            error: null,
            lat: 13.847673555174328,
            lng: 100.56958661138006,
            markers: [
                {
                    position: {
                        lat: 13.847673555174328,
                        lng: 100.56958661138006
                    }
                }
            ],
            circleOptions: {
                strokeColor: "#771bcd",
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillColor: "#771bcd",
                fillOpacity: 0.35,
            },
        }
    },

    async created() {
        const id = this.$route.params.id
        const url = `/posts/${id}`
        try {
            this.error = null
            let response = await this.$axios.get(url)
            if (response.status === 200) {
                this.post = response.data.data
                this.lat = Number(this.post.latitude)
                this.lng = Number(this.post.longitude)
                this.markers = [
                    {
                        position: {
                            lat: this.lat,
                            lng: this.lng
                        }
                    }
                ]
                console.table(this.post)
            }
        } catch (error) {
            this.error = error.message
        }
    },

    methods: {
        updatePost(){
            this.post.is_done = true
        },
        async handleSubmitUsername(){
            //use auth_store checkName to check and assign user to founder
            // console.table(this.auth_store())
            // this.founder = this.auth_store.searchName(this.founder_username)

            // this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post ?'
            // this.updatePost()
        },
        handleYes(){
            if(this.confirm_word === 'Are they a user of this website?'){
                this.founder_use_site = true
                this.confirm_word = 'Please enter their username to give them points'
            }

            if(this.confirm_word === 'Are you sure that you gave it to the right owner?'){
                this.confirm_word = 'Thank you for your service 🫡'
                this.done = true
            }
        },
        handleNo(){
            if(this.confirm_word === 'Are they a user of this website?') {
                this.founder_use_site = false
                this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post ?'
            }

            if(this.confirm_word === 'Please enter their username to give them points'){
                this.done = true
            }
        },
        resetModal(){
            this.confirm_word = 'Are they a user of this website?'
            this.founder_use_site = false
            this.done = false
            this.founder_username = ''
        },
        showModal(){
            if(this.show_modal){
                //stop screen scrolling
                document.getElementsByTagName("html")[0].classList.remove('overflow-y-hidden');
                this.show_modal = false;
            }else{
                document.getElementsByTagName("html")[0].classList.add('overflow-y-hidden');
                this.confirm_word = 'Are they a user of this website?'
                this.show_modal = true;
            }
        },
        formatDate(dateString) {
            const date = new Date(dateString)
            return new Intl.DateTimeFormat('en-US', {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: 'numeric',
                minute: 'numeric',
            }).format(date)
        }
    }
}

</script>

<style>
    .modal-body{
    max-height: 500px;
}
    .bg-gray-800-opacity{
    background-color: #2D374850;
}
    @media screen and (max-width: 768px){
    .modal-body {
    max-height: 400px;
}
}

    /* animation for vue transition tag */

    .fade-up-down-enter-active {
    transition: all 0.3s ease;
}
    .fade-up-down-leave-active {
    transition: all 0.3s ease;
}
    .fade-up-down-enter {
    transform: translateY(10%);
    opacity: 0;
}
    .fade-up-down-leave-to {
    transform: translateY(10%);
    opacity: 0;
}

    .fade-enter-active{
    -webkit-transition: opacity 2s;
    transition: opacity .3s;

}
    .fade-leave-active {
    transition: opacity .3s;
}

    .fade-enter,
    .fade-leave-to{
    opacity: 0;
}
</style>
