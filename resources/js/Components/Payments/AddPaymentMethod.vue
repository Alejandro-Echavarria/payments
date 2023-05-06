<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { router } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';

const state = reactive({
    name: '',
    disabled: false,
    errors: {
        stripe: null
    }
});

onMounted(() => {
    const stripe = Stripe(`${props.stripekey}`);
    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    cardButton.addEventListener('click', async (e) => {

        state.disabled = true;
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
            state.errors.stripe = error.message;
        } else {
            // The card has been verified successfully...
            cardHolderName.value = '';
            cardElement.clear();
            state.errors.stripe = null;

            router.post(route('billings.addpaymentmethod'), setupIntent.payment_method, {
                preserveScroll: true
            });
        }
        state.disabled = false;
    });
});

const props = defineProps({
    intent: {
        type: Object,
        required: true
    },
    stripekey: {
        type: String,
        required: true
    }
});
</script>

<template>
    <section class="bg-white overflow-hidden rounded-lg">
        <div v-inertia-ignore class="px-6 py-4 space-y-3">
            <h3 class="text-gray-700 text-lg font-bold">Add payment method</h3>
            <TextInput v-model="name" id="card-holder-name" type="text" class="w-full p-2.5 text-sm"
                placeholder="Card holder name" />

            <!-- Stripe Elements Placeholder -->
            <div id="card-element"
                class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-blue-500 focus:border-blue-500 peer transition">
            </div>
            <InputError :message="state.errors.stripe" class="mt-2" />
        </div>
        <footer class="px-6 py-4 h-16 border-t border-gray-200">
            <div class="flex justify-end">
                <button id="card-button"
                    class="hover:border-b-2 font-medium text-blue-600 dark:text-blue-500 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out disabled:opacity-50"
                    :data-secret="`${intent.client_secret}`" :disabled="state.disabled">
                    <span v-if="state.disabled" class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5 animate-spin text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
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
</template>

<style scoped></style>