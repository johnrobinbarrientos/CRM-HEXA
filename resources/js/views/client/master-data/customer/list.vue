<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title">
                    <i class="las la-list-ul"></i>
                    <span @click="ROUTE({path: '/customer-main/' })">Customer List</span>
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
                <a @click="ROUTE({path: '/customers/create'})" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>
        
                    
        <div v-if="listLoading" class="text-center my-3 text-loader">
                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div>

        <div v-else> 
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="th-nowrap">
                        <tr>
                            <th width="105">Action</th>
                            <th>Business Name</th>
                            <th>Business Shortname</th>
                            <th>Chain</th>
                            <th>Group Name</th>
                            <th>Contact Person</th>
                            <th>Contact No</th>
                            <th>Payment Term</th>
                            <th>Channel</th>
                            <th>Customer Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(customer) in customerList" :key="customer.uuid">
                            <td width="65" class="text-center">
                                <span class="hx-table-actions">
                                    <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="ROUTE({path: '/customers/' + customer.uuid })">
                                        <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/customers/' + customer.uuid })">Edit</b-dropdown-item>
                                        <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/customers/' + customer.uuid + '/view' })">View</b-dropdown-item>
                                        <b-dropdown-item href="javascript:void(0)" @click="remove(customer)">Delete</b-dropdown-item>
                                    </b-dropdown>
                                </span>
                            </td>
                            <td>{{customer.business_name}}</td>
                            <td>{{customer.business_shortname}}</td>
                            <td>{{customer.customer_chain.chain}}</td>
                            <td>{{customer.customer_group.group_name}}</td>
                            <td>{{customer.contact_person}}</td>
                            <td class="text-right">{{customer.contact_no}}</td>
                            <td>{{customer.payment_term.term}}</td>
                            <td>{{customer.customer_channel.channel}}</td>
                            <td>{{customer.customer_type.customer_type}}</td>
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
        </div>     
             
    </div>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    name: 'customer-list',
    props: ['properties'],
    data: function () {
        return {

            customerList: [],
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
        getCustomerList: function () {
            var scope = this
            scope.listLoading = true
            scope.customerList = []
            scope.GET('customers?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.customerList = res.rows
                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        // create: function () {
        //     var scope = this

        //     scope.POST('customers/create').then(res => {
        //         if (res.success) {
        //            scope.ROUTE({path: '/customers/' + res.data.uuid })
        //         }
        //     })
        // },
        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getCustomerList()
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

            scope.getCustomerList()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getCustomerList()
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
                    scope.DELETE('customers/' + data.uuid).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCustomerList()
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        },

    },
    mounted() {
        var scope = this
        scope.getCustomerList()

    },
}
</script>

<style scoped>
.form-group { margin-top:10px !important; }
</style>