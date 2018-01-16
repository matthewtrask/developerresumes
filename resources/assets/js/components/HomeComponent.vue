<style lang='scss'>

</style>
<template>
    <div>
        <h4 class="font-sans text-3xl text-white">Developer Resumes</h4>
        <h2 class="font-sans text-5xl text-white">Submit your resume and get feedback from developers, managers and other professionals.</h2>

        <p class="font-sans text-2xl text-white pt-4 pb-4">We all know how hard it is to get that first developer job. The hoops you have to jump through are insane sometimes. Let's try to make that a little bit easier.</p>
        <p class="font-sans text-2xl text-white pt-4 pb-4">One of the toughest parts is the resume, and finding people willing to give you the chance you want. So let's fix that!</p>
        <p class="font-sans text-2xl text-white pt-4 pb-4">Here is the process:</p>
        <ul>
            <ol class="font-sans text-2xl text-white">Upload your resume</ol>
            <ol class="font-sans text-2xl text-white">Tweet out the link</ol>
            <ol class="font-sans text-2xl text-white">We tweet out the link too</ol>
            <ol class="font-sans text-2xl text-white">Find people who will give your resume a look over and give some feedback</ol>
            <ol class="font-sans text-2xl text-white">Iterate!</ol>
        </ul>
        <p class="font-sans text-2xl text-white pt-4 pb-4">When you are ready, go ahead and register and get your resume uploaded!</p>
        <button class="w-32 bg-yellow hover:yellow-dark text-black font-bold py-2 px-4 rounded">
            <a class="no-underline text-black" href="/register">Register</a>
        </button>
        <dr-footer class="pt-8"></dr-footer>
    </div>
</template>
<script>
  import axios from 'axios';
  import DrFooter from './FooterComponent.vue';

  export default {
    components: {
      DrFooter,
    }
  };
</script>