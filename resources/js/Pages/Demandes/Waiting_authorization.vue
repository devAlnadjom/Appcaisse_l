<template>
  <Head title="Mes demandes"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      Mes demandes
    </template>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4 mb-5">
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Users
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    4
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Caisse
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    CFA 105.000
                  </p>
                </div>
              </div>


    </div>

    <div class="flex gap-4">
        <div class="w-1/2 p-4 bg-white border rounded">
        Filter
        </div>
        <div class="flex-1 p-4 bg-white border rounded">
            Ajouter
        </div>

    </div>


    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-10 mb-5">
              <div class="w-full overflow-x-auto bg-gray-700 ">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">#</th>
                      <th class="px-4 py-3">Receveur</th>
                      <th class="px-4 py-3">Montant</th>
                      <th class="px-4 py-3">Infos</th>
                      <th class="px-4 py-3">Action</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400" v-for="demande in demandes.data" :key="demande.id_ui">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy">
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                          </div>
                          <div>
                            <p class="font-semibold">{{demande.id_pdc}}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                              {{demande.date_cr_pdc}}
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{demande.receveur_pdc}}

                      </td>
                      <td class="px-4 py-3 text-sm">
                          <p class="font-semibold">{{numberFormatC( demande.montant_pdc)}} </p>

                      </td>
                      <td class="px-4 py-3 text-sm items-center">
                        <div>
                            <p class="font-semibold">{{demande.receveur_pdc}} </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                              {{demande.service?.libelle_ser}}
                            </p>
                          </div>
                           <p class="text-xs mt-2">
                                <status-badge :status="demande.etat_valide_pdc" />
                            </p>
                      </td>
                      <td class="px-4 py-3 ">

                        <div class="flex gap-2">
                            <Link :href="route('demandes.show',demande.id_pdc)" class="text-sm text-green-500 hover:text-green-700"> Details</Link>
                            |
                            <Link :href="route('demandes.show',demande.id_pdc)" class="text-sm text-gray-500 hover:text-gray-700"> Archiver</Link>

                        </div>
                      </td>
                    </tr>


                  </tbody>
                </table>
              </div>
              <div class="flex flex-row-reverse bg-slate-100 px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                  <pagination :links="demandes.links" />
              </div>
            </div>




  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    Pagination,
    Link,
    StatusBadge
  },
  props:{
    demandes:Object,
    card_stat: Object,
  },
  mounted(){
    lineConfig.data.datasets[0].data.push(31);
    lineConfig.data.datasets[1].data.push(120);
    lineConfig.data.labels.push("August");
    /*const lineCtx = document.getElementById('line');
    window.myLine = new Chart(lineCtx, lineConfig);
    const pieCtx = document.getElementById('pie')
    window.myPie = new Chart(pieCtx, pieConfig)*/

  },
  methods:{
       numberFormatC(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
  }

};

const lineConfig = {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Organic',

        backgroundColor: '#0694a2',
        borderColor: '#0694a2',
        data: [43, 48, 40, 54, 67, 73, 70],
        fill: false,
      },
      {
        label: 'Paid',
        fill: false,
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: '#7e3af2',
        borderColor: '#7e3af2',
        data: [24, 50, 64, 74, 52, 51, 65],
      },
    ],
  },
  options: {
    responsive: true,
    /**
     * Default legends are ugly and impossible to style.
     * See examples in charts.html to add your own legends
     *  */
    legend: {
      display: false,
    },
    tooltips: {
      mode: 'index',
      intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true,
    },
    scales: {
      x: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Month',
        },
      },
      y: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Value',
        },
      },
    },
  },
}

const pieConfig = {
  type: 'doughnut',
  data: {
    datasets: [
      {
        data: [33, 33, 33],
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: ['#0694a2', '#1c64f2', '#7e3af2'],
        label: 'Pieces de Caisses',
      },
    ],
    labels: ['Awaiting Appro', 'Awaiting Pyment', 'Paid'],
  },
  options: {
    responsive: true,
    cutoutPercentage: 80,
    /**
     * Default legends are ugly and impossible to style.
     * See examples in charts.html to add your own legends
     *  */
    legend: {
      display: false,
    },
  },
}


</script>
