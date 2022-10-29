<template>
    <div class="chat">
        <Conversation :contact="selectedContact" :messages="messages" ></Conversation>
        <ContactsList :contacts="contacts" @selected="stratConversationWith"></ContactsList>

    </div>
</template>

<script>
import axios from 'axios'
import ContactsList from '@/components/chat/ContactsList.vue';
import Conversation from '@/components/chat/Conversation.vue';

    export default{
        props:{
            user: {
                type: Object,
                //required: true
            }
        },
        data() {
            return {
                selectedContact : null ,
                contacts: null ,
                messages: []
            };
        },
        async mounted() {
            const response = await axios.get('http://localhost/api/contracts')
            this.contacts = response.data.data
        },
        methods: {
            async stratConversationWith(contact){
                
                const response = await axios.get(`http://localhost/api/conversation/${contact.id}`)
                this.selectedContact = contact;
                this.messages = response.data.data
                console.log('Message :')
                console.log(this.messages)
                console.log('Contact :')
                console.log(contact)
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