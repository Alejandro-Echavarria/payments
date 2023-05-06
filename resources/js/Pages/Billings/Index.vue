<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Subscription from '@/Components/Subscription.vue';
import Invoices from '@/Components/Invoices.vue';
import PaymentsMethod from '@/Components/Payments/PaymentsMethod.vue';
import AddPaymentMethod from '@/Components/Payments/AddPaymentMethod.vue';

export default {
    components: {
        AppLayout,
        TextInput,
        InputError,
        Subscription,
        Invoices,
        PaymentsMethod,
        AddPaymentMethod,
    },

    data() {
        return {
            credict: {
                name: '',
            },
            stripekey: this.$inertia.page.props.STRIPE_KEY
        }
    },

    // mounted() {
    //     const stripe = Stripe(`${this.$inertia.page.props.STRIPE_KEY}`);
    //     const elements = stripe.elements();
    //     const cardElement = elements.create('card');

    //     cardElement.mount('#card-element');

    //     const cardHolderName = document.getElementById('card-holder-name');
    //     const cardButton = document.getElementById('card-button');

    //     cardButton.addEventListener('click', async (e) => {

    //         this.disabled = true;
    //         const clientSecret = cardButton.dataset.secret;

    //         const { setupIntent, error } = await stripe.confirmCardSetup(
    //             clientSecret, {
    //             payment_method: {
    //                 card: cardElement,
    //                 billing_details: { name: cardHolderName.value }
    //             }
    //         });

    //         if (error) {
    //             // Display "error.message" to the user...
    //             this.errors.stripe = error.message;
    //         } else {
    //             // The card has been verified successfully...
    //             cardHolderName.value = '';
    //             cardElement.clear();
    //             this.errors.stripe = null;

    //             this.$inertia.post(this.route('billings.addpaymentmethod'), setupIntent.payment_method, { preserveScroll: true });
    //         }
    //         this.disabled = false;
    //     });
    // },


    props: {
        intent: {
            Object,
            required: true
        },
        paymentMethods: {
            Object,
        },
        invoices: {
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
                        <Subscription />
                        <AddPaymentMethod :intent="intent" :stripekey="`${stripekey}`" />
                        <PaymentsMethod :paymentMethods="paymentMethods" />
                        <Invoices :invoices="invoices" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>