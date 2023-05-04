<script>
export default {
    methods: {
        formatDate(timestamp) {
            const date = new Date(timestamp * 1000)
            return date.toLocaleString()
        },

        formatCurrency(amount) {
            const doubleValue = amount / 100; // Dividir el valor entre 100 para convertirlo a un valor decimal
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            });
            return formatter.format(doubleValue);
        }
    },

    props: {
        invoices: {
            type: Object,
        }
    }
}
</script>

<template>
    <section class="bg-white overflow-hidden rounded-lg">
        <div class="relative overflow-x-auto sm:rounded-lg">
            <h3 class="px-6 py-4 space-y-3 text-gray-700 text-lg font-bold">Invoices</h3>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400 border-y-2">
                    <tr>
                        <th scope="col" class="w-1/2 px-6 py-3">
                            Invoice date
                        </th>
                        <th scope="col" class="w-1/4 px-6 py-3">
                            Total
                        </th>
                        <th scope="col" class="w-1/4 px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="invoices.length > 0" v-for="invoice in invoices"
                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ formatDate(invoice.created) }}
                        </th>
                        <td class="px-6 py-4">
                            {{ formatCurrency(invoice.total) }}
                        </td>
                        <td class="px-6 py-4">
                            <a :href="`/user/invoice/${invoice.id}`" class="font-medium text-blue-600 dark:text-blue-500">
                                Download
                            </a>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="3" class="px-6 py-4 text-center">No invoices yet</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<style scoped></style>