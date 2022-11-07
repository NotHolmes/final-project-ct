<template>
    <div class="contacts-list">
        <div class="border rounded">
            <button @click="toggleVisible()" class="inline-flex items-center justify-center h-10 px-3 text-white font-medium tracking-wide transition duration-200 rounded shadow-md bg-cyan-300 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none">
                {{ showContactInput ? "Hide" : "Add contact"  }}
            </button>
        </div>


        <div class="grid min-w-full border rounded" style="min-height: 80vh; ">

        <ul class="overflow-auto" >

                    <span v-show="showContactInput">
            <input v-model="addContactInput" @keydown.enter="addContact" placeholder="user01@api.example.com" type="text" name="" id="">
        </span>

            <h2 class="ml-2 mb-2 text-gray-600 text-lg my-2">Chats</h2>
            <li v-for="( contact, index ) in contacts" :key="contact.id" @click="selectcontact(index, contact)" :class="{ 'selected': contact == selectedContact }">
            <a class="hover:bg-gray-100 border-b border-gray-300 px-3 py-2 cursor-pointer flex items-center text-sm focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
<!--                    <img class="h-10 w-10 rounded-full object-cover"-->
<!--                         src="https://images.pexels.com/photos/837358/pexels-photo-837358.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"-->
<!--                         alt="username" />-->
                    <div class="w-full pb-2">
                        <div class="flex justify-between">
                            <span class="block ml-2 h-10 w-10 font-semibold text-base text-gray-600 object-cover  ">{{ contact.name }}</span>
                            <span v-if="contact.unread > 0" class="rounded-full font-semibold bg-red-600 p-3 ml-2 text-gray-200">{{ contact.unread }}</span>
                        </div>
<!--                        <span class="block ml-2 text-sm text-gray-600">Hello world!!</span>-->
                    </div>
                </a>

            </li>
        </ul>

        </div>
        <!--        <div class="searchbar">-->
<!--            <input type="text" placeholder="search">-->
<!--        </div>-->

    </div>
</template>

<script>
import axios from 'axios'
import SocketioService from '@/services/socketio.js'
import { useAuthStore } from '@/stores/auth.js';

export default {
    setup(){
            const JWT_TOKEN_LOCALSTORAGE_KEY = 'jwt_token'
            const token = localStorage.getItem(JWT_TOKEN_LOCALSTORAGE_KEY)
            const auth_store = useAuthStore()
            return { auth_store , token}
        },
    props: {
        contacts: {
            type: Array,
            default: []
        },
        token:{
            type: String,
            required : true
        },
        selectedContact:{
            type: Object,
            default:null
        },
        user:{
            type: Object,
            default: null
        }
    },
    data() {
        return {
            auth:null,
            selected: 0,
            showContactInput: false ,
            addContactInput: '',
            contactAdd : null ,
            duplicateContact : false ,
            sortedContacts_: [],
        };
    },
    methods: {
        selectcontact(index, contact) {
            console.log(contact)
            this.selected = index;
            this.$emit('selected', contact);
        },
        toggleVisible(){
            this.showContactInput = !this.showContactInput
        },
        async addContact(e){
            if (this.addContactInput == ''){
                alert("Email must not empty.")
                return ;
            }

            this.contacts.map((contact) => {
                if(this.addContactInput == contact.email){
                    alert('Contact already exist. \nContact name is ' + contact.name + '.')
                    this.duplicateContact = true;
                }
            });

            if (this.duplicateContact == true){
                this.duplicateContact = false;
                return;
            }
            const response = await axios.get('http://localhost/api/users',{ headers: {"Authorization" : 'Bearer ' + this.token } })
            this.allUser = response.data.data
            for (let i = 0 ; i < this.allUser.length ; i++){
                if (this.allUser[i].email == this.addContactInput){
                    this.contactAdd = this.allUser[i]
                    this.contacts.unshift(this.contactAdd)
                    e.preventDefault();
                }
            }
            if(this.contactAdd == null ){
                alert("Email not found.")
                    return ;
            }
            this.contactAdd == null
        },
        async ChangeInput(data){
            console.log('MAAAAAAA')
            console.log(data.from + '12312312321')
                if(data.from == this.auth.email){
                console.log('MAAAAAAA')
                this.addContactInput = data.email ;
                this.showContactInput = true;
                }
        }
    },

    created() {
        SocketioService.setupSocketConnection()
        SocketioService.getSocket().on('chat.now', this.ChangeInput)
    },
    mounted(){

        if(this.auth_store.isAuthen){
                this.auth = this.auth_store.getAuth
            } else {
                this.auth = null
            }
    }

    // watch: {
    //     quickChat(quickChat){
    //         ChangeInput()
    //     }
    // }

}
</script>

<style>
.selected {
    display: flex;
    padding-top: 14px;
    /*border-bottom: 1px solid #aaaaaa;*/
    height: 60px;
    position: relative;
    cursor: pointer;
    margin: auto;
    /*width: 50%;*/
    /*&.li{*/
    background: #f3f4f6;
    /*}*/
}

</style>

<!--<style scoped>-->
<!--.contacts-list {-->
<!--    margin-top: 12px;-->
<!--    flex: 2cm;-->
<!--    max-height: 600px;-->
<!--    overflow: scroll;-->
<!--    /*border-left: 1px solid #a6a6a6;*/-->
<!--    margin-right: 10px;-->
<!--    margin-left: 10px;-->
<!--    /*background: #2d3748;*/-->
<!--}-->

<!--div>ul {-->
<!--    list-style-type: none;-->
<!--    /*padding-left: 25px;*/-->
<!--    text-align: center;-->
<!--    border: 1px solid #a6a6a6;-->
<!--    padding-left: 10px;-->
<!--    padding-right: 10px;-->
<!--}-->

<!--ul>li {-->
<!--    display: flex;-->
<!--    padding-top: 14px;-->
<!--    border-bottom: 1px solid #aaaaaa;-->
<!--    height: 60px;-->
<!--    position: relative;-->
<!--    cursor: pointer;-->
<!--    margin: auto;-->
<!--    /*float: contour;*/-->
<!--    /*margin-left: 12px;*/-->

<!--    /*width: 50%;*/-->
<!--    /*&.li{*/-->
<!--    /*    background: #407FFF;*/-->
<!--    /*}*/-->

<!--}-->

<!--ul>li>selected {-->
<!--    display: flex;-->
<!--    padding-top: 14px;-->
<!--    border-bottom: 1px solid #aaaaaa;-->
<!--    height: 60px;-->
<!--    position: relative;-->
<!--    cursor: pointer;-->
<!--    margin: auto;-->
<!--    /*width: 50%;*/-->
<!--    /*&.li{*/-->
<!--    background: #407FFF;-->
<!--    /*}*/-->
<!--}-->


<!--.main-contact {-->
<!--    /*display: inline-block;*/-->
<!--    /*float: left;*/-->
<!--    margin-right: 10px;-->
<!--    margin-left: 5px;-->
<!--    margin-top: 5px;-->
<!--    /*float:*/-->
<!--    /*width: 20%;*/-->
<!--}-->

<!--.searchbar{-->
<!--    border-radius:5px 0 0 5px;-->
<!--}-->
<!--</style>-->
