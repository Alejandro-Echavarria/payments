<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Subscription from '@/Components/Subscription.vue';
import Invoices from '@/Components/Invoices.vue';
import PaymentsMethod from '@/Components/Payments/PaymentsMethod.vue';
import AddPaymentMethod from '@/Components/Payments/AddPaymentMethod.vue';

export default {
    components: {
        AppLayout,
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