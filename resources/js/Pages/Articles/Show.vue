<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Banner from '@/Components/Banner.vue';

export default {
    components: {
        AppLayout,
        Banner,
    },

    props: {
        article: {
            type: Object,
            required: true
        }
    }
}
</script>

<template>
    <AppLayout title="Article">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-4 px-4 sm:px-0 space-y-6">
                    <section class="bg-white overflow-hidden rounded-lg">
                        <div class="space-y-3">
                            <h1 class="text-gray-700 text-3xl font-bold">{{ article.title }}</h1>

                            <div>
                                <p class="text-gray-700">{{ article.extract }}</p>
                            </div>

                            <figure>
                                <img :src="article.image" class="w-full h-80 object-cover object-center rounded-lg" alt="">
                            </figure>

                            <div class="text-gray-700">
                                {{ article.body }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>