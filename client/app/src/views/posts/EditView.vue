<template>
<span>{{post}}</span>
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">

        <Form @submit.prevent="updatePost">

            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                <Field v-bind:rules="[validateNull]" v-model="post.title" type="text" id="title" name="title" autocomplete="off"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Title" required=""/>
                <ErrorMessage class="text-red-500" name="title"></ErrorMessage>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category</label>
                    <Field v-bind:rules="[validateNull]" as="select" v-model="post.category_id" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option disabled>Choose category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </Field>
                    <ErrorMessage class="text-red-500" name="title"></ErrorMessage>
                </div>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Color</label>
                    <Field v-bind:rules="[validateNull]" as="select" name="color" v-model="post.color" id="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option disabled>Choose color</option>
                        <option v-for="color in colors" :key="color.id" :value="color.name">{{ color.name }}</option>
                    </Field>
                    <ErrorMessage class="text-red-500" name="color"></ErrorMessage>
                </div>
                <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Brand</label>
                    <Field placeholder="Brand" v-bind:rules="validateNull" v-model="post.brand" type="text" id="brand" name="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    <ErrorMessage class="text-red-500" name="brand"></ErrorMessage>
                </div>
                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date</label>
                    <Field v-bind:rules="validateNull" v-model="this.date" type="date" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""/>
                    <ErrorMessage class="text-red-500" name="date"></ErrorMessage>
                </div>
                <div>
                    <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Time</label>
                    <Field v-bind:rules="validateNull" v-model="this.time" type="time" id="time" name="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""/>
                    <ErrorMessage class="text-red-500" name="time"></ErrorMessage>
                </div>

                <div v-if="post.is_lost === '1'">
                    <label for="reward" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Reward</label>
                    <Field v-bind:rules="validateReward" placeholder="Reward" v-model="post.reward" type="number" id="reward" name="reward" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""/>
                    <ErrorMessage class="text-red-500" name="reward"></ErrorMessage>
                </div>
                <span v-if="post.is_lost === '1'"></span>

                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                    <Field placeholder="Description..." as="textarea" v-bind:rules="validateNull" v-model="post.description" id="description" name="description" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""/>
                    <ErrorMessage class="text-red-500" name="description"></ErrorMessage>
                </div>
                <span></span>

                <div class="">
                    <label for="upload" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Upload
                        Image(jpg, png, jpeg)</label>
                    <div class="rounded-lg bg-gray-50 lg:w-full" id="upload">
                        <div class="m-4">
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                            Select an image</p>
                                    </div>
                                    <input required type="file" accept="image/*" name="image" id="image" class="opacity-0" @change="onChange" />
                                    <p v-if="validateImage(!this.post.image)" class="my-7" @submit.prevent="saveNewPost">(Image is required)</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="preview" class="mt-6">
                        <img v-if="post.image" :src="post.imageUrl"  alt=""/>
                    </div>
                </div>

            </div>

            <GMapAutocomplete
                placeholder="Search for your location"
                @place_changed="setPlace"
                class="my-6 border border-gray-300"
            >
            </GMapAutocomplete>

            <GMapMap
                :click="true"
                @click="onMapClick"
                :center="{lat: this.lat , lng: this.lng}"
                :zoom="18"
                map-type-id="terrain"
                style="width: 100%; height: 700px"
                streetViewControl: false,
                :options="{
                    zoomControl: true,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    rotateControl: false,
                    fullscreenControl: false,
                    disableDefaultUi: false
                }"
            >
                <GMapMarker
                    v-for="(marker, index) in markers"
                    :key="index"
                    :position="marker.position"
                    @click="center=marker.position">

                </GMapMarker>
            </GMapMap>
            <p v-if="!validateLocation()" class="my-6" @submit.prevent="saveNewPost">(Marker is required)</p>


            <!--            <div class="flex items-start my-6">-->
            <!--                <div class="flex items-center h-5">-->
            <!--                    <input id="remember" type="checkbox" value="" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">-->
            <!--                </div>-->
            <!--                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a>.</label>-->
            <!--            </div>-->
            <button type="submit"
                    @click="updatePost()"
                    class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </Form>
    </div>

</template>

<script>
import SocketioService from '@/services/socketio.js'
import { usePostStore } from "@/stores/post.js";
import { useAuthStore } from "@/stores/auth.js";
// import Form Field ErrorMessage from vee
import { Form, Field, ErrorMessage } from 'vee-validate';
import axios from "axios";

export default {
    components: {
        Form,
        Field,
        ErrorMessage

    },
    setup() {
        const post_store = usePostStore()
        const auth_store = useAuthStore()
        return { post_store, auth_store }
    },
    data() {
        return {
            post: {
                user_id: this.auth_store.auth.id,
                category_id: null,
                title: null,
                description: null,
                brand: null,
                color: null,
                date: null,
                reward: null,
                is_lost: this.$route.params.is_lost,
                time: null,
                image: null,
                latitude: null,
                longitude: null,
            },
            date: null,
            time: null,
            markers: [
                {
                    position: {
                        lat: 0,
                        lng: 0,
                    }
                }
            ],
            error: null,
            categories: null,
            colors: [
                { name: 'Red', value: '#f44336' },
                { name: 'Pink', value: '#e91e63' },
                { name: 'Purple', value: '#9c27b0' },
                { name: 'Deep Purple', value: '#673ab7' },
                { name: 'Indigo', value: '#3f51b5' },
                { name: 'Blue', value: '#2196f3' },
                { name: 'Light Blue', value: '#03a9f4' },
                { name: 'Cyan', value: '#00bcd4' },
                { name: 'Teal', value: '#009688' },
                { name: 'Green', value: '#4caf50' },
                { name: 'Light Green', value: '#8bc34a' },
                { name: 'Lime', value: '#cddc39' },
                { name: 'Yellow', value: '#ffeb3b' },
                { name: 'Amber', value: '#ffc107' },
                { name: 'Orange', value: '#ff9800' },
                { name: 'Deep Orange', value: '#ff5722' },
                { name: 'Brown', value: '#795548' },
                { name: 'Grey', value: '#9e9e9e' },
                { name: 'Blue Grey', value: '#607d8b' },
                { name: 'Black', value: '#000000' },
            ],
            lat: 13.847673555174328,
            lng: 100.56958661138006,
        }
    },
    async created() {
        SocketioService.setupSocketConnection()
        SocketioService.getSocket().on('categories.index',
            this.refreshSocketCategories)

        const id = this.$route.params.id
        const url = `http://localhost/api/posts/${id}`
        try {
            this.error = null
            let response = await this.$axios.get(url)
            if (response.status === 200) {
                this.post = response.data.data
                console.log(this.post)
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
                const dt = this.post.datetime.split(" ")
                this.date = dt[0]
                this.time = dt[1].substring(0, 5)
            }
        } catch (error) {
            this.error = error.message
        }
    },
    methods: {
        setPlace(place) {
            this.post.latitude = place.geometry.location.lat()
            this.post.longitude = place.geometry.location.lng()
            this.markers[0].position.lat = place.geometry.location.lat()
            this.markers[0].position.lng = place.geometry.location.lng()
        },
        validateLocation(){
            if (this.markers[0].position.lat === 0 && this.markers[0].position.lng === 0){
                return false
            }
            return true
        },

        validateImage(image){
            if(!image){
                return false
            }
            return true
        },
        validateReward(){
            const regex = /^[+-]?(\d*\.)?\d+$/i;
            if(!regex.test(this.post.reward)){
                return "Numbers only"
            }
            return true
        },
        validateNull(value){
            if (!value ){
                return "This field is required";
            }
            return true;
        },
        onMapClick(event) {
            // console.table(event.latLng.toJSON().lat)
            //   console.table(event.latLng.toJSON().lng)
            if (event.latLng?.lat) {
                if(this.markers.length > 0) {
                    this.markers = []
                }
                this.markers.push({
                    position: event.latLng.toJSON(),
                })
                this.post.latitude = event.latLng.toJSON().lat
                this.post.longitude = event.latLng.toJSON().lng
            }
        },
        onChange(e) {
            const file = e.target.files[0]
            this.post.image = file
            this.post.imageUrl = URL.createObjectURL(file)
        },
        async refreshCategories() {
            try {
                await this.post_store.fetch()
                this.categories = this.post_store.getCategories
            } catch (error) {
                this.error = error
            }
        },
        async refreshSocketCategories(data) {
            if (data.refresh) {
                await this.refreshCategories()
            }
        },
        async updatePost() {
            //check posts.lat and posts.lng === null
            if (!this.validateLocation()){
                return
            }
            // check image === null
            if (!this.validateImage(this.post.image)){
                return
            }

            this.post.hidden = true
            let url = `http://localhost/api/posts/${this.post.id}`
            let data = {
                user_id: this.post.user_id,
                category_id: this.post.category_id,
                title: this.post.title,
                description: this.post.description,
                brand: this.post.brand,
                color: this.post.color,
                date: this.post.date,
                reward: this.post.reward,
                is_lost: this.post.is_lost,
                time: this.post.time,
                image: this.post.image,
                latitude: this.post.latitude,
                longitude: this.post.longitude,
                hidden: this.post.hidden
            }
            axios.put(url, data)
                .then(async (resp) => {
                    console.table(resp.data)
                    const post_id = await resp.data.post_id;
                    this.$router.push(`/posts/${post_id}`)
                })
                .catch((err) =>{
                    console.log(err.data)
                })

        }
    },
    async mounted() {
        await this.refreshCategories()
    }
}

</script>
