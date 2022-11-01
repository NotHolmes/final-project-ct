<template>
    <div class="contacts-list">
        <div>
            <button @click="toggleVisible()" class="inline-flex items-center justify-center h-12 px-6 text-white font-medium tracking-wide transition duration-200 rounded shadow-md bg-cyan-300 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none">
                {{ showContactInput ? "Hide" : "Add new contact"  }}
            </button>


        </div>
        <div v-show="showContactInput">
            <input v-model="addContactInput" @keydown.enter="addContact" placeholder="email . . " type="text" name="" id="">
        </div>
        <ul>
            <li v-for="( contact, index ) in contacts" :key="contact.id" @click="selectcontact(index, contact)"
                :class="{ 'selected': contact === selected }">
                <div class="contacts">
                    <p class="email">{{ contact.email }} </p>
                </div>
            </li>
        </ul>
    </div>
</template>



<script>
import axios from 'axios'

export default {
    props: {
        contacts: {
            type: Array,
            default: []
        },
        token:{
            type: String,
            required : true
        }
    },
    data() {
        return {
            selected: 0,
            showContactInput: false ,
            addContactInput: '',
            contactAdd : null ,
            duplicateContact : false
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
                    alert('Contact already exist.')
                    this.duplicateContact = true;
                }
            });

            if (this.duplicateContact == true){
                this.duplicateContact = false;
                return;
            }
            const response = await axios.get(`http://localhost/api/contacts/get/${this.addContactInput}`,{ headers: {"Authorization" : 'Bearer ' + this.token } })
            this.contactAdd = response.data
            if (Object.keys(this.contactAdd).length == 0){
                alert("Email not found.")
                return ;
            } else {
                this.contacts.push(this.contactAdd)
                e.preventDefault();
            }

            
        },
    }
}
</script>

<style scoped>


.contacts-list {
    margin-top: 12px;
    flex: 2cm;
    max-height: 600px;
    overflow: scroll;
    border-left: 1px solid #a6a6a6;
}

div>ul {
    list-style-type: none;
    padding-left: 0;
}

ul>li {
    display: flex;
    padding: 2px;
    border-bottom: 1px solid #aaaaaa;
    height: 80px;
    position: relative;
    cursor: pointer;
}
</style>