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
                    <table class="w-full table-fixed text-center">
                        <thead>
                            <tr>
                                <th class="w-1/5 px-2 py-2">Info</th>
                                <th class="w-1/5 px-2 py-2">Configuration</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="product in products" :key="product.id">
                                <td class="border">
                                    <div class="flex flex-wrap text-left">
                                        <div class="w-full sm:w-1/2 p-1 mx-auto">
                                            <Carousel autoplay loop>
                                                <CarouselItem v-for="gallery in product.galleries" :key="gallery.id" >
                                                    <div class="demo-carousel">
                                                        <img :src="gallery.route" alt="">
                                                    </div>
                                                </CarouselItem>
                                            </Carousel>
                                        </div>
                                        <div class="w-2/2 sm:w-1/2 p-1">
                                            <strong class="text-blue-500 text-base">Basic data :</strong>
                                            <p><strong>Name :</strong> {{product.name}}</p>
                                            <p><strong>Price :</strong> {{product.price}}</p>
                                            <p><strong>Stock :</strong> {{product.stock}}</p>
                                            <p><strong>Discount :</strong> {{product.discount}}</p>
                                        </div>
                                        <div class="w-2/2 sm:w-1/2 p-1">
                                            <strong class="text-red-500 text-base">Important data :</strong>
                                            <p><strong>Alert :</strong> {{product.alert}}</p>
                                            <p><strong>Info :</strong> {{product.info}}</p>
                                            <p><strong>Description :</strong> {{product.description}}</p>
                                            <p><strong>Categorie :</strong> {{product.categorie_name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="border px-2 py-2">
                                    <div class="py1">
                                        <button @click="delete_product(product)" class="w-full bg-red-500 hover:bg-red-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">DELETE</button>
                                    </div>
                                    <div class="py-1">
                                        <button @click="edit_product(product)" class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded">EDIT</button>
                                    </div>
                                    <div class="py-1">
                                        <button @click="add_gallery(product)" class="w-full bg-blue-500 hover:bg-blue-400 text-white font-bold mt-2 py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">GALLERY</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import { Carousel } from 'view-design';

    export default {
        components: {
            AppLayout
        },
        props: ['products_prop','galleries_prop'],
        data() {
           return {
               csrf: "",
               products: Array,
               galleries: Array,
            }
        },
        variants: {
            tableLayout: ['responsive']
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
            reload_galleries(res) {
                if(res.msg)
                {
                    alert(msg);
                }else
                {
                    this.galleries = res;
                    this.csrf = document.getElementsByName('csrf-token')[0].getAttribute('content');
                    for (let index = 0; index < this.products.length; index++) {
                        const product_element = this.products[index];
                        if(res.product_id == product_element.id){
                            if(this.products[index].galleries){
                                this.products[index].galleries.push(res);
                            } else {
                                this.products[index].galleries = [];
                                this.products[index].galleries.push(res);
                            }
                        }
                    }
                    this.$set(Carousel);
                }
            },
            async delete_product(product) {
                let response = await this.$inertia.post('/Products/Destroy', product);
            },
            async edit_product(product) {
                console.log(product);
                product.action = "EDIT";
                let response = await this.$inertia.post('/Products/Edit', product);
            },
            async add_gallery(product) {
                console.log(product);
                let response = await this.$inertia.get('/Products/Gallery', product);
            },
            console_product(res,file,files) {
                console.log(res);
                console.log(file);
                console.log(files);
            }
        }
    }
</script>
