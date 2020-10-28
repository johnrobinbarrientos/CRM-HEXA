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
                                <span v-if="purchase.order_reason_code==null">None <i class="bx bx-pencil"></i></span>
                                <span v-else>{{ purchase.order_reason_code.details }} <i class="bx bx-pencil"></i></span>
                                <select @change="changeReasonCode(purchase.uuid)" v-model="selected_reason_code" type="text" class="editable-control">
                                    <option :value="reasoncode.id " v-for="(reasoncode,index) in options_reason_code" :key="index">{{ reasoncode.text }}</option>
                                </select>
                            </td>
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

            purchaseOrders: []
        }
    },
    components: {
        'reason-codes': ReasonCodes,
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