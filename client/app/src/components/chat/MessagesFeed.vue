<template>
    <div class="feed">
        <ul >
            <li v-for="message in messages" :class="message.to == contact.id ? 'sent' : 'received'" :key="message.id">
                <div class="text">
                    {{ message.text }}
                </div>
            </li>

        </ul>
    </div>
</template>

<script>
    export default {
            props:{
                contact: {
                    type: Object,

                },
                messages: {
                    type: Array,
                    required: true
                }
            }
    }
</script>

<style scoped>
    li {
        margin: 10px;
        width: 100%;
    }
    .text {
        max-width: 200px;
        border-radius: 5px;
        padding: 12px;
        display: inline-block;
    }

    .received {
        text-align: left;
        background-color: gray;
    }
    .sent {
        text-align: right;
        background-color: skyblue;
    }
</style>