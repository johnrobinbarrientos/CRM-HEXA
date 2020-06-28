<template>
    <div style="width:450px; margin:10px auto; margin-top:150px;">
       <h2 style="text-align:center; margin-bottom:20px;">ORION TOOLS</h2>
      <form v-on:submit.prevent="authenticate()">
            <div class="kx-alert-red" v-if="credentials.error">
                {{ credentials.error }}
            </div>
            <div class="kx-form-group">
              <label>Email Address</label>
              <input v-model="credentials.email" type="email" class="kx-form-control" placeholder="Email Address">
            </div>
            <div class="kx-form-group">
              <label>Password</label>
              <input v-model="credentials.password" type="password" class="kx-form-control" placeholder="Password">
            </div>
            <button type="submit" class="kx-btn kx-btn-block">SUBMIT</button>
      </form>
    </div>
</template>

<script>
    export default {
    name: 'authentication',
    props: ['properties'],
    data: function () {
        return {
            credentials: {
                email: '',
                password: '',
                error: null
            }
        }
    },
    components: {
    
    },
    methods: {
        authenticate: function () {
            var scope = this
            scope.credentials.error = null
            scope.axios
            .post(scope.API_URL() + '/auth', scope.credentials)
            .then(response => {
                var data = response.data
                if (data.success) {
                    localStorage.setItem("kxtoken", data.token);
                    scope.$router.push({name: 'home'})
                }
            })
            .catch(function (error) {
                var data = error.response.data
                var code = error.response.status
                scope.credentials.error = 'Authentication Failed, Please check your username or password..'
            })
        }
    },
    mounted() {
        
    }
}
</script>