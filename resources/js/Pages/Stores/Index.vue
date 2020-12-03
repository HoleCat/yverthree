<template>
    <store-layout v-bind:store_prop="store">
        <template #header>
            <div class="w-full">
                <h2 class="mt-2 font-semibold text-xl text-gray-800 leading-tight">
                    {{store.store}}
                </h2>
            </div>
            <div class="w-full" style="overflow-y:scroll;position:absolute;top:40px;bottom:60px;">
                <categories v-bind:store="store" v-bind:categories="categories"/>
            </div>
        </template>
        <template #body>
            <div class="flex flex-wrap w-full" style="position:absolute;top:10px;bottom:0;">
                <div class="w-full" style="height: 40px;">
                    <span @click="options_()" class="w-full option_ mt-2 font-semibold text-xl text-gray-800 leading-tight">
                        <svg class="w-10 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.5 10H6V3h8v7h3.5L10 17.5 2.5 10z"/></svg>
                    </span>
                </div>
                <products v-bind:store="store" v-bind:products="products"/>
            </div>
        </template>
    </store-layout>
</template>

<script>
    import StoreLayout from '@/Layouts/StoreLayout'
    import Categories from '@/Pages/Stores/Categories'
    import Products from '@/Pages/Stores/Products'

    export default {
        components: {
            Products,
            Categories,
            StoreLayout
        },
        props: {
            products_prop: Array,
            categories: Array,
            galleries_prop: Array,
            store: Object
        },
        variants: {
            tableLayout: ['responsive']
        },
        data() {
            return {
                products: Array,
                galleries: Array
            }
        },
        created() {
            this.products = this.$props.products_prop;
            this.galleries = this.$props.galleries_prop;
            this.csrf = document.getElementsByName('csrf-token')[0].getAttribute('content');
            for (let index = 0; index < this.products.length; index++) {
                const product_element = this.products[index];
                for (let index_galleries = 0; index_galleries < this.galleries.length; index_galleries++) {
                    const gallery_element = this.galleries[index_galleries];
                    if(gallery_element.object_id == product_element.id){
                        if(this.products[index].galleries){
                            this.products[index].galleries.push(this.galleries[index_galleries]);
                        } else {
                            this.products[index].galleries = [];
                            this.products[index].galleries.push(this.galleries[index_galleries]);
                        }
                    }
                }
            }
        },
        methods: {
            options_() {
                let products = document.querySelector('.products');
                let arrow = document.querySelector('.option_');
                if(products.classList.contains("options_open")==true){
                    arrow.innerHTML = '<svg class="w-10 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 2.5l7.5 7.5H14v7H6v-7H2.5L10 2.5z"/></svg>';
                    arrow.parentNode.nextElementSibling.classList.add("hidden")
                    products.classList.remove("options_open");
                    products.classList.add("options_close");
                }else if(products.classList.contains("options_close")==true){
                    arrow.innerHTML = '<svg class="w-10 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.5 10H6V3h8v7h3.5L10 17.5 2.5 10z"/></svg>';
                    products.classList.add("options_open");
                    arrow.parentNode.nextElementSibling.classList.remove("hidden")
                    products.classList.remove("options_close");
                }
            }
        }
    }
</script>
