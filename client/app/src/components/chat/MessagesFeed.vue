<template>
    <div class="feed" ref="feed">
        <ul >
            <li v-for="message in messages" :class="message.to == contact.id ? 'sent' : 'received'" :key="message.id">
                <div class="text">
                    {{ message.text }}
                </div>
            </li>

        </ul>
    </div>
</template>

<script>
    export default {
            props:{
                contact: {
                    type: Object,

                },
                messages: {
                    type: Array,
                    deflaut: []
                }
            },
            methods:{
                scrollToBottom(){ 
                    setTimeout(() => {
                        this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                    },50);
                }
            },
            computed:{
                messagesLength(){
                    return this.messages.lenght
                }
            },
            watch : {
                contact(contact) {
                    this.scrollToBottom();
                },
                messages(messages){
                    this.scrollToBottom();
                }
                ,
                messagesLength(mes , oldMess){
                    console.log('New massage.')
                    this.scrollToBottom();
                }
            }
    }
</script>

<style scoped>
    .feed {
        margin-top: 12px;
        flex: 2cm;
        max-height: 600px;
        overflow: scroll;
        border-left: 1px solid #a6a6a6;
    }
    li {
        margin: 10px;
        width: 100%;
    }
    .text {
        max-width: 200px;
        border-radius: 5px;
        padding: 12px;
        display: inline-block;
    }

    .received {
        text-align: left;
        background-color: gray;
    }
    .sent {
        text-align: right;
        background-color: skyblue;
    }
</style>