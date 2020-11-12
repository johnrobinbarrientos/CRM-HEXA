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
                            <th>Action</th>
                            <th>#</th>
                            <th>Item Type</th>
                            <th>Transaction No.</th>
                            <th>Supplier Name</th>
                            <th>Branch</th>
                            <th>Location</th>
                            <th>Transaction Date</th>
                            <th>Expected Date</th>
                            <th>Amount</th>
                            <th>Payment Term</th>

                            <th>Status</th> 
                            <th>Reason Code</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(purchase, index) in purchaseOrders" :key="purchase.uuid">
                            <td width="100" style="text-align:center;">
                                <span class="w-65px d-block mx-auto">
                                <a v-if ="purchase.po_status =='To Receive'" href="javascript:void(0)"  @click="ROUTE({path: '/purchase-orders/' + purchase.uuid })" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-pencil"></i></a>
                                <a href="javascript:void(0)" @click="ROUTE({path: '/purchase-orders/' + purchase.uuid + '/view' })" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-eye" title="View"></i></a>
                                </span>
                            </td>
                            <td width="50">{{ (index + 1) }}</td>
                            <td width="100">{{ purchase.item_group.item_group }}</td>
                            <td width="200">{{ purchase.po_no }}</td>
                            <td class="text-center">{{ purchase.supplier.supplier_shortname }}</td>
                            <td>{{ purchase.branch.branch_name.toUpperCase()}}</td>
                            <td>{{ purchase.branch_location.location_shortname.toUpperCase()}}</td>
                            <td width="100">{{ moment(purchase.date_purchased) }}</td>
                            <td>{{ moment(purchase.date_expected) }}</td>

                            <td v-if="purchase.po_total_amount == 0" class="text-right">0.00</td>
                            <td v-else class="text-right">{{putSeparator(purchase.po_total_amount)}}</td>
                            
                            <td v-if="purchase.term > 1" class="text-center">{{ purchase.term }} Days</td>
                            <td v-else-if ="purchase.term === 1" class="text-center">{{ purchase.term }} Day</td>
                            <td v-else></td>
                            
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
                                <span v-if="purchase.order_reason_code==null">None <i class="bx bx-pencil"></i></span>
                                <span v-else>{{ purchase.order_reason_code.short_name }} <i class="bx bx-pencil"></i></span>
                                <select @change="changeReasonCode(purchase.uuid)" v-model="selected_reason_code" type="text" class="editable-control">
                                    <option :value="reasoncode.id " v-for="(reasoncode,index) in options_reason_code" :key="index">{{ reasoncode.text }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
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
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
import ReasonCodes from './purchase-order-reason-codes'
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
            grand_total: 0,
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
        }
    },
    components: {
        'reason-codes': ReasonCodes,
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
        getPurchaseOrders: function () {
           var scope = this

            scope.listLoading = true
            scope.purchaseOrders = []
            scope.GET('buy-and-pay/orders?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.purchaseOrders = res.rows
                scope.grand_total = res.grand_total

                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        getReasonCodes: function () {
           var scope = this

           scope.options_reason_code.push({
               id: '',
               text: 'None'
           });

            scope.GET('buy-and-pay/order-reason-code').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_reason_code.push({
                        id: data.uuid,
                        text: data.details
                    })
                
                })
            })

        },
        changeReasonCode: function (po_uuid) {
            var scope = this

            window.swal.fire({
                title: 'Update Record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('buy-and-pay/order/reason-code', {uuid: po_uuid, orders_reason_code_uuid: scope.selected_reason_code}).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Successfuly Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getPurchaseOrders()
                            })
                        } else {
                            alert('ERROR:' + res.code)
                        }
                    })
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
        scope.getReasonCodes()

        $('.form-reason-codes').on("change", function(e) { 
            scope.selected_reason_code = $('.form-reason-codes').val();
        })
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>