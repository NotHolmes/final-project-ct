<template>

    {{ post.id }}
<!--    <div>-->
<!--        <gmap-map-->
<!--        :center="{lat:10, lng:10}"-->
<!--        :zoom="7"-->
<!--        style="width: 100%; height: 320px">-->

<!--        </gmap-map>-->
<!--        <script src="{{ mix('resources/app.js') }}" ></script>-->
<!--    </div>-->

</template>

<script>
export default {
    data() {
        return {
            post: null,
            error: null
        }
    },
    async created() {
        const id = this.$route.params.id
        const url = `/posts/${id}`
        try {
            this.error = null
            let response = await this.$axios.get(url)
            if (response.status === 200) {
                this.reward = response.data.data
                console.table(this.post)
            }
        } catch (error) {
            this.error = error.message
        }
    }
}
</script>
