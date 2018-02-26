import VueRouter from 'vue-router';
import HomeComponent from './components/HomeComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';
import LoginComponent from './components/LoginComponent.vue';
import ForgotPasswordComponent from './components/ForgotPasswordComponent.vue';
import ProfileComponent from './components/ProfileComponent.vue';
import ResumesComponent from './components/ResumesComponent.vue';
import ResumeComponent from './components/ResumeComponent.vue';
import AdminUsersComponent from './components/Admin/UsersComponent.vue';
import AdminUserComponent from './components/Admin/UserComponent.vue';
import AdminFeedbackComponent from './components/Admin/FeedbackComponent.vue';
import NotFoundComponent from './components/NotFoundComponent.vue';

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
    path: '/admin/users',
    component: AdminUsersComponent,
    name: 'AdminUsers',
    meta: {
      requiresAuth: true,
    }
  },
  {
    path: '/admin/users/:id',
    component: AdminUserComponent,
    name: 'AdminUsers',
    meta: {
      requiresAuth: true,
    }
  },
  {
    path: '/admin/feedback',
    component: AdminFeedbackComponent,
    name: 'AdminFeedback',
    meta: {
      requiresAuth: true,
    }
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