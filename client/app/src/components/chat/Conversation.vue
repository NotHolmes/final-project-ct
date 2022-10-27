<template>
    <div class="conversation">
        <h1>{{ contract ? contact.email : 'Select a Contact' }} </h1>
        <!-- <MessagesFeed :contract="contract" :messages="messages"></MessagesFeed> -->
        <MessageComposer @send="sendMessage"></MessageComposer>
    </div>

</template>

<script>
    import MessageComposer from './MessageComposer.vue';
    export default {
        prop:{
            contract:{
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
            }
        },
        components: {MessageComposer}
    }
</script>

<style scoped>
.conversation {
    flex: 2cm;
}
</style>