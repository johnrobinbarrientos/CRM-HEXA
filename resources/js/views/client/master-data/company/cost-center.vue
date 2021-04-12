<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title">
                    <i class="las la-list-ul"></i>
                    <span>Settings</span>
                    <i class="las la-angle-right"></i>
                    <span>Cost Centers</span>
                </h1>
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
                <a href="javascript:void(0)" @click="OPEN_MODAL('#modalCostCenter');resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>

        <div v-if="listLoading" class="text-center my-3 text-loader">
            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div>


        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="105">Action</th>
                                <th>Cost Center Name</th>
                                <th>Shortname</th>
                                <th>Is Group</th>
                                <th>Cost Center Group</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(costcenter) in costCenters" :key="costcenter.uuid" class="tb-tnx-item">
                                <td width="100">
                                    <span class="hx-table-actions">
                                        <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="OPEN_MODAL('#modalCostCenter');setData(costcenter)" >
                                            <b-dropdown-item href="javascript:void(0)" @click="OPEN_MODAL('#modalCostCenter');setData(costcenter)">Edit</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="remove(costcenter)">Delete</b-dropdown-item>
                                        </b-dropdown>
                                    </span>
                                </td>

                                <td>{{ costcenter.cost_center_name }}</td>
                                <td>{{ costcenter.cost_center_shortname }}</td>
                                <td v-if="costcenter.is_group === 1" class="text-center c-success"><i class="fas fa-check"></i></td>
                                <td v-else class="text-center c-danger"><!-- <i class="fas fa-times"></i> --></td>
                                <td>{{ costcenter.cost_center_group }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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

            



        <!-- Modal Group Form -->
        <div class="modal fade modal-single-form" tabindex="-1" id="modalCostCenter">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cost Center</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalCostCenter');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cost-center">Name:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.cost_center_name" type="text" class="form-control" id="cost-center-name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cost-center">Shortname:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.cost_center_shortname" type="text" class="form-control" id="cost-center-shortname" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.is_group" true-value="1" false-value="0" class="custom-control-input" id="is-group">
                                                <label class="custom-control-label" for="is-group">Is Group?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cost-center">Group:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.cost_center_group" type="text" class="form-control" id="cost-center-group" required>
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
    name: 'cost-centers',
    props: ['properties'],
    data: function () {
        return {
  
            costCenters: [],
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
                cost_center_name: '',
                cost_center_shortname: '',
                is_group: '',
                cost_center_group: ''
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
        getCostCenters: function () {
            var scope = this
            scope.listLoading = true
            scope.costCenters = []
            scope.GET('company/cost-center?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.costCenters = res.rows
                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.cost_center_name = ''
            scope.formdata.cost_center_shortname = ''
            scope.formdata.is_group = ''
            scope.formdata.cost_center_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.cost_center_name = data.cost_center_name
            scope.formdata.cost_center_shortname = data.cost_center_shortname
            scope.formdata.is_group = data.is_group
            scope.formdata.cost_center_group = data.cost_center_group
        },
        save: function () {
            var scope = this
            scope.POST('company/cost-center', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getCostCenters()
                        scope.CLOSE_MODAL('#modalCostCenter')
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
                    scope.POST('company/cost-center', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getCostCenters()
                                scope.CLOSE_MODAL('#modalCostCenter')
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
                    scope.POST('company/cost-center/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCostCenters()
                            scope.CLOSE_MODAL('#modalCostCenter')
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
                scope.getCostCenters()
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

            scope.getCostCenters()
        },
        
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getCostCenters()
        }
    },
    mounted() {
        var scope = this
        scope.getCostCenters()

    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>