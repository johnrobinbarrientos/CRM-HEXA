<template>
    <!-- sidebar @s -->
    <div class="nk-sidebar nk-sidebar-fat nk-sidebar-fixed" data-content="sidebarMenu">
        <div class="nk-sidebar-element nk-sidebar-head">
            <div class="nk-sidebar-brand">
               <a href="html/general/index.html" class="logo-link nk-sidebar-logo">
                    <img class="logo logo-img logo-img-lg" :src="logo"  alt="logo">
                    <img class="logo-dark logo-img logo-img-lg" :src="logo"  alt="logo-dark">
                    <span class="nio-version">SYSTEM</span>
                </a>
            </div>
            <div class="nk-menu-trigger mr-n2">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div><!-- .nk-sidebar-element -->
        <div class="nk-sidebar-element">
            <div class="nk-sidebar-body" data-simplebar>
                <div class="nk-sidebar-content">
                    <div class="nk-sidebar-menu">
                        <!-- Menu -->
                        <ul class="nk-menu">

                            <li class="nk-menu-heading">
                                <h6 class="overline-title">Menu</h6>
                            </li>

                            <li v-for="(menu, index) in menus" :key="'menu-' + index" class="nk-menu-item" v-bind:class="{'has-sub' : menu.route === '#has-submenu'}">
                                <template v-if="menu.route !== '#has-submenu'">
                                    <a href="javascript:void(0);" @click="link(menu.route)" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em v-bind:class="menu.icon"></em></span>
                                        <span class="nk-menu-text">{{ menu.text }}</span>
                                    </a>
                                </template>
                                <template v-else>
                                    <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em v-bind:class="menu.icon"></em></span>
                                        <span class="nk-menu-text">{{ menu.text }}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li v-for="(submenu1, index2) in menu.submenus" :key="'submenu-' + index + '-' + index2" class="nk-menu-item" v-bind:class="{'has-sub' : submenu1.route === '#has-submenu'}">
                                            <template v-if="submenu1.route !== '#has-submenu'">
                                                <a href="javascript:void(0);" @click="link(submenu1.route)" class="nk-menu-link">
                                                    <span class="nk-menu-text">{{ submenu1.text }}</span>
                                                </a>
                                            </template>
                                            <template v-else>
                                                <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                                    <span class="nk-menu-text">{{ submenu1.text }}</span>
                                                </a>
                                                <ul class="nk-menu-sub">
                                                    <li v-for="(submenu2, index3) in submenu1.submenus" :key="'submenu-' + index2 + '-' + index3" class="nk-menu-item">
                                                        <a href="javascript:void(0);" @click="link(submenu2.route)" class="nk-menu-link">
                                                            <span class="nk-menu-text">{{ submenu2.text }}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </template>
                                        </li>
                                    </ul>
                                </template>
                            </li>             
<!-- 
                            <li class="nk-menu-heading">
                                <h6 class="overline-title">Settings</h6>
                            </li>

                            <li class="nk-menu-item">
                                <a @click="link('users')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                    <span class="nk-menu-text">USERS</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('companies')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                                    <span class="nk-menu-text">COMPANIES</span>
                                </a>
                            </li> -->
                        
                        </ul><!-- .nk-menu -->     
                    </div>
                </div><!-- .nk-sidebar-contnet -->
            </div><!-- .nk-sidebar-body -->
        </div><!-- .nk-sidebar-element -->
    </div>
    <!-- sidebar @e -->
</template>

<script>
    import logo from '../../assets/themes/images/hexa-logo.png';
    
    export default {
    name: 'SideBar',
    props: ['properties'],
    data: function () {
        return {
            logo
        }
    },
    computed: {
        menus: function () {
            return this.$store.getters.menus 
        }
    },
    components: {
    
    },
    methods: {
        link: function (name) {
           var scope = this
           scope.$router.push({name: name})
        },
    },
    mounted() {
        var scope = this
    }
}
</script>

<style scoped>
.nk-menu {
      max-height: calc(100vh - 9rem);
      overflow-y: auto;
 }

</style>