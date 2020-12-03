<template>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div>
                    <h2 class="mt-2 font-semibold text-xl text-gray-800 leading-tight">
                        Formulario para agregar categoria.
                    </h2>
                </div>
                <div class="mt-2 text-right">
                    <a href="/Categories/Index" class="bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                        Volver a la lista
                    </a>
                </div>
            </div>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="update_categorie" class="flex flex-wrap">
                        <div class="flex flex-wrap w-full">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Nombre :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane" v-model="categorie.name">
                            </div>
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Descripción :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Doe" v-model="categorie.description">
                            </div>
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                    Icono :
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" v-model="categorie.icon">
                                        <option>pendiente</option>
                                        <option>pendiente</option>
                                        <option>pendiente</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-2 text-center">
                            <input type="hidden" v-model="categorie.action">
                            <input value="ACTUALIZAR CATEGORIA" type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"/>
                        </div>
                    </form>
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
            categorie_prop: Object,
        },
        data() {
            return {
                categorie: {
                    id:'',
                    name:'',
                    description:'',
                    icon:'',
                    image: '',
                    action:''
                }
            }
        },
        created() {
            this.categorie = this.$props.categorie_prop;
        },
        methods: {
            async update_categorie() {
                let response = await this.$inertia.post('/Categories/Update', this.categorie);
            }
        }
    }
</script>
