<template>
        <v-card color="blue darken-1" class="message-body">
            <p class="message-text">
                <strong>{{nickname}}:</strong>
                <br/>
                {{message}}
            </p>
        </v-card>
</template>
<script>
    export default {
        name: "ChatBody",
        props: {
            nickname: String,
            message: String
        }
    }
</script>
<style scoped>
    .message-body{
        animation-duration: 0.5s;
        animation-name: fadein;
    }
    @keyframes fadein {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    .message-text{
        color: white;
        padding: 20px;
    }
</style>
