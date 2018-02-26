<style lang='scss' scoped>
    .container {
        max-height: 750rem;
        overflow: scroll;
    }
</style>
<template>
    <div>
      <dr-navbar :user="user"></dr-navbar>
        <div class="container mx-auto pb-4">
            <div class="mx-auto bg-white rounded overflow-hidden shadow-lg pb-4 mb-4" v-for="comment in feedback.data">
                <h4 class="pl-2 pr-2 pt-2 font-sans tracking-wide">Poster: {{ comment.poster }}</h4>
                <h4 class="pl-2 pr-2 pt-2 font-sans tracking-wide">Posted: {{ comment.createdAt.date | date }}</h4>
                <p class="pl-2 pr-2 pt-2 font-sans tracking-wide">Feedback: {{ comment.feedback }}</p>
                <div class="px-4 py-4">
                    <span class="inline-block bg-red-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2" @click.prevent="moderateFeedback(comment.id)">Moderate</span>
                    <span class="inline-block bg-purple-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2" @click.prevent="viewResume(comment.links.resume)">Resume</span>
                </div>
            </div>
        </div>
      <dr-footer></dr-footer>
    </div>
</template>
<script>
  import axios from 'axios';
  import moment from 'moment';
  import router from '../../routes.js';
  import auth from '../../auth.js';
  import DrNavbar from '../HeaderComponent.vue';
  import DrFooter from '../FooterComponent.vue';

  export default {
    created() {
      this.getFeedback();
      auth.check();
      this.checkPermissions();
    },

    data() {
      return {
        auth: auth,
        user: auth.user,
        feedback: [],
      };
    },

    methods: {
      checkPermissions() {
        if (this.user.role !== 1) {
          return router.push({
            name: 'Home',
          });
        }
      },

      getFeedback() {
        const token = localStorage.getItem('id_token');

        axios.get('/api/feedback', {
          headers: {
            'Authorization': `Bearer ${token}`,
          },
        }).then(response => {
          this.feedback = response.data;
        }).catch(error => {
          console.log(error);
        });
      },

      viewResume(link) {
        return window.location.href = `/${link}`;
      },

      moderateFeedback(id) {
        const token = localStorage.getItem('id_token');

        axios.post('/api/feedback/moderate', {id}, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        }).then(response => {
          this.getFeedback();
        }).catch(error => {
          console.log(response);
        })
      },
    },

    filters: {
      date(value) {
        return moment(value).format('h:mma')
      },
    },

    components: {
      DrNavbar,
      DrFooter,
    }
  };
</script>