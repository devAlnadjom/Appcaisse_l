<template>
  <input
      class="mt-1 border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:border-indigo-400 focus:ring-1 focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-indigo-900"
      :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"/>
</template>

<script>
export default {
  props: ["modelValue"],

  emits: ["update:modelValue"],

  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
};
</script>
