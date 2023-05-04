<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Banner from '@/Components/Banner.vue';

export default {
    components: {
        AppLayout,
        Banner,
    },

    props: {
        product: {
            type: Object,
            required: true
        }
    }
}
</script>

<template>
    <AppLayout title="Product">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-4 px-4 sm:px-0 space-y-6">
                    <section class="bg-white overflow-hidden rounded-lg">
                        <div class="grid grid-cols-12 gap-6 px-6 py-4 space-y-3">
                            <div class="col-span-7 ">
                                <div class="flex space-x-2">
                                    <figure>
                                        <img :src="product.image" class="w-48 h-28 object-cover object-center rounded-lg"
                                            alt="">
                                    </figure>
                                    <div>
                                        <h1 class="text-gray-700 text-xl font-bold">{{ product.title }}</h1>
                                        <p class="text-gray-700 text-sm">${{ product.price }} USD</p>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Facilis ratione explicabo repellendus. Quae et corporis illo
                                    iure exercitationem quia! Saepe id aspernatur blanditiis quia vel facilis qui rati
                                    one delectus nulla!
                                </p>
                            </div>

                            <div class="col-span-5">

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>