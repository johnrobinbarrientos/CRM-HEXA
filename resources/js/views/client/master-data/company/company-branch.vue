<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                    <option value="1">1</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalBranch');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New</span>
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

                                <div v-if="listLoading" class="text-center my-3 text-loader">
                                    <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
                                </div>

                                <table class="table table-tranx">
                                    <thead>
                                        <tr class="tb-tnx-head">
                                            <th><span class="">#</span></th>
                                            <th><span class="">Branch Name</span></th>
                                            <th><span class="">Shortname</span></th>
                                            <th><span class="">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(branch, index) in Branches" :key="branch.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ branch.branch_name }}</span></td>
                                            <td><span class="">{{ branch.branch_shortname }}</span></td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalBranch');setData(branch)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(branch)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
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
                    <div class="modal fade" tabindex="-1" id="modalBranch">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Branch Details</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalBranch');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="branch-name">Branch Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.branch_name" type="text" class="form-control" id="branch-name" required>
                                                    </div>
                                                    <label class="form-label" for="shortname">Shortname</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.branch_shortname" type="text" class="form-control" id="shortname" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>                                    
                                        
                                    </form>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button v-if="formdata.uuid === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
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
    name: 'company-branch',
    props: ['properties'],
    data: function () {
        return {
            Branches: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null, 
                branch_name: '',
                branch_shortname: ''
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
        getBranches: function () {
           var scope = this

            scope.listLoading = true
            scope.Branches = []
            scope.GET('company/branch?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.Branches = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.branch_name = ''
            scope.formdata.branch_shortname = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.branch_name = data.branch_name
            scope.formdata.branch_shortname = data.branch_shortname
        },
        save: function () {
            var scope = this
            scope.POST('company/branch', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Branch Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getBranches()
                        scope.CLOSE_MODAL('#modalBranch')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
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
                    scope.POST('company/branch', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Branch Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getBranches()
                                scope.CLOSE_MODAL('#modalBranch')
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
                    scope.POST('company/branch/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Branch Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getBranches()
                            scope.CLOSE_MODAL('#modalBranch')
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
                scope.getBranches()
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

            scope.getBranches()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getBranches()
        }
    },
    mounted() {
        var scope = this
        scope.getBranches()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>