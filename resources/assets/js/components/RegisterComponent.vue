<style lang='scss' scoped>
    .flex-col {
        margin-right: auto;
        margin-left: auto;
    }
</style>
<template>
    <div>
        <dr-header :user="user"></dr-header>
        <div class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4 flex flex-col pin-x w-2/3">

            <div class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 rounded relative" role="alert" v-if="showConductError === true">
                <strong class="font-bold tracking-wide">In order to register, you need to agree to abide by our Code Of Conduct.</strong>
                <span class="absolute pin-t pin-b pin-r px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red" role="button" @click.prevent="showConductError = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
              </span>
            </div>

            <div class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 rounded relative" role="alert" v-if="showTermsError === true">
                <strong class="font-bold tracking-wide">In order to register, you need to agree to our Terms Of Service.</strong>
                <span class="absolute pin-t pin-b pin-r px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red pb-4" role="button" @click.prevent="showTermsError = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
              </span>
            </div>

            <div class="mb-4 flex-1">
                <h2 class="font-sans text-2xl tracking-wide">Developer Resumes</h2>
                <h4 class="font-sans tracking-wide">Register Account</h4>

                <p class="font-sans text-3xl pb-2 tracking-wide pt-2">How is works</p><hr>
                <ul class="list-reset">
                    <li class="pl-0 font-sans text-2xl text-black tracking-wide">Create account &amp; upload your resume.</li>
                    <li class="pl-0 font-sans text-2xl text-black tracking-wide">We give you a link to tweet out to your network.</li>
                    <li class="pl-0 font-sans text-2xl text-black tracking-wide">We will also tweet out the link to our networks.</li>
                    <li class="pl-0 font-sans text-2xl text-black tracking-wide">Professionals will come along and give you feedback on your resume.</li>
                </ul>
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2 font-sans tracking-wide" for="username">
                    Username <i v-if="success === true" class="fa fa-check text-green-dark"></i>
                  </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="username" type="text" placeholder="Username" v-model="username">
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2 font-sans tracking-wide" for="password">
                    Password <i v-if="success === true" class="fa fa-check text-green-dark"></i>
                  </label>
                <input v-bind:class="{ error: formError }" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" type="password" placeholder="******************" v-model="password">
                <p v-if="formError === true" class="text-red text-xs italic">Please choose a password.</p>
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2 font-sans tracking-wide" for="password">
                    Confirm Password <i v-if="success === true" class="fa fa-check text-green-dark"></i>
                  </label>
                <input v-bind:class="{ error: formError }" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3" id="confirmPassword" type="password" placeholder="******************" v-model="confirmPassword">
                <p v-if="formError === true" class="text-red text-xs italic">Please confirm your password.</p>
            </div>
            <div class="flex items-center justify-between pb-2">
                <label class="text-grey font-bold" for="code-of-conduct"><input id="code-of-conduct" class="mr-2" type="checkbox" v-model="codeOfConduct"/> <span class="text-sm">
                    By registering, you agree to abide by our  <a class="text-gray no-underline" href="/code-of-conduct">code of conduct</a> and you agree to abide by our <a class="text-gray no-underline" href="/terms-of-service">terms of service</a>.
                  </span>
                </label>
            </div>
            <div class="flex items-center justify-between">
		        <p class="font-sans tracking-wide">We are not taking registrations just yet, please sign up for our email updates and we will announce when we are ready to help!</p>
                <button disabled class="shadow bg-yellow-dark hover:bg-yellow-dark text-black font-bold py-2 px-4 rounded" type="button" @click.prevent="register">
                    Register
                </button>
            </div>
        </div>
        <dr-footer></dr-footer>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../auth.js';
  import DrFooter from './FooterComponent.vue';
  import DrHeader from './HeaderComponent.vue';

  export default {

    created() {
      return auth.check();
    },

    data() {
      return {
        username: '',
        password: '',
        confirmPassword: '',
        codeOfConduct: false,
        success: false,
        formError: false,
        showConductError: false,
        showTermsError: false,
        formSuccess: false,
        auth: auth,
        user: auth.user || null,
      };
    },

    methods: {
      register() {
        this.codeOfConductCheck();

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
        }

        return;
      },
    },

    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>
