<template>
    <div class="conversation">
        <MessagesFeed :contact="contact" :messages="messages"></MessagesFeed>
        <MessageComposer @send="sendMessage"></MessageComposer>
    </div>

</template>

<script>
    import MessageComposer from './MessageComposer.vue';
    import MessagesFeed from './MessagesFeed.vue';
    export default {
        props:{
            contact:{
                type: Object,
                default:null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods:{
            sendMessage(text){
                console.log(text);
                console.log('Message in Conversation')
                console.log(this.messages);
            }
        },
        components: {MessageComposer, MessagesFeed}
    }
</script>

<style scoped>
.conversation {
    flex: 2cm;
}
</style>