<template>
    <div>
        <div>
            <div class="row">
                <div class="col-6 col-lg-6">
                    <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                </div>
            </div>
        </div>
        <br>
        <div>
            <table class="table table-bordered table-hover table-striped">
                    <thead class="th-nowrap">
                        <tr>
                            <th>Action</th>
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
                    <tbody class="td-border-bottom-black">
                        <template v-if="toReceive.length > 0">
                            <tr v-for="(purchase) in toReceive" :key="purchase.uuid">
                                <template v-if="purchase.po_status !== 'Cancelled'">
                                    <td width="100" style="text-align:center;">
                                        <b-button @click="ROUTE({path: '/buy-and-pay/receipts/' + purchase.uuid + '/edit'})" type="button" size ="sm" class="m-2">Receive</b-button>
                                    </td>
                                    <td width="100">{{ purchase.item_group.item_group }}</td>
                                    <td width="200">{{ purchase.po_no }}</td>
                                    <td width="200" class="text-center">{{ purchase.supplier.supplier_shortname }}</td>
                                    <td width="100">{{ purchase.branch.branch_shortname.toUpperCase() }}</td>
                                    <td>{{ purchase.branch_location.location_shortname.toUpperCase() }}</td>
                                    <td width="100">{{ FORMAT_DATE(purchase.date_purchased) }}</td>

                                    <td v-if="purchase.po_total_amount == 0" class="text-right">0.00</td>
                                    <td v-else class="text-right">{{PUT_SEPARATOR(purchase.po_total_amount.toFixed(2))}}</td>

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
                                        <span v-if="purchase.order_reason_code==null">None</span>
                                        <span v-else>{{ purchase.order_reason_code.short_name }}</span>
                                    </td>
                                </template>
                            </tr>
                            <tr>
                                <td colspan="6"></td>
                                <td style="border-left: 2px solid #eee">
                                    <span><strong>Total:</strong></span>
                                </td>
                                <td class="text-right">
                                    <span v-if="grand_total==0"><strong>0.00</strong></span>
                                    <span v-else><strong>{{PUT_SEPARATOR(grand_total.toFixed(2))}}</strong></span>
                                </td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="11">
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

            toReceive: [],
            grand_total: 0,

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
        getToReceive: function () {
           var scope = this
            scope.listLoading = true
            scope.toReceive = []
            scope.GET('buy-and-pay/orders?type=to-receive&keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.toReceive = res.rows
                scope.grand_total = res.grand_total

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
                scope.getToReceive()
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

            scope.getToReceive()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getToReceive()
        }

    },
    mounted() {
        var scope = this
        scope.getToReceive()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

.td-border-bottom-black tr:nth-last-child(3) td { border-bottom-color: #495057 !important; }
.td-border-bottom-black tr:nth-last-child(2) td { border-bottom-color: #495057 !important; }
</style>