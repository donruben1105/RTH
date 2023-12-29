<script setup>
import { defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    singleListings: Array,
})
</script>

<template>
    <Head title="SingleListing" />
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div canLogin="true" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link :href="route('listing.listing')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Shop</Link>
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

                <Link canRegister="true" :href="route('register')" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
            </template>
        </div>

        <div class="p-6 lg:p-8">

            <div class="">
                <div v-if="props.singleListings">
                    <div class="mt-10">
                        <div
                            class="flex flex-cols p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
                        >
                        <div>
                            <img :src="props.singleListings.files" alt="Listing Image" class="mb-4 w-full h-full object-fit rounded-lg">
                        </div>
                            <div class="relative text-start pl-12">
                                <h2 class="text-4xl item font-semibold text-gray-900 dark:text-white">Name: {{ props.singleListings.name }}</h2>
                                <h2 class="text-4xl item font-semibold text-gray-900 dark:text-white">Price: {{ props.singleListings.price }}</h2>
                                <h2 class="text-4xl item font-semibold text-gray-900 dark:text-white">Size: {{ props.singleListings.size }}</h2>
                                <h2 class="mb-4 text-4xl item font-semibold text-gray-900 dark:text-white">Quantity: {{ props.singleListings.quantity }}</h2>
                                <button class="w-10/12 absolute bottom-0 transition ease-in-out delay-150 hover:-translate-y-1 text-xl font-semibold text-gray-900 dark:text-white border p-2 rounded-lg border-blue-500 hover:bg-blue-500 hover:text-white">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>