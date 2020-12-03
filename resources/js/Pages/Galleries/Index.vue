<template>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div>
                    <h2 class="mt-2 font-semibold text-xl text-gray-800 leading-tight">
                        Modulo de productos
                    </h2>
                </div>
                <div class="mt-2 grid grid-cols-2">
                    <div class="text-center">
                        <a href="/dashboard" class="bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                            Volver al menu
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="/Products/Create" class="bg-blue-500 hover:bg-blue-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Nuevo producto
                        </a>
                    </div>
                </div>
            </div>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="w-full">
                        <Upload
                            type="drag"
                            :data='{"id":id,"type":type}'
                            :headers='{"X-CSRF-TOKEN":csrf}'
                            :on-success="reload_galleries"
                            action="/Gallery/Upload">
                            <div style="padding: 20px 0">
                                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                <p>Click or drag files here to upload</p>
                            </div>
                        </Upload>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 text-left" >
                        <div class="px-2" v-for="gallery in galleries" :key="gallery.id">
                            <img class="w-full bg-green-200 h-56" :src="gallery.route" alt="">
                            <div class="grid grid-cols-2">
                                <div class="px-2 py-1">
                                    <input type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="gallery.order">
                                </div>
                                <div class="px-2 py-1">
                                    <select v-model="gallery.status" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="0">Active</option>
                                        <option value="1">Ocult</option>
                                        <option value="2">Delete</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="w-full text-center">
                        <button @click="update_gallery(galleries)" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">UPDATE</button>
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
            AppLayout
        },
        props: ['galleries_prop','type','id'],
        variants: {
            tableLayout: ['responsive']
        },
        data(){ 
            return {
               csrf: "",
               galleries: Array,
            }
        },
        created() {
            this.galleries = this.$props.galleries_prop;
            this.csrf = document.getElementsByName('csrf-token')[0].getAttribute('content');
        },
        methods: {
            reload_galleries(res) {
                this.galleries = res;
            },
            async update_gallery(galleries) {
                console.log(galleries);
                let response = await this.$inertia.post('/Gallery/Update', galleries);
            }
        }
    }
</script>
