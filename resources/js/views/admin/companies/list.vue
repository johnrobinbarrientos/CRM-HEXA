<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Company">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)"  @click="ROUTE({ path: '/companies/create' })" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Company</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="nk-content nk-content-fluid">          
            <div class="container-fluid">
                <div class="nk-content-body">

                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="card card-bordered card-preview">
                                <table class="table table-tranx">
                                    <thead>
                                        <tr class="tb-tnx-head">
                                            <th><span class="">Actions</span></th>
                                            <th><span class="">#</span></th>
                                            <th><span class="">Company Name</span></th>
                                            <th><span class="">Shortname</span></th>
                                            <th><span class="">Tagline</span></th>
                                            <th><span class="">Website</span></th>
                                            <th><span class="">Email</span></th>
                                            <th><span class="">Contact Number</span></th>
                                            <th><span class="">TIN</span></th>
                                            <th><span class="">Prefix</span></th>
                                            <th><span class="">Address</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(company, index) in companies" :key="company.id" class="tb-tnx-item">
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCompanyList');setData(company)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(company)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ company.company_name }}</span></td>
                                            <td><span class="">{{ company.shortname }}</span></td>
                                            <td><span class="">{{ company.tagline }}</span></td>
                                            <td><span class="">{{ company.website }}</span></td>
                                            <td><span class="">{{ company.email }}</span></td>
                                            <td><span class="">{{ company.contact_no }}</span></td>
                                            <td><span class="">{{ company.tax_id_no }}</span></td>
                                            <td><span class="">{{ company.prefix }}</span></td>
                                            <td><span class="">{{ company.address_list.barangay }} {{ company.address_list.city_municipality }} {{ company.address_list.postal_code }} {{ company.address_list.province }} {{ company.address_list.region }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    


                    <!-- Modal Group Form -->
                    <div class="modal fade" tabindex="-1" id="modalCompanyList">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Company Details</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalCompanyList');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="company-name">Company Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.company_name" type="text" class="form-control" id="company-name" required>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="shortname">Shortname</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.shortname" type="text" class="form-control" id="shortname" required>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="tagline">Tagline</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.tagline" type="text" class="form-control" id="tagline" required>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="website">Website</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.website" type="text" class="form-control" id="website" required>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.email" type="text" class="form-control" id="email" required>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="contact-no">Contact Number</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.contact_no" type="text" class="form-control" id="contact-no" required>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="tin">TIN</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.tax_id_no" type="text" class="form-control" id="tin" required>
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-6 col-12">
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
                                        
                                    </form>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button v-if="formdata.id === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                                    <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Save Changes</button>
                                </div>
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
    name: 'company-list',
    props: ['properties'],
    data: function () {
        return {

            selected_global_address: null,
            options_global_address: [],

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
                global_address_uuid: ''
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