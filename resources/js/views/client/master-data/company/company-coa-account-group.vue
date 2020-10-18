<template>
    <div >
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i>Account Groups</h1>
            </div>
            <div class="bar-right">
                <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
                <a href="javascript:void(0)" @click="OPEN_MODAL('#modalAccountGroup');resetData()" class="btn btn-primary" data-toggle="modal">
                    <em class="icon ni ni-plus"></em> <span>New</span>
                </a>
            </div>
        </div>
        

                            
        <div v-if="listLoading" class="text-center my-3 text-loader">
            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div>


        <div v-else class="table-responsive">
            <table class="table table-tranx">
                <thead>
                    <tr>
                        <th>Actions</th> 
                        <th>#</th>
                        <th>Account Groups</th>
                        <th>Report Group</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(account, index) in accountGroups" :key="account.uuid" class="tb-tnx-item">
                        <td width="100">
                            <span class="w-65px d-block mx-auto">
                                <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalAccountGroup');setData(account)" class="btn btn-sm btn-shineblue" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                <a href="javascript:void(0)"  @click="remove(account)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can" title="Trash"></i></a>
                            </span>
                        </td>
                        <td width="50">{{ (index + 1) }}</td>
                        <td>{{ account.account_group }}</td>
                        <td>{{ account.report_group.coa_report_name }}</td>

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
                    

        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalAccountGroup">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Account Group Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalAccountGroup');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="report-group">Report Group</label>
                                            <select class="form-select-report" v-model="selected_report_group" :options="options_report_group" name="report-group">
                                            <!-- <option></option> -->
                                        </select>
                                        <label class="form-label" for="account-group">Account Group</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.account_group" type="text" class="form-control" id="account-group" required>
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
>        
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'coa-account-groups',
    props: ['properties'],
    data: function () {
        return {
            accountGroups: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null,
                coa_report_uuid: '', 
                account_group: ''
            },
            selected_report_group: null,
            options_report_group: []

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
        getReportGroups: function () {
           var scope = this
            scope.GET('company/coa-report-group').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_report_group.push({
                        id: data.uuid,
                        text: data.coa_report_name
                    })
                
                })

                $(".form-select-report").select2({data: scope.options_report_group});
                
                scope.selected_report_group = scope.options_report_group[0].id
            })

        },
        getAccountGroups: function () {
            var scope = this
            scope.listLoading = true
            scope.accountGroups = []
            scope.GET('company/coa-account-group?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.accountGroups = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },

        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.coa_report_uuid = ''
            scope.formdata.account_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.coa_report_uuid = data.coa_report_uuid
            scope.formdata.account_group = data.account_group

            $('.form-select-report').val(data.coa_report_uuid);
            $('.form-select-report').trigger('change');
        },
        save: function () {
            var scope = this
            scope.formdata.coa_report_uuid = scope.selected_report_group

            scope.POST('company/coa-account-group', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Account Group Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getAccountGroups()
                        scope.CLOSE_MODAL('#modalAccountGroup')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.formdata.coa_report_uuid = scope.selected_report_group

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
                    scope.POST('company/coa-account-group', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Account Group Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getAccountGroups()
                                scope.CLOSE_MODAL('#modalAccountGroup')
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
                    scope.POST('company/coa-account-group/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Account Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getAccountGroups()
                            scope.CLOSE_MODAL('#modalAccountGroup')
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
                scope.getAccountGroups()
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

            scope.getAccountGroups()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getAccountGroups()
        }
    },

    mounted() {
        var scope = this
        scope.getAccountGroups()
        scope.getReportGroups()
         
        $('.form-select-report').on("change", function(e) { 
            scope.selected_report_group = $('.form-select-report').val();
        })
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>