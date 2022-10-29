<template>

    <div v-if=post>
        <h1> id : {{ post.id }}</h1>
        {{ post.title }}
    </div>

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
                this.post = response.data.data
                console.table(this.post)
            }
        } catch (error) {
            this.error = error.message
        }
    }
}
</script>
