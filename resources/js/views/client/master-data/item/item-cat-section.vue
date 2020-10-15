<template>
    <div>
        <div id="accordion">
            <div class="card shadow-none">
                <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="card-header" id="headingOne">
                        <h5 class="m-0">Section</h5>
                        <i class="las la-plus-circle fs-30"></i>
                    </div>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">

                        <div class="container-fluid">
                            <div class="d-none d-lg-flex justify-content-between" style="margin-bottom: 20px;">
                                <div class="d-flex align-items-center">
                                    <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none mr-1" placeholder="Search">
                                    <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                <div>
                                    <a href="javascript:void(0)" @click="OPEN_MODAL('#modalSection');resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                                        <i class="las la-plus"></i> <span>New</span>
                                    </a>
                                </div>
                            </div>

                            <div v-if="listLoading" class="text-center my-3 text-loader">
                                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
                            </div>
       
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Actions</th>
                                            <th>#</th>
                                            <th>Section</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(category, index) in categories" :key="category.uuid">
                                            <td width="100">
                                                <span class="w-65px d-block mx-auto">
                                                    <a href="javascript:void(0)" @click="OPEN_MODAL('#modalSection');setData(category)" class="btn btn-sm btn-shineblue "><i class="mdi mdi-pencil"></i></a>
                                                    <a href="javascript:void(0)" @click="remove(category)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                                </span>
                                            </td>
                                            <td width="100"><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ category.section }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                    
                            <!-- Modal Category1 Form -->
                            <div class="modal fade" tabindex="-1" id="modalSection">
                                <div class="modal-dialog modal-lg " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Section Details</h5>
                                            <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalSection');" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="bx bx-x"></i>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <form action="#" class="form-validate is-alter">

                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="section">Section</label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="formdata.section" type="text" class="form-control" id="section" required>
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
        </div>
    </div><!-- div end -->
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'item-cat-section',
    props: ['properties'],
    data: function () {
        return {
            categories: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null, 
                section: ''
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
        getCatSection: function () {
            var scope = this
            scope.listLoading = true
            scope.categories = []
            scope.GET('items/cat-section?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.categories = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.section = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.section = data.section
        },
        save: function () {
            var scope = this
            scope.POST('items/cat-section', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Category Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getCatSection()
                        scope.CLOSE_MODAL('#modalSection')
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
                    scope.POST('items/cat-section', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Category Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getCatSection()
                                scope.CLOSE_MODAL('#modalSection')
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
                    scope.POST('items/cat-section/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Category Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCatSection()
                            scope.CLOSE_MODAL('#modalSection')
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
                scope.getCatSection()
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

            scope.getCatSection()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getCatSection()
        }
    },
    mounted() {
        var scope = this
        scope.getCatSection()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>