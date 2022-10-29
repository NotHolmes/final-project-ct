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

export default{
    props:{
            contact:{
                type: Object,
                default:null
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
        methods:{
            async sendMessage(text){
                // if(!this.contrat){
                //     return;
                // }
                console.log('Now Text : ');
                console.log(text);


                const response = await axios.post('http://localhost/api/conversation/send', {
                    user_id: this.user.email,
                    contact_id: this.contact.id,
                    text: text
                })


                this.$emit('new', response.data)

                console.log('Now Message : ')
                console.log(this.messages);
            },
            
        },
        components: {MessageComposer, MessagesFeed}
}


</script>

<style scoped>
.conversation {
    flex: 2cm;
}
</style>