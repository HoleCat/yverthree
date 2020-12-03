<template>
    <app-layout>
        <template #header>
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div>
                    <h2 class="mt-2 font-semibold text-xl text-red-800 leading-tight">
                        Security alert
                    </h2>
                </div>
            </div>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <p></p>
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
            free_location: Object,
            msg: String
        },
        data() {
            return {
                security: {}
            }
        },
        created() {
            this.free_location = this.$props.free_location;
            //this.google_location = this.$props.google_location;
            this.msg = this.$props.msg;
        },
        methods: {
            async update_product() {
                let response = await this.$inertia.post('/Securities/Update', this.security);
            }
        }
    }
</script>
