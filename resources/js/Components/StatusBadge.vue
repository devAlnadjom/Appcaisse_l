<template>

     <span v-if="status==1" class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:bg-green-700 dark:text-green-100">
        A Valider
    </span>
    <span v-if="status==2" class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
    A Payer
    </span>
    <span v-if="status==5" class="px-2 py-1 font-semibold leading-tight text-orange-600 bg-yellow-100 rounded-full dark:bg-green-700 dark:text-green-100">
    A Authoriser
    </span>
    <span v-if="status==3" class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-green-100">
    Payée
    </span>
    <span v-if="status==0" class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
    Rejeté
    </span>
</template>

<script>
export default {
    props: ["status"],
};
</script>
