<template>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="mt-2 grid grid-cols-2">
                    <div class="text-center">
                        <a href="/Register" class="bg-blue-500 hover:bg-blue-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Create my own store
                        </a>
                    </div>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {AppLayout},
        props: ['msg'],
        variants: {tableLayout: ['responsive']},
        methods: {}
    }
</script>
