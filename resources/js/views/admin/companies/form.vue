<template>
    <div style="padding-top:65px;">
        <div class="nk-content nk-content-fluid">          
            <div class="container-fluid">
                <div class="nk-content-body">

                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div>
                                <form action="#" class="form-validate is-alter">
                                    <h4>Company Details</h4>
                                    <hr/>

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
                                                    <input v-model="formdata.email" type="text" class="form-control" id="email" required>
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

                                        <br/>

                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="address-list">Address</label>
                                                <select class="form-select-address-list" v-model="selected_global_address" :options="options_global_address" name="address-list">
                                                </select>
                                            </div>
                                        </div>                                          
                                    </div>  

                                    <br/>
                                    <h4>User Details</h4>
                                    <hr/> 

                                  
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                 <div class="form-group">
                                                    <label class="form-label" for="full-name">First Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.first_name" type="text" class="form-control" id="first-name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                 <div class="form-group">
                                                    <label class="form-label" for="full-name">Last Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.last_name" type="text" class="form-control" id="last-name" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="email-address">Email address</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.email" type="text" class="form-control" id="email-address" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="phone-no">Phone No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.phone" type="text" class="form-control" id="phone-no">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                                     
                                </form>
                            </div>
                            <div style="padding:20px 0px; text-align:right;">
                                <button v-if="formdata.id === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                                <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
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
                email: '',
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
    methods: {
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
                    title: 'Company Successfuly Saved',
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
        },

        update: function () {
            var scope = this
            scope.formdata.global_address_uuid = scope.selected_global_address

            window.swal.fire({
                title: 'Update Record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('admin/company-list', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Company Successfuly Updated',
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
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('admin/company-list/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Company Deleted',
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