<template>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div>
                    <h2 class="mt-2 font-semibold text-xl text-gray-800 leading-tight">
                        List of clients
                    </h2>
                </div>
                <div class="mt-2 grid grid-cols-2">
                    <div class="text-center">
                        <a href="/dashboard" class="bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                            Back to menu.
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="/Clients/Create" class="bg-blue-500 hover:bg-blue-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Add client.
                        </a>
                    </div>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="w-full table-fixed text-center">
                        <thead>
                            <tr>
                                <th class="w-1/5 px-2 py-2">Info</th>
                                <th class="w-1/5 px-2 py-2">Configuration</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="client in clients" :key="client.id">
                                <td class="border">
                                    <div class="grid grid-cols-1 md:grid-cols-2 text-left">
                                        <div class="px-2">
                                            <strong class="text-blue-500 text-base">Basic data :</strong>
                                            <p><strong>Name :</strong> {{client.name}}</p>
                                            <p><strong>Document :</strong> {{client.document}}</p>
                                            <p><strong>Email :</strong> {{client.email}}</p>
                                            <p><strong>Phone :</strong> {{client.phone}}</p>
                                        </div>
                                        <div class="px-2">
                                            <strong class="text-red-500 text-base">Important data :</strong>
                                            <p><strong>Direction :</strong> {{client.direction}}</p>
                                            <p><strong>Adiction :</strong> {{client.adiction}}</p>
                                            <p><strong>Points :</strong> {{client.points}}</p>
                                            <p><strong>Interactions :</strong> {{client.interactions}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="border px-2 py-2">
                                    <div class="py1">
                                        <button @click="delete_client(client)" class="w-full bg-red-500 hover:bg-red-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">ELIMINAR</button>
                                    </div>
                                    <div class="py-1">
                                        <button @click="edit_client(client)" class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded">EDITAR</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: ['clients'],
        variants: {
            tableLayout: ['responsive']
        },
        methods: {
            async delete_client(client) {
                let response = await this.$inertia.post('/Clients/Destroy', client);
            },
            async edit_client(client) {
                console.log(client);
                client.action = "EDIT";
                let response = await this.$inertia.post('/Clients/Edit', client);
            }
        }
    }
</script>
