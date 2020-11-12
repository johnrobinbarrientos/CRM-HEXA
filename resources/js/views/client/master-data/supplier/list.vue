<template>
    <div>
        <div v-show="show_preloader">
            <Spinner />
        </div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i> Supplier List</h1>
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
            <table class="table table-bordered">
                <thead class="th-nowrap">
                    <tr>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Supplier Name</th>
                        <th>Supplier Shortname</th>
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
                    <tr v-for="(supplier, index) in supplierList" :key="supplier.uuid">
                        <td width="100">
                            <span class="w-65px d-block mx-auto">
                                <a href="javascript:void(0)" @click="ROUTE({path: '/suppliers/' + supplier.uuid })" class="btn btn-sm btn-shineblue" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                <a href="javascript:void(0)" @click="ROUTE({path: '/suppliers/' + supplier.uuid + '/view' })" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-eye" title="View"></i></a>
                            </span>
                        </td>
                        <td><span class="">{{ (index + 1) }}</span></td>
                        <td><span class="">{{supplier.supplier_name}}</span></td>
                        <td><span class="">{{supplier.supplier_shortname}}</span></td>
                        <td v-if="supplier.is_transporter === 1">Yes</td>
                        <td v-else>No</td>
                        <td class="text-right">{{supplier.lead_time}}</td>
                        <td>
                            <span v-if="supplier.supplier_group">{{supplier.supplier_group.group_name }}</span>
                            <span v-else></span>
                        </td>
                        <td class="text-right">{{supplier.contact_no}}</td>
                        <td>
                            <span v-if="supplier.payment_term">{{supplier.payment_term.term }}</span>
                            <span v-else></span>
                        </td>
                        <td class="text-right">{{supplier.tax_identification_no}}</td>
                        <td>
                            <span v-if="supplier.account_payable">{{supplier.account_payable.account_name }}</span>
                            <span v-else></span>
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
</template>

<script>
import Swal from 'sweetalert2'

export default {
    name: 'supplier-list',
    props: ['properties'],

    data: function () {
        return {
            show_preloader: true,

            supplierList: [],
            supplier_data: [],
            show_view: false,
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null
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
        getSupplierList: function () {
            var scope = this
            scope.listLoading = true
            scope.supplierList = []
            scope.GET('suppliers/supplier-list?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.supplierList = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        create: function () {
            var scope = this

            scope.POST('suppliers/supplier-list').then(res => {
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

            scope.getSupplierList()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getSupplierList()
        }
    },
    mounted() {
        var scope = this
        scope.getSupplierList()

        setTimeout(function(){ scope.show_preloader = false },2000)
    },
}
</script>

<style scoped>
    .table-tranx { table-layout: auto; }
    .table-fixed-column { position:absolute; }
    .form-group { margin-top:10px !important; }
</style>