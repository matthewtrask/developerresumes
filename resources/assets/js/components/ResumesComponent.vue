<style lang='scss'>

</style>
<template>
    <div>
      <dr-header :user="user"></dr-header>
      <div class="flex">
          <div v-for="resume in resumes.data" class="flex-1 bg-white mx-auto max-w-sm shadow-lg rounded-lg overflow-hidden">
              <div class="sm:flex sm:items-center px-6 py-4">
                  <img class="block h-16 sm:h-24 rounded-full mx-auto mb-4 sm:mb-0 sm:mr-4 sm:ml-0" :src="'https://avatars2.githubusercontent.com/' + resume.profile.data.githubUsername" alt="">
                  <div class="text-center sm:text-left sm:flex-grow">
                      <div class="mb-4">
                          <p class="text-xl leading-tight">{{ resume.profile.data.preferredName }}'s Resume</p>
                          <p class="text-sm leading-tight text-grey-dark"><i class="fa fa-map-marker"></i> {{ resume.profile.data.location }}</p>
                          <p class="text-sm leading-tight text-grey-dark"><i class="fa fa-github"></i> {{ resume.profile.data.github }}</p>
                          <p class="text-sm leading-tight text-grey-dark"><i class="fa fa-twitter"></i> {{ resume.profile.data.twitter }}</p>
                          <p class="text-sm leading-tight text-grey-dark"><i class="fa fa-twitter"></i> {{ resume.profile.data.blog }}</p>
                      </div>
                      <div>
                          <a class="no-underline text-purple hover:text-white tracking-wide" v-bind:href='"/resumes/"+resume.id'><button class="text-xs font-semibold rounded-full px-4 py-1 leading-normal bg-white border border-purple text-purple hover:bg-purple hover:text-white">Review</button></a>
                      </div>
                  </div>
              </div>
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
      this.getUsersWithResumes();
    },

    data() {
      return {
        auth: auth,
        user: auth.user || null,
        resumes: [],
      };
    },

    methods: {
      getUsersWithResumes() {
        axios.get('/api/resumes').then(response => {
          this.resumes = response.data;
        }).catch(error => {

        })
      }
    },

    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>