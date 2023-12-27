<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdateListing from '@/Components/UpdateListing.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="UpdateListing" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Update Listing</h2>
        </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">Update listing, {{ $page.props.auth.user.name }}!</div>
                        <button class="p-6 text-gray-900 hover:text-blue-600 hover:underline">
                            <Link :href="route('listing.index')">Check all listings</Link>
                        </button>
                    </div>
                </div>
            </div>
            <UpdateListing :listings="$page.props.listings" />

    </AuthenticatedLayout>
</template>
