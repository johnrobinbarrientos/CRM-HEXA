<template>
    <div>
        <div v-show="show_preloader">
            <Spinner />
        </div>

        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i>Admin Chart of Accounts</h1>
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
                <a href="javascript:void(0)" @click="OPEN_MODAL('#modalCOA');resetData()" class="btn btn-primary" data-toggle="modal">
                    <em class="icon ni ni-plus"></em> <span>New</span>
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
                                <th>Code</th>
                                <th>Account Name</th>
                                <th>Account Group</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(account, index) in chartOfAccounts" :key="account.uuid">
                                 <td width="100">
                                     <span class="w-65px d-block mx-auto">
                                        <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCOA');setData(account)" class="btn btn-sm btn-shineblue" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"  @click="remove(account)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can" title="Trash"></i></a>
                                    </span>
                                </td>
                                <td width="50">{{ (index + 1) }}</td>
                                <td>{{ account.code }}</td>
                                <td>{{ account.account_name }}</td>
                                <td>{{ account.account_group.account_group }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <nav v-if="listTotalPages > 1" class="pagination pagination-rounded justify-content-center mt-4" aria-label="pagination">
                        <ul class="pagination">
                            <li @click="listPaginate('prev')"  v-bind:class="{'disabled' : listCurrentPage <= 1}"  class="page-item" >
                                <a href="javascript:void(0)" class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">‹</span><span class="sr-only">Previous</span>
                                </a>
                            </li>

                            
                            <li @click="listPaginate(page)" v-for="page in listTotalPages" :key="page" class="page-item" v-bind:class="{'active' : page === listCurrentPage}">
                                <a href="javascript:void(0)" class="page-link">
                                    {{ page }}
                                </a>
                            </li>
                            
                            <li @click="listPaginate('next')" v-bind:class="{'disabled' : listCurrentPage >= listTotalPages}" class="page-item">
                                <a href="javascript:void(0)" class="page-link" aria-label="Next"><span aria-hidden="true">›</span><span class="sr-only">Next</span></a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
        
        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalCOA">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chart of Accounts Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalCOA');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="account-groups">Account Group</label>
                                            <select class="form-select-account-group" v-model="selected_account_group" :options="options_account_group" name="account-group">
                                            <!-- <option></option> -->
                                        </select>
                                        <label class="form-label" for="account-groups">Code</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.code" type="text" class="form-control" id="code" required>
                                        </div>
                                        <label class="form-label" for="account-groups">Account Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.account_name" type="text" class="form-control" id="account-name" required>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="formdata.uuid === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                        <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'chart-of-accounts',
    props: ['properties'],
    data: function () {
        return {
            show_preloader: true,

            chartOfAccounts: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null,
                code: '', 
                account_name: '', 
                coa_group_uuid: '', 
                account_group: ''
            },
            selected_account_group: null,
            options_account_group: []

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
        getAccountGroups: function () {
           var scope = this
            scope.GET('admin/coa-account-group').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_account_group.push({
                        id: data.uuid,
                        text: data.account_group
                    })
                
                })
                $(".form-select-account-group").select2({data: scope.options_account_group});
                
                scope.selected_account_group = scope.options_account_group[0].id
            })

        },
        getChartofAccounts: function () {
            var scope = this
            scope.listLoading = true
            scope.chartOfAccounts = []
            scope.GET('admin/chart-of-accounts?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.chartOfAccounts = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },

        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.code = ''
            scope.formdata.account_name = ''
            scope.formdata.coa_group_uuid = ''
            scope.formdata.account_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.code = data.code
            scope.formdata.account_name = data.account_name
            scope.formdata.coa_group_uuid = data.coa_group_uuid
    
            $('.form-select-account-group').val(data.coa_group_uuid);
            $('.form-select-account-group').trigger('change');
        },
        save: function () {
            var scope = this
            scope.formdata.coa_group_uuid = scope.selected_account_group

            scope.POST('admin/chart-of-accounts', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getChartofAccounts()
                        scope.CLOSE_MODAL('#modalCOA')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.formdata.coa_group_uuid = scope.selected_account_group

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
                    scope.POST('admin/chart-of-accounts', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getChartofAccounts()
                                scope.CLOSE_MODAL('#modalCOA')
                            })
                        }
                        else{
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
                    scope.POST('admin/chart-of-accounts/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getChartofAccounts()
                            scope.CLOSE_MODAL('#modalCOA')
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
                scope.getChartofAccounts()
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

            scope.getChartofAccounts()
        },
        
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getChartofAccounts()
        }
    },

    mounted() {
        var scope = this
        scope.getChartofAccounts()
        scope.getAccountGroups()
         
        $('.form-select-account-group').on("change", function(e) { 
            scope.selected_account_group = $('.form-select-account-group').val();
        })

        setTimeout(function(){ scope.show_preloader = false },2000)
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>