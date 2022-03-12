<template>
  <Head title="Liste des Approvisionement"/>

  <BreezeAuthenticatedLayout>
    <template #header>

       <div class="flex md:flex-row md:justify-between w-full">
            <p> Liste des Approvisionement </p>
            <p class="ml-2 p-2 bg-green-50 shadow-sm text-lg"> Solde actuel: <span class=" text-green-600">{{numberFormatC(solde)}} CFA</span>   </p>
        </div>

    </template>


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


    <div class="flex mb-4 w-full justify-between">
         <!--div class="flex flex-row w-3/5">
            <div class=" w-44">
                <select v-model="form.trashed" class=" rounded-l py-1 w-full border-r-0">
                    <option :value="null" />
                    <option value="with">All </option>
                    <option value="only">Trashed</option>
                    <option value="1">Avaible</option>
                    <option value="0">Not Avaible</option>
                  </select>
            </div>
            <div class="flex w-full bg-white shadow rounded">
                <input class="relative w-full px-4 py-1 rounded-r -focus:ring border" autocomplete="off" type="text" name="search" placeholder="Rechercher" v-model="form.search"  />
            </div>
                <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500 " type="button" @click="reset()">Effacer</button>
        </div-->
            <Link :href="route('caisse.add_appro',)" active class="block">
                    <span class="flex ml-auto text-white bg-indigo-500 border-0 py-1 px-4 focus:outline-none hover:bg-indigo-600 rounded">Ajouter Appro</span>
            </Link>
    </div>


    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-3 mb-5">
              <div class="w-full overflow-x-auto bg-gray-700 ">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">#</th>
                      <th class="px-4 py-3">Date</th>
                      <th class="px-4 py-3">Montant</th>
                      <th class="px-4 py-3">Source</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400" v-for="demande in appro.data" :key="demande.id_finn">
                      <td class="px-4 py-3">

                            <p class="font-semibold">{{demande.id_finn}}</p>

                      </td>
                      <td class="px-4 py-3 text-sm">

                              {{demande.date_finn}}

                      </td>
                      <td class="px-4 py-3 text-sm">
                          <p class="font-semibold">{{numberFormatC(demande.entre_finn)}} </p>

                      </td>
                      <td class="px-4 py-3 text-sm items-center">
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                              {{demande.source_finn}}
                            </p>


                      </td>

                    </tr>


                  </tbody>
                </table>
              </div>
              <div class="flex flex-row-reverse bg-slate-100 px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                  <pagination :links="appro.links" />
              </div>
            </div>




  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';


/*import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
import mapValues from 'lodash/mapValues';*/

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    Pagination,
    Link,
    StatusBadge
  },
  props:{
    appro:Object,
    card_stat: Object,
    solde: Number,
    //filters: Object,
  },
  data() {
        return {
            modalOpen:false,
           /* form: {
            search: this.filters.search,
            trashed: this.filters.trashed,
          },*/
        };
    },

    /*watch: {
    form: {
      deep: true,
      handler: throttle(function() {
        this.$inertia.get(this.route('caisse.index'), pickBy(this.form), { preserveState: true })
      }, 400),
    }*/

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
