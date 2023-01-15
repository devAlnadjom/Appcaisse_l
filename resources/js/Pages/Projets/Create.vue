<template>
  <Head title="Mes demandes"/>

  <BreezeAuthenticatedLayout>




       <!-- This example requires Tailwind CSS v2.0+ -->
<div class="lg:flex  lg:w-3/4 lg:items-center lg:justify-between">
  <div class="flex-1 min-w-0">
    <h2 class="text-lg font-bold leading-7 text-gray-900 sm:text-2xl sm:truncate">
        Projet / Nouveau
    </h2>

  </div>
  <!--div class="mt-5 flex lg:mt-0 lg:ml-4">

    <span class="sm:ml-3">
      <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        Retour
      </button>
    </span>


  </div-->
</div>


    <div>
        <BreezeValidationErrors class="mt-3"/>
    </div>

    <div class="w-full lg:w-3/4 overflow-hidden rounded-lg border shadow-xs mt-10 mb-10">
        <!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <form @submit.prevent="submit">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg leading-6 font-medium text-gray-900">Information du Projet</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">Veuillez remplir convenablement le formulaire. </p>
    <div class="mt-4">
           </div>
  </div>
  <div class="border-t border-gray-200">
    <dl>

      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Libellé </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput type="text" v-model="form.libelle_projet" class="block w-full mt-1" required  autofocus   />

        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Description </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <textarea
                class="mt-1 border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:border-indigo-400 focus:ring-1 focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-indigo-900 w-full"
                id="concept_pdc" v-model="form.data_projet"
                placeholder="Description"
                rows="5">
            </textarea>
        </dd>
      </div>

      <div class="bg-white border-t px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500"></dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <div class="flex items-center justify-end mt-4">
            <span
                @click="clearForm"
                class="text-sm text-gray-600 underline  hover:text-gray-900 cursor-pointer"
            >
              Effacer
            </span>

            <BreezeButton
                class="ml-8" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"  >
              Créer Services
            </BreezeButton>
          </div>
        </dd>
      </div>
    </dl>
  </div>

    </form>
    </div>


    </div>

  </BreezeAuthenticatedLayout>
</template>

<script setup>

import { computed } from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeButton from '@/Components/Button.vue';

import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

 const form = useForm({
          data_projet: null,
          libelle_projet: null,
 })

const props = defineProps({
    projets:Object,
  });

const submit = () => {

    form.post(route('projets.store'), {
        onFinish: () => form.reset('libelle_projet'),
    })
};


const clearForm = () => {
    form.libelle_projet = null;
}

</script>
