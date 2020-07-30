<template>
    <div>
        <div v-if="authenticated" class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- SIDEBAR HERE -->
                <SideBar></SideBar>
               
                <!-- wrap @s -->
                <div class="nk-wrap">
                    <!-- main header @s -->
                
                    <!-- HEADER HERE -->
                     <Header></Header>
                    <!-- content @s -->
                    <router-view></router-view>
                    
                </div>
                <!-- wrap @e -->
            </div>
            <!-- main @e -->
        </div>
        <div v-else>
            <router-view></router-view>
        </div>
        <div style="display:none;" class="modal-backdrop fade"></div>
    </div>
</template>

<script>
    import SideBar from './components/SideBar'
    import Header from './components/Header'
    export default {
    name: 'home',
    props: ['properties'],
    data: function () {
        return {
            
        }
    },
    computed: {
        authenticated: function () {
            return this.$store.getters.isAuthenticated
        }
    },
    components: {
        SideBar,
        Header
    },
    methods: {
        authenticate: function () {
           
        }
    },
    mounted() {
        if (this.$route.meta.protected) {
            this.$store.dispatch('checkAuthenticated',{ test: 'test' })
            this.$store.dispatch('getMenus',{})
        }
    }
}
</script>

<style>
</style>