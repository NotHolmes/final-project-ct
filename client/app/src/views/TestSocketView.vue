<template>
  <div class="m-8">
    <h1>Socket.io</h1>

    <div>
      <input type="text" v-model="message">
      <button @click="sendMessage()">Send</button>
    </div>

    <div>
      <ul>
        <li v-for="m in sends" :key="m">
          {{ m }}
        </li>
        <li v-for="m in messages" :key="m">
          {{ m }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import SocketioService from '@/services/socketio.js'

export default {
  data() {
    return {
      message: '',
      messages: [],
      sends: []
    }
  },
  created() {
    SocketioService.setupSocketConnection()
    SocketioService.getSocket().on('hello.reply', this.onReplyMessage)
  },
  methods: {
    sendMessage() {
      console.log(SocketioService.getId())
      this.sends.push(this.message)
      SocketioService.sendToServer('hello.message', {message : this.message
      })
    },
    onReplyMessage(data){
      this.messages.push(data)
    },
    listenChatroom(data) {
      this.messages.push(data)
    },
  },

}
</script>