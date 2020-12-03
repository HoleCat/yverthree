<template>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div>
                    <h2 class="mt-2 font-semibold text-xl text-gray-800 leading-tight">
                        Formulario para agregar producto.
                    </h2>
                </div>
                <div class="mt-2 text-right">
                    <a href="/Products/Index" class="bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                        Volver a la lista
                    </a>
                </div>
            </div>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="store_product" class="flex flex-wrap">
                        <div class="flex flex-wrap w-full">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                    Categorie :
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" v-model="product.categorie_id">
                                        <option  v-for="categorie in categories" :value="categorie.id" :key="categorie.id">{{categorie.name}}</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Nombre :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="....." v-model="product.name">
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Price :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="10.00" v-model="product.price">
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Stock :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="1,2,3" v-model="product.stock">
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Discount :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="10,20,25" v-model="product.discount">
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Alert :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="....." v-model="product.alert">
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Info :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="....." v-model="product.info">
                            </div>
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Description :
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="....." v-model="product.description">
                            </div>
                        </div>
                        <div class="w-full mt-2 text-center">
                            <input value="AGREGAR PRODUCTO" type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"/>
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
            categories: Array,
        },
        data() {
            return {
                product: {
                    name:'',
                    price:'',
                    alert:'',
                    info: '',
                    stock:'',
                    description: '',
                    discount: '',
                    categorie_id: 0,
                    image: ''
                }
            }
        },
        methods: {
            async store_product() {
                let response = await this.$inertia.post('/Products/Store', this.product);
            }
        }
    }
</script>
