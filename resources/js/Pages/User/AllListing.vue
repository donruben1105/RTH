<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Listing from '@/components/Listing.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps, onMounted } from 'vue';

const props = defineProps(['listings']);

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
                              
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </AuthenticatedLayout>
</template>
