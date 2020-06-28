<template>
    <div class="kx-sidebar">
      <div class="logo">EASYWRITE</div>
      <div class="navs">
        <div @click="link('users')" class="item"><i class="las la-user icon"></i> USERS</div>
        <div @click="link('companies')" class="item"><i class="las la-building icon"></i> GROUPS</div>
        <div @click="link('templates')" class="item"><i class="las la-map-marked-alt icon"></i> TEMPLATES</div>
        <div @click="link('projects')" class="item"><i class="las la-rocket icon"></i> ASSIGNMENTS</div>
        <div @click="link('calculations')" class="item"><i class="las la-calculator icon"></i> BOOKS</div>
        <div @click="link('home')" class="item"><i class="las la-cog icon"></i> SETTINGS</div>
        <div @click="logout()" class="item"><i class="las la-power-off icon"></i> LOGOUT</div>
      </div>
    </div>
</template>

<script>
    export default {
    name: 'SideBar',
    props: ['properties'],
    data: function () {
        return {
            
        }
    },
    components: {
    
    },
    methods: {
        link: function (name) {
           var scope = this
           scope.$router.push({name: name})
        },
        logout: function () {
          var scope = this
          localStorage.removeItem("kxtoken");
          scope.$router.push({name: 'auth'})
        }
    },
    mounted() {
        
    }
}
</script>