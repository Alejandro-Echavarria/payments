<script>
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

export default {
    components: {
        DangerButton,
        SecondaryButton,
    },

    methods: {
        checkResumeSubscription(price) {
            let data = this.$inertia.page.props.subscriptions.find(obj => obj.stripe_price === price && obj.ends_at !== null);
            return data;
        },

        newSubscription(plan) {
            this.$inertia.post(this.route('subscriptions.store'), {
                id: plan,
            }, {
                preserveScroll: true,
                preserveState: true
            });
        },

        resumeSubscription(price) {
            let data = this.$inertia.page.props.subscriptions.find(
                obj => obj.stripe_price === price
                    && (obj.stripe_status === 'active' || obj.stripe_status === 'trialing')
                    && obj.ends_at !== null
            );

            if (data) {
                this.$inertia.put(this.route('subscriptions.resumesubscription'), {
                    name: data.name,
                }, {
                    preserveScroll: true,
                    preserveState: true
                });
            } else {
                alert('No se pudo reanudar la suscripción');
            }
        },

        stripePrice(price) {
            let valor = this.$inertia.page.props.subscriptions.find(
                obj => obj.stripe_price === price
                    && (obj.stripe_status === 'active' || obj.stripe_status === 'trialing')
            );
            return valor;
        },

        cancelSubscription(price) {
            let data = this.$inertia.page.props.subscriptions.find(
                obj => obj.stripe_price === price
                    && (obj.stripe_status === 'active' || obj.stripe_status === 'trialing')
            );

            if (data) {
                this.$inertia.delete(this.route('subscriptions.cancelsubscription', {
                    name: data.name,
                }), {
                    preserveScroll: true,
                    preserveState: true
                });
            } else {
                alert('No se pudo cancelar la suscripción');
            }
        },

        sentAlert(message) {
            alert(message);
        }
    },
}
</script>

<template>
    <section class="overflow-hidden rounded-lg dark:bg-gray-900">
        <div class="py-8 mx-auto max-w-screen-xl lg:py-16">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-700 dark:text-white">Designed for business
                    teams like yours</h2>
                <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets
                    where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
            </div>
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                <!-- Pricing Card -->
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border-2 border-gray-100 dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Starter</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best option for personal use & for
                        your next project.</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$9.99</span>
                        <span class="text-gray-500 dark:text-gray-400">/mensual</span>
                    </div>
                    <!-- List -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Individual configuration</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>No setup, or hidden fees</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Team size: <span class="font-semibold">1 developer</span></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Premium support: <span class="font-semibold">6 months</span></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Free updates: <span class="font-semibold">6 months</span></span>
                        </li>
                    </ul>
                    <template v-if="stripePrice('price_1N3Kk2Kx34527y4IlYk6ESrc')">
                        <div class="flex space-x-2">
                            <p
                                class="w-1/3 text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white">
                                Suscrito
                            </p>
                            <SecondaryButton v-if="checkResumeSubscription('price_1N3Kk2Kx34527y4IlYk6ESrc')"
                                @click="resumeSubscription('price_1N3Kk2Kx34527y4IlYk6ESrc')" class="w-full justify-center">
                                Reanudar
                            </SecondaryButton>
                            <DangerButton v-else @click="cancelSubscription('price_1N3Kk2Kx34527y4IlYk6ESrc')"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900 cursor-pointer">
                                Cancelar
                            </DangerButton>
                        </div>
                    </template>
                    <button v-else @click="newSubscription('price_1N3Kk2Kx34527y4IlYk6ESrc')"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900">
                        Get started
                    </button>
                </div>
                <!-- Pricing Card -->
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border-2 border-gray-100 dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Company</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Relevant for multiple users, extended
                        & premium support.</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$24.99</span>
                        <span class="text-gray-500 dark:text-gray-400" dark:text-gray-400>/trimestral</span>
                    </div>
                    <!-- List -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Individual configuration</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>No setup, or hidden fees</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Team size: <span class="font-semibold">10 developers</span></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Premium support: <span class="font-semibold">24 months</span></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Free updates: <span class="font-semibold">24 months</span></span>
                        </li>
                    </ul>
                    <template v-if="stripePrice('price_1N3Kk2Kx34527y4I0irJD59l')">
                        <div class="flex space-x-2">
                            <p
                                class="w-1/3 text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white">
                                Suscrito
                            </p>
                            <SecondaryButton v-if="checkResumeSubscription('price_1N3Kk2Kx34527y4I0irJD59l')"
                                @click="resumeSubscription('price_1N3Kk2Kx34527y4I0irJD59l')" class="w-full justify-center">
                                Reanudar
                            </SecondaryButton>
                            <DangerButton v-else @click="cancelSubscription('price_1N3Kk2Kx34527y4I0irJD59l')"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900 cursor-pointer">
                                Cancelar
                            </DangerButton>
                        </div>
                    </template>
                    <button v-else @click="newSubscription('price_1N3Kk2Kx34527y4I0irJD59l')"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900">
                        Get started
                    </button>
                </div>
                <!-- Pricing Card -->
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border-2 border-gray-100 dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Enterprise</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best for large scale uses and extended
                        redistribution rights.</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-extrabold">$99.99</span>
                        <span class="text-gray-500 dark:text-gray-400">/anual</span>
                    </div>
                    <!-- List -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Individual configuration</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>No setup, or hidden fees</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Team size: <span class="font-semibold">100+ developers</span></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Premium support: <span class="font-semibold">36 months</span></span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <!-- Icon -->
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>Free updates: <span class="font-semibold">36 months</span></span>
                        </li>
                    </ul>
                    <template v-if="stripePrice('price_1N3Kk2Kx34527y4IwlNRhrz7')">
                        <div class="flex space-x-2">
                            <p
                                class="w-1/3 text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white">
                                Suscrito
                            </p>
                            <SecondaryButton v-if="checkResumeSubscription('price_1N3Kk2Kx34527y4IwlNRhrz7')"
                                @click="resumeSubscription('price_1N3Kk2Kx34527y4IwlNRhrz7')" class="w-full justify-center">
                                Reanudar
                            </SecondaryButton>
                            <DangerButton v-else @click="cancelSubscription('price_1N3Kk2Kx34527y4IwlNRhrz7')"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900 cursor-pointer">
                                Cancelar
                            </DangerButton>
                        </div>
                    </template>
                    <button v-else @click="newSubscription('price_1N3Kk2Kx34527y4IwlNRhrz7')"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900">
                        Get started
                    </button>
                </div>
            </div>
            <div v-if="$page.props.jetstream.flash && $page.props.jetstream.flash.error">
                {{ sentAlert($page.props.jetstream.flash.error.message) }}
            </div>
        </div>
    </section>
</template>

<style lang="">
    
</style>