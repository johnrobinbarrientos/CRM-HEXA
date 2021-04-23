<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title">
                    <i class="las la-list-ul"></i>
                    <span>Project Scopes</span>
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
                <a href="javascript:void(0)" @click="addNewScope()" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>

        <!-- <div v-if="listLoading" class="text-center my-3 text-loader">
            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div> -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="105">Action</th>
                                    <th>Scope</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="prjScopes.length > 0">
                                    <template v-bind:class="{'table-success' : (selected_scope && selected_scope.uuid === prjScopes.uuid) }" style="cursor:pointer;" v-for="(projectscope,index) in prjScopes">
                                        
                                            <tr :key="'projectscope-' + index">
                                                    <td width="65" class="text-center">
                                                        <span class="hx-table-actions">
                                                            <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="editScope(projectscope,index)">
                                                                <b-dropdown-item href="javascript:void(0)"  @click="editScope(projectscope,index)">Edit</b-dropdown-item>
                                                                <b-dropdown-item href="javascript:void(0)" @click="removeScope(index)">Delete</b-dropdown-item>
                                                            </b-dropdown>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ projectscope.scope_of_work }}
                                                    </td>
                                            </tr>
                                        
                                    </template>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="3" style="padding:20px; text-align:center; font-weight:600;">No Records</td>
                                    </tr>
                                </template>
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
 
        <div class="modal fade modal-md-form" tabindex="-1" id="modalprojectScope">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="selected_scope" class="modal-title">
                            <span v-if="!selected_scope.id">New</span>
                            <span v-else>Edit</span>
                        </h5>
                        <a href="javascript:void(0)"  @click="cancelScope()" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form v-if="selected_scope" action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">

                                    <div style="padding:5px;">

                                        <div class="form-group">
                                            <label class="form-label" for="group-name">Scope</label>
                                            <div class="form-control-wrap">
                                                <input v-model="selected_scope.scope_of_work" class="form-control" v-bind:class="{'error' : selected_scope.scope_error}" type="text" placeholder="ie: Sites" required>
                                            </div>
                                        </div>

                                        <div class="hx-card-small">
                                            <div class="card-header">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span style="font-weight: 600">Details</span>
                                                    <button class="btn-gray-small btn-primary m-0" @click="addNewDetails(selected_scope)" type="button">
                                                        <i class="las la-plus"></i> Add Detail
                                                    </button>
                                                </div>
                                            </div>
                                            <div style="padding: 8px 10px;">
                                                <table style="margin-top:5px;" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr style="background:#fff;">
                                                            <th>Action</th>
                                                            <th>Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background:#fff;" v-for="(details,detail_index) in selected_scope.scope_details" :key="'edit-group-detail-' + detail_index ">
                                                          
                                                            <td width="60"><button class="btn-gray-small" type="button" @click="removeDetails(selected_scope.scope_details,detail_index)">Delete</button></td>
                                                            <td style="padding:0px 2px;">
                                                                <input class="form-control-gray-small" v-bind:class="{'error' : details.detail_error}" type="text" v-model="details.detail ">
                                                            </td>
                                                    
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button  @click="cancelScope()" type="button" class="btn btn-sm btn-outline-secondary">Close</button>
                        <button v-if="selected_scope && selected_scope.uuid === null" @click="checkScope()" type="button" class="btn btn-sm btn-primary">Save</button>
                        <button v-else @click="checkScope()" type="button" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
  

    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'project-scope',
    props: ['properties'],
    data: function () {
        return {
            selected_scope: null,
            scopeDetails: [],
            prjScopes: [],

            selected_scope_index: null, // used for editing

            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            listOffset: 0,
            listResults: 0,
            searchKeyword: '',
            timer: null,
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
        addNewDetails: function (projectScope) {
           var scope = this
            projectScope.scope_details.push({
                id: null,
                uuid: null,
                detail: '',
            });
        },
        removeDetails: function (details,details_index) {
            var scope = this
            details.splice(details_index,1)
        },
        addNewScope: function () {
            var scope = this
            scope.selected_scope = {
                id: null,
                uuid: null,
                scope_of_work: '',
                edit: true,
                new: true,
                scope_details: []
            }
            scope.addNewDetails(scope.selected_scope);
            scope.OPEN_MODAL('#modalprojectScope');

        },
        editScope: function (data,index) {
           var scope = this
            // we will use this when cancelling the edit
            var copy = JSON.parse(JSON.stringify(data))
            scope.selected_scope = copy
            scope.selected_scope.new = false
            scope.selected_scope.edit = true
            scope.selected_scope_index = index

           scope.OPEN_MODAL('#modalprojectScope'); 
        },
        cancelScope: function () {
            var scope = this 
            scope.selected_scope = null   
            scope.selected_scope_index = null  
            scope.CLOSE_MODAL('#modalprojectScope'); 
        },
        removeScope: function (index) {
            var scope = this
            scope.prjScopes.splice(index, 1)
        },
        getProjectScope: function () {
            var scope = this
            scope.listLoading = true
            scope.prjScopes = []

            scope.GET('projects/project-scope?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {

                scope.prjScopes = (res.rows) ? res.rows : []
                // console.log('asdasdsad')
                // console.log(res.rows)

                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
       checkScope: function () {
            var scope = this

            var error = 0

            scope.$set(scope.selected_scope,'scope_error',false);

            if (scope.selected_scope.scope_of_work == '') {
                error++;
                scope.selected_scope.scope_error = true
            }
            
            for (let i = 0; i < scope.selected_scope.scope_details.length; i++) {
                var scopeDetail = scope.selected_scope.scope_details[i]

                scope.$set(scope.selected_scope.scope_details[i],'detail_error',false);

                if (scopeDetail.detail == '') {
                    error++;
                    scope.selected_scope.scope_details[i].detail_error = true
                } 

            }

            if (error) {
                return
            }

            scope.selected_scope.edit = false

            if (scope.selected_scope_index === null) {
                scope.prjScopes.push(scope.selected_scope);
            } else {
                scope.prjScopes[scope.selected_scope_index] = JSON.parse(JSON.stringify(scope.selected_scope)) 
            }


            if (scope.prjScopes[scope.selected_scope_index].uuid == null){
                scope.saveScope('Saved')
            }else{

                window.swal.fire({
                    title: 'Update?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#548235',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {
                        scope.saveScope('Updated')
                    }
                })
                
            }

       },

       saveScope: function (swalTitle) {
           var scope = this

            scope.POST('projects/project-scope', scope.prjScopes[scope.selected_scope_index]).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: swalTitle,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.selected_scope = null
                        scope.selected_scope_index = null
                        scope.CLOSE_MODAL('#modalprojectScope')
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
                scope.getProjectScope()
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

            scope.getProjectScope()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getProjectScope()
        }
    },
    mounted() {
        var scope = this
        scope.getProjectScope()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>