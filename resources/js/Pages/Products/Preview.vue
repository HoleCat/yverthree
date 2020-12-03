<template>
    <app-layout>
        <div class="py-3 min-h-full">
            <div class="max-h-20 mx-auto px-2 sm:px-6 lg:px-8">
                <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-3">
                    <form @submit.prevent="acept_product" class="flex flex-wrap px-1">
                        <input value="OK" type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"/>
                    </form>
                    <form @submit.prevent="cancel_product" class="flex flex-wrap px-1">
                        <input value="X" type="submit" class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded"/>    
                    </form>
                    <form @submit.prevent="destroy_product" class="flex flex-wrap px-1">
                        <input value="BORRAR" type="submit" class="w-full bg-red-500 hover:bg-red-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded"/>
                    </form>
                </div>
            </div>
            <div class="max-h-screem overflow-y-scroll max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-2" >
                <div class="mt-2 mx-2 rounded shadow-lg grid grid-cols-2 sm:grid-cols-1">
                    <img class="w-full bg-green-200 h-56" src="/img/card-top.jpg" alt="Imagen">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{product.name}}</div>
                        <span class="inline-block bg-yellow-200 rounded-full px-3 py-1 text-sm font-semibold text-yellow-900 mr-2 mb-2">S/.{{product.price}}</span>
                        <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-blue-900 mr-2 mb-2">stock : {{product.stock}}</span>
                        <p class="text-red-700 text-base">
                        !{{product.alert}}
                        </p>
                        <p class="text-blue-700 text-base">
                        *{{product.info}}
                        </p>
                        <p class="text-gray-700 text-base">
                        {{product.description}}
                        </p>
                        <span class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-red-900 mr-2 mb-2">-%{{product.stock}}</span>
                        <span class="inline-block bg-purple-200 rounded-full px-3 py-1 text-sm font-semibold text-purple-900 mr-2 mb-2">{{product.categorie_name}}</span>
                    </div>
                </div>
                <div class="mt-2 mx-2 rounded shadow-lg grid grid-cols-2 sm:grid-cols-1">
                    <img class="w-full bg-green-200 h-56" src="/img/card-top.jpg" alt="Imagen">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{product.name}}</div>
                        <span class="inline-block bg-yellow-200 rounded-full px-3 py-1 text-sm font-semibold text-yellow-900 mr-2 mb-2">S/.{{product.price}}</span>
                        <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-blue-900 mr-2 mb-2">stock : {{product.stock}}</span>
                        <p class="text-red-700 text-base">
                        !{{product.alert}}
                        </p>
                        <p class="text-blue-700 text-base">
                        *{{product.info}}
                        </p>
                        <p class="text-gray-700 text-base">
                        {{product.description}}
                        </p>
                        <span class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-red-900 mr-2 mb-2">-%{{product.stock}}</span>
                        <span class="inline-block bg-purple-200 rounded-full px-3 py-1 text-sm font-semibold text-purple-900 mr-2 mb-2">{{product.categorie_name}}</span>
                    </div>
                </div>
                <div class="mt-2 mx-2 rounded shadow-lg grid grid-cols-2 sm:grid-cols-1">
                    <img class="w-full bg-green-200 h-56" src="/img/card-top.jpg" alt="Imagen">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{product.name}}</div>
                        <span class="inline-block bg-yellow-200 rounded-full px-3 py-1 text-sm font-semibold text-yellow-900 mr-2 mb-2">S/.{{product.price}}</span>
                        <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-blue-900 mr-2 mb-2">stock : {{product.stock}}</span>
                        <span class="inline-block bg-purple-200 rounded-full px-3 py-1 text-sm font-semibold text-purple-900 mr-2 mb-2">{{product.categorie_name}}</span>
                        <p class="text-red-700 text-base">!{{product.alert}}</p>
                        <p class="text-blue-700 text-base">*{{product.info}}</p>
                        <p class="text-gray-700 text-base">{{product.description}}</p>
                        <span class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-red-900 mr-2 mb-2">-%{{product.stock}}</span>
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
            product_prop: Object,
            store_prop: Object
        },
        data() {
            return {
                product: {
                    id:'',
                    name:'',
                    price:0.0,
                    alert:'',
                    info: '',
                    stock:'',
                    description: '',
                    discount: 0,
                    categorie_id: 0,
                    image: '',
                    action: 'ACEPT',
                    old_product: ''
                },
                store: {
                    id:0,
                    store : '',
                    logo : "missing",
                    slogan : "my new slogan for my new store",
                    background_one : "#F44336",
                    background_two : "#00ffd9",
                    background_three : "#00ffd9",
                    background_products : "#00ffd9",
                    background_categories : "#00ffd9",
                    color_title_principal : "#212121",
                    color_title_secondary : "#212121",
                    color_product_price : "#212121",
                    color_product_categorie : "#212121",
                    color_product_discount : "#212121",
                    color_product_stock : "#212121",
                    background_product_price : "#212121",
                    background_product_categorie : "#212121",
                    background_product_discount : "#212121",
                    background_product_stock : "#212121",
                    color_product_alert : "#212121",
                    color_product_info : "#212121",
                    color_product_description : "#212121",
                    radio_options : "40px",
                }
            }
        },
        created() {
            this.product = this.$props.product_prop;
            this.store = this.$props.store_prop;
        },
        methods: {
            async acept_product() {
                let response = await this.$inertia.get('/Products/Index', this.product);
            },
            async cancel_product() {
                this.product.action = "CANCEL"
                let response = await this.$inertia.post('/Products/Update', this.product);
            },
            async destroy_product() {
                let response = await this.$inertia.post('/Products/Destroy', this.product);
            }
        }
    }
</script>
