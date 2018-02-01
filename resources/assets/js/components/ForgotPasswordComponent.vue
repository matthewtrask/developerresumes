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
                <h1 class="font-sans tracking-wide">Forgot Password</h1>
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="username" type="text" placeholder="Email Address" v-model="email">
            </div>
            <div class="flex items-center justify-between">
                <button disabled class="bg-yellow hover:bg-yellow-dark text-black font-bold py-2 px-4 rounded shadow" type="button" @click="passwordReset">
                    Reset Password
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
        email: '',
        auth: auth,
        user: auth.user || null,
      };
    },

    methods: {
      passwordReset() {
        console.log
        //auth.resetPassword(this, this.email);
      },
    },

    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>