<script setup>
import { defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    welcomeListings: Array
})
console.log(props)
</script>

<template>
    <Head title="HomeListing" />
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div canLogin="true" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

                <Link canRegister="true" :href="route('register')" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
            </template>
        </div>

        <div class="p-6 lg:p-8">
            <div class="flex justify-center">
                <img src="../../img/HERO.png" alt="" class="w-4/6">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8">
                <div v-for="welcomeListing in props.welcomeListings" :key="welcomeListing.id">
                    <div class="mt-10">
                        
                            <div
                                class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
                            >
                                <div class="text-center">
                                    <h2 class="text-xl item font-semibold text-gray-900 dark:text-white">Name: {{ welcomeListing.name}}</h2>
                                    <h2 class="text-xl item font-semibold text-gray-900 dark:text-white">Price: {{ welcomeListing.price}}</h2>
                                    <h2 class="text-xl item font-semibold text-gray-900 dark:text-white">Size: {{ welcomeListing.size}}</h2>
                                    <h2 class="text-xl item font-semibold text-gray-900 dark:text-white">Quantity: {{ welcomeListing.quantity}}</h2>
                                </div>
                            </div>
        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>