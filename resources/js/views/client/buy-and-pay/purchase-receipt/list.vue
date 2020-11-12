<template>
    <div>
        <div class="hx-tab">

            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title">Item Receipts</h1>
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
                        <!-- <a @click="ROUTE({path: '/purchase-orders/create' });" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                            <i class="las la-plus"></i> <span>New</span>
                        </a> -->
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalPurchaseList')" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                            <i class="las la-plus"></i> <span>New</span>
                        </a>

                    </div>
            </div>

            <div v-if="listLoading" class="text-center my-3 text-loader">
                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
            </div>

            <div v-else class="table-responsive;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>#</th>
                            <th>Item Type</th>
                            <th>Transaction No</th>
                            <th>Supplier Name</th>
                            <th>Branch</th>
                            <th>Location</th>
                            <th>Transaction Date</th>
                            <th>Amount</th>
                            <th>Status</th> 
                            <th>Reason Code</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(purchase, index) in receivedOrders" :key="purchase.uuid">
                            <template v-if="purchase.po_status !== 'Cancelled'">
                                <td width="100" style="text-align:center;">
                                    <span class="w-65px d-block mx-auto">
                                    <a v-if="purchase.po_status === 'To Receive'" href="javascript:void(0)"  @click="ROUTE({path: '/purchase-receipt-details/' + purchase.uuid })" class="btn btn-sm hx-btn-shineblue"><i class="las la-cart-plus"></i></a>
                                    <a href="javascript:void(0)" @click="ROUTE({path: '/purchase-orders/' + purchase.uuid + '/view' })" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-eye" title="View"></i></a>
                                    </span>
                                </td>
                                <td width="50">{{ (index + 1) }}</td>
                                <td width="100">{{ purchase.item_group.item_group }}</td>
                                <td width="150">{{ purchase.receive_no }}</td>
                                <td width="200" class="text-center">{{ purchase.supplier.supplier_shortname }}</td>
                                <td width="100">{{ purchase.branch.branch_name.toUpperCase() }}</td>
                                <td>{{ purchase.branch_location.location_shortname.toUpperCase() }}</td>
                                <td width="100">{{ purchase.date_received }}</td>

                                <td v-if="purchase.po_total_amount == 0" class="text-right">0.00</td>
                                <td v-else class="text-right">{{putSeparator(purchase.po_total_amount)}}</td>

                                <td v-if="purchase.po_status === 'To Receive'" style="text-align:center;" class="editable" width="150">
                                    <span class="badge badge-danger font-size-12">To Receive</span>
                                </td>
                                <td v-else-if="purchase.po_status === 'Partially Received'" style="text-align:center;" class="editable">
                                    <span class="badge badge-warning font-size-12">Partially Received</span>
                                </td>
                                <td v-else-if="purchase.po_status === 'Cancelled'" style="text-align:center;" class="editable">
                                    <span class="badge badge-secondary font-size-12">Cancelled</span>
                                </td>
                                <td v-else-if="purchase.po_status === 'Fully Received'" style="text-align:center;" class="editable">
                                    <span class="badge badge-success font-size-12">Fully Received</span>
                                </td>

                                <td class="editable text-center">

                                </td>
                            </template>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" tabindex="-1" id="modalPurchaseList">
            <div class="modal-dialog modal-lg " role="document" style="max-width: 1100px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Purchase Orders</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalPurchaseList');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <search-to-receive></search-to-receive>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'
import SearchToReceive from './search-to-receive'

export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {
            selected_reason_code: null,
            options_reason_code: [],

            receivedOrders: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
        }
    },
    components: {
        'search-to-receive': SearchToReceive
    },
    computed: {
        listTotalPages: function () {
            var scope = this
            var pages = Math.ceil(scope.listCount / scope.listItemPerPage)
            return pages
        }
    },
    methods: {
        putSeparator: function(value) {
            var num_parts = value.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        },
        getReceivedOrders: function () {
           var scope = this
            scope.listLoading = true
            scope.receivedOrders = []
            scope.GET('buy-and-pay/received?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.receivedOrders = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getReceivedOrders()
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

            scope.getReceivedOrders()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getReceivedOrders()
        }

    },
    mounted() {
        var scope = this
        scope.getReceivedOrders()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>