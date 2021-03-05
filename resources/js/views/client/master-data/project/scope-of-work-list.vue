<template>
    <div >
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i>Scope of Works</h1>
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
                <!-- <a href="javascript:void(0)" @click="OPEN_MODAL('#modalScopeOFWork');resetData()" class="btn btn-primary" data-toggle="modal">
                    <i class="las la-plus"></i> <span>New</span>
                </a> -->
                <a @click="OPEN_MODAL('#modalScopeOFWork');resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>
        


        <div v-if="listLoading" class="text-center my-3 text-loader">
            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div>

        <div class="row">
            <div class="col-lg-6">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="105">Action</th> 
                            <th>Project Type</th>
                            <th>Scope</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(scopeOfWork) in scopeOfWorks" :key="scopeOfWork.uuid" class="tb-tnx-item">
                            <td width="100">
                                <span class="hx-table-actions">
                                    <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="OPEN_MODAL('#modalScopeOFWork');setData(scopeOfWork)" >
                                        <b-dropdown-item href="javascript:void(0)" @click="OPEN_MODAL('#modalScopeOFWork');setData(scopeOfWork)" >Edit</b-dropdown-item>
                                        <b-dropdown-item href="javascript:void(0)" @click="remove(scopeOfWork)">Delete</b-dropdown-item>
                                    </b-dropdown>
                                </span>
                            </td>
                            <td>{{ scopeOfWork.project_type.type }}</td>
                            <td>{{ scopeOfWork.scope_of_work }}</td>
                        </tr>
                    </tbody>
                </table>
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
        <div class="modal fade modal-single-form" tabindex="-1" id="modalScopeOFWork">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Scope Of Work</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalScopeOFWork');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">

                                
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="project-type-scope">Project Type:</label>
                                            <select class="form-select-project-type" v-model="selected_project_type" :options="options_project_type" name="project-type-scope">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="location-name">Scope:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.scope_of_work" type="text" class="form-control" id="location-name" required>
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
    name: 'branch-location',
    props: ['properties'],
    data: function () {
        return {
            scopeOfWorks: [],
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
                project_type_uuid: '', 
                scope_of_work: ''
            },
            selected_project_type: null,
            options_project_type: []

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
        getProjectType: function () {
           var scope = this
            scope.GET('projects/project-type').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_project_type.push({
                        id: data.uuid,
                        text: data.type
                    })
                
                })

                $(".form-select-project-type").select2({data: scope.options_project_type});
                
                scope.selected_project_type = scope.options_project_type[0].id
            })

        },
        getScopeOfWork: function () {
            var scope = this
            scope.listLoading = true
            scope.scopeOfWorks = []
            scope.GET('projects/scope-of-work?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.scopeOfWorks = res.rows
                console.log(scope.scopeOfWorks)
                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },

        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.project_type_uuid = ''
            scope.formdata.scope_of_work = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.scope_of_work = data.scope_of_work

            $('.form-select-project-type').val(data.project_type_uuid);
            $('.form-select-project-type').trigger('change');
        },
        save: function () {
            var scope = this
            scope.formdata.project_type_uuid = scope.selected_project_type

            scope.POST('projects/scope-of-work', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getScopeOfWork()
                        scope.CLOSE_MODAL('#modalScopeOFWork')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.formdata.project_type_uuid = scope.selected_project_type

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
                    scope.POST('projects/scope-of-work', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getScopeOfWork()
                                scope.CLOSE_MODAL('#modalScopeOFWork')
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
                    scope.POST('company/branch-location/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getScopeOfWork()
                            scope.CLOSE_MODAL('#modalScopeOFWork')
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
                scope.getScopeOfWork()
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

            scope.getScopeOfWork()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getScopeOfWork()
        }
    },

    mounted() {
        var scope = this
        scope.getProjectType()
        scope.getScopeOfWork()
         
        $('.form-select-project-type').on("change", function(e) { 
            scope.selected_project_type = $('.form-select-project-type').val();
        })
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>