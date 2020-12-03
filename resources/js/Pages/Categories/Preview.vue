<template>
    <app-layout>
        <div class="py-3 min-h-full">
            <div class="max-h-20 mx-auto px-2 sm:px-6 lg:px-8">
                <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-3">
                    <form @submit.prevent="acept_categorie" class="flex flex-wrap px-1">
                        <input value="OK" type="submit" class="w-full bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"/>
                    </form>
                    <form @submit.prevent="cancel_categorie" class="flex flex-wrap px-1">
                        <input value="X" type="submit" class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded"/>    
                    </form>
                    <form @submit.prevent="destroy_categorie" class="flex flex-wrap px-1">
                        <input value="BORRAR" type="submit" class="w-full bg-red-500 hover:bg-red-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded"/>
                    </form>
                </div>
            </div>
            <div class="h-full sm:max-h-56 overflow-y-scroll max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" 
            style="
                z-index:1
            "
            >
                <div class="mt-2 mx-2 max-w-xs rounded shadow-lg grid grid-cols-2 sm:grid-cols-1 lg:grid-cols-1"
                style="
                    position:relative;
                    z-index:1;
                "
                >
                    <div class="px-6 py-4" style="
                        z-index: 2;
                    ">
                        <div class="font-bold text-xl mb-2">{{categorie.name}}</div>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{categorie.icon}}</span>
                        <p class="text-gray-700 text-base">
                        {{categorie.description}}
                        </p>
                    </div>
                    <img class="w-full bg-blue-200 h-48" src="" alt="Imagen">
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
            store_prop: Object
        },
        data() {
            return {
                categorie: {
                    id:'',
                    name:'',
                    description:'',
                    icon:'',
                    image: '',
                    action: 'ACEPT',
                    old_categorie: ''
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
            this.categorie = this.$props.categorie_prop;
            //console.log(this.$props);
        },
        methods: {
            async acept_categorie() {
                let response = await this.$inertia.get('/Categories/Index');
            },
            async cancel_categorie() {
                this.categorie.action = "CANCEL"
                let response = await this.$inertia.post('/Categories/Update', this.categorie);
            },
            async destroy_categorie() {
                let response = await this.$inertia.post('/Categories/Destroy', this.categorie);
            }
        }
    }
</script>
