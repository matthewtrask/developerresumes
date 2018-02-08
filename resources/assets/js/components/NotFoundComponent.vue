<style lang='scss'>

</style>
<template>
    <div>
        <dr-header :user="user"></dr-header>
        <h1 class="font-sans tracking-wide text-white text-5xl">Whoops!</h1>
        <p class="font-sans tracking-wide text-white text-4xl">The page you tried to go to doesn't exist!</p>
        <p class="font-sans tracking-wide text-white text-4xl">If you think this was a mistake to reach this page, please <a class="text-white no-underline" href="https://github.com/matthewtrask/developerresumes/issues">open an issue</a>.</p>
        <dr-footer></dr-footer>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../auth.js';
  import DrHeader from './HeaderComponent.vue';
  import DrFooter from './FooterComponent.vue';
  export default {
    created() {
      auth.check();
    },

    data() {
      return {
        auth: auth,
        user: auth.user,
      };
    },

    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>