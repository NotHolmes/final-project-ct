<template>
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
                                <span v-if="!post.is_done">
                                <h4 v-if="post.reward !== 0 && post.reward !== null && post.is_lost" class="mb-5 text-xs leading-5"> Reward : {{post.reward}} baht</h4>
                                    <span v-if="this.auth_store.auth.role !== 'ADMIN'">
                                <button v-if="parseInt(post.user_id) !== parseInt(auth_store.auth.id)"
                                    class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                                        @click="handleContact()"
                                >
                                    Contact

                                </button>
                                        <span v-if="parseInt(post.is_lost)">
                                 <button v-if="parseInt(post.user_id) === parseInt(auth_store.auth.id)"
                                         class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                         @click="showModal('selfFound'); resetModal('selfFound')"
                                 >
                                        I found it
                                    </button>
                                            </span>
                                <span v-if="parseInt(post.is_lost)" @click="resetModal('someoneFound')">
                                    <button v-if="parseInt(post.user_id) === parseInt(auth_store.auth.id)"
                                            class="mr-5 mt-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                            @click="showModal('someoneFound')"
                                    >
                                        Someone found it
                                    </button>
                                </span>
                                <span v-else @click="resetModal('found')">
                                    <button v-if="parseInt(post.user_id) !== parseInt(auth_store.auth.id)"
                                            class="mr-5 mt-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                            @click="showModal('found')"
                                    >
                                        This is my item
                                    </button>
                                </span>
                                    </span>

                                </span>

                                <span v-if="parseInt(post.user_id) === parseInt(auth_store.auth.id) && !post.is_done">
                                      <button
                                          class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                                          @click="this.$router.push('/posts/edit/' + post.id)"
                                      >
                                    Edit

                                </button>
                                </span>

                                <span v-if="this.auth_store.auth.role === 'ADMIN' || (parseInt(this.auth_store.auth.id) === parseInt(this.post.user_id))">
                                          <button
                                              class="mr-5 mt-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-red-400 hover:bg-red-700 focus:shadow-outline focus:outline-none"
                                              @click="showModal('delete')"
                                          >
                                        Delete
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
                                        <span v-if="(founder_use_site && this.give_points && !this.done && !this.submit)">
                                            <div class="my-6">
                                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                                                <input v-model="founder_username" type="text" id="username" name="username" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Username" required=""/>
<!--                                                v-bind:rules="[validateNull]" <ErrorMessage class="text-red-500" name="title"></ErrorMessage>-->
                                                <p v-if="founder && parseInt(founder.id) === parseInt(auth_store.auth.id)" class="my-3 text-red-400">You can't return your own item</p>
                                                <p v-if="founder && parseInt(founder.id) !== parseInt(auth_store.auth.id)" class="my-3 text-green-400">User found</p>
                                                <p v-if="founder_username !== null && founder_username !== '' && !founder" class="my-3 text-red-400">User not found</p>
                                            </div>
                                        </span>
                                    </div>

                                    <div class="modal-footer py-3 px-5 border0-t text-right">
                                        <button v-if="(!this.done && !this.founder_use_site && this.chat && this.item_returned ) || this.submit || !this.give_points"
                                            class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                            @click="handleYes">Yes
                                        </button>
                                        <button v-if="((!this.done && !this.founder_use_site && this.chat && this.item_returned) || this.submit || !this.give_points)"
                                            class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-orange-400 hover:bg-orange-700 focus:shadow-outline focus:outline-none"
                                            @click="handleNo">No
                                        </button>
                                        <button v-if="!this.done && this.founder_use_site && founder_username !== null && founder_username !== '' && founder && parseInt(founder.id) !== parseInt(auth_store.auth.id) && this.chat && !this.submit && !this.checkCongrat()"
                                                class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-400 hover:bg-green-700 focus:shadow-outline focus:outline-none"
                                                @click="handleSubmitUsername()">Submit
                                        </button>
                                        <button v-if="!this.done && this.founder_use_site && !this.submit  && !this.checkCongrat() "
                                                class="mr-5 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-orange-400 hover:bg-orange-700 focus:shadow-outline focus:outline-none"
                                                @click="handleNo">No thanks
                                        </button>
                                        <button v-if="!this.done && this.chat && this.item_returned && !this.delete"
                                            class="inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-red-400 hover:bg-red-700 focus:shadow-outline focus:outline-none"
                                            @click="showModal()">Cancel
                                        </button>
                                        <button v-if="this.done || !this.chat || !this.item_returned"
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
import axios from "axios";
import SocketioService from '@/services/socketio.js'
import router from "../../router";

export default {
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },

    data() {
        return {
            auth:null ,
            congrat: false,
            do_you_want: false,
            submitting: false,
            delete: false,
            give_points: true,
            item_returned: true,
            chat: true,
            submit: false,
            users: [],
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
    watch: {
        founder_username: function (newVal, oldVal) {
            let user = this.users.find(user => user.name === newVal)
            if(user) {
                this.founder = user
            } else {
                this.founder = null
            }
        }
    },
    async mounted() {

        if(this.auth_store.isAuthen){
                this.auth = this.auth_store.getAuth
            } else {
                this.auth = null
            }

        await axios.get('http://localhost/api/users', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('jwt_token')}`
            }
            })
            .then(async (resp) => {
                this.users = await resp.data.data;
            })
            .catch((err) =>{
                console.log(err.data)
            })
    },
    async created() {
        SocketioService.setupSocketConnection()
        const id = this.$route.params.id
        const url = `/posts/${id}`
        try {
            this.error = null
            let response = await this.$axios.get(url, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('jwt_token')}`
                }
            })
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
        checkCongrat(){
            if(this.confirm_word === 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?')
                return true
            else
                return false
        },
        async handleContact(){
            // find user by user_id
            console.log(this.auth_store.auth.email + 'autththth');
            let user = this.users.find(user => user.id === this.post.user_id)

            //access email in user
            console.log(user.email)
            await this.$router.push('/chat')
            SocketioService.sendToServer('quick.chat', {
                email: user.email,
                name: user.name,
                from: this.auth_store.auth.email
            })
            this.$router.push('/chat')
        },
        async updatePostIsDone(){
            let url = `http://localhost/api/posts/${this.$route.params.id}`
            let data = {
                is_done: true
            }
            await axios.put(url, data, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('jwt_token')}`
                }
            })
                .then(async (resp) => {
                    this.post = await resp.data.data;
                })
                .catch((err) =>{
                    console.log(err.data)
                })
        },
        async updatePointForPost(user_id){
            let url = `http://localhost/api/users/${this.founder.id}`
            let data = {
                point: this.founder.point + 100
            }
            await axios.put(url, data, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('jwt_token')}`
                }
            })
                .then(async (resp) => {
                    this.founder = await resp.data.data;
                })
                .catch((err) =>{
                    console.log(err.data)
                })
        },
        async updatePostHidden(){
            let url = `http://localhost/api/posts/${this.$route.params.id}`
            let data = {
                hidden: true
            }
            axios.put(url, data, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('jwt_token')}`
                }
            })
                .then(async (resp) => {
                    const temp = await resp.data.data;
                })
                .catch((err) =>{
                    console.log(err.data)
                })
        },
        async handleSubmitUsername(){
            if(this.founder.id && parseInt(this.founder.id) !== parseInt(this.auth_store.auth.id))
            {
                await this.updatePointForPost()
            }
            await this.updatePostIsDone()
            this.submit = true
            this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'
            this.congrat = true
            // this.$router.push({ name: 'posts' })

        },
        async handleYes(){

            if(this.confirm_word === 'Are you sure that you want to delete this item?'){
                this.delPost(this.post.id)
                this.$router.push({ name: 'posts' })
                return
            }

            if(this.confirm_word === 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'){
                await this.updatePostHidden()
                this.$router.push({ name: 'posts' })
                return
            }


            if(this.confirm_word === 'Are they a user of this website?'){
                this.founder_use_site = true
                this.confirm_word = ('Please enter their username to give them points')
                this.submitting = true
                return
            }

            if(this.confirm_word === 'Are you sure that you gave it to the right owner?'){
                this.confirm_word = 'Thank you for your service 🫡'
                this.done = true
                return
            }

            if(this.confirm_word === 'Have you tried contact this person through our chat system?') {
                this.chat = true
                this.confirm_word = 'Did the person return you this item?'
                return
            }

            if(this.confirm_word === 'Did the person return you this item?') {
                this.confirm_word = 'Do you want to give points to this person?'
                return
            }

            if(this.confirm_word === 'Do you want to give points to this person?') {
                this.give_points = true
                this.do_you_want = true
                this.submitting = true
                this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'
                return
            }

            if(this.confirm_word === 'Please enter their username to give them points') {
                this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'
                this.congrat = true
                // this.submitting = true
                return
            }
        },
        async handleNo(){
            if(this.confirm_word === 'Are you sure that you want to delete this item?'){
                this.showModal()
                return
            }

            if(this.confirm_word === 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'){
                await this.updatePostIsDone()
                this.$router.push({ name: 'posts' })
                return
            }

            if(this.confirm_word === 'Do you want to give points to this person?') {
                this.give_points = false
                this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'
                this.congrat = true
                return
            }

            if(this.confirm_word === 'Did the person return you this item?') {
                this.item_returned = false
                this.confirm_word = 'You can use our chat system to contact this person to return you your item'
                return
            }

            if(this.confirm_word === 'Are they a user of this website?') {
                this.founder_use_site = false
                this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'
                this.congrat = true
                return
            }

            if(this.confirm_word === 'Please enter their username to give them points'){
                this.give_points = false
                this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'
                this.congrat = true
                return
            }

            if(this.confirm_word === 'Have you tried contact this person through our chat system?') {
                this.chat = false
                this.confirm_word = 'Please use our chat system to contact this person to identify your item first'
                return
            }
        },
        resetModal(type){
            if(type === 'someoneFound')
                this.confirm_word = 'Are they a user of this website?'

            if(type === 'selfFound')
                this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'

            this.congrat = false
            this.do_you_want = false
            this.delete = false
            this.give_points = true
            this.item_returned = true
            this.chat = true
            this.founder_use_site = false
            this.done = false
            this.founder_username = ''
        },
        showModal(type){
            if(type === 'someoneFound')
                this.confirm_word = 'Are they a user of this website?'


            if(type === 'delete') {
                this.confirm_word = 'Are you sure that you want to delete this item?'
                this.delete = true;
            }

            if(type === 'selfFound') {
                this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'
                this.congrat = true
            }

            if(this.show_modal){
                //stop screen scrolling
                // document.getElementsByTagName("html")[0].classList.remove('overflow-y-hidden');
                this.show_modal = false;
            }else{
                // document.getElementsByTagName("html")[0].classList.add('overflow-y-hidden');
                if(type === 'found') {
                    this.confirm_word = 'Have you tried contact this person through our chat system?'
                    this.do_you_want = false;
                }
                else if(type === 'delete')
                    this.confirm_word = 'Are you sure that you want to delete this item?'
                else if (type === 'selfFound') {
                    this.confirm_word = 'Congratulations on your found ! 🎉' + "\n" + 'do you want to hide this post?'
                    this.congrat = true
                }
                else
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
        },
        editPost() {
            console.table(this.post)
            this.$router.push(`edit/${this.post.id}`)
        },
        delPost(id) {
            const JWT_TOKEN_LOCALSTORAGE_KEY = 'jwt_token'
            const token = localStorage.getItem(JWT_TOKEN_LOCALSTORAGE_KEY)

            console.log(token)

            let url = `http://localhost/api/posts/${id}`
            axios.delete(url, {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            }).then((resp) => {
                    console.log(resp.data)
                })
                .catch((err) =>{
                    console.log(err.data)
                })

        },
    },
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
