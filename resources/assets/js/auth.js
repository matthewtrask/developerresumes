'use strict';

import axios from 'axios';
import router from './routes.js';

export default {
  user: {
    authenticated: false,
    email: null,
    profile: null,
    resume: null,
    feedback: null,
  },

  check() {
    let token = localStorage.getItem('id_token');
    if (token !== null) {

      axios.get('/api/user', {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json',
          'Content-type': 'application/json',
        },
      }).then(response => {
        this.user.authenticated = true;
        this.user.email = response.data.data.email,
        this.user.id = response.data.data.id,
        this.user.profile = response.data.data.profile;
        this.user.resume = response.data.data.resume;
        this.user.feedback = response.data.data.feedback;
      });
    }
  },

  register(context, username, password) {
    return axios.post('api/register', {
      email: username,
      password: password,
    }).then(response => {
      context.success = true;
      router.push({
        name: 'Login',
      });
    }, response => {
      context.response = response.data;
      context.error = true;
    });
  },

  signin(context, email, password, rememberMe) {
    axios.post('oauth/token', {
      grant_type: 'password',
      client_id: 2,
      client_secret: 'X71IYtz6OeoASzkLLW34BjxVEeVrAWjzFuYrChuM',
      username: email,
      password: password,
      rememberMe: rememberMe,
    }).then(response => {
      context.error = false;
      localStorage.setItem('id_token', response.data.access_token);
      window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token');
      this.check();

      router.push({
        name: 'Home'
      }, response => {
        context.error = true
      });
    });
  },

  signout() {
    localStorage.removeItem('id_token');
    this.user.authenticated = false;
    this.user.profile = null;
    router.push('/');
  },

  resetPassword(context, email) {
    return axios.post('/password/email', { email: email }).then(response => {

    });
  }
};
