<template>
    <div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">Report Group</div>
                <div class="mb-3 card-subtitle">
                    Below are the list of active Report Group.
                </div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
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
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalReportGroup');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div v-if="listLoading" class="text-center my-3 text-loader">
                    <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
                </div>

                <div class="table-responsive">
                    <table class="table mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th width="100">Actions</th>
                                <th width="100">#</th>
                                <th>Report Group</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(report, index) in reportGroups" :key="report.uuid" class="tb-tnx-item">
                                <td>
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalReportGroup');setData(report)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(report)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                                <td>{{ (index + 1) }}</td>
                                <td>{{ report.coa_report_name }}</td>
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
        <div class="modal fade" tabindex="-1" id="modalReportGroup">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Report Group Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalReportGroup');" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="report-group">Report Group</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.coa_report_name" type="text" class="form-control" id="report-name" required>
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
    name: 'admin-coa-report-group',
    props: ['properties'],
    data: function () {
        return {
            reportGroups: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null, 
                coa_report_name: ''
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
        getReportGroup: function () {
           var scope = this
            scope.listLoading = true
            scope.reportGroups = []
            scope.GET('admin/coa-report-group?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.reportGroups = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.coa_report_name = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.coa_report_name = data.coa_report_name
        },
        save: function () {
            var scope = this
            scope.POST('admin/coa-report-group', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Report Group Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getReportGroup()
                        scope.CLOSE_MODAL('#modalReportGroup')
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
                    scope.POST('admin/coa-report-group', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Report Group Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getReportGroup()
                                scope.CLOSE_MODAL('#modalReportGroup')
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
                    scope.POST('admin/coa-report-group/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Report Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getReportGroup()
                            scope.CLOSE_MODAL('#modalReportGroup')
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
                scope.getReportGroup()
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

            scope.getReportGroup()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getReportGroup()
        }

    },
    mounted() {
        var scope = this
        scope.getReportGroup()
    },
}
</script>

<style scoped>
.nk-fmg-body-head .d-none .d-lg-flex { margin-bottom: 80px;}

</style>