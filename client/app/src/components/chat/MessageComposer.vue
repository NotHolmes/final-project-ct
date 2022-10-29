<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="..."></textarea>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                message: []
            };
        },
        methods: {
            send(){
                if(this.message === ''){
                    return;
                }

                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>

<style>
div > textarea {
    width: 96%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid #aaaaaa;
    padding: 6px;
}

</style>