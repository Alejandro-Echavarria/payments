<script setup>
import { router } from '@inertiajs/vue3';

defineProps({
    paymentMethods: {
        type: Object,
        required: true
    },
});

const defaultpaymentmethod = (id) => {
    router.put(route('billings.defaultpaymentmethod'), id, { preserveScroll: true });
}
</script>

<template>
    <section class="bg-white overflow-hidden rounded-lg">
        <div v-inertia-ignore class="px-6 py-4 space-y-3">
            <h3 class="text-gray-700 text-lg font-bold">Payments method</h3>
            <ul class="divide-y divide-gray-200">
                <TransitionGroup name="list">
                    <li v-for="paymentMethod in paymentMethods" :key="'paymentMethod-' + paymentMethod.id"
                        class="py-2 flex justify-between">
                        <div>
                            <div class=" flex flex-wrap space-x-2">
                                <div class="font-bold">
                                    <p>
                                        {{ paymentMethod.billing_details.name }}
                                    </p>
                                </div>
                                <div>
                                    <span>
                                        ••••{{ paymentMethod.card.last4 }}
                                    </span>
                                </div>
                                <div>
                                    <span
                                        v-if="$page.props.defaultPaymentMethod.id == paymentMethod.id"
                                        class="text-nowrap bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                        Default
                                    </span>
                                </div>
                            </div>
                            <p>
                                Expira:
                                {{ paymentMethod.card.exp_month }}/{{ paymentMethod.card.exp_year }}
                            </p>
                        </div>

                        <div class="flex space-x-4">
                            <button @click="defaultpaymentmethod(paymentMethod.id)" :class="`${$page.props.defaultPaymentMethod != null && $page.props.defaultPaymentMethod.id == paymentMethod.id
                                ? 'text-green-600/80'
                                : 'text-gray-400'}`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                </svg>
                            </button>

                            <template
                                v-if="!($page.props.defaultPaymentMethod != null && $page.props.defaultPaymentMethod.id == paymentMethod.id)">
                                <button
                                    @click="$inertia.delete(route('billings.removepaymentmethod', paymentMethod.id), { preserveScroll: true })"
                                    class="text-red-600/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </button>
                            </template>
                        </div>
                    </li>
                </TransitionGroup>
            </ul>
        </div>
    </section>
</template>

<style scoped>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
</style>
