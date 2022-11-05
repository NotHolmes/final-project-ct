<template>
<!--    <div class="composer">-->
<!--        <textarea v-model="message" @keydown.enter="send" placeholder="พิมพ์ข้อความ"-->
<!--                  class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700"></textarea>-->
<!--    </div>-->

    <div class="w-full py-3 px-3 flex items-center justify-between border rounded border-t border-gray-300">
    <input v-model="message" @keydown.enter="send" placeholder="Aa"
           class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700" type="text" name="message" required/>
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
/*div > textarea {*/
/*    */
/*    resize:none;*/
/*    border:none;*/
/*    display:block;*/
/*    width:94%;*/
/*    height:80px;*/
/*    border-radius:3px;*/
/*    padding:20px;*/
/*    font-size:13px;*/
/*    margin: 10px;*/
/*    border: 1px solid #aaaaaa;*/
/*    padding: 6px;*/
/*}*/

/*textarea{*/
/*    width: 100px;*/
/*    !*height: 150px;*!*/
/*}*/

</style>
