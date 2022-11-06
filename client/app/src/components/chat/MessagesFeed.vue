<template>
    <div class="feed" style="height:71vh;" >
        <ul >
            <li v-for="message in messages" :class="message.to == contact.email ? 'sent' : 'received'" :key="message.id">
                <div class="bg-grey-100 rounded px-5 py-1 my-1 text-gray-700 relative">
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
                // messagesLength(){
                //     return this.messages.lenght
                // }
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
            },
            updated(){
                var elem = this.$el
                elem.scrollTop = elem.clientHeight;
                this.scrollToBottom();
            },
    }
</script>

<style scoped>
.feed {
    /*margin-top: 12px;*/
    /*flex: 2cm;*/
    /*max-height: 600px;*/
    overflow: scroll;
    /*border-left: 1px solid #a6a6a6;*/
}


/*ul {*/
/*    list-style-type: none;*/
/*    padding: 5px;*/
/*}*/
li {
    margin: 10px;
    /*width: 100%;*/
}
/*.text {*/
/*    !*max-width: max-content;*!*/
/*    max-width: 500px;*/
/*    border-radius: 5px;*/
/*    padding: 12px;*/
/*    display: inline-block;*/

/*}*/

.received {
    text-align: left;
    background-color: #F3F4F6;
    color: #374151;
    width: 45%;
    border-radius: 10px;
    padding: .1em;
    display: flex;
    flex-direction: column;
    overflow-wrap: break-word;

}
.sent {
    background-color: #F3F4F6;
    color: #374151;
    width: 45%;
    border-radius: 10px;
    /*padding: .1em;*/
    display: flex;
    margin-left: 50%;
    flex-direction: column;
    overflow-x: auto;
    overflow-wrap: break-word;



}
</style>
