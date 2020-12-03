<template>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div>
                    <h2 class="mt-2 font-semibold text-xl text-gray-800 leading-tight">
                        Modulo de categorias
                    </h2>
                </div>
                <div class="mt-2 grid grid-cols-2">
                    <div class="text-center">
                        <a href="/dashboard" class="bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                            Volver al menu
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="/Categories/Create" class="bg-blue-500 hover:bg-blue-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Nueva categoria
                        </a>
                    </div>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg my-2">
                    <div class="flex flex-wrap">
                        <p class="border w-2/4 px-2 py-2">{{preview.name}}</p>
                        <p class="border w-2/4 px-2 py-2">{{preview.description}}</p>
                        <p class="border w-2/4 px-2 py-2">{{preview.icon}}</p>
                        <p class="border w-2/4 px-2 py-2">{{preview.image}}</p>
                    </div>
                    <Upload
                        type="drag"
                        :data='{"id":id,"type":type}'
                        :headers='{"X-CSRF-TOKEN":csrf}'
                        :on-success="reload_categories"
                        action="/Gallery/Upload">
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>Click or drag files here to replace the photo</p>
                        </div>
                    </Upload>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="w-full table-fixed text-center">
                        <thead>
                            <tr>
                                <th class="w-1/5 px-2 py-2">Name</th>
                                <th class="w-1/5 px-2 py-2">Description</th>
                                <th class="w-1/5 px-2 py-2">Icon</th>
                                <th class="w-1/5 px-2 py-2">Image</th>
                                <th class="w-1/5 px-2 py-2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="categorie in categories" :key="categorie.id" @click="id_reload(categorie);color_change($event)">
                                <td class="border w-1/4 px-2 py-2">{{categorie.name}}</td>
                                <td class="border w-1/4 px-2 py-2">{{categorie.description}}</td>
                                <td class="border w-1/4 px-2 py-2">{{categorie.icon}}</td>
                                <td class="border w-1/4 px-2 py-2">{{categorie.image}}</td>
                                <td class="border w-1/4 px-2 py-2">
                                    <div class="py-1">
                                        <button @click="edit_categorie(categorie)" class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded">EDITAR</button>
                                    </div>
                                    <div class="py1">
                                        <button @click="delete_categorie(categorie)" class="w-full bg-red-500 hover:bg-red-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">ELIMINAR</button>
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
        props: ['categories','type'],
        variants: {
            tableLayout: ['responsive']
        },
        data() {
            return {
                id: 0,
                csrf: "",
                preview: {
                    name: "",
                    description: "",
                    icon: "",
                    image: ""
                }
            }
        },
        created() {
            this.csrf = document.getElementsByName('csrf-token')[0].getAttribute('content');
        },
        methods: {
            async delete_categorie(categorie) {
                let response = await this.$inertia.post('/Categories/Destroy', categorie);
            },
            async edit_categorie(categorie) {
                console.log(categorie);
                categorie.action = "EDIT";
                let response = await this.$inertia.post('/Categories/Edit', categorie);
            },
            reload_categories(res){
                if(res.msg){
                    alert(res.msg);
                }else{
                    this.categories = res.categories;
                }
            },
            id_reload(categorie) {
                console.log("categories module 1....");
                this.id = categorie.id;
                this.preview.name = categorie.name;
                this.preview.description = categorie.description;
                this.preview.icon = categorie.icon;
                this.preview.image = categorie.image;
            },
            color_change(event) {
                let tr = document.querySelectorAll('tr');
                for (let index = 0; index < tr.length; index++) {
                    const element = tr[index];
                    element.setAttribute('class','');
                }
                event.currentTarget.setAttribute('class','bg-blue-200');
            }
        }
    }
</script>
