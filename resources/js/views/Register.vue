<template>
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="/" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" :src="logo" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" :src="logo"  alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Register</h4>
                                        <div class="nk-block-des">
                                            <p>Create your account. It's free and only takes a minute.</p>
                                        </div>
                                    </div>
                                </div>
                                <form v-on:submit.prevent="register()">
                                    <div class="alert alert-danger alert-icon" v-if="data.error">
                                        <em class="icon ni ni-cross-circle"></em> <strong>Error</strong>! 
                                        {{ data.error }}
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="default-01">First Name</label>
                                                </div>
                                                <input v-model="data.first_name" type="text" class="form-control form-control-lg" id="default-01" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="default-01">Last Name</label>
                                                </div>
                                                <input v-model="data.last_name" type="text" class="form-control form-control-lg" id="default-01" placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <input v-model="data.email" type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address or username">
                                    </div>


                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Company Name</label>
                                        </div>
                                        <input v-model="data.name" type="text" class="form-control form-control-lg" id="default-01" placeholder="Company Name">
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input v-model="data.password" type="password" class="form-control form-control-lg" id="password" placeholder="Enter your password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Confirm Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input v-model="data.password_confirmation" type="password" class="form-control form-control-lg" id="password" placeholder="Confirm your password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Create Account</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> Already have account? <a href="javascript:void(0);" @click="ROUTE('auth')">Sign in</a>
                                </div>
              
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10"><span>English</span></a>
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
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2019 CryptoLite. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
</template>

<script>
    import logo from '../assets/themes/images/orion-logo.png';

    export default {
    name: 'register',
    props: ['properties'],
    data: function () {
        return {
            data: {
                email: '',
                first_name: '',
                last_name: '',
                password: '',
                password_confirmation: '',
                name: '',
                error: null
            },
            logo
        }
    },
    components: {
        
    },
    methods: {
        register: function () {
            var scope = this
            scope.data.error = null
            scope.axios
            .post(window.API_URL + '/register', scope.data)
            .then(response => {
                var data = response.data
                if (data.success) {
                    scope.$store.dispatch('authenticate',{ token: data.access_token })
                }
            })
            .catch(function (error) {
                var data = error.response.data
                var code = error.response.status
                scope.data.error = 'Registration Failed, Something went wrong..'
            })
        }
    },
    mounted() {
        
    }
}
</script>

<style>
    .logo-link { min-width:120px; }
</style>