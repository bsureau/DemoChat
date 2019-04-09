<template>
    <v-container grid-list-md>
        <v-container grid-list-md id="chat-container">
            <v-flex xs12 v-if="this.messages.length === 0">
                <v-progress-circular
                                     :size="50"
                                     color="primary"
                                     indeterminate
                ></v-progress-circular>
                <br/>
                <em>Loading...</em>
            </v-flex>
            <v-layout align-center justify-center v-if="error">
                <v-alert
                        :value="true"
                        type="error"
                >
                    <strong>An error occurred.</strong> Try to reload the page.
                </v-alert>
            </v-layout>
            <v-layout row wrap justify-center id="container">
                <v-flex xs7 md6>
                    <ChatBody v-for="(msg, key) in messages" :nickname="msg.pseudonym" :message="msg.message" :key="key"/>
                </v-flex>
            </v-layout>
        </v-container>
        <v-layout row wrap justify-end v-for="(thumb, key) in thumbs" :key="key">
            <v-icon class="like" color="primary">thumb_up</v-icon>
        </v-layout>
        <ChatForm v-on:submited="scrollBottom"/>
    </v-container>
</template>
<script>
    // @ is an alias to /src
    import ChatBody from '@/components/ChatBody.vue'
    import ChatForm from '@/components/ChatForm.vue'
    export default {
        components: {
            ChatBody,
            ChatForm
        },
        data: () => ({
            messages: [],
            thumbs: 0,
            isLoading: true,
            error: false
        }),
        methods: {
            scrollBottom(){
                let container = document.getElementById("container")
                container.scrollTop = container.scrollHeight
            }
        },
        created : function(){
            const axios = require('axios');
            axios.get('http://demochat.local:80/')
                .then((response) => {
                    this.messages = JSON.parse(response.data)
                })
                .catch((error) => {
                    alert(error);
                });
        },
        mounted: function(){
            const url = new URL('http://demochat.local:3000/hub')
            url.searchParams.append('topic', 'http://demochat.local:80/')
            url.searchParams.append('topic', 'http://demochat.local:80/ping')
            const eventSource = new EventSource(url)
            eventSource.onmessage = e => {
                // Will be called every time an update is published by the server
                let origin = JSON.parse(e.data)
                if(origin.data === 'ping'){
                    this.thumbs += 1
                    window.setTimeout(() => {
                        this.thumbs -= 1
                    }, 5000)
                }else{
                    this.messages.push(JSON.parse(e.data))
                }
            }
        },
        updated: function(){
            this.scrollBottom()
        }
    }
</script>
<style scoped>
    #container{
        position:fixed;
        width:100%;
        left:0;
        top:0px;
        bottom:200px;
        overflow:auto;
    }
    .like {
        visibility: hidden;
        animation-duration: 2s;
        animation-name: slidein;
    }
    @keyframes slidein {
        from {
            visibility: visible;
            margin-top: 100%;
        }
        to {
            visibility: hidden;
            margin-top: -150%;
            font-size: 1000%;
            opacity: 0.6;
        }
    }
</style>
