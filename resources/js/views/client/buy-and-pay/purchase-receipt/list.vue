<template>
    <div>
        <div class="hx-tab">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Purchase Orders</h1>
                </div>
                <div class="bar-right">
                    <input type="text" class="form-control" placeholder="Search Item">
                    <a @click="ROUTE({path: '/purchase-orders/create' });" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-plus"></i> <span>New</span>
                    </a>
                </div>
            </div>

            <div class="table-responsive;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>#</th>
                            <th>PO No.</th>
                            <th>PO Date</th>
                            <th>Supplier</th>    
                            <th>Amount</th> 
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
                            <td width="200">{{ purchase.po_no }}</td>
                            <td width="100">{{ purchase.date_purchased }}</td>
                            <td class="text-center">{{ purchase.supplier.supplier_shortname }}</td>
                            <td v-if="purchase.po_total_amount == 0" class="text-right">0.00</td>
                            <td v-else class="text-right">{{putSeparator(purchase.po_total_amount)}}</td>
                            <td v-if="purchase.po_status === 'PENDING RECEIPT'" style="text-align:center;" class="editable">
                                <i class="mdi mdi-circle text-danger align-middle mr-1"></i><span>PENDING RECEIPT</span>
                            </td>
                            <td v-else-if="purchase.po_status === 'PARTIALLY RECIEVED'" style="text-align:center;" class="editable">
                                <i class="mdi mdi-circle text-warning align-middle mr-1"></i><span>PARTIALLY RECIEVED</span>
                            </td>
                            <td v-else-if="purchase.po_status === 'COMPLETED'" style="text-align:center;" class="editable">
                                <i class="mdi mdi-circle text-success align-middle mr-1"></i><span>COMPLETED</span>
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
    name: 'purchase-reciept',
    props: ['properties'],
    data: function () {
        return {
            purchaseOrders: []
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
            scope.GET('buy-and-pay/orders').then(res => {
                scope.purchaseOrders = res.rows
                console.log(scope.purchaseOrders)
            })
        },

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