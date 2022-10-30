<template>
    <div class="chat">
            Welcome , {{ auth.email }}
        <Conversation :contact="selectedContact" :messages="messages" :user="auth" @new="saveNewMessage" ></Conversation>
        <ContactsList :contacts="contacts" @selected="stratConversationWith"></ContactsList>

    </div>
</template>

<script>
import axios from 'axios'
import ContactsList from '@/components/chat/ContactsList.vue';
import Conversation from '@/components/chat/Conversation.vue';
import { useAuthStore } from '@/stores/auth.js';

    export default{
        setup(){
            const auth_store = useAuthStore()
            return { auth_store }
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
                messages: []
            };
        },
        async mounted() {
            const response = await axios.get('http://localhost/api/contracts')
            this.contacts = response.data.data
            if(this.auth_store.isAuthen){
                this.auth = this.auth_store.getAuth
            } else {
                this.auth = null
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
            async stratConversationWith(contact){
                
                const response = await axios.get(`http://localhost/api/conversation/${contact.email}`)
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