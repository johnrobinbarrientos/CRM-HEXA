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
                
                            <li class="nk-menu-item has-sub">
                                <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-files-fill"></em></span>
                                    <span class="nk-menu-text">MASTER DATA &amp; LEDGERS</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="html/crypto/welcome.html" class="nk-menu-link">
                                            <span class="nk-menu-text">ITEM</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/general/pages/auths/auth-login.html" target="_blank" class="nk-menu-link">
                                            <span class="nk-menu-text">SUPPLIER</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/general/pages/auths/auth-register.html" target="_blank" class="nk-menu-link">
                                            <span class="nk-menu-text">CUSTOMER</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/general/pages/auths/auth-reset.html" target="_blank" class="nk-menu-link">
                                            <span class="nk-menu-text">EMPLOYEE</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/general/pages/auths/auth-success.html" target="_blank" class="nk-menu-link">
                                            <span class="nk-menu-text">COST CENTER</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/general/pages/auths/auth-success.html" target="_blank" class="nk-menu-link">
                                            <span class="nk-menu-text">LOCATION</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="html/general/pages/auths/auth-success.html" target="_blank" class="nk-menu-link">
                                            <span class="nk-menu-text">PROJECT</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            
                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('home')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                    <span class="nk-menu-text">BUY &amp; PAY</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('home')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span>
                                    <span class="nk-menu-text">SELL &amp; COLLECT</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('home')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                    <span class="nk-menu-text">ACCOUNTING</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('home')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                    <span class="nk-menu-text">FINANCIAL</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('home')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                    <span class="nk-menu-text">OTHERS</span>
                                </a>
                            </li>
          


                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('users')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                    <span class="nk-menu-text">USERS</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('companies')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                                    <span class="nk-menu-text">COMPANIES</span>
                                </a>
                            </li>
                         
                            
                          

                        </ul><!-- .nk-menu -->
                    </div>
                    <div class="nk-sidebar-footer">
                        <ul class="nk-menu nk-menu-footer">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                    <span class="nk-menu-text">Support</span>
                                </a>
                            </li>
                            <li class="nk-menu-item ml-auto">
                                <div class="dropup">
                                    <a href="#" class="nk-menu-link dropdown-indicator has-indicator" data-toggle="dropdown" data-offset="0,10">
                                        <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                                        <span class="nk-menu-text">English</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="language-list">
                                            <li>
                                                <a href="#" class="language-item">
                                                    <img src="" alt="" class="language-flag">
                                                    <span class="language-name">English</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="language-item">
                                                    <img src="" alt="" class="language-flag">
                                                    <span class="language-name">Español</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="language-item">
                                                    <img src="" alt="" class="language-flag">
                                                    <span class="language-name">Français</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="language-item">
                                                    <img src="" alt="" class="language-flag">
                                                    <span class="language-name">Türkçe</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul><!-- .nk-footer-menu -->
                    </div><!-- .nk-sidebar-footer -->
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