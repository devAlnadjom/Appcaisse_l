<template>
  <Head title="Reinitialiser le compte"/>

  <div class="flex flex-col overflow-y-auto md:flex-row">
    <div class="h-32 md:h-auto md:w-1/2">
      <img
          aria-hidden="true"
          class="object-cover w-full h-full"
          src="/images/forgot-password-office.jpeg"
          alt="Office"
      />
    </div>
    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
      <div class="w-full">
        <h1 class="mb-4 font-semibold text-gray-700">
          Mot de passe oublié? Ne vous en faites pas, saisissez juste votre adresse mail et nous vous
          enverrons un mail de reinitialisation.
        </h1>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
          {{ status }}
        </div>

        <BreezeValidationErrors class="mb-4"/>

        <form @submit.prevent="submit">
          <div>
            <BreezeLabel for="email" value="Email"/>
            <BreezeInput
                id="email"
                type="email"
                class="block w-full mt-1"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
            />
          </div>

          <div class="flex items-center justify-between mt-4">
            <Link
                :href="route('login')"
                class="text-sm text-gray-600 underline  hover:text-gray-900"
            >
                J'ai deja un compte?
            </Link>
            <BreezeButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
              Envoyer le lien
            </BreezeButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import BreezeButton from "@/Components/Button.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    Head,
    Link,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.email"));
    },
  },
};
</script>
