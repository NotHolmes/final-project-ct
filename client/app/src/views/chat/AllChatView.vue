<template>
    <div class="chat">
<!--            Welcome , {{ auth.email }}-->
        <ContactsList :user="auth" :selectedContact="selectedContact" :contacts="contacts" :token="token" @selected="stratConversationWith" class="aside"></ContactsList>
        <Conversation :contact="selectedContact" :messages="messages" :user="auth" :token="token" @new="saveNewMessage" ></Conversation>

    </div>
</template>

<script>
import axios from 'axios'
import ContactsList from '@/components/chat/ContactsList.vue';
import Conversation from '@/components/chat/Conversation.vue';
import { useAuthStore } from '@/stores/auth.js';
import SocketioService from '@/services/socketio.js'

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
                contacts: [] ,
                messages: [] ,
                qChat: null

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

            const response = await axios.get(`http://localhost/api/contacts`,{ headers: {"Authorization" : 'Bearer ' + this.token } })
            this.contacts = response.data
            // this.selectedContact = this.contacts[0]
            // this.stratConversationWith(this.selectedContact)

        },

        watch: {
            auth_store: {
                immediate: true,
                deep: true,
                handler(newValue, oldValue){
                    console.log(newValue.getAuth)
                    this.auth = this.auth_store.getAuth
                }
            },
            // contacts:{
            //     immediate: true,
            //     deep: true,
            //     handler(newValue, oldValue){
            //         console.log('newValue')
            //     }
            // }
        },
        methods: {
            async stratConversationWith(contact){
                this.updateUnreadCount(contact,true);
                const response = await axios.get(`http://localhost/api/conversation/${contact.email}`,{ headers: {"Authorization" : 'Bearer ' + this.token } })
                this.selectedContact = contact;
                this.messages = response.data
                console.log('Message :')
                console.log(this.messages)
                console.log('Contact :')
                console.log(contact)
            },

            saveNewMessage(text) {
                console.log('SAVEEEEEEEE')
                this.messages.push(text);
                console.log(this.messages)
            },

            updateUnreadCount(contact, reset){
                this.contacts = this.contacts.map((single) => {
                    if (single.email != contact.email){
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            },
            async updateList(data){
                const response = await axios.get(`http://localhost/api/contacts`,{ headers: {"Authorization" : 'Bearer ' + this.token } })
                this.contacts = response.data
                if(this.selectedContact != null && data.from == this.selectedContact.email && data.to == this.auth.email){
                    for (let i = 0 ; i < this.contacts.length ; i++){
                        console.log(this.contacts[i].email)
                        if(this.contacts[i].email == data.from){
                            this.contacts[i].unread = 0 ;
                        }
                    }
                }
            },

        },
        created() {
            SocketioService.setupSocketConnection()
            SocketioService.getSocket().on('list.update', this.updateList)
            // SocketioService.getSocket().on('chat.now', this.quickChat)
        },


        components: {ContactsList,Conversation}
    }
</script>

<style scoped>
.chat {
    display: flex;
}
.aside{
    /*margin-right: 30%;*/
    /*padding-right: 30%;*/
    width: 260px;
    height: 800px;
    display: inline-block;
    font-size: 15px;
    vertical-align: top;
    width: 20%;
    flex: 0.4;
}
.right{
    margin-right: 50%;

}

.container {
    margin: 0 auto;
    width: 750px;
    background: #444753;
    border-radius: 5px;
}

.clearfix:after {
    display: block;
    content: " ";
    clear: both;
    height: 0;
}
</style>
