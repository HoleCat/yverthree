<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 py-3">
        <div v-for="categorie in categories" :key="categorie.id" class="mt-2 mx-2 rounded shadow-lg grid grid-cols-2 sm:grid-cols-1 lg:grid-cols-1"
                style="position:relative;" v-bind:style="{background:store.background_categories}">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{categorie.name}}</div>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{categorie.icon}}</span>
                <p class="text-gray-700 text-base" style="min-height:72px">
                {{categorie.description}}
                </p>
            </div>
            <img class="w-full bg-blue-200 h-full sm:h-48" :src="categorie.image" alt="Imagen">
        </div>
    </div>
</template>

<script>
    export default {
        components: {},
        props: ['categories','store'],
        methods: {}
    }
</script>
