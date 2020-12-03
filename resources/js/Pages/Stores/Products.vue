<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 px-1" style="position: absolute;bottom: 0px;top: 40px;overflow-y: scroll;">
        <div class="p-1" v-for="product in products" :key="product.id">
            <div v-bind:style="{background:store.background_products}" class="w-full p-2 rounded shadow-lg grid grid-cols-1 sm:grid-cols-2">
                <div class="">
                    <Carousel autoplay loop>
                        <CarouselItem v-for="gallery in product.galleries" :key="gallery.id" >
                            <div class="demo-carousel">
                                <img class="products_img bg-green-200" :src="gallery.route" alt="">
                            </div>
                        </CarouselItem>
                    </Carousel>
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{product.name}}</div>
                    <p v-bind:style="{color:store.color_product_alert}" class="text-700 text-base">!{{product.alert}}</p>
                    <p v-bind:style="{color:store.color_product_info}" class="text-700 text-base">*{{product.info}}</p>
                    <p v-bind:style="{color:store.color_product_description}" class="text-700 text-base">{{product.description}}</p>
                    <span v-bind:style="{background:store.background_product_categorie,color:store.color_product_categorie}" class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-900 mr-2 mb-2">{{product.categorie_name}}</span>
                    <div class="w-full p-2">
                        <span v-bind:style="{background:store.background_product_price,color:store.color_product_price}" class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-900 mr-2 mb-2">price : S/.{{product.price}}</span>
                        <span v-bind:style="{background:store.background_product_stock,color:store.color_product_stock}" class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-900 mr-2 mb-2">stock : {{product.stock}}</span>
                        <span v-bind:style="{background:store.background_product_discount,color:store.color_product_discount}" class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-900 mr-2 mb-2">-%{{product.discount}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Carousel } from 'view-design';
    export default {
        components: {},
        props: ['products','store'],
        methods: {}
    }
</script>