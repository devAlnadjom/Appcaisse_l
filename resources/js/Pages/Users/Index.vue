<template>
  <Head title="Utilisateur"/>

  <BreezeAuthenticatedLayout>
  <template #header>

    <div class="md:flex md:justify-between">
        <h3>Utlisateurs / Liste</h3>
        <span class="sm:ml-3">
            <Link :href="route('users.create')"
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
            <th class="px-4 py-3">Nom </th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Poste</th>
            <th class="px-4 py-3"></th>
          </tr>
          </thead>
          <tbody class="bg-white divide-y">
            <tr v-for="user in users.data" :key="user.id" class="text-gray-700">
                <td class="px-4 py-3 text-sm">
                    <h4 class="font-semibold"> {{ user.name }} </h4>
                </td>
                <td class="px-4 py-3 text-sm">
                {{ user.email }}
                </td>
                <td class="px-4 py-3 text-sm">
                  {{ user?.account?.poste_ui }}
                </td>
                <td class="px-4 py-3 text-sm">
                    <Link :href="route('users.edit',user.id)" class="text-sm text-green-500 hover:text-green-700">
                        Details
                    </Link>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div
          class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
        <pagination :links="users.links" />
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

  const props = defineProps({
    users: Object,
  })
</script>
