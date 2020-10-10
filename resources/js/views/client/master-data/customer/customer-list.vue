<template>
    <div>
        <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Customer List</h1>
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
        </div>
        
        <div>
            <div class="row">
                <div class="col-12">
                    
                    <div v-if="listLoading" class="text-center my-3 text-loader">
                            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
                    </div>

                    <div v-else style="overflow-x:auto;"> 
                        <table class="table table-tranx table-items">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th>Actions</th>
                                    <th>#</th>
                                    <th>Sold To Name</th>
                                    <th>Business Group Name</th>
                                    <th>Business Shortname</th>
                                    <th>Chain</th>
                                    <th>Group Name</th>
                                    <th>Contact Person</th>
                                    <th>Contact No</th>
                                    <th>Applied VAT?</th>
                                    <th>Payment Term</th>
                                    <th>Channel</th>
                                    <th>Customer Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(customer, index) in customerList" :key="customer.uuid" class="tb-tnx-item">
                                    <td>
                                        <a href="javascript:void(0)"  @click="ROUTE({path: '/customers/' + customer.uuid })" class="btn btn-sm btn-light"><i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"  @click="remove(customer)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                    <td>{{ (index + 1) }}</td>
                                    <td>{{customer.sold_to_name}}</td>
                                    <td>{{customer.business_group_name}}</td>
                                    <td>{{customer.business_shortname}}</td>
                                    <td>{{customer.customer_chain.chain}}</td>
                                    <td>{{customer.customer_group.group_name}}</td>
                                    <td>{{customer.contact_person}}</td>
                                    <td class="text-right">{{customer.contact_no}}</td>
                                    <td v-if="customer.is_applied_vat === 1">Yes</td>
                                    <td v-else>No</td>
                                    <td>{{customer.payment_term.term}}</td>
                                    <td>{{customer.customer_channel.channel}}</td>
                                    <td>{{customer.customer_type.customer_type}}</td>
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
            scope.GET('customers/customer-list?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.customerList = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        create: function () {
            var scope = this

            scope.POST('customers/customer-list').then(res => {
                if (res.success) {
                   scope.ROUTE({path: '/customers/' + res.data.uuid })
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
        }

    },
    mounted() {
        var scope = this
        scope.getCustomerList()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; }
/*.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }*/
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>