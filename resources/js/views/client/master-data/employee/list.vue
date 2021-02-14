<template>
    <div>
        <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Employee List</h1>
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

            <div class="table-responsive"> 
                <table class="table table-bordered table-hover table-striped">
                    <thead class="th-nowrap">
                        <tr>
                            <th width="105">Action</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Assign Branch</th>
                            <th>Department</th>
                            <th>Job Title</th>
                            <th>Is Custodian?</th>
                            <th>Is Driver?</th>
                            <th>Is Active</th>
                            <th>Is System User?</th>
                            <th>Employment Type</th>
                            <th>Employment Status</th>
                            <th>Date Hired</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(employee) in employeeList" :key="employee.uuid">
                            <td width="65" class="text-center">
                                <span class="hx-table-actions">
                                    <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="ROUTE({path: '/employees/' + employee.uuid })">
                                        <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/employees/' + employee.uuid })">Edit</b-dropdown-item>
                                        <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/employees/' + employee.uuid + '/view' })">View</b-dropdown-item>
                                        <b-dropdown-item href="javascript:void(0)">Delete</b-dropdown-item>
                                    </b-dropdown>
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
                            <td v-if="employee.is_custodian === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_driver === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_active === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_system_user === 1">Yes</td>
                            <td v-else>No</td>
                            <td>
                                <span style="text-transform: uppercase" class="text-nowrap">
                                    {{employee.employment_type.employment_type}}
                                </span>        
                            </td>
                            <td>
                                <span style="text-transform: uppercase" class="text-nowrap">
                                    {{employee.employment_status.employment_status}}
                                </span>        
                            </td>
                            <td>
                                <span class="text-nowrap">
                                    {{moment(employee.date_hired)}}
                                </span>        
                            </td>
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
        getEmployeeList: function () {
            var scope = this
            scope.listLoading = true
            scope.employeeList = []
            scope.GET('employees/?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.employeeList = res.rows
                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        moment: function (date_hired) {
            return moment(date_hired).format('DD-MMM-YYYY')
        },

        create: function () {
            var scope = this

            scope.POST('employees/').then(res => {
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