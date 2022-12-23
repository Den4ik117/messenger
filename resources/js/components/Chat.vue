<template>
    <div class="bg-white rounded shadow-lg col-span-3 grid grid-rows-layout overflow-hidden">
        <header class="px-4 py-3 border-b border-gray-300 font-semibold text-lg">{{ user.name }}</header>
        <main class="px-4 py-3 text-sm">
            <template v-for="{message} in messages" :key="message.id">
                <template v-if="message.user_to.id === user.id">
                    <template v-if="message.user_from.id === auth.id">
                        <div class="mb-4 flex gap-2 justify-end">
                            <div class="text-right max-w-md">
                                <small class="text-gray-600">{{ message.user_from.name }}</small>
                                <p>{{ message.message }}</p>
                            </div>
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 w-8 h-8 rounded-full flex-none flex items-center justify-center">
                                <span class="text-white font-bold">{{ message.user_from.name[0] }}</span>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="mb-4 flex gap-2" >
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 w-8 h-8 rounded-full flex-none flex items-center justify-center">
                                <span class="text-white font-bold">{{ message.user_from.name[0] }}</span>
                            </div>
                            <div class="max-w-md">
                                <small class="text-gray-600">{{ message.user_from.name }}</small>
                                <p>{{ message.message }}</p>
                            </div>
                        </div>
                    </template>
                </template>
            </template>
        </main>
        <footer class="border-t">
            <form class="relative" @submit.prevent="send">
                <input type="text" class="rounded w-full text-base shadow-none outline-none border-none border-t focus:ring-0 focus:bg-gray-50 pr-12" v-model="message" autofocus>
                <button type="submit" class="absolute inset-y-0 right-0 px-3 flex items-center justify-center">
                    <img class="w-6 h-6" src="/images/send.svg" alt="Send message">
                </button>
            </form>
        </footer>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        users: {
            type: Array,
            required: true
        },
        user: {
            type: Object,
            required: true
        },
        auth: {
            type: Object,
            required: true
        },
        messages: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            message: ''
        };
    },
    methods: {
        async send() {
            const message = this.message;
            this.message = '';

            try {
                const data = await axios.post('/send', {
                    message: message,
                    user_from: this.auth.id,
                    user_to: this.user.id,
                });
            } catch (e) {
                console.log(e);
            }
        }
    }
}
</script>
