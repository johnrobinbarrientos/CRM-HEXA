<template>
    <div>
        <div class="hx-tab">

            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title">Purchase Orders</h1>
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
                        <a @click="ROUTE({path: '/purchase-orders/create' });" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
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
                            <th>Actions</th>
                            <th>#</th>
                            <th>PR Type</th>
                            <th>Reference No</th>
                            <th>Transaction No</th>
                            <th>Supplier Name</th>
                            <th>Branch</th>
                            <th>PO Date</th>
                            <th>Expected Date</th>
                            <th>Received Date</th>
                                
                            <th>PO Amount</th>
                            <th>Memo</th> 
                            <th>Status</th> 
                            <th>Reason Code</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(purchase, index) in purchaseOrders" :key="purchase.uuid">
                            <td width="100" style="text-align:center;">
                                <span class="w-65px d-block mx-auto">
                                <a v-if ="purchase.po_status =='PENDING RECEIPT'" href="javascript:void(0)"  @click="ROUTE({path: '/purchase-orders/' + purchase.uuid })" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-pencil"></i></a>
                                <a href="javascript:void(0)" @click="ROUTE({path: '/purchase-orders/' + purchase.uuid + '/view' })" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-eye" title="View"></i></a>
                                </span>
                            </td>
                            <td width="50">{{ (index + 1) }}</td>
                            <td width="100">{{ purchase.item_group.item_group }}</td>
                            <td width="200">{{ purchase.po_no }}</td>
                            <td width="200">{{ purchase.receive_no }}</td>
                            <td class="text-center">{{ purchase.supplier.supplier_shortname }}</td>
                            <td>{{ purchase.branch.branch_name }}</td>
                            <td width="100">{{ purchase.date_purchased }}</td>
                            <td width="100">{{ purchase.date_expected }}</td>
                            <td width="100">{{ purchase.date_received }}</td>

                            <td v-if="purchase.po_total_amount == 0" class="text-right">0.00</td>
                            <td v-else class="text-right">{{putSeparator(purchase.po_total_amount)}}</td>

                            <td>{{ purchase.memo }}</td>

                            <td v-if="purchase.po_status === 'PENDING RECEIPT'" style="text-align:center;" class="editable">
                                <i class="mdi mdi-circle text-danger align-middle mr-1"></i><span>PENDING RECEIPT</span>
                            </td>
                            <td v-else-if="purchase.po_status === 'PARTIALLY RECEIVED'" style="text-align:center;" class="editable">
                                <i class="mdi mdi-circle text-warning align-middle mr-1"></i><span>PARTIALLY RECEIVED</span>
                            </td>
                            <td v-else-if="purchase.po_status === 'CANCELLED'" style="text-align:center;" class="editable">
                                <i class="mdi mdi-circle text-muted align-middle mr-1"></i><span>CANCELLED</span>
                            </td>
                            <td v-else-if="purchase.po_status === 'FULLY RECEIVED'" style="text-align:center;" class="editable">
                                <i class="mdi mdi-circle text-success align-middle mr-1"></i><span>FULLY RECEIVED</span>
                            </td>

                            
                            <!-- <td>None</td> -->
                            <td class="editable text-center">

                            </td>
                        </tr>
                    </tbody>
                </table>
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
            selected_reason_code: null,
            options_reason_code: [],

            purchaseOrders: [],
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
        putSeparator: function(value) {
            var num_parts = value.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        },
        getPurchaseOrders: function () {
           var scope = this
            scope.listLoading = true
            scope.purchaseOrders = []
            scope.GET('buy-and-pay/orders?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.purchaseOrders = res.rows
                scope.listLoading = false
                scope.listCount = res.count
                console.log(scope.purchaseOrders)
            })
        },
        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getPurchaseOrders()
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

            scope.getPurchaseOrders()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getPurchaseOrders()
        }

    },
    mounted() {
        var scope = this
        scope.getPurchaseOrders()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>