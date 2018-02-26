<style lang='scss'>

</style>
<template>
    <div>

    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../../auth.js';
  import router from '../../routes.js';

  export default {
    created() {
      auth.check();
      this.checkPermissions();
    },

    data() {
      return {
        auth: auth,
        user: auth.user,
      };
    },

    methods: {
      checkPermissions() {
        if (this.user.role !== 1) {
          return router.push({
            name: 'Home',
          });
        }
      },
    }
  };
</script>