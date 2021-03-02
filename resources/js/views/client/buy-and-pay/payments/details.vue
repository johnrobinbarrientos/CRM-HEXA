<template>
    <div v-if="is_ready">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><!--<i class="las la-list-ul"></i>--> New Payment Entry</h1>
                </div>
                <div class="bar-right">
                    <a @click="ROUTE({path: '/buy-and-pay/payments' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-x"></i> <span>Cancel</span>
                    </a>
                    <a @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-saves"></i> <span>Save</span>
                    </a>
                </div>
            </div>
                    
            <div class="card hx-card-override no-header card-1200">
                <div class="card-body">
 
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Entry Type</label>
                                        <select v-model="formdata.entry_type" class="form-control">
                                            <option value="Pay">Pay</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Mode</label>
                                        <select v-model="formdata.pe_mode" class="form-control">
                                            <option value="Cash">Cash</option>
                                            <option value="Check">Check</option>
                                            <option value="Direct to Bank">Direct to Bank</option>
                                            <option value="Adjustment +">Adjustment +</option>
                                            <option value="Adjustment -">Adjustment -</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-select-supplier" v-model="formdata.supplier_uuid" :options="options_supplier" name="supplier"></select>
                                    </div>
                                </div>

                                
                                

                                <template v-if="formdata.pe_mode == 'Check'">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Check No.</label>
                                            <input v-model="formdata.check_no" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="date-terminated">Check Date</label>
                                            <div class="form-control-wrap">
                                                <date-picker v-model="formdata.check_date" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                
                            </div>

                        </div>
                        <div class="col-12 col-md-4">
                            
                            <div class="form-group">
                                <label>Amount</label>
                                <input v-model="formdata.amount" type="text" class="form-control">
                            </div>
                         
                        </div>
                    </div>
                    

                    <hr/>


                    <table class="table table-bordered table-hover table-striped">
                        <thead class="th-nowrap">
                            <tr>
                                <th>Transaction No</th>
                                <th>Item Type</th>
                                <th>Supplier Name</th>
                                <th>Transaction Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody class="td-border-bottom-black">
                          
                                <tr v-for="(bill) in bills" :key="bill.uuid">
                                    <td width="150">{{ bill.transaction_no }}</td>
                                    <td width="100">{{ bill.transaction_type }}</td>
                                    
                                    <td width="200">{{ payment.supplier.supplier_name }}</td>
                                    <td width="150">{{ bill.transaction_date }}</td>
                                    <td width="100" v-if="bill.po_total_amount == 0" class="text-right">0.00</td>
                                    <td width="100" v-else class="text-right">{{PUT_SEPARATOR(bill.amount)}}</td>

                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4">
                                        <span><strong>Grand Total:</strong></span>
                                    </td>
                                    <td class="text-right">
                                        <span v-if="GRAND_TOTAL==0"><strong>0.00</strong></span>
                                        <span v-else><strong>{{ PUT_SEPARATOR( parseFloat(GRAND_TOTAL).toFixed(2) )}}</strong></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <div style="margin-bottom: 2px;"></div>
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

export default {
    name: 'purchase-order-form',
    props: ['form','order','view_mode'],
    data: function () {
        return {
            edit: false,
            //ready: false,
            prerequisite: {
                getBillsBySupplier: false,
                getSupplier: false,
                getPaymentDetails: false,
            },
            

            selected_supplier: [],
            options_supplier: [],

            formdata: {
                amount: 0.00,
                entry_type: 'Pay',
                supplier_uuid: null,
                pe_mode: 'Cash',
                check_no: '',
                check_date: '',
                bills: []
            },
            payment: null,
            bills: [],
            selected_bills: [],
            GRAND_TOTAL: 0
        }
    },
    computed: {
        is_ready: function () {
            var scope = this
            return (scope.getPaymentDetails) ? true : false
        }
    },
    methods: {
        toggleSelectedBill: function (bill) {
            var scope = this

            var index = scope.selected_bills.indexOf(bill.uuid);
            if (index !== -1) {
                scope.selected_bills.splice(index, 1);
                scope.GRAND_TOTAL -= parseFloat(bill.amount)
            } else {
                scope.selected_bills.push(bill.uuid)
                scope.GRAND_TOTAL += parseFloat(bill.amount)
            }

            return
        },
        getSupplier: function () {
           var scope = this
            scope.GET('suppliers').then(res => {

                res.rows.forEach(function (data) {

                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.supplier_shortname,
                        lead_time: data.lead_time,
                        vat_uuid: data.vat_uuid
                    })
                
                })
       
                $(".form-select-supplier").select2({data: scope.options_supplier});
                var supplier_uuid =  scope.options_supplier[0].id
                scope.formdata.supplier_uuid = supplier_uuid
                scope.getBillsBySupplier(supplier_uuid)

                scope.prerequisite.getSupplier = true
                
            })
        },
        getBillsByPayment: function (payment_uuid) {
           var scope = this
            scope.listLoading = true
            scope.bills = []
       
            scope.GET('buy-and-pay/payments/' + payment_uuid + '/bills').then(res => {
                scope.bills = res.rows

                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results

                scope.prerequisite.getBillsBySupplier = true
                
            })
        },
        getPaymentDetails: function (payment_uuid) {
            var scope = this
            scope.GET('buy-and-pay/payments/' + payment_uuid ).then(res => {
                scope.payment = res.data
                scope.bills = res.billings

                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results

                scope.prerequisite.getPaymentDetails = true
                
            })
        },
        save: function () {
            var scope = this

            scope.formdata.bills = scope.selected_bills
            scope.POST('buy-and-pay/payments', scope.formdata).then(res => {

                if (res.success) {
                    if (!scope.$props.order) {
                        scope.ROUTE({path: '/buy-and-pay/payments'})
                    } 
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        }
    },
    mounted() {
        var scope = this
        var payment_uuid = scope.$route.params.payment_uuid;
        scope.ACTION = scope.$route.params.action;
        scope.getPaymentDetails(payment_uuid)

        return

        //  scope.getSupplier()


        $('.form-select-supplier').on("change", function(e) { 
            var supplier_uuid = $('.form-select-supplier').val();
            scope.formdata.supplier_uuid = supplier_uuid
            scope.getBillsBySupplier(supplier_uuid)
            scope.selected_bills = []
        })

      
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>