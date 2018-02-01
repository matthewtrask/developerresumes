<style lang='scss'>

</style>
<template>
    <div>
        <div class="flex">
            <div class="flex-1 px-4 py-2 m-2">
                <h4 class="font-sans text-3xl text-white tracking-wide"><a class="no-underline text-white tracking-wide" href="/">AdviseMyResume</a></h4>
            </div>
            <div class="flex-1 text-center px-4 py-2 m-2"></div>
            <div class="flex-1 text-center px-4 py-2 m-2">
                <a class="no-underline text-white tracking-wide" href="/resumes"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Resumes</a>
                <a disabled v-if="!user.authenticated" class="no-underline pl-4 text-white tracking-wide" href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                <a disabled v-if="!user.authenticated" class="no-underline pl-4 text-white tracking-wide" href="/register"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
                <a disbaled v-if="user.authenticated" class="no-underline pl-4 text-white tracking-wide" href="/profile"><i class="fa fa-user" aria-hidden="true"></i> {{ user.profile.data.name }}</a>
                <a disabled v-if="user.authenticated" class="no-underline pl-4 text-white tracking-wide" href @click.prevent="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../auth.js';

  export default {
    methods: {
      logout() {
        return auth.signout();
      }
    },

    props: ['user'],
  };
</script>