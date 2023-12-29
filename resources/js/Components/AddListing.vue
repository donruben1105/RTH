<script setup>
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'


const form = reactive({
  name: null,
  price: null,
  size: null,
  quantity: null,
  files: [],
})

const resetForm = () => {
    form.name = null
    form.price = null
    form.size = null
    form.quantity = null
    form.files = null
}

const selectedFiles = ref([])

// Add the 'uploadFiles' function to handle multiple file uploads
const uploadFiles = (event) => {
  const fileInput = event.target
  const files = fileInput.files

  if (files && files.length) {
    for (let i = 0; i < files.length; i++) {
      form.files.push(files[i])
      selectedFiles.value.push(URL.createObjectURL(files[i]))
    }
  }

  // Clear the file input value after processing files
  fileInput.value = ''
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
  try {
   router.post('/listing', form, { forceFormData: true });
      resetForm();

      // Show success Toast
      const Toast = configureSwal();
      Toast.fire({
        icon: 'success',
        title: 'Listing submitted successfully',
      });
  } catch (error) {
    // Handle any errors during the submission
    console.error('Error during form submission:', error);
  }
}

</script>
<template>
    <div class="flex">
        <div class="bg-white p-12 lg:mx-auto lg:max-w-full rounded-lg">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <form @submit.prevent="submit">
                    <div class="space-y-4 md:flex md:space-x-4 md:space-y-0">
                        <div class="flex-1">
                            <!-- IMG -->
                            <section class="mb-8 drop-shadow-lg">
                                <div class="mb-1 block text-sm font-medium ">Attachments:</div>
                                <div class="flex items-center gap-4">
                                  <div v-for="(file, index) in selectedFiles" :key="index">
                                    <img :src="file" alt="Uploaded Image" class="mr-5 mt-4 h-32 w-32 border-dashed rounded-full" />
                                  </div>
                    
                                  <div class="rounded border bg-indigo-500 px-3 py-3 text-center hover:bg-indigo-600">
                                    <label for="file" class="block text-sm text-white">Upload Image</label>
                                    <input @change="uploadFiles" ref="fileInput" class="sr-only" id="file" type="file" name="files[]" />
                                  </div>
                                </div>
                              </section>
                        </div>
                    </div>
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