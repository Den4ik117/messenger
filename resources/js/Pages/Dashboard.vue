<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import axios from "axios";
import {onMounted, reactive, ref} from "vue";

const messages = ref([]);
const form = reactive({
    message: ''
});

const send = async () => {
    try {
        const data = await axios.post('/send', form);
        console.log(data);
    } catch (e) {
        console.log(e);
    }
};

onMounted(() => {
    Echo.channel('chat')
        .listen('MessageSent', (e) => {
            console.log(e);
            messages.value.push(e.message);
        });
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col gap-4">
                            <div class="mb-4">
                                <div class="p-2 bg-gray-100" v-for="message in messages">{{ message }}</div>
                            </div>
                            <TextInput type="text" v-model="form.message"/>
                            <PrimaryButton class="justify-center" @click="send">Отправить сообщение</PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
