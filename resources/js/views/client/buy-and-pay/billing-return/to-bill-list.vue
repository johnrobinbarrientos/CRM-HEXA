<template>
    <div>
        <div style="margin-top:5px;" >
            <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
        </div>
        <br>
        <div class="table-responsive;">
            <table class="table table-bordered">
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
                    <tr v-for="(purchase, index) in toBill" :key="purchase.uuid">
                        <template v-if="purchase.po_status !== 'Cancelled'">
                            <td width="100" style="text-align:center;">
                                <span class="w-65px d-block mx-auto">
                                <a href="javascript:void(0)"  @click="ROUTE({path: '/buy-and-pay/bills/' + purchase.uuid + '/view'})" class="btn btn-sm hx-btn-shineblue">Bill</a>
                                </span>
                            </td>
                            <td width="50">{{ (index + 1) }}</td>
                            <td width="100">{{ purchase.item_group.item_group }}</td>
                            <td width="150">{{ purchase.receiving_no }}</td>
                            <td width="200" class="text-center">{{ purchase.supplier.supplier_shortname }}</td>
                            <td width="100">{{ purchase.branch.branch_name.toUpperCase() }}</td>
                            <td>{{ purchase.branch_location.location_shortname.toUpperCase() }}</td>
                            <td width="100">{{ moment(purchase.date_purchased) }}</td>

                            <td v-if="purchase.po_total_amount == 0" class="text-right">0.00</td>
                            <td v-else class="text-right">{{putSeparator(purchase.po_total_amount)}}</td>

                            <td v-if="purchase.receiving_status === 'To Bill'" style="text-align:center;" class="editable" width="150">
                                <span class="badge badge-danger font-size-12">To Bill</span>
                            </td>
                            <td v-else-if="purchase.receiving_status === 'Billed'" style="text-align:center;" class="editable">
                                <span class="badge badge-success font-size-12">Billed</span>
                            </td>

                            <td class="editable text-center">
                                <span>{{ purchase.receiving_reason_code }}</span>
                            </td>
                        </template>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span><strong>Grand Total:</strong></span>
                        </td>
                        <td>
                            <span v-if="grand_total==0"><strong>0.00</strong></span>
                            <span v-else><strong>{{putSeparator(grand_total)}}</strong></span>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'buy-and-pay-billing-to-bill-list',
    props: ['properties'],
    data: function () {
        return {
            selected_reason_code: null,
            options_reason_code: [],

            toBill: [],
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
        moment: function (date) {
            return moment(date).format('DD-MMM-YYYY')
        },
        putSeparator: function(value) {
            var num_parts = value.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        },

        getToBill: function () {
           var scope = this
            scope.listLoading = true
            scope.toBill = []
            scope.GET('buy-and-pay/to-bill?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.toBill = res.rows
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
                scope.getToBill()
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

            scope.getToBill()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getToBill()
        }

    },
    mounted() {
        var scope = this
        scope.getToBill()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>