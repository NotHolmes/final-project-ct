<template>
    <div class="contacts-list">
        <ul>
            <li v-for="( contact, index ) in contacts" :key="contact.id" @click="selectcontact(index, contact)" :class="{ 'selected': contact === selected}">
                <div class="contacts">
                    <p class="email">{{ contact.email }} </p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contacts:{
                type: Object,
                default: null
            }
        },
        data(){
            return {
                selected: 0
            };
        },
        methods:{
            selectcontact(index, contact){
                console.log(contact)
                this.selected = index;
                this.$emit('selected', contact);
            }
        }
    }
</script>

<style scoped>
/* .contacts-list{
    margin-top: 12px;
    flex: 2cm;
    max-height: 600px;
    overflow: scroll;
    border-left: 1px solid #a6a6a6;
}

div > ul {
    list-style-type: none;
    padding-left: 0;
}
ul > li {
    display: flex;
    padding: 2px;
    border-bottom: 1px solid #aaaaaa;
    height: 80px ;
    position: relative;
    cursor:pointer;
} */
</style>
