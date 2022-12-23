<template>
    <Chats :users="users" :user="user" @update="update" :messages="messages"></Chats>
    <Chat :users="users" :user="user" :auth="auth" :messages="messages"></Chat>
<!--    <div v-html="messages.map(m => JSON.stringify(m)).join('<br><br>')"></div>-->
</template>

<script>
import './../bootstrap.js';
import Chats from "./Chats.vue";
import Chat from "./Chat.vue";

export default {
    components: {
        Chats,
        Chat
    },
    props: {
        users: {
            type: Array,
            required: true
        },
        auth: {
            type: Object,
            required: true
        },
        msgs: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            user: this.users[0],
            messages: this.msgs,
        };
    },
    methods: {
        update(newUser) {
            this.user = newUser;
        }
    },
    mounted() {
        Echo.channel('chat')
            .listen('MessageSent', (e) => {
                this.messages.push(e);
            });
    }
}
</script>
