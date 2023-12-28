<script setup>
import { defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    welcomeListings: Array
})
console.log(props)
</script>

<template>
    <Head title="Welcome" />
    
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
            <div class="flex justify-center">
                <img src="../../img/HERO.png" alt="" class="w-4/6">
            </div>
        </div>
    </div>
</template>