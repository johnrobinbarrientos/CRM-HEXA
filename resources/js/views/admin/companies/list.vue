<template>
    <div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">Companies</div>
                <div class="mb-3 card-subtitle">
                    Below are the list of active companies.
                </div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" placeholder="Search Item">
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)"  @click="ROUTE({ path: '/companies/create' })" class="btn btn-primary bl" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New Company</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Shortname</th>
                                <th>Tagline</th>
                                <th>Website</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>TIN</th>
                                <th>Prefix</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(company, index) in companies" :key="company.id" class="tb-tnx-item">
                                <td>
                                   
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCompanyList');setData(company)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(company)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                
                                </td>
                                <td>{{ (index + 1) }}</td>
                                <td>{{ company.company_name }}</td>
                                <td>{{ company.shortname }}</td>
                                <td>{{ company.tagline }}</td>
                                <td>{{ company.website }}</td>
                                <td>{{ company.email }}</td>
                                <td>{{ company.contact_no }}</td>
                                <td>{{ company.tax_id_no }}</td>
                                <td>{{ company.prefix }}</td>
                                <td>{{ company.address_list.barangay }} {{ company.address_list.city_municipality }} {{ company.address_list.postal_code }} {{ company.address_list.province }} {{ company.address_list.region }}</td>
                            </tr>
                        </tbody>
                    </table>
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