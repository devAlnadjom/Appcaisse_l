<template>
  <Head title="Utilisateur"/>

  <BreezeAuthenticatedLayout>
  <template #header>

    <div class="md:flex md:justify-between">
        <h3>Services / Liste</h3>
        <span class="sm:ml-3">
            <Link :href="route('services.create')"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <!-- Heroicon name: solid/check -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
                Nouveau
            </link>
        </span>
    </div>
  </template>


    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
          <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
            <th class="px-4 py-3">Code</th>
            <th class="px-4 py-3">Libelle</th>
            <th class="px-4 py-3">Statuts</th>
            <!--th class="px-4 py-3"></th-->
          </tr>
          </thead>
          <tbody class="bg-white divide-y">
            <tr v-for="service in services.data" :key="service.cod_ser" class="text-gray-700">
                <td class="px-4 py-3 text-sm">
                    <h4 class="font-semibold"> {{ service.cod_ser }} </h4>
                </td>
                <td class="px-4 py-3 text-sm">
                {{ service.libelle_ser }}
                </td>
                <td class="px-4 py-3 text-sm">
                  <span v-if="service?.data1_ser == 1" class="p-1 px-2 rounded bg-green-100 text-green-600"> Actif </span>
                  <span v-else class="p-1 bg-red-100 text-red-600 rounded"> Inactif </span>
                </td>
                <!--td class="px-4 py-3 text-sm">
                    <Link :href="route('services.edit',service.cod_ser)" class="text-sm text-green-500 hover:text-green-700">
                        Details
                    </Link>
                </td-->
            </tr>
          </tbody>
        </table>
      </div>
      <div
          class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
        <pagination v-if="services?.links" :links="services.links" />
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

  const props = defineProps({
    services: Object,
  })
</script>
