<template>
    <app-layout v-bind:store_prop="store">
        <template #header>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div>
                    <h2 class="mt-2 font-semibold text-xl text-gray-800 leading-tight">
                        Update {{store.store}}
                    </h2>
                </div>
            </div>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg mb-2">
                    <div class="flex flex-wrap w-full">
                        <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Primary color :</label>
                            <div v-bind:style="{background:store.background_one}" class="w-full h-20"></div>
                        </div>
                        <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Secondary color :</label>
                            <div v-bind:style="{background:store.background_two}" class="w-full h-20"></div>
                        </div>
                        <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Extra color :</label>
                            <div v-bind:style="{background:store.background_three}" class="w-full h-20"></div>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="update_store" class="flex flex-wrap">
                        <div class="flex flex-wrap w-full">
                            <div class="w-full sm:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">Store name :</label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="....." v-model="store.store">
                            </div>
                            <div class="w-full sm:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">Slogan :</label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="....." v-model="store.slogan">
                            </div>
                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                <h2>Principal Colors:</h2>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Background categories:</label>
                                <ColorPicker v-model="store.background_one" />
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Background products:</label>
                                <ColorPicker v-model="store.background_two" />
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Background extra:</label>
                                <ColorPicker v-model="store.background_three" />
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Alert text color :</label>
                                <ColorPicker v-model="store.color_title_principal" />
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Info text color :</label>
                                <ColorPicker v-model="store.color_title_secondary" />
                            </div>
                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                <h2>General Colors:</h2>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Background item categories:</label>
                                <ColorPicker v-model="store.background_categories" />
                            </div>
                            <div class="w-full sm:w-1/3 px-3 mb-6 md:mb-0">
                                <h2>Product colors:</h2>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Background products:</label>
                                <ColorPicker v-model="store.background_products" />
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Price color/background:</label>
                                <ColorPicker v-model="store.color_product_price" />/<ColorPicker v-model="store.background_product_price" />
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Categorie color/background:</label>
                                <ColorPicker v-model="store.color_product_categorie" />/<ColorPicker v-model="store.background_product_categorie" />
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Discount color/background:</label>
                                <ColorPicker v-model="store.color_product_discount" />/<ColorPicker v-model="store.background_product_discount" />
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Stock color/background:</label>
                                <ColorPicker v-model="store.color_product_stock" />/<ColorPicker v-model="store.background_product_stock" />
                            </div>
                        </div>
                        <div class="w-full mt-2 text-center">
                            <input value="UPDATE STORE" type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"/>
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
            store_prop: Object,
        },
        data() {
            return {
                store: {
                    id: 0,
                    store: '',
                    slogan: '',
                    background_one: '',
                    background_two: '',
                    background_three: '',
                    background_products: '',
                    background_categories: '',
                    color_title_principal: '',
                    color_title_secondary: '',
                    color_product_price: '',
                    color_product_categorie: '',
                    color_product_discount: '',
                    color_product_stock: '',
                    background_product_price: '',
                    background_product_categorie: '',
                    background_product_discount: '',
                    background_product_stock: '',
                    color_product_alert: '',
                    color_product_info: '',
                    color_product_description: '',
                    radio_options: 0,
                    action: '',
                    ok: 'ok'
                }
            }
        },
        created() {
            this.store = this.$props.store_prop;
        },
        methods: {
            async update_store() {
                let response = await this.$inertia.post('/Stores/Update', this.store);
            }
        }
    }
</script>
