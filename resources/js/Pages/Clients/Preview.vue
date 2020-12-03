<template>
    <app-layout>
        <div class="py-3 min-h-full">
            <div class="max-h-20 mx-auto px-2 sm:px-6 lg:px-8">
                <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-3">
                    <form @submit.prevent="acept_client" class="flex flex-wrap px-1">
                        <input value="OK" type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"/>
                    </form>
                    <form @submit.prevent="cancel_client" class="flex flex-wrap px-1">
                        <input value="X" type="submit" class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded"/>    
                    </form>
                    <form @submit.prevent="destroy_client" class="flex flex-wrap px-1">
                        <input value="BORRAR" type="submit" class="w-full bg-red-500 hover:bg-red-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded"/>
                    </form>
                </div>
            </div>
            <div class="max-h-screem overflow-y-scroll max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-2" >
                <div class="mt-2 mx-2 rounded shadow-lg grid grid-cols-2 sm:grid-cols-1">
                    <img class="w-full bg-green-200 h-56" src="/img/card-top.jpg" alt="Imagen">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{client.name}}</div>
                        <span class="inline-block bg-yellow-200 rounded-full px-3 py-1 text-sm font-semibold text-yellow-900 mr-2 mb-2">document : {{client.document}}</span>
                        <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-blue-900 mr-2 mb-2">email : {{client.email}}</span>
                        <p class="text-red-700 text-base">
                        {{client.phone}}
                        </p>
                        <p class="text-blue-700 text-base">
                        {{client.direction}}
                        </p>
                        <p class="text-gray-700 text-base">
                        adiction : {{client.adiction}}
                        </p>
                        <span class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-red-900 mr-2 mb-2">-%{{client.points}}</span>
                        <span class="inline-block bg-purple-200 rounded-full px-3 py-1 text-sm font-semibold text-purple-900 mr-2 mb-2">{{client.interactions}}</span>
                    </div>
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
        props: {
            client_prop: Object,
        },
        data() {
            return {
                client: {
                    id:'',
                    name:'',
                    document:0,
                    email:'',
                    phone: '',
                    direction:'',
                    adiction: '',
                    points: '',
                    interactions: 0,
                    action: 'ACEPT',
                    old_client: ''
                }
            }
        },
        created() {
            this.client = this.$props.client_prop;
            //console.log(this.$props);
        },
        methods: {
            async acept_client() {
                let response = await this.$inertia.get('/Clients/Index', this.client);
            },
            async cancel_client() {
                this.client.action = "CANCEL"
                let response = await this.$inertia.post('/Clients/Update', this.client);
            },
            async destroy_client() {
                let response = await this.$inertia.post('/Clients/Destroy', this.client);
            }
        }
    }
</script>
