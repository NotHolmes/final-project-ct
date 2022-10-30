<template>
<!--<div v-if=post>lat = {{ post.latitude }} lng = {{ post.longitude }} {{this.markers}}</div>-->

    <section class="text-gray-600 body-font relative">
        <div class="absolute inset-0 bg-gray-300">
<!--            <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=%C4%B0zmir+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" style=""></iframe>-->
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
                                <h4 v-if="post.reward !== 0" class="mb-5 text-xs leading-5"> Reward : {{post.reward}} baht</h4>
                                <button
                                    class="inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                                >
                                    Contact
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
export default {

    data() {
        return {
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
