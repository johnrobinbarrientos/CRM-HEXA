<template>
    <div v-if="is_ready">
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>

            <div class="card-body" >
                <div class="actions-bar">
                    <div class="w-100">
                        <h1 class="title">Billing</h1>
                    </div>
                    <div class="bar-right">
                        <span v-if="bill.transaction_type == 'Expenses'">
                            <a @click="ROUTE({path: '/buy-and-pay/bills' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                                <span>Back</span>
                            </a>
                            
                            

                            <a v-if ="!bill.uuid" @click="ROUTE({path: '/purchase-orders/' + bill.uuid })" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                                <span>Bill</span>
                            </a>

                            <a v-if ="bill.uuid && ACTION == 'edit'"  @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                                <span>Update</span>
                            </a>

                            <a v-if="bill.uuid &&  bill.status =='To Pay' && ACTION == 'view'" @click="cancel()" class="btn btn-md btn-danger waves-effect"  href="javascript:void(0)">Cancel</a>

                            <a v-if="bill.uuid &&  bill.status =='To Pay' && ACTION == 'view'"  @click="ROUTE({path: '/buy-and-pay/bills/' + bill.uuid + '/edit'})" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                                <span>Edit</span>
                            </a>
                        </span>
                        <span v-else>
                            <a @click="ROUTE({path: '/buy-and-pay/bills' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                                <span>Back</span>
                            </a>
                            <a v-if ="!bill.uuid"  @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                                <span>Bill</span>
                            </a>
                        </span>
                    </div>
                </div>

                <form action="#" class="form-validate is-alter">
                        <div v-if="bill.transaction_type == 'Expenses' && AMOUNT_TO_ALLOCATE < 0" class="alert alert-danger" ><i class="fas fa-exclamation-triangle"></i> 
                            You exceed the amount to allocate by: <strong>{{ PUT_SEPARATOR(Math.abs(AMOUNT_TO_ALLOCATE.toFixed(2))) }}</strong>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-12">

                                    <div v-if="bill.transaction_type === 'Expenses'" class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="item-group">Transaction No.</label>
                                                <input type="text" class="form-control disabled" v-model="bill.transaction_no" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="branch-name">Transaction Date</label>
                                                <div class="form-control-wrap">
                                                    <date-picker class="form-control disabled" v-model="bill.transaction_date" :config="{format: 'DD-MMM-YYYY'}" disabled></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="branch-name">Branch</label>
                                                <input type="text" class="form-control disabled" v-model="bill.branch.branch_name" readonly>
                                            </div>
                                        </div>
                                        
                                 

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="supplier">Supplier</label>
                                                <input type="text" class="form-control disabled" v-model="bill.supplier.supplier_shortname" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="row">
                                                <div class="col-md-8 col-12">
                                                     <div class="form-group">
                                                        <label class="form-label" for="supplier">Amount</label>
                                                        <input type="text" class="form-control" v-model="temp_amount" v-bind:class="{'disabled' : ACTION != 'edit'}" :disabled="ACTION != 'edit'">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <button type="button" @click="updateAmount()" style="margin-top:28px;" class="hx-btn hx-btn-shineblue" v-bind:class="{'disabled' : ACTION != 'edit'}" :disabled="ACTION != 'edit'">Apply</button>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>

                                    <div v-if="bill.transaction_type === 'Inventory'" class="row">

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="item-group">Transaction No.</label>
                                                <input type="text" class="form-control disabled" v-model="bill.transaction_no" readonly>
                                            </div>
                                        </div>

                                        <div v-if="order.asset_group" class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="asset-group">Asset Group</label>
                                                <input type="text" class="form-control disabled" v-model="bill.order.asset_group" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="item-group">Item Type</label>
                                                <input type="text" class="form-control disabled" v-model="bill.order.item_group.item_group" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="branch-name">Transaction Date</label>
                                                <div class="form-control-wrap">
                                                    <date-picker class="form-control disabled" v-model="bill.transaction_date" :config="{format: 'DD-MMM-YYYY'}" disabled></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="branch-name">Branch</label>
                                                <input type="text" class="form-control disabled" v-model="bill.branch.branch_shortname" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="date-expected">Expected Date</label>
                                                <div class="form-control-wrap">
                                                    <date-picker class="form-control disabled" v-model="bill.transaction_date" :config="{format: 'DD-MMM-YYYY'}" disabled></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="supplier">Supplier</label>
                                                <input type="text" class="form-control disabled" v-model="bill.supplier.supplier_shortname" readonly>
                                            </div>
                                        </div>



                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="po-status">Term</label>
                                                <input type="text" class="form-control disabled" v-model="order.term" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="discount-group">Discount Group</label>
                                                <div style="margin-top:7px;">
                                                    <span v-for="(discount_group) in bill.order.discount_groups" :key="discount_group.uuid" class="badge badge-pill badge-info mr-1">
                                                        {{ discount_group.group_name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                
                            </div>

                            <div class="col-md-3 col-12">

                                <div  v-if="bill.transaction_type == 'Inventory'" class="buy-and-pay-summary">
                                    <h4>Summary:</h4>

                                    <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                        <div><span>Gross</span></div>
                                        <div><span>{{ PUT_SEPARATOR(TOTALS.GROSS.toFixed(2) ) }}</span></div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                        <div><span>Discount</span></div>
                                        <div><span>-{{ PUT_SEPARATOR(TOTALS.DISCOUNT_AMOUNT.toFixed(2) ) }}</span></div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                        <div><span>Tax</span></div>
                                        <div><span>{{ PUT_SEPARATOR(TOTALS.VAT.toFixed(2) ) }}</span></div>
                                    </div>
                                    <hr>
                                    <div style="display:flex; justify-content: space-between; font-weight:900;">
                                        <div><span>Amount</span></div>
                                        <div><span>{{ PUT_SEPARATOR(TOTALS.AMOUNT.toFixed(2) ) }}</span></div>
                                    </div>
                                    <hr style="margin-bottom: 2px">
                                    <hr>
                                </div>
                                <div  v-else class="buy-and-pay-summary">
                                    <div style="display:flex; justify-content: space-between; font-weight:900;">
                                        <div><span>Amount</span></div>
                                        <div><span>{{ PUT_SEPARATOR(bill.amount) }}</span></div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; font-weight:900;">
                                        <div><span>Tax Base</span></div>
                                        <div><span>{{ PUT_SEPARATOR(TAX_BASE.toFixed(2)) }}</span></div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; font-weight:900;">
                                        <div><span>Input Tax</span></div>
                                        <div><span>{{ PUT_SEPARATOR(INPUT_TAX.toFixed(2)) }}</span></div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; font-weight:900;">
                                        <div><span>EWT</span></div>
                                        <div><span>{{ PUT_SEPARATOR(EWT.toFixed(2)) }}</span></div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>


                    <br/>
                    <div  v-if="bill.transaction_type == 'Inventory'" class="hx-tab-2 tabbed round">
                        <ul class="nav nav-tabs">    
                            <li class="nav-item">        
                                <a data-toggle="tab" href="#tax">Tax</a>    
                            </li>
                            <li class="nav-item">        
                                <a data-toggle="tab" href="#discounts">Discount</a>    
                            </li>
                            <li class="nav-item">        
                                <a class="active" data-toggle="tab" href="#item-details">Item</a>    
                            </li>  
                        </ul>

                        <div class="clearfix"></div>
                        <div class="tab-content">    
                            <div class="tab-pane active" id="item-details">
                                <items ref="items" :order="bill.order" :VAT="VAT" :type="'bills'" :action="ACTION"></items>
                            </div>

                            <div class="tab-pane" id="discounts">
                                <discounts ref="discounts" :order="bill.order" :DISCOUNTS="DISCOUNTS" :action="ACTION"></discounts>
                            </div>

                            <div class="tab-pane" id="tax">
                               <taxes ref="taxes" :order="bill.order" :DISCOUNTS="DISCOUNTS" :action="ACTION"></taxes>
                            </div>   
                        </div>
                    </div>
                    <div v-else>
                        <expenses ref="expenses" :bill="bill" :action="ACTION"></expenses>
                    </div>
                
                </form>
            </div>
        </div>


    </div>
</template>

<script>

import Swal from 'sweetalert2'
import moment from 'moment'
import Items from '../../components/items'
import Discounts from '../../components/discounts'
import Taxes from '../../components/taxes'
import Expenses from '../../components/expenses'

export default {
    name: 'purchase-order',
    props: ['properties','view_mode'],
    data: function () {
        return {
            is_ready: false,
            bill: null,
            order: null,
            DRAFT: false,
            ACTION: 'view',
            AMOUNT_TO_ALLOCATE: 0,
            temp_amount: 0.00,
            TOTALS: {
                GROSS: 0.00,
                SUBTOTAL: 0.00,
                RATE: 0.00,
                DISCOUNT_AMOUNT: 0.00,
                DISCOUNT_RATE: 0.00,
                NET: 0.00,
                VAT: 0.00,
                AMOUNT: 0.00,
                QUANTITY: 0.00,
                PACKING: 0.00,
            },
            DISCOUNTS: {
                base: [],
                price_rules: [],
                additionals: [],
            },
            SELECTED_ITEMS: [],
        }
    },
    components: {
        'items' : Items,
        'discounts' : Discounts,
        'taxes' : Taxes,
        'expenses' : Expenses,
    },
    computed: {
        TAX_BASE: function () {
            var scope = this
            var vat = scope.bill.supplier.v_a_t;
            
            vat = (vat) ? vat.tax_rate / 100 : 0
            var total = scope.bill.amount / (1 + vat) // e.g 1.12 if VAT = 12%

            return total
        },
        EWT: function () {
            var scope = this
            var ewt = scope.bill.supplier.e_w_t;
            ewt = (ewt) ? ewt.tax_rate / 100 : 0

            return (scope.TAX_BASE * ewt)
        },
        INPUT_TAX: function() {
            var scope = this
            return (scope.bill.amount - scope.TAX_BASE)
             
        }
    },
    watch: {
        '$route': function(){
            var scope = this
            scope.ACTION = scope.$route.params.action;
        }
    },
    methods: {
        updateAmount: function () {
            var scope = this
            window.swal.fire({
                title: 'Update?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.bill.amount = scope.temp_amount
                    scope.$refs.expenses.clear();
                }                              
            })
           
        },
        updateTOTALS: function (data) {
            var scope = this
            scope.TOTALS = data
        },
        updateAmountToAllocate: function () {
            var scope = this
            scope.AMOUNT_TO_ALLOCATE = parseFloat(scope.$refs.expenses.getAmountToAllocate());
        },
        getTaxBaseAmount: function () {
            return this.TAX_BASE
        },
        getBillDetails: function (bill_uuid,is_draft = false) {
            var scope = this
            var URL = (!is_draft) ? 'buy-and-pay/bills/' + bill_uuid : 'buy-and-pay/bills/draft' + window.location.search;

            scope.GET(URL).then(res => {
                if (!res) {
                    scope.ROUTE({path: '/buy-and-pay/bills' });
                }

                scope.bill = res.data
                // scope.memo_po = res.data.memo_po

                scope.bill.transaction_no = (!scope.bill.transaction_no || scope.bill.transaction_no == '') ? 'To be generated' : scope.bill.transaction_no
                scope.bill.transaction_date = (!scope.bill.transaction_date || scope.bill.transaction_date == '') ? moment() : scope.bill.transaction_date

                scope.temp_amount = parseFloat(scope.bill.amount)

                if (scope.bill.transaction_type == 'Inventory') {
                    scope.order = res.data.order
                    scope.order.term = (scope.order.term == 1) ? scope.order.term + ' Day' : scope.order.term + ' Days' ;
                    var supplier_uuid = scope.order.supplier_uuid
                }
            
                scope.is_ready = true
            })
        },
        save: function() {

            var scope = this
            var type = scope.bill.transaction_type
            var URL = (!scope.bill.uuid) ? 'buy-and-pay/bills' : 'buy-and-pay/bills/' + scope.bill.uuid ;
            var expenses = [];
  
            if (type == 'Expenses') {
                // for validation purposes
                expenses = scope.$refs.expenses.getExpensesList();
            }
            

            scope.POST(URL, { type: type, bill: scope.bill, expenses: expenses }).then(res => {
                if (res.success) {
                    scope.$refs.expenses.saveBillExpenses(res.data.uuid) 
                    // scope.$refs.items.saveOrderItems() 
                    // scope.ROUTE({path: '/buy-and-pay/bills' });
                } else {
                    alert(res.message)
                }
            })
        },
        cancel: function () {
            var scope = this

            var URL =  'buy-and-pay/bills/' + scope.bill.uuid + '/cancel';

            window.swal.fire({
                title: 'Cancel?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                    scope.POST(URL, { type: type, bill: scope.bill, expenses: expenses }).then(res => {
                        if (res.success) {
                            scope.ROUTE({path: '/buy-and-pay/bills' });
                        } else {
                            alert(res.message)
                        }
                    })
                }                              
            })
        },
        loadData: function () {
            
        }
    },
    mounted() {
        var scope = this

        var bill_uuid = scope.$route.params.bill_uuid;
        scope.ACTION = ( scope.$route.params.action) ? scope.$route.params.action : 'edit';

        var is_draft = (!bill_uuid) ? true : false

        scope.DRAFT = is_draft
        scope.getBillDetails(bill_uuid,is_draft)
        
      
       $(document).on('click','.autocomplete-suggestion',function(){
           var barcode = $(this).data('barcode')
           scope.selectItem(barcode) 
        })
    },
}


function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
      return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
      return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1 || data.item_code.indexOf(params.term.toLowerCase()) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (matched)';

      // You can return modified objects from here
      // This includes matching the `children` how you want in nested data sets
      return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}
</script>

<style scoped>
.autocomplete-suggestion:hover { cursor:pointer !important; }
.table-discount-summary thead th { background:#398cdb !important; color:#fff;  }

.buy-and-pay-summary {
    margin-bottom:30px; padding:10px; background:#eee; border:1px solid #efefef; border-radius: 4px;
}
.buy-and-pay-summary span { font-size: 16px; }
.buy-and-pay-summary hr { margin: 0; border-color: #495057; }
.buy-and-pay-summary h4 { margin-bottom: 12px; font-weight: 600; font-size: 18px; }
</style>