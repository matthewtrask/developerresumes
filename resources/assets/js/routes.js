import VueRouter from 'vue-router';
import axios from 'axios';
import HomeComponent from './components/HomeComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';
import LoginComponent from './components/LoginComponent.vue';
import ForgotPasswordComponent from './components/ForgotPasswordComponent.vue';
import ProfileComponent from './components/ProfileComponent.vue';
import ResumesComponent from './components/ResumesComponent.vue';
import ResumeComponent from './components/ResumeComponent.vue';
import NotFoundComponent from './components/NotFoundComponent.vue';
import auth from './auth.js';

const user = {
  authenticated: false,
  profile: null,
};

const routes = [
  {
    path: '/',
    component: HomeComponent,
    name: 'Home',
  },
  {
    path: '/register',
    component: RegisterComponent,
    name: 'Register',
  },
  {
    path: '/login',
    component: LoginComponent,
    name: 'Login',
  },
  {
    path: '/forgot-password',
    component: ForgotPasswordComponent,
    name: 'ForgotPassword',
  },
  {
    path: '/profile',
    component: ProfileComponent,
    name: 'Profile',
    meta: {
      requiresAuth: true,
    }
  },
  {
    path: '/resumes',
    component: ResumesComponent,
    name: 'Resumes',
  },
  {
    path: '/resumes/:id',
    component: ResumeComponent,
    name: 'Resume',
  },
  {
    path: '*',
    component: NotFoundComponent,
    name: 'NotFoundComponent'
  },
];

const router = new VueRouter({
  routes,
  hashbang: false,
  linkActiveClass: 'active',
  mode: 'history',
});

export default router;