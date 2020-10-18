<template>
    <div>
        <div v-show="show_preloader">
            <Spinner />
        </div>

        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i>Company List</h1>
            </div>
            <div class="bar-right">
                <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <a href="javascript:void(0)"  @click="ROUTE({ path: '/companies/create' })" class="btn btn-primary bl" data-toggle="modal">
                    <em class="icon ni ni-plus"></em> <span>New Company</span>
                </a>
            </div>
        </div>


        <div class="card">
            <div class="card-body">

                <div v-if="listLoading" class="text-center my-3 text-loader">
                    <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
                </div>

                <div v-else class="table-responsive">
                    <table class="table table-striped table-bordered">
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
                                <td width="100">
                                    <span class="w-65px d-block mx-auto">
                                        <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCompanyList');setData(company)" class="btn btn-sm btn-shineblue" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"  @click="remove(company)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can" title="Trash"></i></a>
                                    </span>
                                </td>
                                <td width="50">{{ (index + 1) }}</td>
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

        
        <div class="card">
            <div class="card-body">
              
                <table class="table mb-0 table table-striped">
                    <thead>
                        <tr>
                            <th>Name 1</th>
                            <th>Name 2</th>
                            <th>Name 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(company, index) in companies" :key="index">
                            <td class="editable">
                                <span>{{ company.company_name  }}</span>
                                <input v-model="company.company_name" type="text" class="editable-control">
                            </td>
                            <td class="editable">
                                <span>{{ company.shortname  }}</span>
                                <input  v-model="company.shortname" type="text" class="editable-control">
                            </td>
                            <td class="editable">
                                <span>{{ company.website  }}</span>
                                <input  v-model="company.website" type="text" class="editable-control">
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            show_preloader: true,
            
            selected_global_address: null,
            options_global_address: [],
            companies: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
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
    computed: {
        listTotalPages: function () {
            var scope = this
            var pages = Math.ceil(scope.listCount / scope.listItemPerPage)
            return pages
        }
    },
    methods: {
        getCompanyList: function () {
           var scope = this

            scope.listLoading = true
            scope.companies = []
            scope.GET('admin/company-list?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.companies = res.rows
                scope.listLoading = false
                scope.listCount = res.count
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
        },

        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getCompanyList()
            }, 800);
        },
        listPaginate: function(page) {
            var scope = this
        
            if (page === 'prev') {
                scope.listCurrentPage = scope.listCurrentPage - 1
            } else if (page === 'next') {
                scope.listCurrentPage = scope.listCurrentPage + 1
            } else {
                scope.listCurrentPage = page
            }

            if (scope.listCurrentPage < 1) {
                scope.listCurrentPage = 1
                return
            } else  if (scope.listCurrentPage > scope.listTotalPages) {
                scope.listCurrentPage =  scope.listTotalPages
                return
            }

            scope.getCompanyList()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getCompanyList()
        }


    },
    mounted() {
        var scope = this
        scope.getCompanyList()
        scope.getAddressList()

        $('.form-select-address-list').on("change", function(e) { 
            scope.selected_global_address = $('.form-select-address-list').val();
        })

        setTimeout(function(){ scope.show_preloader = false },2000)
    },
}
</script>

<style scoped>
    .editable.focused { background:red; }
    .editable.focused span {display:none; }
    .editable > .editable-control { width:0px; height:0px; opacity:0; }
    .editable > .editable-control:focus { width:inherit; height:25px; opacity:1; }
</style>
