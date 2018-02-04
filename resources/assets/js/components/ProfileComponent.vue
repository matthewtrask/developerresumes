<style lang='scss'>
    .vue-dropzone {
        border: 2px dashed #8795A1;
    }
</style>
<template>
    <div>
      <dr-header :user="user"></dr-header>
      <div class="flex">
          <div class="flex-1 px-4 py-2 m-2">
              <h2 class="text-white font-sans tracking-wide text-5xl"><span v-if="user.profile.data !== 0">{{ user.profile.data.preferredName }}'s</span> Profile</h2>
          </div>
          <div class="flex-1 text-grey-darker text-center px-4 py-2 m-2"></div>
          <div class="flex-1 text-grey-darker text-center px-4 py-2 m-2"></div>
      </div>
      <div class="flex">
          <div class="flex-1 text-white text-center px-4 py-2 m-2">
              <p class="float-left font-sans text-3xl tracking-wide pb-2">Resume and Feedback</p>
              <p class="text-right cursor-pointer pl-4 pt-2 text-left tracking-wide text-white font-sans no-decoration" @click.prevent="removeResume"><i class="fa fa-minus-circle"></i> Remove Resume</p>
              <br><br>
              <div v-if="user.resume.data.length === 0" class="relative w-64 mb-4">
                  <vue-dropzone
                    ref="myVueDropzone"
                    id="dropzone"
                    :options="dropzoneOptions"
                    v-on:vdropzone-thumbnail="thumbnail"
                    v-on:vdropzone-success="showSuccess">
                  </vue-dropzone>
              </div>
              <object v-bind:data="user.resume.data.link" type="application/pdf" width="100%" height="500rem"></object>
          </div>
          <div class="flex-1 text-white text-center px-4 py-2 m-2">
              <p class="float-left font-sans tracking-wide"><span class="text-3xl">User Info |</span>
                  <span v-if="user.profile.data.length === 0" class="text-blue-light cursor-pointer" @click="completeInfo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Complete</span>
                  <span v-if="user.profile.data.length !== 0" class="text-blue-light cursor-pointer" @click="editInfo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</span>
              </p>
              <br><br>
              <p v-if="user.profile.data.length === 0" class="tracking-wide font-sans">Adding your Github, Twitter and blog will help you out by showing off the brand you've created around yourself!</p>
              <ul v-if="user.profile.data.length !== 0" class="list-reset">
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-user" aria-hidden="true"></i> Name:</span> {{ user.profile.data.name }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-envelope" aria-hidden="true"></i> Email:</span> {{ user.profile.data.email }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-globe" aria-hidden="true"></i> Location:</span> {{ user.profile.data.location }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter:</span> {{ user.profile.data.twitter }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-github" aria-hidden="true"></i> Github:</span> {{ user.profile.data.github }}</li>
                  <li class="font-sans tracking-wide"><span class="float-left"><i class="fa fa-id-card" aria-hidden="true"></i> Blog:</span> {{ user.profile.data.blog }}</li>
              </ul>
          </div>

          <dr-modal v-if="showCompleteModal" @blur="showCompleteModal === false">
              <div slot="header">
                  <h2 class="pt-4 pb-4 ml-4 font-sans tracking-wide font-light">Complete Profile Information</h2>
              </div>
              <div slot="body">
                  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="firstName">
                              First Name
                            </label>
                          <input v-model="firstName" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="firstName" type="text" placeholder="Your First Name">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="lastName">
                              Last Name
                            </label>
                          <input v-model="lastName" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="lastName" type="text" placeholder="Your Last Name">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="preferredName">
                              Preferred Name <small>(why? because we know some people may not want to go by their first name, or may be in the process of changing it)</small>
                            </label>
                          <input v-model="preferredName" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="preferredName" type="text" placeholder="Your Preferred Name">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="location">
                              Location
                            </label>
                          <input v-model="location" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="location" type="text" placeholder="Your Location">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="github">
                              Github
                            </label>
                          <input v-model="github" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="github" type="text" placeholder="https://github.com/you">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="twitter">
                              Twitter
                            </label>
                          <input v-model="twitter" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="twitter" type="text" placeholder="https://twitter.com/you">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="blog">
                              Blog
                            </label>
                          <input v-model="blog" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="blog" type="text" placeholder="https://yourblog.com">
                      </div>
                      <button @click.prevent="saveProfile" class="border-indigo hover:bg-indigo text-indigo font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent font-sans tracking-wide" type="button">
                          Submit
                        </button>
                      <button @click.prevent="hideCompleteModal" class="border-red hover:bg-red text-red-dark font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent font-sans tracking-wide" type="button">
                          Cancel
                      </button>
                  </form>
              </div>
          </dr-modal>

          <dr-modal v-if="showEditModal" @blur="hideEditModal">
              <div slot="header">
                  <h2 class="pt-4 pb-4 ml-4 font-sans tracking-wide font-light">Edit Profile Information</h2>
              </div>
              <div slot="body">
                  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="editFirstName">
                              First Name
                            </label>
                          <input v-model="user.profile.data.firstName" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="editFirstName" type="text" placeholder="Your First Name">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="editLastName">
                              Last Name
                            </label>
                          <input v-model="user.profile.data.lastName" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="editLastName" type="text" placeholder="Your Last Name">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="editPreferredName">
                              Preferred Name <small>(why? because we know some people may not want to go by their first name, or may be in the process of changing it)</small>
                          </label>
                          <input v-model="user.profile.data.preferredName" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="editPreferredName" type="text" placeholder="Your Preferred Name">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="editLocation">
                              Location
                            </label>
                          <input v-model="user.profile.data.location" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="editLocation" type="text" placeholder="Your Location">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="editGithub">
                              Github
                            </label>
                          <input v-model="user.profile.data.github" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="editGithub" type="text" placeholder="https://github.com/you">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="editTwitter">
                              Twitter
                            </label>
                          <input v-model="user.profile.data.twitter" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="editTwitter" type="text" placeholder="https://twitter.com/you">
                      </div>
                      <div class="mb-4">
                          <label class="font-sans tracking-wide block text-grey-darker text-sm font-bold mb-2" for="editBlog">
                              Blog
                            </label>
                          <input v-model="user.profile.data.blog" class="shadow appearance-none border w-full py-2 px-3 text-grey-darker" id="editBlog" type="text" placeholder="https://yourblog.com">
                      </div>
                      <button @click.prevent="saveEditProfile" class="border-indigo hover:bg-indigo text-indigo font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent font-sans tracking-wide" type="button">
                          Submit
                        </button>
                      <button @click.prevent="hideEditModal" class="border-red hover:bg-red text-red-dark font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent font-sans tracking-wide" type="button">
                          Cancel
                      </button>
                  </form>
              </div>
          </dr-modal>
      </div>
      <dr-footer></dr-footer>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../auth.js';
  import VueDropzone from 'vue2-dropzone';
  import 'vue2-dropzone/dist/vue2Dropzone.css';
  import DrHeader from './HeaderComponent.vue';
  import DrFooter from './FooterComponent.vue';
  import DrModal from './Modal.vue';

  export default {
    created() {
      return auth.check();
    },

    data() {
      return {
        auth: auth,
        user: auth.user,
        profile: '',
        resume: '',
        showEditModal: false,
        showCompleteModal: false,
        firstName: '',
        lastName: '',
        preferredName: '',
        location: '',
        github: '',
        twitter: '',
        blog: '',
        dropzoneOptions: {
          acceptedFiles: 'application/pdf',
          url: '/api/resumes/upload',
          thumbnailWidth: 150,
          maxFilesize: 2,
          dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> UPLOAD",
          headers: { 'Authorization': `Bearer ${localStorage.getItem('id_token')}` },
          },
      };
    },

    watch: {
      user() {
        this.profile = this.user.profile.data;
        this.resume = this.user.resume.data;
      }
    },

    methods: {
      removeResume() {
        let authToken = localStorage.getItem('id_token');

        axios.delete(`/api/resumes/${this.user.resume.data.id}`, {
          headers: {
            'Authorization': `Bearer ${authToken}`,
          },
        }).then(response => {
          auth.check();
        }).catch(error => {
          console.log(error);
        });
      },

      showSuccess() {
        return auth.check();
      },

      editInfo() {
        this.showEditModal = !this.showEditModal;
      },

      completeInfo() {
        this.showCompleteModal = !this.showCompleteModal;
      },

      hideEditModal() {
        this.showEditModal = !this.showEditModal;
      },

      hideCompleteModal() {
        this.showCompleteModal = !this.showCompleteModal;
      },

      saveProfile() {
        let authToken = localStorage.getItem('id_token');

        axios.post('/api/profile', {
          firstName: this.firstName,
          lastName: this.lastName,
          preferredName: this.preferredName,
          location: this.location,
          github: this.github,
          twitter: this.twitter,
          blog: this.blog,
        }, {
          headers: {
            'Authorization': `Bearer ${authToken}`
          }
        },).then(response => {
          this.showCompleteModal = !this.showCompleteModal;
          auth.check();
        }).catch(error => {
          console.log(error);
        });
      },

      saveEditProfile() {
        let authToken = localStorage.getItem('id_token');

        axios.put('/api/profile', {
          firstName: this.user.profile.data.firstName,
          lastName: this.user.profile.data.lastName,
          preferredName: this.user.profile.data.preferredName,
          location: this.user.profile.data.location,
          github: this.user.profile.data.github,
          twitter: this.user.profile.data.twitter,
          blog: this.user.profile.data.blog,
        }, {
          headers: {
            'Authorization': `Bearer ${authToken}`
          }
        },).then(response => {
          this.showEditModal = !this.showEditModal;
          auth.check();
        }).catch(error => {
          console.log(error);
        });
      },
    },

    components: {
      DrHeader,
      DrFooter,
      DrModal,
      VueDropzone,
    }
  };
</script>