<template>
    <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i>Payments</h1>
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
                        <a href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/payments/create' });" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                            <i class="las la-plus"></i> <span>New</span>
                        </a>

                    </div>
            </div>

            <div v-if="listLoading" class="text-center my-3 text-loader">
                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
            </div>

            <div v-else class="table-responsive;">


                <table class="table table-bordered table-hover table-striped">
                    <thead class="th-nowrap">
                        <tr>
                            <th width="105">Action</th>
                            
                            <th>Transaction No</th>
                            <th>Transaction Date</th>
                            <th>Entry Type</th>
                            <th>Mode</th>
                            <th>Supplier Name</th>
                            <th>Amount</th>
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody class="td-border-bottom-black">
                        <template v-if="billedOrders.length > 0">
                            <tr v-for="(purchase) in billedOrders" :key="purchase.uuid">
                                <template v-if="purchase.po_status !== 'Cancelled'">
                                    <td width="100" style="text-align:center;">
                                        <b-dropdown v-if="purchase.transaction_type == 'Expenses' && purchase.status == 'To Pay'"  split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/bills/' + purchase.uuid + '/edit' })">
                                            <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/bills/' + purchase.uuid + '/edit'})">Edit</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/bills/' + purchase.uuid + '/view' })">View</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="cancel(purchase.uuid)">Cancel</b-dropdown-item>
                                        </b-dropdown>
                                        <b-dropdown v-else  split text="View" size ="sm" class="m-2" href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/bills/' + purchase.uuid + '/view' })">
                                            <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/bills/' + purchase.uuid + '/view' })">View</b-dropdown-item>
                                        </b-dropdown>
                                    </td>
                                    
                                    <td width="200">{{ purchase.transaction_no }}</td>
                                    <td width="150">{{ moment(purchase.date) }}</td>
                                    <td width="100">{{ purchase.entry_type }}</td>
                                    <td width="100">{{ purchase.pe_mode }}</td>
                                    <td width="200">{{ purchase.supplier.supplier_name }}</td>
                                   

                                    <td width="100" v-if="purchase.amount == 0" class="text-right">0.00</td>
                                    <td width="100" v-else class="text-right">{{ PUT_SEPARATOR(purchase.amount) }}</td>

                                    <td v-if="purchase.status === 'To Release'" style="text-align;" class="editable" width="150">
                                        <span class="badge badge-danger font-size-12">To Release</span>
                                    </td>
                                    <td v-else-if="purchase.status === 'Released'" style="text-align;" class="editable" width="150">
                                        <span class="badge badge-success font-size-12">Release</span>
                                    </td>
                                    <td v-else-if="purchase.status === 'Reconciled'" style="text-align;" class="editable" width="150">
                                        <span class="badge badge-success font-size-12">Reconciled</span>
                                    </td>

        
                                </template>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td style="border-left: 2px solid #eee">
                                    <span><strong>Total:</strong></span>
                                </td>
                                <td class="text-right">
                                    <span v-if="grand_total==0"><strong>0.00</strong></span>
                                    <span v-else><strong>{{PUT_SEPARATOR(grand_total.toFixed(2))}}</strong></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <div style="margin-bottom: 2px;"></div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="11" class="text-center">
                                    <strong style="display: block; height: 30px; line-height: 30px;">No Transactions</strong>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div style="padding:10px; padding-top:20px; padding-bottom:0px;"> Showing {{ listOffset + 1  }} to {{ listOffset +  listResults }} of  {{ listCount }} entries</div>
                <nav style="float:right;" v-if="listTotalPages > 1" class="pagination pagination-rounded mt-4" aria-label="pagination">
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


        <!-- Modal -->
        <div class="modal fade" tabindex="-1" id="modalItemReceipts">
            <div class="modal-dialog modal-lg " role="document" style="max-width: 1100px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Billings</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalItemReceipts');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                       TO PAY LIST
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'


export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {

            prerequisite: {
                getBranch: false,
                getBranchLocations: false,
                getSupplierDiscountGroup: false,
                getAssetGroup: false,
                getOrderReasonCodes: false,
                getSupplier: false,
            },

            transaction_from: null,
            transaction_to: null,

            selected_item_group: '',
            options_item_group: [],

            selected_supplier: '',
            options_supplier: [],

            selected_asset_group: '',
            options_asset_group: [],

            selected_reason_code: '',

            selected_reason_code_filter: '',
            options_reason_code: [],

            selected_item_discount_group: '',
            options_item_discount_group: [],

            selected_branch: '',
            options_branch: [],

            selected_branch_location: '',
            options_branch_location: [],


            selected_status: '',

            selected_reason_code: null,
            options_reason_code: [],

            billedOrders: [],
            grand_total: 0,

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
    components: {

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
        getPayments: function () {
           var scope = this
            scope.listLoading = true
            scope.billedOrders = []

            var params = {
                item_group: scope.selected_item_group,
                supplier: scope.selected_supplier,
                reason_code: scope.selected_reason_code_filter,
                item_discount_group: scope.selected_item_discount_group,
                branch: scope.selected_branch,
                branch_location: scope.selected_branch_location,
                status: scope.selected_status,
                from: scope.transaction_from,
                to: scope.transaction_to,
            }

            var str = jQuery.param( params );

            scope.GET('buy-and-pay/payments?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage + '&' + str).then(res => {
                scope.billedOrders = res.rows
                scope.grand_total = res.grand_total

                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getPayments()
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

            scope.getPayments()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getPayments()
        },
        cancel: function (bill_uuid) {
            var scope = this

            var URL =  'buy-and-pay/bills/' + bill_uuid + '/cancel';

            window.swal.fire({
                title: 'Cancel?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                    scope.POST(URL, {}).then(res => {
                        if (res.success) {
                            scope.getPayments()
                        } else {
                            alert(res.message)
                        }
                    })
                }                              
            })
        }

    },
    mounted() {
        var scope = this
        scope.getPayments()
    },
}
</script>


<style scoped>
.table-filter { background:#f9f9f9; border:1px solid #d7d8e0; padding:0px; margin-bottom: 8px; }
.table-filter-row { display:flex; justify-content: space-evenly; }
.select-wrap { background:#e5e5ed; padding-right: 5px; border-right:1px solid #d7d8e0; width: 100%; }
.select-wrap select { padding:5px; padding-top: 6px; background:transparent; border:none; width:100%; font-size: 12px; }
.badge { font-size: 11px; }

.td-border-bottom-black tr:nth-last-child(3) td { border-bottom-color: #495057 !important; }
.td-border-bottom-black tr:nth-last-child(2) td { border-bottom-color: #495057 !important; }
</style>