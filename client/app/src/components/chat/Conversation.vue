<template>
    <div class="conversation pb-2" >
        <h1 class="block ml-2 font-semibold text-base rounded p-2 border text-gray-600 ">{{ contact? contact.name : 'Unknow Person'}}</h1>
        <MessagesFeed :contact="contact" :messages="messages"></MessagesFeed>
        <MessageComposer @send="sendMessage"></MessageComposer>
    </div>

</template>

<script>
import axios from 'axios';
import MessageComposer from './MessageComposer.vue';
import MessagesFeed from './MessagesFeed.vue';
import SocketioService from '@/services/socketio.js'
import { useAuthStore } from '@/stores/auth.js';

export default {
    setup(){
        const auth_store = useAuthStore()
        return { auth_store }
    },
    data() {
        return {
            auth : null
        };
    },
    mounted(){
        if(this.auth_store.isAuthen){
                this.auth = this.auth_store.getAuth
            } else {
                this.auth = null
        }
    },
    props: {
        token: {
            type: String,
            required: true
        }
        ,
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
    watch: {
            auth_store: {
                immediate: true,
                deep: true,
                handler(newValue, oldValue){
                    console.log(newValue.getAuth)
                    this.auth = this.auth_store.getAuth
                }
            }
    },
    methods: {
        async sendMessage(text) {
            // if(!this.contrat){
            //     return;
            // }

            const response = await axios.post('http://localhost/api/conversation/send', {
                contact_email: this.contact.email,
                text: text
            },{ headers: {"Authorization" : 'Bearer ' + this.token } })

            console.log(SocketioService.getId())
            SocketioService.sendToServer('hello.message', {
                from: this.auth.email,
                text:text,
                to:this.contact.email
            })

            this.$emit('new', response.data)

        },
        listenChatroom(data) {
            if(this.contact != null && this.contact.email == data.from && this.auth.email == data.to){
                this.messages.push(data)
            }
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

.contactName{
    /*margin-left: 5px;*/
    /*margin-right: ;*/
    /*margin: 10px;*/
    width:95%;
    padding: 10px;
    border-radius: 3px;
    border: 1px solid #aaaaaa ;
}
</style>
