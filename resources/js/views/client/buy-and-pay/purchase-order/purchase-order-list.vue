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

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="90">Actions</th>
                            <th width="100">#</th>
                            <th>PO No.</th>
                            <th>PO Date</th>
                            <th>Supplier</th>    
                            <th>Amount</th> 
                            <th>Status</th> 
                            <th>Reason Code</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(purchase, index) in purchaseOrders" :key="purchase.uuid" class="tb-tnx-item">
                            <td>
                                <a href="javascript:void(0)"  @click="ROUTE({path: '/purchase-orders/' + purchase.uuid })" class="btn btn-sm hx-btn-shineblue">
                                    <i class="mdi mdi-eye"></i>
                                </a>
                            </td>
                            <td>{{ (index + 1) }}</td>
                            <td>{{ purchase.po_no }}</td>
                            <td>{{ purchase.date_purchased }}</td>
                            <td>{{ purchase.supplier.business_shortname }}</td>
                            <td class="text-right">0.00</td>
                            <td>{{ purchase.status }}</td>
                            <td>None</td>
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
            purchaseOrders: [],
        }
    },
    methods: {
        getPurchaseOrders: function () {
           var scope = this
            scope.GET('buy-and-pay/orders').then(res => {
                scope.purchaseOrders = res.rows
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