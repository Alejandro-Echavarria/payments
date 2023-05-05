<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Banner from '@/Components/Banner.vue';
import PaymentsMethod from '@/Components/Payments/PaymentsMethod.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

export default {
    components: {
        AppLayout,
        Banner,
        PaymentsMethod,
        PrimaryButton,
        InputError,
    },

    data() {
        return {
            disabled: false,
            errors: {
                stripe: null
            }
        };
    },

    methods: {
        purchase() {
            this.disabled = true;
            this.$inertia.post(this.route('purchases.store', this.product.id), {
                preserveScroll: true,
                preserveState: true
            }, {
                onSuccess: () => {
                    this.disabled = false;
                    this.errors.stripe = this.$inertia.page.props.jetstream.flash.error?.message;
                },
                onError: () => {
                    this.disabled = false;
                }
            });
        },
    },

    props: {
        product: {
            type: Object,
            required: true
        },
        paymentMethods: {
            type: Object,
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
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 md:col-span-7 px-6 py-4 space-y-3">
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
                            <div class="col-span-12 md:col-span-5">
                                <PaymentsMethod :paymentMethods="paymentMethods" />
                                <InputError :message="errors.stripe" class="mt-2 flex justify-end px-6 pb-4" />
                                <div class="flex justify-end px-6 pb-4">
                                    <PrimaryButton @click="purchase" :disabled="disabled">
                                        <span v-if="disabled" class="flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5 animate-spin text-blue-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M 12 2 a 10 10 0 0 1 10 10 a 1 1 0 1 1 -2 0 a 8 8 0 0 0 -8 -8 a 1 1 0 1 1 0 -2 z">
                                                </path>
                                            </svg>
                                            <span>Loading</span>
                                        </span>
                                        <span v-else>
                                            Buy
                                        </span>
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>