<template>
    <div class="chat">
            Welcome , {{ auth.email }}
        <Conversation :contact="selectedContact" :messages="messages" :token="token" @new="saveNewMessage" ></Conversation>
        <ContactsList :contacts="contacts" :token="token" @selected="stratConversationWith"></ContactsList>

    </div>
</template>

<script>
import axios from 'axios'
import ContactsList from '@/components/chat/ContactsList.vue';
import Conversation from '@/components/chat/Conversation.vue';
import { useAuthStore } from '@/stores/auth.js';

    export default{
        setup(){
            const JWT_TOKEN_LOCALSTORAGE_KEY = 'jwt_token'
            const token = localStorage.getItem(JWT_TOKEN_LOCALSTORAGE_KEY)
            const auth_store = useAuthStore()
            return { auth_store , token}
        },
        props:{
            user: {
                type: Object,
                //required: true
            }
        },
        data() {
            return {
                auth: null ,
                selectedContact : null ,
                contacts: null ,
                messages: [] ,

            };
        },
        async mounted() {
            // const instance = axios.create({
            //     baseURL: 'https://example.com/api/',
            //     timeout: 1000,
            //     headers: {'Authorization':  'Bearer ' + token }
            // });

            if(this.auth_store.isAuthen){
                this.auth = this.auth_store.getAuth
            } else {
                this.auth = null
            }

            const response = await axios.get(`http://localhost/api/contacts/${this.auth.email}`,{ headers: {"Authorization" : 'Bearer ' + this.token } })
            this.contacts = response.data
            this.selectedContact = this.contacts[0]
            this.stratConversationWith(this.selectedContact)

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
            async stratConversationWith(contact){
                
                const response = await axios.get(`http://localhost/api/conversation/${contact.email}`,{ headers: {"Authorization" : 'Bearer ' + this.token } })
                this.selectedContact = contact;
                this.messages = response.data.data
                console.log('Message :')
                console.log(this.messages)
                console.log('Contact :')
                console.log(contact)
            },

            saveNewMessage(text) {
                console.log('SAVEEEEEEEE')
                this.messages.push(text);
                console.log(this.messages)
            }

        },


        components: {ContactsList,Conversation}
    }
</script>

<style scoped>
.chat {
    display: flex;
}
</style>