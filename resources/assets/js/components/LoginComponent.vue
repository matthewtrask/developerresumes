<style lang='scss' scoped>
    .flex-col {
        margin-right: auto;
        margin-left: auto;
    }

    .error {
        border: 1px solid red;
    }
</style>
<template>
    <div>
        <dr-header :user="user"></dr-header>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col pin-x w-2/3">
            <div class="mb-4">
                <h3 class="font-sans tracking-wide">Developer Resumes</h3>
                <h1 class="font-sans tracking-wide">Login</h1>
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
                <p v-if="formError === true" class="text-red text-xs italic">Please enter a password.</p>
            </div>
            <div class="flex items-center justify-between pb-2">
                <label class="text-grey font-bold" for="rememberMe"><input id="rememberMe" class="mr-2" type="checkbox" v-model="rememberMe" /> <span class="text-sm">
                    Remember Me
                  </span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button disabled class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="button" @click.prevent="login">
                    Login
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
        rememberMe: false,
        formError: false,
        success: false,
        auth: auth,
        user: auth.user || null,
      };
    },

    methods: {
      login() {
        if (this.password === '') {
          this.formError = true;

          setTimeout(() => {
            this.formError = false;
          }, 1000);

          return;
        }

        this.success = true;

        setTimeout(() => {
          auth.signin(this, this.username, this.password, this.rememberMe);
        }, 5000);

      },
    },

    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>