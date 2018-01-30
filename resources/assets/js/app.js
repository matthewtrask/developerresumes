require('./bootstrap');
import router from './routes';
import auth from './auth';

router.beforeEach((to, from, next) => {
  let token = localStorage.getItem('id_token');

  if (to.matched.some(record => record.meta.requiresAuth) && !token) {
    next({ path: '/login', query: { redirect: to.fullPath }});
  } else {
    next();
  }
});

const app = new Vue({
  el: '#app',
  router,
});