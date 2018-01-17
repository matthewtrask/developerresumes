<style lang='scss'>

</style>
<template>
    <div>
        <dr-header></dr-header>

        <h2 class="font-sans text-5xl text-white tracking-wide">Submit your resume and get feedback from developers, managers and other professionals.</h2>

        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">We all know how hard it is to get that first developer job. The hoops you have to jump through are insane sometimes. Let's try to make that a little bit easier.</p>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">What are employers looking for from a junior developer?</p>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">How do you make your current experience look relevant if you haven’t had a dev job before?</p>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">How do you find someone with the experience to help you with these things?</p>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">We want to take all the guesswork out of this process for you.</p>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">We’ll help you find the professional developers and managers that can help point you in the right direction.</p>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">Simply:</p>
        <ul>
            <ol class="font-sans text-2xl text-white tracking-wide">Upload your resume</ol>
            <ol class="font-sans text-2xl text-white tracking-wide">Tweet out the link you receive</ol>
            <ol class="font-sans text-2xl text-white tracking-wide">Then we will also tweet out the link to our large network of developers</ol>
            <ol class="font-sans text-2xl text-white tracking-wide">Follow the feedback you’re given</ol>
        </ul>
        <p class="font-sans text-1xl text-white pt-4 pb-4 tracking-wide">It’s that easy to get your resume in order so you can start applying, so once you’ve done that first draft, register and upload your resume!</p>
        <button class="w-32 bg-yellow hover:yellow-dark text-black font-bold py-2 px-4 rounded">
            <a class="no-underline text-black tracking-wide" href="/register">Register</a>
        </button>
        <dr-footer class="pt-8"></dr-footer>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../auth.js';
  import DrFooter from './FooterComponent.vue';
  import DrHeader from './HeaderComponent.vue';

  export default {
    components: {
      DrHeader,
      DrFooter,
    }
  };
</script>