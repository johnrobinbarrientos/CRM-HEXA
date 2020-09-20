<template>
    <div>
        <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Supplier List</h1>
                </div>
                <div class="bar-right">
                    <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                    <select style="max-width:80px;" @change="changeSupplierListItemPerPage()" v-model="supplierListItemPerPage" class="form-control border-transparent form-focus-none">
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
                    <div class="card card-bordered card-preview">
                        
                        <div v-if="supplierListLoading" class="text-center my-3 text-loader">
                            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
                        </div>
                        <div v-else style="overflow-x:auto;"> 
                            <table class="table table-tranx table-items">
                                <thead>
                                    <tr class="tb-tnx-head">
                                        <!-- <th class="table-fixed-column" style="left:0px; width:150px; background: #f5f6fa;">Actions</span></th>
                                        <th class="table-fixed-column" style="left:150px; width:100px; background: #f5f6fa;">#</span></th>
                                        <th class="table-fixed-column" style="left:250px; width:200px; background: #f5f6fa; border-right:1px solid #dbdfea;">Shortname</span></th> -->
                                        <th>Actions</th>
                                        <th>#</th>
                                        <th>Business Name</th>
                                        <th>Business Shortname</th>
                                        <th>Check Payee</th>
                                        <th>Is Transporter?</th>
                                        <th>Lead Time (Days)</th>
                                        <th>Group Name</th>
                                        <th>Contact No</th>
                                        <th>Payment Term</th>
                                        <th>Tax Identification No</th>
                                        <th>Account Payable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(supplier, index) in supplierList" :key="supplier.uuid" class="tb-tnx-supplier">
                                        <td>
                                        
                                            <a href="javascript:void(0)"  @click="ROUTE({path: '/suppliers/' + supplier.uuid })" class="btn btn-sm btn-light"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript:void(0)"  @click="remove(supplier)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                        
                                        </td>
                                        <td><span class="">{{ (index + 1) }}</span></td>
                                        <td><span class="">{{supplier.business_name}}</span></td>
                                        <td><span class="">{{supplier.business_shortname}}</span></td>
                                        <td><span class="">{{supplier.check_payee}}</span></td>
                                        <td v-if="supplier.is_transporter === 1">Yes</td>
                                        <td v-else>No</td>
                                        <td><span class="">{{supplier.lead_time}}</span></td>
                                        <td>
                                            <span v-if="supplier.supplier_group">{{supplier.supplier_group.group_name }}</span>
                                            <span v-else></span>
                                        </td>
                                        <td><span class="">{{supplier.contact_no}}</span></td>
                                        <td>
                                            <span v-if="supplier.payment_term">{{supplier.payment_term.term }}</span>
                                            <span v-else></span>
                                        </td>
                                        <td><span class="">{{supplier.tax_identification_no}}</span></td>
                                        <td>
                                            <span v-if="supplier.account_payable">{{supplier.account_payable.account_name }}</span>
                                            <span v-else></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav v-if="supplierListTotalPages > 1" class="pagination pagination-rounded justify-content-center mt-4" aria-label="pagination">
                                <ul class="pagination">
                                    <li @click="supplierListPaginate('prev')"  v-bind:class="{'disabled' : supplierListCurrentPage <= 1}"  class="page-item" >
                                        <a href="javascript:void(0)" class="page-link" aria-label="Previous">
                                            <span aria-hidden="true">‹</span><span class="sr-only">Previous</span>
                                        </a>
                                    </li>

                                    
                                    <li @click="supplierListPaginate(page)" v-for="page in supplierListTotalPages" :key="page" class="page-item" v-bind:class="{'active' : page === supplierListCurrentPage}">
                                        <a href="javascript:void(0)" class="page-link">
                                            {{ page }}
                                        </a>
                                    </li>
                                    
                                    <li @click="supplierListPaginate('next')" v-bind:class="{'disabled' : supplierListCurrentPage >= supplierListTotalPages}" class="page-item">
                                        <a href="javascript:void(0)" class="page-link" aria-label="Next"><span aria-hidden="true">›</span><span class="sr-only">Next</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    name: 'supplier-list',
    props: ['properties'],

    data: function () {
        return {
            supplierListLoading: true,
            supplierList: [],
            supplierListCurrentPage: 1,
            supplierListItemPerPage: 20,
            supplierListCount: 0,
            searchKeyword: '',
            timer: null
        }
    },
    computed: {
        supplierListTotalPages: function () {
            var scope = this
            var pages = Math.ceil(scope.supplierListCount / scope.supplierListItemPerPage)
            return pages
        }
    },
    watch: {

    },
    methods: {
        getSupplierList: function () {
            var scope = this
            scope.supplierListLoading = true
            scope.supplierList = []
            scope.GET('suppliers/supplier-list?keyword=' + scope.searchKeyword + '&page=' + scope.supplierListCurrentPage + '&take=' + scope.supplierListItemPerPage).then(res => {
                scope.supplierList = res.rows
                scope.supplierListLoading = false
                scope.supplierListCount = res.count
            })
        },
        create: function () {
            var scope = this

            scope.POST('suppliers/supplier-list', scope.formdata).then(res => {
                if (res.success) {
                   scope.ROUTE({path: '/suppliers/' + res.data.uuid })
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
                scope.getSupplierList()
            }, 800);
            
        },
        supplierListPaginate: function(page) {
            var scope = this
        
            if (page === 'prev') {
                scope.supplierListCurrentPage = scope.supplierListCurrentPage - 1
            } else if (page === 'next') {
                scope.supplierListCurrentPage = scope.supplierListCurrentPage + 1
            } else {
                scope.supplierListCurrentPage = page
            }

            if (scope.supplierListCurrentPage < 1) {
                scope.supplierListCurrentPage = 1
                return
            } else  if (scope.supplierListCurrentPage > scope.supplierListTotalPages) {
                scope.supplierListCurrentPage =  scope.supplierListTotalPages
                return
            }

            scope.getSupplierList()
        },
        changeSupplierListItemPerPage: function () 
        {
            var scope = this
            scope.supplierListCurrentPage = 1
            scope.getSupplierList()
        }
    },
    mounted() {
        var scope = this
        scope.getSupplierList() 
    },
}
</script>

<style scoped>
    .table-tranx { table-layout: auto; }
    .table-fixed-column { position:absolute; }
    .form-group { margin-top:10px !important; }
</style>