<style lang='scss'>

</style>
<template>
    <div>
        <dr-navbar :user="user"></dr-navbar>
        <div class="container mx-auto">
            <table class="w-full">
                <thead class="border-b-2 border-grey-darkest border-solid">
                <tr>
                    <th class="font-sans text-white tracking-wide">Id</th>
                    <th class="font-sans text-white tracking-wide">Email</th>
                    <th class="font-sans text-white tracking-wide">Name</th>
                    <th class="font-sans text-white tracking-wide">Created At</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users.data">
                    <td class="font-sans text-white tracking-wide text-center"><a class="text-white no-underline hover-text-yellow" :href="/admin/ + user.links.uri">{{ user.id }}</a></td>
                    <td class="font-sans text-white tracking-wide text-center">{{ user.email }}</td>
                    <td class="font-sans text-white tracking-wide text-center">{{ user.profile.data.name }}
                    <td class="font-sans text-white tracking-wide text-center">{{ user.createdAt.date | date }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <dr-footer></dr-footer>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../../auth.js';
  import moment from 'moment';
  import router from '../../routes.js';
  import DrNavbar from '../HeaderComponent.vue';
  import DrFooter from '../FooterComponent.vue';

  export default {
    created() {
      this.getUsers();
      auth.check();
      this.checkPermissions();
    },

    data() {
      return {
        users: [],
        auth: auth,
        user: auth.user,
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

      getUsers() {
        const token = localStorage.getItem('id_token');

        axios.get('/api/users', {
          headers: {
            'Authorization': `Bearer ${token}`,
          }
        }).then(response => {
          this.users = response.data;
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
    },
  };
</script>