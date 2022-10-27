<template>
    <div>
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
import axios from 'axios'
    export default{
        data() {
            return {
                contracts: null
            };
        },
        async mounted() {
            const response = await axios.get('http://localhost/api/contracts')
            this.contracts = response.data.data
        }
    }
</script>