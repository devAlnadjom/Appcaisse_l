<template>
  <Head title="A Propos"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      A Propos
    </template>

    <div class="p-4 bg-white rounded-lg shadow-xs">
      Conçu par <span class="font-semibold text-purple-600">@alnadjom</span> <br/>

    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
  },
};
</script>
