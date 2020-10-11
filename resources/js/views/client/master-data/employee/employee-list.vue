<template>
    <div>
        <div v-show="show_preloader">
            <Spinner />
        </div>
        <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Employee List</h1>
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
                    <a @click="create()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
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
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Ext</th>
                            <th>Is Custodian?</th>
                            <th>Is Driver?</th>
                            <th>Is System User?</th>
                            <th>Is Active</th>
                            <th>Contact No</th>
                            <th>Emergency Contact</th>
                            <th>Contact Relation</th>
                            <th>Relation Contact No</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(employee, index) in employeeList" :key="employee.uuid">
                            <td width="100">
                                <span class="w-65px d-block mx-auto">
                                    <a href="javascript:void(0)" @click="ROUTE({path: '/employees/' + employee.uuid })" class="btn btn-sm btn-shineblue" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript:void(0)" @click="remove(employee)" class="btn btn-sm btn-danger" title="Trash"><i class="mdi mdi-trash-can"></i></a>
                                </span>
                            </td>
                            <td class="text-right">{{ (index + 1) }}</td>
                            <td class="text-right">{{employee.emp_id}}</td>
                            <td>
                                <span class="d-block w-100px">
                                    {{employee.first_name}}
                                </span>
                            </td>
                            <td>
                                <span class="d-block w-100px">
                                    {{employee.middle_name}}
                                </span>
                            </td>
                            <td>
                                <span class="d-block w-100px">
                                    {{employee.last_name}}
                                </span>
                            </td>
                            <td class="text-right">{{employee.ext}}</td>
                            <td v-if="employee.is_custodian === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_driver === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_system_user === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_active === 1">Yes</td>
                            <td v-else>No</td>
                            <td class="text-right">{{employee.contact_no}}</td>
                            <td>
                                <span class="d-block w-120px">
                                    {{employee.emergeny_contact}}
                                </span>
                            </td>
                            <td>
                                <span class="d-block w-100px">
                                    {{employee.emergeny_contact_relation}}
                                </span>
                            </td>
                            <td class="text-right">{{employee.relation_contact_no}}</td>
                            <td>
                                <span class="d-block w-200px">
                                    {{employee.branch_location.location_name}}
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
import Spinner from '../../../components/Spinner'

export default {
    name: 'employee-list',
    props: ['properties'],
    data: function () {
        return {
            show_preloader: true,
            
            employeeList: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,

        }
    },
    components: { Spinner },
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
            scope.GET('employees/employee-list?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.employeeList = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
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

        scope.getBranchLocation()
        scope.getEmploymentType()
        scope.getCostCenter()
        scope.getEwt()
        scope.getAddressList()


        $('.form-select-branch-location').on("change", function(e) { 
            scope.selected_branch_location = $('.form-select-branch-location').val();
        })
        
        $('.form-select-employment-type').on("change", function(e) { 
            scope.selected_employment_type = $('.form-select-employment-type').val();
        })

        $('.form-select-cost-center').on("change", function(e) { 
            scope.selected_cost_center = $('.form-select-cost-center').val();
        })

        $('.form-select-ewt').on("change", function(e) { 
            scope.selected_ewt = $('.form-select-ewt').val();
        })

        $('.form-select-address-list').on("change", function(e) { 
            scope.selected_global_address = $('.form-select-address-list').val();
            scope.fillAddress()
        })


        setTimeout(function(){ scope.show_preloader = false },2000)

    },
}
</script>

<style scoped>
.form-group { margin-top:10px !important; }
</style>