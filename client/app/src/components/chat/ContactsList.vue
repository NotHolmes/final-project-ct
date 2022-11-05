<template>

    <div class="contacts-list">

        <div class="">
            <button @click="toggleVisible()" class="inline-flex items-center justify-center h-12 px-6 text-white font-medium tracking-wide transition duration-200 rounded shadow-md bg-cyan-300 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none">
                {{ showContactInput ? "ซ่อน" : "เพิ่มผู้ติดต่อ"  }}
            </button>
        </div>
        <span v-show="showContactInput">
            <input v-model="addContactInput" @keydown.enter="addContact" placeholder="user01@api.example.com" type="text" name="" id="">
        </span>

        <div class="my-4">รายชื่อผู้ติดต่อ</div>

<!--        <div class="searchbar">-->
<!--            <input type="text" placeholder="search">-->
<!--        </div>-->

        <ul>
            <li v-for="( contact, index ) in contacts" :key="contact.id" @click="selectcontact(index, contact)"                :class="{ 'selected': contact === selected }">
                <div class="contacts">
                    <p class="email">{{ contact.name }} </p>
                </div>
                <span class="unread" v-if="contact.unread"> {{ contact.unread }}</span>
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
                this.contacts.unshift(this.contactAdd)
                e.preventDefault();
            }
        },
        async updateList() {
            console.log('update LISTTTTTT')
            const response = await axios.get(`http://localhost/api/contacts/get/${this.addContactInput}`,{ headers: {"Authorization" : 'Bearer ' + this.token } })
            this.contactAdd = response.data
        },
    },

}
</script>

<style scoped>


.contacts-list {
    margin-top: 12px;
    flex: 2cm;
    max-height: 600px;
    overflow: scroll;
    /*border-left: 1px solid #a6a6a6;*/
    margin-right: 10px;
    margin-left: 10px;
    /*background: #2d3748;*/
}

div>ul {
    list-style-type: none;
    /*padding-left: 25px;*/
    text-align: center;
    border: 1px solid #a6a6a6;
    padding-left: 10px;
    padding-right: 10px;
}

ul>li {
    display: flex;
    padding-top: 14px;
    border-bottom: 1px solid #aaaaaa;
    height: 60px;
    position: relative;
    cursor: pointer;
    margin: auto;
    /*float: contour;*/
    /*margin-left: 12px;*/

    /*width: 50%;*/
    /*&.li{*/
    /*    background: #407FFF;*/
    /*}*/

}

ul>li>selected {
    display: flex;
    padding-top: 14px;
    border-bottom: 1px solid #aaaaaa;
    height: 60px;
    position: relative;
    cursor: pointer;
    margin: auto;
    /*width: 50%;*/
    /*&.li{*/
    background: #407FFF;
    /*}*/
}


.main-contact {
    /*display: inline-block;*/
    /*float: left;*/
    margin-right: 10px;
    margin-left: 5px;
    margin-top: 5px;
    /*float:*/
    /*width: 20%;*/
}

.searchbar{
    border-radius:5px 0 0 5px;
}
</style>
