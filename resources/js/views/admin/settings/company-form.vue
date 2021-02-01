<template>
    <div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Setup New Company</h4>
                <div id="progrss-wizard" class="twitter-bs-wizard">
                    <ul class="twitter-bs-wizard-nav nav-justified nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" v-bind:class="{'active' : step >= 1}">
                                <span class="step-number mr-2">01</span>
                               <span>Company Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" v-bind:class="{'active' : step >= 2}">
                                <span class="step-number mr-2">02</span>
                                <span>User Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" v-bind:class="{'active' : step >= 3}">
                                <span class="step-number mr-2">03</span>
                                <span>Review</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" v-bind:class="{'active' : step >= 4}">
                                <span class="step-number mr-2">04</span>
                                <span>Complete</span>
                            </a>
                        </li>
                    </ul>
                    
                    <div id="bar" class="mt-4">
                        <div class="progress">
                            <div class="progress-bar progress-bar-animated bg-info progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" v-bind:style="{width: progress}"></div>
                        </div>
                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated"></div>
                    </div>
                    
                    <div class="tab-content twitter-bs-wizard-tab-content">
                        <div class="tab-pane" v-bind:class="{'active' : step == 1}">
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="company-name">Company Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.company_name" type="text" class="form-control" id="company-name" required>
                                        </div>
                                    </div>
                                </div>                                           
                            
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="shortname">Shortname</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.shortname" type="text" class="form-control" id="shortname" required>
                                        </div>
                                    </div>
                                </div>                                           
                            

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tagline">Tagline</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.tagline" type="text" class="form-control" id="tagline" required>
                                        </div>
                                    </div>
                                </div>                                           
                        

                    
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="website">Website</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.website" type="text" class="form-control" id="website" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div> 

                            <br/>

                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.company_email" type="text" class="form-control" id="email" required>
                                        </div>
                                    </div>
                                </div>                                           
                            
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="contact-no">Contact Number</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.contact_no" type="text" class="form-control" id="contact-no" required>
                                        </div>
                                    </div>
                                </div>                                           
                            
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tin">TIN</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.tax_id_no" type="text" class="form-control" id="tin" required>
                                        </div>
                                    </div>
                                </div>                                           
                            
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="prefix">Prefix</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.prefix" type="text" class="form-control" id="prefix" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div> 

                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="address-list">Address</label>
                                        <select class="form-select-address-list" v-model="selected_global_address" :options="options_global_address" name="address-list">
                                        </select>
                                    </div>
                                </div>                                          
                            </div> 
                        </div>

                        <div class="tab-pane" v-bind:class="{'active' : step == 2}">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                        <div class="form-group">
                                        <label class="form-label" for="full-name">First Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.first_name" type="text" class="form-control" id="first-name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                        <div class="form-group">
                                        <label class="form-label" for="full-name">Last Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.last_name" type="text" class="form-control" id="last-name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email-address">Email Address</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.email" type="text" class="form-control" id="email-address" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="phone-no">Phone No</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.phone" type="text" class="form-control" id="phone-no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" v-bind:class="{'active' : step == 3}">
                            
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 col-lg-12">
                                            <h4>Company Details</h4>
                                            <hr/>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div>
                                                <strong>Company Name:</strong>
                                                <p>{{ formdata.company_name }}</p>
                                            </div>
                                            <div>
                                                <strong>Short Name:</strong>
                                                <p>{{ formdata.shortname }}</p>
                                            </div>
                                            <div>
                                                <strong>Company Email:</strong>
                                                <p>{{ formdata.company_email }}</p>
                                            </div>
                                            <div>
                                                <strong>Tagline:</strong>
                                                <p>{{ formdata.tagline }}</p>
                                            </div>
                                            <div>
                                                <strong>Website:</strong>
                                                <p>{{ formdata.website }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            
                                            <div>
                                                <strong>Contact #:</strong>
                                                <p>{{ formdata.contact_no }}</p>
                                            </div>
                                            <div>
                                                <strong>TIN:</strong>
                                                <p>{{ formdata.tax_id_no }}</p>
                                            </div>
                                            <div>
                                                <strong>Prefix:</strong>
                                                <p>{{ formdata.prefix }}</p>
                                            </div>
                                            <div>
                                                <strong>Address:</strong>
                                                <p>{{ address }}</p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 col-lg-12">
                                            <h4>User Details</h4>
                                            <hr/>
                                        </div>
                                        <div class="col-12 col-lg-12">
                                            <div>
                                                <strong>First Name:</strong>
                                                <p>{{ formdata.first_name }}</p>
                                            </div>
                                            <div>
                                                <strong>Last Name:</strong>
                                                <p>{{ formdata.last_name }}</p>
                                            </div>
                                            <div>
                                                <strong>Email Address:</strong>
                                                <p>{{ formdata.email }}</p>
                                            </div>
                                            <div>
                                                <strong>Phone Number:</strong>
                                                <p>{{ formdata.phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" v-bind:class="{'active' : step == 4}">
                            <br/>
                            <div class="alert alert-success fade show text-center">
                                <br/>
                                <i style="font-size:80px;" class="bx bx-check"></i>
                                <h2>{{ formdata.company_name }} has been successfully added</h2>
                                <p><strong>{{ formdata.company_name }}'s</strong> administrator account credentials has been sent to <strong>{{ formdata.email }}</strong></p>
                                <br/>
                                <br/>
                                <br/>
                            </div>

                            <div style="text-align:center; margin-top:20px;">
                                <button @click="ROUTE({path: '/companies'})" class="btn btn-primary">Back to Companies List</button>
                            </div>
                        </div>
                    </div>
                    <ul v-if="step <= 3" class="pager wizard twitter-bs-wizard-pager-link">
                        <li class="previous" v-bind:class="{'disabled' : step <= 1}">
                            <a href="javascript:void(0);" @click="prev()">Previous</a>
                        </li>
                        <li class="next" v-bind:class="{'disabled' : step >= 5}">
                            <a v-if="step == 3" href="javascript:void(0);" @click="save()">Confirm</a>
                            <a v-else href="javascript:void(0);" @click="next()">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>       
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'company-create',
    props: ['properties'],
    data: function () {
        return {
            step: 1,
            selected_global_address: null,
            options_global_address: [],
            option_companies: [],
            companies: [],
            formdata: { 
                id: null, 
                company_name: '',
                shortname: '',
                tagline: '',
                website: '',
                company_email: '',
                contact_no: '',
                tax_id_no: '',
                prefix: '',
                global_address_uuid: '',

                user_id: null,  
                email: '', 
                first_name: '', 
                last_name: '', 
                phone: ''
            }
        }
    },
    computed: {
        progress: function() {
            var scope = this
            var progress = [];
            progress[1] = '25%';
            progress[2] = '50%';
            progress[3] = '75%';
            progress[4] = '100%';
            
            var step = scope.step
            return progress[step]
        },
        address: function () {
            var scope = this
            for (let i = 0; i < scope.options_global_address.length; i++) {
                var current = scope.options_global_address[i]
                if (current.id === scope.selected_global_address) {
                    return current.text
                }
            }
            return ''
        }
    },
    methods: {
        prev: function() {
            var scope = this
            if (scope.step <= 1) {
                scope.step = 1
                return
            }

            scope.step = scope.step - 1
        },
        next: function() {
            var scope = this
            if (scope.step >= 4) {
                scope.step = 4
                return
            }

            scope.step = scope.step + 1
        },
        getCompanyList: function () {
           var scope = this
            scope.GET('admin/company-list').then(res => {
                scope.companies = res.rows
            })
        },
        getAddressList: function () {
           var scope = this
            scope.GET('globals/address-list').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_global_address.push({
                        id: data.uuid,
                        text: data.barangay + ' ' + data.city_municipality + ' ' + data.province + ' ' + data.region
                    })
                
                })

                $(".form-select-address-list").select2({data: scope.options_global_address});
                
                scope.selected_global_address = scope.options_global_address[0].id
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.id = null
            scope.formdata.company_name = ''
            scope.formdata.shortname = ''
            scope.formdata.tagline = ''
            scope.formdata.website = ''
            scope.formdata.email = ''
            scope.formdata.contact_no = ''
            scope.formdata.tax_id_no = ''
            scope.formdata.prefix = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.id = data.id
            scope.formdata.company_name = data.company_name
            scope.formdata.shortname = data.shortname
            scope.formdata.tagline = data.tagline
            scope.formdata.website = data.website
            scope.formdata.email = data.email
            scope.formdata.contact_no = data.contact_no
            scope.formdata.tax_id_no = data.tax_id_no
            scope.formdata.prefix = data.prefix

            $('.form-select-address-list').val(data.global_address_uuid);
            $('.form-select-address-list').trigger('change');
        },
        save: function () {
            var scope = this
            scope.formdata.global_address_uuid = scope.selected_global_address

            scope.POST('admin/company-list', scope.formdata).then(res => {
            if (res.success) {
                window.swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Saved',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    scope.step = 4
                    scope.getCompanyList()
                    // scope.CLOSE_MODAL('#modalCompanyList')
                })
            } else {
                alert('ERROR:' + res.code)
            } 
            })
        },

        update: function () {
            var scope = this
            scope.formdata.global_address_uuid = scope.selected_global_address

            window.swal.fire({
                title: 'Update?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('admin/company-list', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Updated',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.getCompanyList()
                            scope.CLOSE_MODAL('#modalCompanyList')
                        })
                    } else {
                        alert('ERROR:' + res.code)
                    } 
                    })
                }
            })
        },

        remove: function (data) {
            var scope = this
            window.swal.fire({
                title: 'Delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('admin/company-list/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCompanyList()
                            scope.CLOSE_MODAL('#modalCompanyList')
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        }
    },
    mounted() {
        var scope = this
        scope.getCompanyList()
        scope.getAddressList()

        $('.form-select-address-list').on("change", function(e) { 
            scope.selected_global_address = $('.form-select-address-list').val();
        })
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>