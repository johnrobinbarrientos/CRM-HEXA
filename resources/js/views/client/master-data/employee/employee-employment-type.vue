<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title">Employment Type</h1>
            </div>
            <div class="bar-right">
                <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                    <option value="1">1</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
                <a @click="OPEN_MODAL('#modalEmploymentType');resetData();" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>
                

        <div v-if="listLoading" class="text-center my-3 text-loader">
            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><span class="">Actions</span></th>
                    <th><span class="">#</span></th>
                    <th><span class="">Employment Type</span></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(type, index) in employmentTypes" :key="type.uuid" class="tb-tnx-item">
                    <td width="100">
                        <span class="w-65px d-block mx-auto">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalEmploymentType');setData(type)" class="btn btn-sm btn-shineblue" title="Edit"><i class="mdi mdi-pencil"></i></a>
                            <a href="javascript:void(0)" @click="remove(type)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can" title="Trash"></i></a>
                        </span>
                    </td>
                    <td width="100"><span class="">{{ (index + 1) }}</span></td>
                    <td><span class="">{{ type.employment_type }}</span></td>
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
            

        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalEmploymentType">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Employment Type Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalEmploymentType');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="employment-type">Employment Type</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.employment_type" type="text" class="form-control" id="employment-type" required>
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
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'employment-type',
    props: ['properties'],
    data: function () {
        return {
            employmentTypes: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null, 
                employment_type: ''
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
        getEmploymentType: function () {
            var scope = this
            scope.listLoading = true
            scope.employmentTypes = []
            scope.GET('employees/employment-type?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.employmentTypes = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.employment_type = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.employment_type = data.employment_type
        },
        save: function () {
            var scope = this
            scope.POST('employees/employment-type', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Employment Type Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getEmploymentType()
                        scope.CLOSE_MODAL('#modalEmploymentType')
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
                    scope.POST('employees/employment-type', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Employment Type Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getEmploymentType()
                                scope.CLOSE_MODAL('#modalEmploymentType')
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
                    scope.POST('employees/employment-type/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Employment Type Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getEmploymentType()
                            scope.CLOSE_MODAL('#modalEmploymentType')
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
                scope.getEmploymentType()
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

            scope.getEmploymentType()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getEmploymentType()
        }
    },
    mounted() {
        var scope = this
        scope.getEmploymentType()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>