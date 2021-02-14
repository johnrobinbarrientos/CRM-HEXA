<template>
    <div>
        <div id="accordion">
            <div class="card shadow-none">
                <a href="#collapseOne" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                    <div class="card-header" id="headingOne">
                        <h5 class="m-0">Department</h5>
                        <i class="las la-plus-circle fs-30"></i>
                    </div>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">

                        <div class="container-fluid">
                            <div class="d-none d-lg-flex justify-content-between" style="margin-bottom: 20px;">
                                <div class="d-flex align-items-center">
                                    <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none mr-1" placeholder="Search">
                                    <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div>
                                    <a href="javascript:void(0)" @click="OPEN_MODAL('#modalDepartment');resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                                        <i class="las la-plus"></i> <span>New</span>
                                    </a>
                                </div>
                            </div>

                            <div v-if="listLoading" class="text-center my-3 text-loader">
                                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
                            </div>
       
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="105">Action</th>
                                            <th>Department</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(category) in categories" :key="category.uuid">
                                            <td width="100">
                                                <span class="hx-table-actions">
                                                    <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="OPEN_MODAL('#modalDepartment');setData(category)" >
                                                        <b-dropdown-item href="javascript:void(0)" @click="OPEN_MODAL('#modalDepartment');setData(category)" >Edit</b-dropdown-item>
                                                        <b-dropdown-item href="javascript:void(0)" @click="remove(category)">Delete</b-dropdown-item>
                                                    </b-dropdown>
                                                </span>
                                            </td>
                                            <td><span class="">{{ category.department }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div style="padding:10px; padding-top:20px; padding-bottom:0px;"> Showing {{ listOffset + 1  }} to {{ listOffset +  listResults }} of  {{ listCount }} entries</div>
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
                                    
                            <!-- Modal Category1 Form -->
                            <div class="modal fade modal-single-form" tabindex="-1" id="modalDepartment">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Department</h5>
                                            <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalDepartment');" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="bx bx-x"></i>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <form action="#" class="form-validate is-alter">

                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="department">Department:</label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="formdata.department" type="text" class="form-control" id="department" required>
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

                    </div>
                </div>
            </div>
        </div>
    </div><!-- div end -->
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'item-cat-department',
    props: ['properties'],
    data: function () {
        return {
            categories: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            listOffset: 0,
            listResults: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null, 
                department: ''
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
        getCatDepartment: function () {
            var scope = this
            scope.listLoading = true
            scope.categories = []
            scope.GET('items/cat-department?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.categories = res.rows
                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.department = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.department = data.department
        },
        save: function () {
            var scope = this
            scope.POST('items/cat-department', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getCatDepartment()
                        scope.CLOSE_MODAL('#modalDepartment')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
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
                    scope.POST('items/cat-department', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getCatDepartment()
                                scope.CLOSE_MODAL('#modalDepartment')
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
                    scope.POST('items/cat-department/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCatDepartment()
                            scope.CLOSE_MODAL('#modalDepartment')
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
                scope.getCatDepartment()
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

            scope.getCatDepartment()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getCatDepartment()
        }
    },
    mounted() {
        var scope = this
        scope.getCatDepartment()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>