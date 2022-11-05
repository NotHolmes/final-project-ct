<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="พิมพ์ข้อความ"></textarea>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                message: []
            };
        },
        methods: {
            send(e){

                e.preventDefault();

                if(this.message === ''){
                    return;
                }

                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>

<style>
div > textarea {
    /*width: 96%;*/
    /*margin: 10px;*/
    /*resize: none;*/
    /*border-radius: 3px;*/
    /*border: 1px solid #aaaaaa;*/
    /*padding: 6px;*/
    /*bottom: 20px;*/
    resize:none;
    border:none;
    display:block;
    width:94%;
    height:80px;
    border-radius:3px;
    padding:20px;
    font-size:13px;
    margin: 10px;
    border: 1px solid #aaaaaa;
    padding: 6px;
    /*background: #afadad;*/
}

textarea{
    width: 100px;
    /*height: 150px;*/
}

</style>
