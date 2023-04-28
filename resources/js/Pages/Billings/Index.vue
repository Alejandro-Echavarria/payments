<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

export default {
    components: {
        AppLayout,
        TextInput,
        InputError,
    },

    data() {
        return {
            credict: {
                name: '',
            },
            disabled: false,
            errors: {
                stripe: null,
            },
        }
    },

    mounted() {
        const stripe = Stripe(`${this.$inertia.page.props.STRIPE_KEY}`);
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {

            this.disabled = true;
            const clientSecret = cardButton.dataset.secret;

            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            });

            if (error) {
                // Display "error.message" to the user...
                this.errors.stripe = error.message;
            } else {
                // The card has been verified successfully...
                cardHolderName.value = '';
                cardElement.clear();
                this.errors.stripe = null;

                this.$inertia.post(this.route('billings.addpaymentmethod'), setupIntent.payment_method);
            }
            this.disabled = false;
        });
    },

    props: {
        intent: {
            Object,
            required: true
        },
        paymentMethods: {
            Object,
        }

    }
};
</script>

<template>
    <AppLayout title="Products">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-4 px-4 sm:px-0">
                    <div class="grid grid-cols-1 gap-6">
                        <section class="bg-white overflow-hidden rounded-lg">
                            <div v-inertia-ignore class="px-6 py-4 space-y-3">
                                <h1 class="text-gray-700 text-lg font-bold">Add payment method</h1>

                                <TextInput v-model="credict.name" id="card-holder-name" type="text"
                                    class="w-full p-2.5 text-sm" placeholder="Card holder name" />

                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-blue-500 focus:border-blue-500 peer transition">
                                </div>

                                <InputError :message="errors.stripe" class="mt-2" />
                            </div>

                            <footer class="px-6 py-4 h-16 border-t border-gray-200">
                                <div class="flex justify-end">
                                    <button id="card-button"
                                        class="hover:border-b-2 font-medium text-blue-600 dark:text-blue-500 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out disabled:opacity-50"
                                        :data-secret="`${intent.client_secret}`" :disabled="disabled">
                                        <span v-if="disabled" class="flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5 animate-spin text-blue-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M 12 2 a 10 10 0 0 1 10 10 a 1 1 0 1 1 -2 0 a 8 8 0 0 0 -8 -8 a 1 1 0 1 1 0 -2 z">
                                                </path>
                                            </svg>
                                            <span>Adding</span>
                                        </span>
                                        <span v-else>
                                            Add payment method
                                        </span>
                                    </button>
                                </div>
                            </footer>
                        </section>

                        <section class="bg-white overflow-hidden rounded-lg">
                            <div v-inertia-ignore class="px-6 py-4 space-y-3">
                                <h1 class="text-gray-700 text-lg font-bold">Payments method</h1>
                                <div>
                                    <ul class="divide-y divide-gray-200">
                                        <li 
                                            v-for="paymentMethod in paymentMethods"
                                            :key="'paymentMethod-' + paymentMethod.id" class="py-2 flex justify-between">
                                            <div>
                                                <p>
                                                    <span class="font-bold">
                                                        {{ paymentMethod.billing_details.name }}
                                                    </span>
                                                    ••••{{ paymentMethod.card.last4 }}
                                                </p>
                                                <p>
                                                    Expira:
                                                    {{ paymentMethod.card.exp_month }}/{{ paymentMethod.card.exp_year }}
                                                </p>
                                            </div>
                                            <button
                                                @click="$inertia.delete(route('billings.removepaymentmethod', paymentMethod.id))"
                                                class="text-red-600/80">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>