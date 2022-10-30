<template>
    <div class="conversation">
        <MessagesFeed :contact="contact" :messages="messages"></MessagesFeed>
        <MessageComposer @send="sendMessage"></MessageComposer>
    </div>

</template>

<script>
import axios from 'axios';
import MessageComposer from './MessageComposer.vue';
import MessagesFeed from './MessagesFeed.vue';
import SocketioService from '@/services/socketio.js'

export default {
    props: {
        contact: {
            type: Object,
            default: null
        },
        messages: {
            type: Array,
            default: []
        },
        user: {
            type: Object,
            required: true
        }
    },
    methods: {
        async sendMessage(text) {
            // if(!this.contrat){
            //     return;
            // }

            const response = await axios.post('http://localhost/api/conversation/send', {
                email: this.user.email,
                contact_email: this.contact.email,
                text: text
            })

            console.log(SocketioService.getId())
            SocketioService.sendToServer('hello.message', {
                text:text,
                to:this.contact.email
            })

            this.$emit('new', response.data)

        },
        listenChatroom(data) {
            this.messages.push(data)
        }
    },
    created() {
        SocketioService.setupSocketConnection()
        SocketioService.getSocket().on('chatroom', this.listenChatroom)
    },
    components: { MessageComposer, MessagesFeed }
}


</script>

<style scoped>
.conversation {
    flex: 2cm;
}
</style>