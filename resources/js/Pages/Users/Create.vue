<template>
  <Head title="Mes demandes"/>

  <BreezeAuthenticatedLayout>




       <!-- This example requires Tailwind CSS v2.0+ -->
<div class="lg:flex  lg:w-3/4 lg:items-center lg:justify-between">
  <div class="flex-1 min-w-0">
    <h2 class="text-lg font-bold leading-7 text-gray-900 sm:text-2xl sm:truncate">
        Utilisateurs / Nouveau
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
    <h3 class="text-lg leading-6 font-medium text-gray-900">Information de l'utilisateur</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">Veuillez remplir convenablement le formulaire. </p>
    <div class="mt-4">
           </div>
  </div>
  <div class="border-t border-gray-200">
    <dl>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Email </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput   type="email" v-model="form.email_ui" class="block w-full mt-1"    required  autofocus   />

        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Mot de Passe </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput   type="password" v-model="form.password_ui" class="block w-full mt-1"    required  autofocus   />

        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6 border-b">
        <dt class="text-sm font-medium text-gray-500">Confirmer Mot de passe </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput  id="receveur_pdc" type="password" v-model="form.c_password_ui" class="block w-full mt-1"    required  autofocus   />
             <small v-if="passIsValid" class="text-green-500"> Password is valid</small>
             <small v-else class="text-red-600"> Password is invalid</small>
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <h3 class="font-bold">Information Identification</h3>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Nom d'utilisateur</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput   type="text" v-model="form.nom_p_ui" class="block w-full mt-1"    required  autofocus   />

        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Contact</dt>
        <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput placehoder="+XXX XXX XXX XXX"  type="tel" v-model="form.contact_ui" class="block w-full mt-1"    required   />

        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Intitulé du poste</dt>
        <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput type="text" v-model="form.poste_ui" class="block w-full mt-1"  required   />
        </dd>
      </div>

      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Autres Infos</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
              <div class="w-0 flex-1 flex items-center">

                <span class="ml-2 flex-1 w-0 truncate"> Role </span>
              </div>
              <div class="ml-4 flex-shrink-0">
                 <select v-model="form.level_ui" class=" text-sm px-2  border border-gray-300 rounded-md shadow-sm  focus:border-indigo-400  focus:ring-1 focus:ring-indigo-400 focus:ring-opacity-50 focus-within:text-indigo-900 p-1">
                        <option :value="null">Choisissez Votre Manager &nbsp;&nbsp;&nbsp;&nbsp;</option>
                        <option v-for="manager in managers " :key="manager.value" :value="manager.value">{{manager.label}}</option>
                    </select>
              </div>
            </li>

            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
              <div class="w-0 flex-1 flex items-center">
                <span class="ml-2 flex-1 w-0 truncate"> Permission</span>
              </div>
              <div class="ml-3 flex-shrink-0 ">

                <div class="flex items-center" v-for="(item,val,index) in permissions" :key="index">
                    <input v-model="form.permissions[val]" :id="'key-'+index" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label :for="'key-'+index" class="ml-2 text-sm font-medium"> {{ val }}</label>
                </div>

              </div>
            </li>
          </ul>
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
              Créer Utilisateur
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
import Pagination from '@/Components/Pagination.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeButton from '@/Components/Button.vue';

import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const permissions = {"caisse":"false","can_pay":"false","can_delete_pay":"false","validation":"false","can_validate":"false","user":"false","permissions":"false","systeme":"false"}

 const form = useForm({

          login_ui: null,
          password_ui: null,
          c_password_ui: null,
          email_ui: null,
          level_ui: null,
          // group_ui: null,
          nom_p_ui: null,
          poste_ui: null,
          contact_ui: null,
          permissions: permissions,
 })

const props = defineProps({
    services:Object,
  });


const managers = [
    { value: 10, label: 'Demandeur' },
    { value: 20, label: 'Manager' },
    { value: 30, label: 'Caissier' },
    { value: 40, label: 'Validateur' },
    { value: 45, label: 'Administrateur' },
    { value: 50, label: 'Super Admin' },
]
const submit = () => {
    form.login_ui = form.email_ui
    form.post(route('users.store'), {
        onFinish: () => form.reset('password_ui'),
    })
};

const passIsValid = computed (() => {
 if(!form.c_password_ui || !form.password_ui ) {
    return false
 }
  return (form.c_password_ui.length > 7 && (form.password_ui == form.c_password_ui ))
})

const clearForm = () => {
    form.email_ui = null;
    form.password_ui = null;
    form.c_password_ui = null;
}

</script>
