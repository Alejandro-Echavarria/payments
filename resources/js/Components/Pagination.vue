<script>
import { Link } from '@inertiajs/vue3';

export default {
    props: {
        pagination: {
            type: Object,
            required: true
        }
    },
    methods: {
        changePage(url) {
            const page = url.split("?page=")[1];
            this.$inertia.visit(this.$inertia.page.url, {
                replace: true,
                preserveState: true,
                preserveScroll: true,
                data: {
                    page: page
                }
            });
        }
    },
    components: { Link }
}
</script>

<template>
    <div class="flex items-center justify-between px-4 py-3 sm:px-0">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="#"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Previous
            </a>
            <a href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ pagination.from }}</span>
                    to
                    <span class="font-medium">{{ pagination.to }}</span>
                    of
                    <span class="font-medium">{{ pagination.total }}</span>
                    results
                </p>
            </div>
            <div v-if="pagination.links.length > 3">
                <nav class="isolate inline-flex -space-x-px rounded-md" aria-label="Pagination">
                    <template v-for="(link, index) in pagination.links">
                        <div v-if="link.url == null" :key="'botons-' + index"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-400 focus:z-20 cursor-not-allowed"
                            v-html="link.label">
                        </div>

                        <Link v-else :key="'links-' + index" :href="link.url"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 focus:z-20 cursor-pointer"
                            :class="link.active
                                    ? 'z-10 border-b-2 border-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                    : ''" v-html="link.label">
                        </Link>
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>

<style scoped></style>