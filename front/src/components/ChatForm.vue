<template>
    <v-container grid-list-md align-end class="chatForm">
        <v-layout row wrap justify-center align-content-start>
            <v-flex xs6>
                <v-textarea
                        :label="label"
                        height="80"
                        no-resize
                        placeholder="Send a new message..."
                        hint="Press enter to send your message"
                        v-model="message"
                        counter="500"
                        :rules="messageRules"
                        v-on:keyup="isValid"
                        v-on:keyup.enter="submit"
                ></v-textarea>
            </v-flex>
            <v-flex xs2>
                <v-btn outline fab small :disabled="!valid" v-on:click="submit" color="primary">
                    <v-icon>send</v-icon>
                </v-btn>
                <v-btn outline fab small color="primary" v-on:click="ping">
                    <v-icon>thumb_up</v-icon>
                </v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: 'ChatForm',
        data: () => ({
            label : "What's up ?",
            nickname: '',
            message: '',
            messageRules: [
                v => v.length <= 500 || 'Message must be less than 500 characters'
            ],
            valid: false
        }),
        methods: {
            isValid(){
                if(this.message.replace(/\s/g, '').length === 0 || this.message.trim().length > 500)
                    this.valid = false
                else
                    this.valid = true
            },
            submit(){
                if(this.valid===true){
                    const axios = require('axios');
                    axios.post('http://demochat.local:80/', {
                        pseudonym: this.nickname,
                        message: this.message
                    })
                        .then(() => {
                            this.$emit('submited')
                        })
                        .catch((error) => {
                            alert(error);
                        });
                    this.message = ''
                    this.valid = false
                }
            },
            ping(){
                const axios = require('axios');
                axios.post('http://demochat.local:80/ping')
                    .catch((error) => {
                        alert(error);
                    });
            },
        },
        created : function(){
            this.nickname = localStorage.nickname
            this.label = "What's up "  + this.nickname + "?"
        }
    }
</script>
<style>
    .chatForm{
        position: fixed;
        bottom:0px;
        width:100%;
        height:190px;
    }
</style>
