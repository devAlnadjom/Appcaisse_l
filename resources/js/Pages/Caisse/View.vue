<template>
  <Head title="Paiement dune peice"/>

  <BreezeAuthenticatedLayout>




       <!-- This example requires Tailwind CSS v2.0+ -->
<div class="lg:flex  lg:w-3/4 lg:items-center lg:justify-between">
  <div class="flex-1 min-w-0">
    <h2 class="text-lg font-bold leading-7 text-gray-900 sm:text-2xl sm:truncate">Paiement PDC - {{ demande.id_pdc}}</h2>

  </div>
  <div class="mt-5 flex lg:mt-0 lg:ml-4">
    <span class="hidden sm:block">
      <button  type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <!-- Heroicon name: solid/pencil -->
        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
        Solde Actuel
      </button>
    </span>

    <span class="hidden sm:block ml-3">
      <button v-if="($page.props.auth.level >=20) && ($page.props.auth.user.users_in_id==demande.team_l) && (5==demande?.etat_valide_pdc)"
          @click="authorize()"
          type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <!-- Heroicon name: solid/link -->
        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        Retour
      </button>
    </span>

    <span class="sm:ml-3">
      <button
      @click="reject()"
      v-if="(demande.etat_valide_pdc ==1 || demande.etat_valide_pdc ==5 || demande.etat_valide_pdc ==2) && ($page.props.auth?.level >=20 )"
      type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
        <!-- Heroicon name: solid/check -->

        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 20 20" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Rejeter
      </button>
    </span>



    <span class="hidden sm:block ml-3">
      <button v-if="(demande.etat_valide_pdc ==2) && ( $page.props.auth.permission?.can_pay=='true')"
      type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <!-- Heroicon name: solid/link -->
        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        Payer
      </button>
    </span>

  </div>
</div>

<div class="lg:w-1/2 mt-5">
    <div v-show="$page.props.flash.success"
           class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-center w-12 bg-green-500">
          <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
            </path>
          </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
          <div class="mx-3">
            <span class="font-semibold text-green-500">Success</span>
            <p class="text-sm text-gray-600">{{ $page.props.flash.success }}</p>
          </div>
        </div>
      </div>
    </div>

    <div>
        <BreezeValidationErrors class="mt-3"/>
    </div>

    <div class="flex lg:flex-row gap-4">

            <div class="w-full lg:w-2/5 overflow-hidden rounded-lg shadow-xs mt-10 mb-5">
            <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Information Sur la PDC- {{ demande.id_pdc}} </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Demande du {{ demande.date_cr_pdc}}</p>
    </div>
    <div class="border-t border-gray-200">
        <dl>
        <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Nom du Receveur</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ demande.receveur_pdc}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t">
            <dt class="text-sm font-medium text-gray-500">Montant</dt>
            <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">{{numberFormatC( demande.montant_pdc)}} </dd>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t">
            <dt class="text-sm font-medium text-gray-500">Reste A Payer</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{numberFormatC( demande.id_restapayer_pdc)}} </dd>
        </div>

        <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t">
            <dt class="text-sm font-medium text-gray-500">Description</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ demande.concept_pdc}}</dd>
        </div>


        <div class="bg-gray-50 px-4 py-3  sm:gap-4 sm:px-6 border-t">

            <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center">
                    <!-- Heroicon name: solid/paper-clip -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 flex-1 w-0 truncate"> Demande Par </span>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> {{ demande.account?.nom_p_ui}} </a>
                </div>
                </li>
                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center">
                    <!-- Heroicon name: solid/paper-clip -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 flex-1 w-0 truncate"> Projet Rataché </span>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> {{ demande.projet.libelle_projet}} </a>
                </div>
                </li>
                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center">
                    <!-- Heroicon name: solid/paper-clip -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 flex-1 w-0 truncate"> Service Rataché</span>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> {{ demande.service?.libelle_ser}}</a>
                </div>
                </li>
                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center">
                    <!-- Heroicon name: solid/paper-clip -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 flex-1 w-0 truncate"> Bon de Commande  </span>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-800"> {{ demande.bcomande?.numero_bc}} </a>
                </div>
                </li>
            </ul>

        </div>
        </dl>
    </div>
    </div>


        </div>




        <div class="w-full lg:flex-1 overflow-hidden rounded-lg border shadow-xs mt-10 mb-10">
        <!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <form @submit.prevent="submit">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg leading-6 font-medium text-gray-900">Information Sur la PDC</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">Veuillez remplir convenablement le formulaire. </p>

  </div>
  <div class="border-t border-gray-200">
    <dl>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Receveur</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput  id="receveur_pdc" type="text" v-model="form.source_finn" class="block w-full mt-1"    required  autofocus   />

        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t">
        <dt class="text-sm font-medium text-gray-500">Montant</dt>
        <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">
             <BreezeInput   id="montant_pdc" type="number" v-model="form.sortie_finn" class="block w-full mt-1"    required  autofocus   />

        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t">
        <dt class="text-sm font-medium text-gray-500">Description</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
             <textarea
                class="mt-1 border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:border-indigo-400 focus:ring-1 focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-indigo-900 w-full"
                 id="concept_pdc" v-model="form.libelle_finn" rows="5">
                 </textarea>
        </dd>
      </div>



      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t">
        <dt class="text-sm font-medium text-gray-500">Autres Infos</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

            <li  class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">

              <div class=" flex-shrink-0">
                 <select v-model="form.code_cdc_finn" class="  px-3  border border-gray-300 rounded-md shadow-sm  focus:border-indigo-400  focus:ring-1 focus:ring-indigo-400 focus:ring-opacity-50 focus-within:text-indigo-900 p-1">
                        <option :value="null">Choisissez le centre de cout &nbsp;&nbsp;&nbsp;&nbsp;</option>
                        <option v-for="ligne in cdc " :key="ligne.code_cdc" :value="ligne.code_cdc">{{ligne.libelle_cdc}}</option>
                    </select>
              </div>
            </li>


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
              Payer
            </BreezeButton>
          </div>
        </dd>
      </div>
    </dl>
  </div>

    </form>
    </div>


    </div>


    </div>






  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeInput from '@/Components/Input.vue';
import BreezeButton from '@/Components/Button.vue';

import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    Pagination,
    Link, StatusBadge,BreezeValidationErrors, BreezeButton,BreezeInput
  },
  props:{
    demande:Object,
    solde:Number,
    cdc: Object,
  },
  data(){
      return{
      form: useForm({
            libelle_finn : this.demande.concept_pdc,
            source_finn : this.demande.receveur_pdc,
            sortie_finn : this.demande.id_restapayer_pdc,
            data2_finn : this.demande.id_pdc,
            cod_proj_finn : this.demande.projet?.id_projet,
            code_cdc_finn : null,
            code_service_finn : this.demande.service?.cod_ser
      }),
  }
  },
  mounted(){

  },
  methods:{
       numberFormatC(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },

    submit()
    {
        if(confirm("Etes vous sur de vouloir payer cette pièce?"))
        this.form.post(route("caisse.payer"));
    },
    authorize()
    {
        if(confirm("Voulez approuver cette piece de caisse?"))
        this.$inertia.post(route("approbation.authorize",this.demande.id_pdc));
    },
    reject()
    {
        if(confirm("Voulez rejeter cette piece de caisse?"))
        this.$inertia.post(route("approbation.reject",this.demande.id_pdc));
    },
    archive()
    {
        if(confirm("Voulez archiver cette piece de caisse?"))
        this.$inertia.post(route("approbation.archive",this.demande.id_pdc));
    },
  }

};




</script>
