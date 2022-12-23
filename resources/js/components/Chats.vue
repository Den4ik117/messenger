<template>
    <aside>
        <ul class="rounded bg-white shadow-lg p-1 flex flex-col gap-1">
            <li v-for="chatUser in users">
                <a href="javascript:void(0)" class="flex p-2 hover:bg-gray-100 items-center gap-2 rounded text-sm font-semibold" :class="{'bg-gray-100': user.id === chatUser.id}" @click="$emit('update', chatUser)">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 w-8 h-8 rounded-full flex-none flex items-center justify-center">
                        <span class="text-white font-bold">{{ chatUser.name[0] }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span>{{ chatUser.name }}</span>
                        <span class="font-normal text-gray-500 max-w-full text-ellipsis overflow-hidden whitespace-nowrap w-40">{{ messages.findLast(({message}) => message.user_from.id === chatUser.id || message.user_to.id === chatUser.id)?.message.message }}</span>
                    </div>
                </a>
            </li>
        </ul>
    </aside>
</template>

<script>
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
        messages: {
            type: Array,
            required: true
        }
    },
    emits: ['update']
}
</script>
