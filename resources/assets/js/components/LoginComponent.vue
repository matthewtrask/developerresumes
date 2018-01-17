<style lang='scss' scoped>
    .flex-col {
        margin-right: auto;
        margin-left: auto;
    }
</style>
<template>
    <div>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col pin-x w-2/3">
            <div class="mb-4">
                <h2 class="font-sans tracking-wide">Developer Resumes</h2>
                <h4 class="font-sans tracking-wide">Login</h4>
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                    Username <i v-if="success === true" class="fa fa-check text-green-dark"></i>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="username" type="text" placeholder="Username" v-model="username">
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Password <i v-if="success === true" class="fa fa-check text-green-dark"></i>
                </label>
                <input v-bind:class="{ error: formError }" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" type="password" placeholder="******************" v-model="password">
                <p v-if="formError === true" class="text-red text-xs italic">Please choose a password.</p>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="button" @click.prevent="register">
                    Register
                </button>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../auth.js';

  export default {

    data() {
      return {
        username: '',
        password: '',
        confirmPassword: '',
        termsOfService: false,
        codeOfConduct: false,
        success: false,
        formError: false,
        showConductError: false,
        showTermsError: false,
        formSuccess: false,
      };
    },

    methods: {
      register() {
        this.codeOfConductCheck();
        this.termsOfServiceCheck();

        if (this.password !== this.confirmPassword) {
          this.formError = true;

          setTimeout(() => {
            this.formError = false;
          }, 5000);

          return;
        }

        this.success = true;

        setTimeout(() => {
          auth.register(this, this.username, this.password);
        }, 5000);

      },

      codeOfConductCheck() {
        if (this.codeOfConduct === false) {
          this.showConductError = true;

          setTimeout(() => {
            this.showConductError = false;
          }, 5000);

          return;
        }
      },

      termsOfServiceCheck(){
        if (this.termsOfService === false) {
          this.showTermsError = true;

          setTimeout(() => {
            this.showTermsError = false;
          }, 5000);

          return;
        }
      }
    }
  };
</script>