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
            if (description.length > 200) {
                return description.substring(0, 200) + '...';
            } else {
                return description;
            }
        }
    },

    props: {
        articles: {
            type: Object,
            required: true
        },

    }
}
</script>

<template>
    <AppLayout title="Articles">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-4 px-4 sm:px-0 space-y-6">
                    <template v-for="article in articles.data" :key="'article-' + article.id">
                        <div class="bg-white rounded-xl overflow-hidden">
                            <img class="h-72 w-full object-cover object-center" :src="`${article.image}`" alt="">

                            <div class="px-6 py-4">
                                <h1 class="font-semibold text-xl mb-2">
                                    <Link :href="route('articles.show', article.id)" preserve-state>
                                        {{ article.title }}
                                    </Link>
                                </h1>
                                <p class="mt-2 text-gray-600 text-sm">
                                    {{ truncateDescription(article.extract) }}
                                </p>
                            </div>
                        </div>
                    </template>
                    <Pagination :pagination="articles" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>