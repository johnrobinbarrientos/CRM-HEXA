<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i> Project List</h1>
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
                <a @click="create()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>
        
                    
        <div v-if="listLoading" class="text-center my-3 text-loader">
                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div>

        <div v-else class="table-responsive"> 
            <table class="table table-bordered table-hover table-striped">
                <thead class="th-nowrap">
                    <tr>
                        <th width="105">Action</th>
                        <th>Project Code</th>
                        <th>Project Name</th>
                        <th>Project Shortname</th>
                        <th>Date Start</th>
                        <th>End Date</th>
                        <th>Cost</th>
                        <th>Is Completed?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(project) in projectList" :key="project.uuid">
                        <td width="65" class="text-center">
                            <span class="hx-table-actions">
                                <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="ROUTE({path: '/projects/' + project.uuid })">
                                    <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/projects/' + project.uuid })">Edit</b-dropdown-item>
                                    <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/projects/' + project.uuid + '/view' })">View</b-dropdown-item>
                                    <b-dropdown-item href="javascript:void(0)">Delete</b-dropdown-item>
                                </b-dropdown>
                            </span>
                        </td>
                        <td>{{project.project_code}}</td>
                        <td>{{project.project_name}}</td>
                        <td>{{project.project_shortname}}</td>
                        <td>{{ moment(project.date_start)}}</td>
                        <td v-if="project.end_date == null"></td>
                        <td v-else>{{ moment(project.end_date)}}</td>
                        <td>{{project.cost}}</td>
                        <td>No</td>
                    </tr>
                </tbody>
            </table>
            
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
        </div>     
             
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'project-list',
    props: ['properties'],
    data: function () {
        return {

            projectList: [],
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
        moment: function (date) {
            return moment(date).format('DD-MMM-YYYY')
        },
        getProjectList: function () {
            var scope = this
            scope.listLoading = true
            scope.projectList = []
            scope.GET('projects?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.projectList = res.rows
                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        create: function () {
            var scope = this
            scope.POST('projects').then(res => {
                if (res.success) {
                   scope.ROUTE({path: '/projects/' + res.data.uuid })
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
                scope.getProjectList()
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

            scope.getProjectList()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getProjectList()
        }

    },
    mounted() {
        var scope = this
        scope.getProjectList()

    },
}
</script>

<style scoped>
.form-group { margin-top:10px !important; }
</style>