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
                    <div v-for="product in products" :key="product.id">
                        <td class="border">
                            <div class="flex flex-wrap text-left">
                                
                            </div>
                        </td>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
export default {
    components: {
        AppLayout
    },
    props: ['galleries'],
}
</script>