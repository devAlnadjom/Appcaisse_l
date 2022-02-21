<template>
  <Head title="Mes demandes"/>

  <BreezeAuthenticatedLayout>




       <!-- This example requires Tailwind CSS v2.0+ -->
<div class="lg:flex  lg:w-3/4 lg:items-center lg:justify-between">
  <div class="flex-1 min-w-0">
    <h2 class="text-lg font-bold leading-7 text-gray-900 sm:text-2xl sm:truncate">Nouvelle demande </h2>

  </div>
  <div class="mt-5 flex lg:mt-0 lg:ml-4">


    <span class="sm:ml-3">
      <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <!-- Heroicon name: solid/check -->
        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        Retour
      </button>
    </span>


  </div>
</div>


    <div>
        <BreezeValidationErrors class="mt-3"/>
    </div>

    <div class="w-full lg:w-3/4 overflow-hidden rounded-lg border shadow-xs mt-10 mb-10">
        <!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <form @submit.prevent="submit">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg leading-6 font-medium text-gray-900">Information Sur la PDC</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">Veuillez remplir convenablement le formulaire. </p>
    <div class="mt-4">
           </div>
  </div>
  <div class="border-t border-gray-200">
    <dl>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Nom du Receveur</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput  id="receveur_pdc" type="text" v-model="form.receveur_pdc" class="block w-full mt-1"    required  autofocus   />

        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Montant</dt>
        <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput   id="montant_pdc" type="number" v-model="form.montant_pdc" class="block w-full mt-1"    required  autofocus   />

        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Description</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <textarea
                class="mt-1 border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:border-indigo-400 focus:ring-1 focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-indigo-900 w-full"
                 id="concept_pdc" v-model="form.concept_pdc" rows="5">
                 </textarea>
        </dd>
      </div>



      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Autres Infos</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
            <li v-if="!isManager" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
              <div class="w-0 flex-1 flex items-center">

                <span class="ml-2 flex-1 w-0 truncate"> Manager </span>
              </div>
              <div class="ml-4 flex-shrink-0">
                 <select v-model="form.team_l" class=" text-sm px-2  border border-gray-300 rounded-md shadow-sm  focus:border-indigo-400  focus:ring-1 focus:ring-indigo-400 focus:ring-opacity-50 focus-within:text-indigo-900 p-1">
                        <option :value="null">Choisissez Votre Manager &nbsp;&nbsp;&nbsp;&nbsp;</option>
                        <option v-for="manager in managers " :key="manager.id_ui" :value="manager.id_ui">{{manager.nom_p_ui}}</option>
                    </select>
              </div>
            </li>
            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
              <div class="w-0 flex-1 flex items-center">

                <span class="ml-2 flex-1 w-0 truncate"> Projet Rataché </span>
              </div>
              <div class="ml-4 flex-shrink-0">
                 <select v-model="form.projet_pdc" class="text-sm px-2  border border-gray-300 rounded-md shadow-sm  focus:border-indigo-400  focus:ring-1 focus:ring-indigo-400 focus:ring-opacity-50 focus-within:text-indigo-900 p-1">
                        <option :value="null">Choisir un Projet</option>
                        <option v-for="projet in projets " :key="projet.id_projet" :value="projet.id_projet">{{projet.libelle_projet}}</option>
                    </select>
              </div>
            </li>
            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
              <div class="w-0 flex-1 flex items-center">
                <span class="ml-2 flex-1 w-0 truncate"> Service Rataché</span>
              </div>
              <div class="ml-3 flex-shrink-0 ">

                    <select v-model="form.code_service_pdc" class="text-sm px-2  border border-gray-300 rounded-md shadow-sm  focus:border-indigo-400  focus:ring-1 focus:ring-indigo-400 focus:ring-opacity-50 focus-within:text-indigo-900 p-1">
                        <option :value="null">Choisir un Service</option>
                        <option v-for="service in services " :key="service.cod_ser" :value="service.cod_ser">{{service.libelle_ser}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                    </select>

              </div>
            </li>
            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
              <div class="w-0 flex-1 flex items-center">

                <span class="ml-2 flex-1 w-0 truncate"> Bon de Commande  </span>
              </div>
              <div class="ml-4 flex-shrink-0">
                 <select v-model="form.data3_pdc" class=" text-sm px-2 border border-gray-300 rounded-md shadow-sm  focus:border-indigo-400  focus:ring-1 focus:ring-indigo-400 focus:ring-opacity-50 focus-within:text-indigo-900 p-1">
                        <option :value="0">Choisir un Bon</option>
                        <option v-for="commande in commandes " :key="commande.id_bc" :value="commande.id_bc">{{commande.numero_bc +" - "+commande.nom_cli_bc}}</option>
                    </select>
                    <p class="text-xs text text-indigo-700 mt-2"> Ne Choisissez que si vous êtes sur.</p>
              </div>
            </li>
          </ul>
        </dd>
      </div>
      <div class="bg-white border-t px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500"></dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <div class="flex items-center justify-end mt-4">
            <Link

                :href="route('password.request')"
                class="text-sm text-gray-600 underline  hover:text-gray-900"
            >
              Effacer
            </Link>

            <BreezeButton
                class="ml-8" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"  >
              Soummetre la Demande
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

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeButton from '@/Components/Button.vue';

import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    Pagination,
    Link, StatusBadge,
     BreezeInput,BreezeButton,BreezeValidationErrors
  },
  data(){
      return{
      form: useForm({
          receveur_pdc:"",
          montant_pdc:0,
          concept_pdc:"",
          code_service_pdc:null,
          team_l:0,
          projet_pdc:null,
          data3_pdc:0,
      }),
  }
  },
  props:{
    services:Object,
    projets:Object,
    commandes:Object,
    managers:Object,
    isManager:Boolean,
  },
  mounted(){

  },
  methods:{
      submit() {
      this.form.post(this.route('demandes.store'), {
        onFinish: () => this.form.reset('password'),
      });
    },

  }

};




</script>
