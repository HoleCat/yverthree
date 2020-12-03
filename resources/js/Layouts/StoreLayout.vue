<template>
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow" v-bind:style="{background:store.background_one}" style="position: absolute;z-index: 0;top: 0;bottom: 0;right: 0;left: 0;">
            <div class="h-full py-2 text-center" style="position:relative">
                <slot name="header"></slot>
            </div>
        </header>
        <main class="products options_open" v-bind:style="{background:store.background_two}">
            <slot name="body"></slot>
        </main>
        <button @click="open_car()"
            style="position: absolute;z-index: 9;bottom: 60px;right: 20px;" 
            class="bg-green-500 hover:bg-green-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">Shop cart</button>

        <div v-if="modal==true" class="flex flex-wrap bg-white" style="transition:2s;align-items:center;z-index:10;position:absolute;top:0px;bottom:0px;left:0px;right:0px;">
            <div class="bg-white w-2/2 sm:w-1/2 mx-auto" style="z-index:11">
                <car v-bind="car=car"/>
                <button @click="open_car()"
                style="position: absolute;z-index: 9;bottom: 60px;right: 20px;" 
                class="bg-red-500 hover:bg-red-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">
                Shop cart
                </button>                
            </div>
        </div>
    </div>
</template>

<script>
    import Car from '@/Pages/Stores/Car'

    export default {
        components: {
            Car
        },
        props:{
            store_prop: Object,
            modal:false
        },
        data() {return {
            showingCategories: false,
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
                radio_options : "40px"
            }
        }},
        created() {
            this.store = this.$props.store_prop;
        },
        methods: {
            open_car() {
                this.$props.modal = !this.$props.modal;
            }
        },
        computed: {},
        theme: {
            maxHeight: {
            '0': '0',
            '1/4': '25%',
            '1/2': '50%',
            '3/4': '75%',
            'full': '100%',
            }
        }
    }
</script>
