<template>
    <div class="contracts-list">
        <ul>
            <li v-for="contract in contracts" :key="contract.id">
                <div class="contracts">
                    <p class="email">{{ contract.email }} </p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contracts:{
                type: Object,
                default: null
            }
        }
    }
</script>

<style scoped>
.contracts-list{
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
}
</style>