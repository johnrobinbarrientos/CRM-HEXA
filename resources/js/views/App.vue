<template>
    <div>
        <div v-bind:class="{'collapsed-sidebar': $store.getters.collapsedSideNav}" v-if="authenticated" id="layout-wrapper">
            <Header></Header>
            <SideBar></SideBar>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="d-flex h-100 align-items-center"><span>2020 © HEXA SUITE</span></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">Powered by <img class="pl-1" height="25" :src="logo"></div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div v-else>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import SideBar from './components/SideBar'
    import Header from './components/Header'
    import logo from '../assets/themes/images/hexa-text.png';

    export default {
    name: 'home',
    props: ['properties'],
    data: function () {
        return {
            logo
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