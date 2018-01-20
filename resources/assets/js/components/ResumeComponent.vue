<template>
    <div>
      <dr-header :user="user"></dr-header>
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
      this.getResume();
      this.authCheck();
    },

    data() {
      return {
        resume: '',
        auth: auth,
        user: auth.user,
      };
    },

    methods: {
      getResume() {
        axios.get('/api/resumes').then(response => {
          this.resume = response.data;
        }).catch(error => {
          console.error(error);
        });
      },

      authCheck() {
        return auth.check();
      },
    },

    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>