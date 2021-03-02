<template>
    <div>
        <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> System Users</h1>
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

            <div class="table-responsive table-striped"> 
                <table class="table table-bordered">
                    <thead class="th-nowrap">
                        <tr>
                            <th>Action</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Branch</th>
                            <th>Department</th>
                            <th>Job Title</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(employee) in employeeList" :key="employee.uuid">
                            <td width="65" class="text-center">
                                <span class="hx-table-actions">
                                    <a href="javascript:void(0)" @click="" title="Send Credentials" class="btn btn-sm hx-btn-shineblue"><i class="bx bx-mail-send" title="Send Credentials"></i></a>
                                </span>
                            </td>
                            <td class="text-right">{{employee.emp_id}}</td>
                            <td>
                                <span class="text-nowrap">
                                    {{employee.first_name}} {{employee.last_name}}
                                </span>
                            </td>
                            <td>
                                <span style="text-transform: uppercase" class="text-nowrap">
                                    {{employee.branch_location.location_name}}
                                </span>        
                            </td>
                            <td>
                                <span style="text-transform: uppercase" class="text-nowrap">
                                    {{employee.department.department}}
                                </span>        
                            </td>
                            <td>
                                <span style="text-transform: uppercase" class="text-nowrap">
                                    {{employee.job_title}}
                                </span>        
                            </td>
                            <td>
                                <span style="text-transform: uppercase" class="text-nowrap">
                                    <span v-if="system_invitation"></span>
                                    <span v-else>Pending</span>
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
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'employee-list',
    props: ['properties'],
    data: function () {
        return {
            
            employeeList: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
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
        getEmployeeList: function () {
            var scope = this
            scope.listLoading = true
            scope.employeeList = []
            scope.GET('employees/employee-list?system=yes&keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.employeeList = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        moment: function (date_hired) {
            return moment(date_hired).format('DD-MMM-YYYY')
        },

        create: function () {
            var scope = this

            scope.POST('employees/employee-list').then(res => {
                if (res.success) {
                   scope.ROUTE({path: '/employees/' + res.data.uuid })
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
                scope.getEmployeeList()
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

            scope.getEmployeeList()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getEmployeeList()
        }

    },
    mounted() {
        // Tooltips
        $('[data-toggle="tooltip"]').tooltip()
        
        var scope = this
        scope.getEmployeeList()

    },
}
</script>

<style scoped>
.form-group { margin-top:10px !important; }
</style>