<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3'

const props = defineProps(['listings']);

const form = useForm({
    id: props.listings.id,
})

</script>

<template>

    <Head title="Listing" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listing</h2>
        </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">Here are your posted items, {{ $page.props.auth.user.name }}!</div>
                        
                    </div>
                </div>
            </div>

            <div class="pb-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
                              <tr>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                  <div class="flex items-center"></div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                  <div class="font-semibold text-left">name</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                  <div class="font-semibold text-left">price</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                  <div class="font-semibold text-left">size</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                  <div class="font-semibold text-left">quantity</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                  <div class="font-semibold text-left pl-20">Action</div>
                                </th>
                              </tr>
                            </thead>
                    
                        <tbody>
                            <!-- Table rows -->
                            <tr v-for="listing in props.listings" :key="listing.id">
                              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                <div class="flex items-center"></div>
                              </td>
                              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                  <div class="font-medium text-slate-800">{{ listing.name }}</div>
                                </div>
                              </td>
                              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="text-left">{{ listing.price}}</div>
                              </td>
                              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="text-left">{{ listing.size }}</div>
                              </td>
                              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="text-left">{{ listing.quantity }}</div>
                              </td>
                              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <button class="p-6 text-blue-500 hover:text-blue-600 hover:underline">
                                  <Link :href="`/edit/listing/${listing.id}`">Update</Link>
                                </button>
                                <button class="p-6 text-red-500 hover:text-red-600 hover:underline">
                                  <button @click="form.delete(`/listing/${listing.id}`)">Delete</button>
                                </button>
                              </td>
                              
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </AuthenticatedLayout>
</template>
