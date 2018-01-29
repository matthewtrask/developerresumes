<style lang="scss" scoped>
  form {
    margin-left: auto;
    margin-right: auto;
  }

  .w-5\/6 {
    width: 95%;
  }
</style>

<template>
    <div>
      <dr-header :user="user"></dr-header>
      <div class="container mx-auto">
        <div class="flex">
          <div class="flex-1">
            <h2 class="text-white font-sans tracking-wide">{{ profile.preferredName }}'s Resume and Information</h2>
            <ul class="list-reset pt-4">
              <li class="text-white font-sans tracking-wide"><i class="fa fa-rss" aria-hidden="true"></i> {{ profile.blog }}</li>
              <li class="text-white font-sans tracking-wide"><i class="fa fa-github" aria-hidden="true"></i> {{ profile.github }}</li>
              <li class="text-white font-sans tracking-wide"><i class="fa fa-twitter" aria-hidden="true"></i> {{ profile.twitter }}</li>
            </ul>
            <div class="pt-4 pb-4">
              <button @click.prevent="leaveFeedback" class="bg-transparent hover:bg-white text-white font-semibold hover:text-purple-dark py-2 px-4 border border-white hover:border-transparent">
                Leave Feedback
              </button>
            </div>

            <div class="h-64 overflow-scroll w-5/6">
              <div v-for="comment in feedback" class="max-w-md pb-2 lg:flex">
                <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                  <div class="mb-8">
                    <div class="border-bottom border-solid border-purple-dark tracking-wide font-sans text-black font-bold text-xl mb-2">Feedback from {{ comment.poster }} as {{ comment.createdAt.date | date }}</div>
                    <p class="tracking-wide font-sans text-grey-darker text-base" v-html="comment.feedback"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex-1">
            <object v-bind:data="resume.link" type="application/pdf" width="100%" height="500rem"></object>
          </div>
        </div>
      </div>

      <dr-modal v-if="showModal">
        <div slot="header">
          <h2 class="pt-4 pb-4 ml-4 font-sans tracking-wide font-light">Leave feedback for {{ profile.preferredName }}</h2>
        </div>
        <div slot="body">
          <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
              <label class="block text-grey-darker text-sm font-bold mb-2" for="feedback">
                Feedback
              </label>
              <textarea v-model="newFeedback" rows="10" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="feedback" type="text" placeholder="Some feedback!"></textarea>
            </div>
            <div>
              <div class="mb-8 bg-red-lightest border border-red-light text-red-dark px-4 py-3 relative" role="alert" v-if="flashError === true">
                <strong class="font-bold">Uh oh!</strong>
                <span class="block sm:inline">You must be signed in in order to leave feedback.</span>
                <span class="absolute pin-t pin-b pin-r px-4 py-3">
                  <svg @click.prevent="flashError = false" class="fill-current h-6 w-6 text-red" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
              </div>
              <button @click.prevent="saveFeedback" class="border-purple-dark hover:bg-white text-purple-dark font-semibold hover:text-purple-dark py-2 px-4 border border-white hover:border-transparent" type="button">
                Send Feedback
              </button>
              <button @click.prevent="hideModal" class="border-red-dark hover:bg-white text-red-dark font-semibold hover:text-red-dark py-2 px-4 border border-white hover:border-transparent" type="button">
                Cancel
              </button>
            </div>
          </form>
        </div>
      </dr-modal>
      <dr-footer></dr-footer>
    </div>
</template>
<script>
  import axios from 'axios';
  import Moment from 'Moment';
  import auth from '../auth.js';
  import DrHeader from './HeaderComponent.vue';
  import DrFooter from './FooterComponent.vue';
  import DrModal from './Modal.vue';

  export default {
    created() {
      return auth.check();
    },

    mounted() {
      this.getResume();
    },

    data() {
      return {
        resume: '',
        profile: '',
        feedback: [],
        auth: auth,
        user: auth.user || null,
        showModal: false,
        newFeedback: '',
        flashError: false,
      };
    },

    watch: {
      resume() {
        this.feedback = this.resume.feedback.data;
        this.profile = this.resume.profile.data;
      },
    },

    methods: {
      getResume() {
        axios.get(`/api/resumes/${this.$route.params.id}`).then(response => {
          this.resume = response.data.data;
        }).catch(error => {
          console.error(error);
        });
      },

      leaveFeedback() {
        this.showModal = !this.showModal;
      },

      hideModal() {
        this.showModal = !this.showModal;
      },

      saveFeedback() {
        let authToken = localStorage.getItem('id_token');

        if (! authToken) {
          this.flashError = true;

          setTimeout(() => {
            this.flashError = false;
          }, 5000);
        }

        axios.post('/api/feedback',{
            feedback: this.newFeedback,
            resumeId: this.resume.id
          }, {
          headers: {
            'Authorization': `Bearer ${authToken}`
          },
          
        }).then(response => {
          this.showModal = false;
           
          this.getResume;
        }).catch(error => {
          console.log(error);
        });
      },
    },

    filters: {
      date(value) {
        return Moment(value).format('h:mma')
      }
    },

    components: {
      DrHeader,
      DrFooter,
      DrModal,
    }
  };
</script>