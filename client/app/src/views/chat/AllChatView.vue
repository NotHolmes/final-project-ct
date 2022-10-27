<template>
    <div class="chat">
        <Conversation :contract="contact" @selected="stratConversationWith"></Conversation>
        <ContractsList :contracts="contracts"></ContractsList>

    </div>
</template>

<script>
import axios from 'axios'
import ContractsList from '@/components/chat/ContractsList.vue';
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
                selectedContract : null ,
                contracts: null
            };
        },
        async mounted() {
            const response = await axios.get('http://localhost/api/contracts')
            this.contracts = response.data.data
        },
        methods: {
            stratConversationWith(contact){
                axios.get(`/conversantion/${contact.id}`)
                    .then((response) => {
                        this.selectedContract = contact;

                    })
            }
        },
        components: {ContractsList,Conversation}
    }
</script>

<style scoped>
.chat {
    display: flex;
}
</style>