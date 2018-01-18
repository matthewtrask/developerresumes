<style lang='scss'>

</style>
<template>
    <div>
      <dr-header :user="user"></dr-header>
      <div class="flex">
          <div class="flex-1 px-4 py-2 m-2">
              <h2 class="text-white font-sans tracking-wide text-5xl">{{ user.profile.data.preferredName }}'s Profile</h2>
          </div>
          <div class="flex-1 text-grey-darker text-center px-4 py-2 m-2"></div>
          <div class="flex-1 text-grey-darker text-center px-4 py-2 m-2"></div>
      </div>
      <div class="flex">
          <div class="flex-1 text-white text-center px-4 py-2 m-2">
              <p class="float-left font-sans text-3xl tracking-wide">Resume and Feedback</p>
          </div>
          <div class="flex-1 text-white text-center px-4 py-2 m-2">
              <p class="float-left font-sans tracking-wide"><span class="text-3xl">User Info |</span>  <span class="text-blue-light cursor-pointer" @click="editInfo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</span></p>
              <hr>
              <br><br>
              <ul class="list-reset">
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-user" aria-hidden="true"></i> Name:</span> {{ user.profile.data.name }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-envelope" aria-hidden="true"></i> Email:</span> {{ user.profile.data.email }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-globe" aria-hidden="true"></i> Location:</span> {{ user.profile.data.location }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter:</span> {{ user.profile.data.twitter }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-github" aria-hidden="true"></i> Github:</span> {{ user.profile.data.github }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-id-card" aria-hidden="true"></i> Blog:</span> {{ user.profile.data.blog }}</li>
              </ul>
          </div>
      </div>
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
      return auth.check();
    },

    mounted() {
      this.getResume();
      this.getFeedback();
    },

    data() {
      return {
        auth: auth,
        user: auth.user,
        resume: '',
        feedback: [],
      };
    },

    methods: {
      getResume() {
        axios.get('/api/resume').then(response => {
          this.resume = response.data;
        }).catch(error => {
          console.error(error);
        });
      },

      getFeedback() {
        axios.get('/api/feedback').then(response => {
          this.feedback = response.data;
        }).catch(error => {
          console.error(error);
        })
      },

      editInfo() {
        console.log('clicked');
      },
    },

    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>