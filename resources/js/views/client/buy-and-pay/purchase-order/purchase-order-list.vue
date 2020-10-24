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
                <div>
                    <button @click="OPEN_MODAL('#modalReasonCodeMain');" class="hx-btn hx-btn-shineblue"><i class="las la-plus"></i>Reason Codes</button>
                </div>
                <br>

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
                                <a href="javascript:void(0)"  @click="ROUTE({path: '/purchase-orders/' + purchase.uuid })" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-pencil"></i></a>
                                </span>
                            </td>
                            <td width="50">{{ (index + 1) }}</td>
                            <td width="200">{{ purchase.po_no }}</td>
                            <td width="100">{{ purchase.date_purchased }}</td>
                            <td class="text-center">{{ purchase.supplier.supplier_shortname }}</td>
                            <td v-if="purchase.po_total_amount == 0" class="text-right">0.00</td>
                            <td v-else class="text-right">{{putSeparator(purchase.po_total_amount)}}</td>
                            <td v-if="purchase.status === 'Open'" style="text-align:center;" class="editable">
                                <span class="badge badge-pill badge-soft-success font-size-12">Open</span>
                            </td>
                            <td v-else style="text-align:center;" class="editable">
                                <span class="badge badge-pill badge-soft-danger font-size-12">Closed</span>
                            </td>
                            <td>None</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

                <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalReasonCodeMain">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reason Codes</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalReasonCodeMain');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <reason-codes></reason-codes>
                    </div>
                </div>
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
                console.log('naa ko sa list')
                console.log(res.rows)
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
                        text: data.reason_code
                    })
                
                })

                $(".form-reason-codes").select2({data: scope.options_reason_code});
                
                scope.selected_reason_code = scope.options_reason_code[0].id
            })

        },

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