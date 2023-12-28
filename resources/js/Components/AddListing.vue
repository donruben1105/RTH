<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'


const form = reactive({
  name: null,
  price: null,
  size: null,
  quantity: null,
})

const resetForm = () => {
    form.name = null
    form.price = null
    form.size = null
    form.quantity = null
}

const configureSwal = () => {
    return Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
};

function submit() {
    router.post('/listing', form, {
        onSuccess: () => {
            // Reset the form fields
            resetForm();

            // Show success Toast
            const Toast = configureSwal();
            Toast.fire({
                icon: 'success',
                title: 'Listing submitted successfully',
            });
        },
    });
}
</script>
<template>
    <div class="flex">
        <div class="bg-white p-12 lg:mx-auto lg:max-w-full rounded-lg">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <form @submit.prevent="submit">
                    <div class="space-y-4 md:flex md:space-x-4 md:space-y-0">
                        <div class="flex-1">
                            <label class="mb-1 block text-sm font-medium" for="name">name:</label>
                            <input class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-1 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" id="name" v-model="form.name" />
                        </div>
                        <div class="flex-1">    
                            <label class="mb-1 block text-sm font-medium" for="price">price:</label>
                            <input class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-1 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" id="price" v-model="form.price" />
                        </div>
                    </div>
                    <div class="space-y-4 md:flex md:space-x-4 md:space-y-0">
                        <div class="flex-1">
                            <label class="mb-1 block text-sm font-medium" for="size">size:</label>
                            <input class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-1 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" id="size" v-model="form.size" />
                        </div>
                        <div class="flex-1">
                            <label class="mb-1 block text-sm font-medium" for="quantity">quantity:</label>
                            <input class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-1 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" id="quantity" v-model="form.quantity" />
                        </div>
                    </div>
                    <div class="pt-5 flex flex-col">
                        <button class="rounded-lg border bg-indigo-500 px-3 py-3 text-center text-white hover:bg-indigo-600" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>