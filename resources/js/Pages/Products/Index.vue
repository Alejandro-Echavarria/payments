<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Pagination,
        Link,
    },

    methods: {
        truncateDescription(description) {
            if (description.length > 100) {
                return description.substring(0, 100) + '...';
            } else {
                return description;
            }
        }
    },

    props: {
        products: {
            type: Object,
            required: true
        },

    }
}
</script>

<template>
    <AppLayout title="Products">
        <!-- <template #header>
            <h2 id="con" class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-4 px-4 sm:px-0">
                    <div class="grid xs:grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template v-for="product in products.data" :key="'product-' + product.id">
                            <div class="bg-white rounded-xl overflow-hidden">
                                <div class="h-56 bg-cover bg-center px-6 py-4"
                                    :style="`background-image: url(${product.image});`">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                        {{ product.price }} USD
                                    </span>
                                </div>

                                <div class="px-6 py-4">
                                    <h1 class="text-gray-800 font-semibold text-xl">
                                        <Link :href="route('products.show', product.id)" preserve-state>
                                            {{ product.title }}
                                        </Link>
                                    </h1>
                                    <p class="mt-2 text-gray-600 text-sm">
                                        {{ truncateDescription(product.description) }}
                                    </p>
                                </div>
                            </div>
                        </template>
                    </div>
                    <Pagination :pagination="products" class="mt-6"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>