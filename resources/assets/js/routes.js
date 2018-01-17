import VueRouter from 'vue-router';
import HomeComponent from './components/HomeComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';
import LoginComponent from './components/LoginComponent.vue';
import auth from './auth.js';

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
  }
];

const router = new VueRouter({
  routes,
  hashbang: false,
  linkActiveClass: 'active',
  mode: 'history',
});


router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth) && auth.user.authenticated === false) {
    console.log('hello world');
    next({ path: '/login', query: { redirect: to.fullPath }});
  } else {
    next();
  }
});

export default router;