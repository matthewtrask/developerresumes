<style lang='scss'>

</style>
<template>
    <div>
        <dr-header :user="user"></dr-header>

        <h2 class="font-sans text-5xl text-white tracking-wide">Submit your resume and get feedback from developers, managers and other professionals.</h2>

        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">
            That first job for a developer is huge, we know it.
            What makes it tough on new developers is the endless cycle of submitting resume after resume, sometimes not even getting an acknowledgement back!
            Lets fix that. We made AdviseMyResume as a way for junior developers to get the advice they need to get more call backs, more acknowledgement and hopefully
            more chances.
</p>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">
            The fact is this: developers, managers and team leads are busy. If your resume doesn't stand out to them in the first pass, you aren't getting another chance.
            What we have done is found developers, managers and team leads who are willing to give us some time to review resumes and give feedback. It's on you to take the feedback
            and turn it into actionable items. We help you find people who are experienced all over the community who will help you out. Who knows? This could even turn into
            bigger for you!
        </p>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">
            While we are still building out the last few features we need for a solid 1.0, sign up to get updates! We are developers too, so we know how lame it is to get a deluge of emails, so you will get the bare minimum
            emails possible from now until we launch.
        </p>

        <form class="w-full max-w-sm">

            <div class="bg-green-lightest border border-green-light text-green-dark px-4 py-3 rounded relative" role="alert" v-if="flashSuccess">
                <strong class="font-bold">Yay!</strong>
                <span class="block sm:inline">You're on the list! We will email you once we are ready!</span>
                <span class="absolute pin-t pin-b pin-r px-4 py-3">
                  <svg @click="flashSuccess = false" class="fill-current h-6 w-6 pb-1 text-green" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>

            <div class="flex items-center border-b border-b-2 border-yellow py-2">
                <input class="appearance-none bg-transparent border-none w-full text-white mr-3 py-1 px-2" type="text" placeholder="developer@developer.com" aria-label="Full name"  v-model="email">
                <button @click.prevent="emailSignup" class="flex-no-shrink bg-yellow hover:bg-yellow border-yellow hover:border-yellow text-sm border-4 text-black py-1 px-2 rounded" type="button">
                    Sign Up
                </button>
            </div>
        </form>

        <!--<button class="w-32 bg-yellow hover:yellow-dark text-black font-bold py-2 px-4 rounded">-->
            <!--<a class="no-underline text-black tracking-wide" href="/register">Register</a>-->
        <!--</button>-->

        
        <dr-footer class="pt-8"></dr-footer>
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
        auth: auth,
        user: auth.user || null,
        email: '',
        flashSuccess: false,
      };
    },

    methods: {
      emailSignup() {
        axios.post('/api/signup', { email: this.email }).then(response => {
          this.flashSuccess = true;

          setTimeout(() => {
            this.flashSuccess = false;
          }, 3000);
        });
      },
    },

    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>