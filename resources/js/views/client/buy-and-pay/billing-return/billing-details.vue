<template>
    <div>
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>
            <div class="card-body" >
                <div class="actions-bar">
                    <div class="w-100">
                        <h1 v-if ="view_mode" class="title">View Bill</h1>
                        <h1 v-else class="title">New Bill</h1>
                    </div>
                    <div class="bar-right">
                        <span v-if ="view_mode">
                            <a @click="ROUTE({path: '/billing-return-main' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                                <i class="las la-x"></i> <span>Back</span>
                            </a>
                        </span>
                        <span v-else>
                            <a @click="ROUTE({path: '/billing-return-main' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                                <i class="las la-x"></i> <span>Back</span>
                            </a>
                            <a @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                                <i class="las la-pluss"></i> <span>Bill</span>
                            </a>
                        </span>
                    </div>
                </div>


                <form action="#" class="form-validate is-alter">
                        
                        <div class="row">
                            <div class="col-md-7 col-12">
                                
                                    <div class="row">

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="item-group">Transaction No.</label>
                                                <input type="text" class="form-control disabled" v-model="receiving_no" readonly>
                                            </div>
                                        </div>

                                        <div v-if="asset_group" class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="asset-group">Asset Group</label>
                                                <input type="text" class="form-control disabled" v-model="asset_group" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="item-group">Item Type</label>
                                                <input type="text" class="form-control disabled" v-model="item_group" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="branch-name">Receive Date</label>
                                                <div class="form-control-wrap">
                                                    <date-picker class="form-control disabled" v-model="date_received" :config="{format: 'DD-MMM-YYYY'}" disabled="true"></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="branch-name">Transaction Date</label>
                                                <div class="form-control-wrap">
                                                    <date-picker class="form-control disabled" v-model="date_billed" :config="{format: 'DD-MMM-YYYY'}" disabled="true"></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="branch-name">Branch</label>
                                                <input type="text" class="form-control disabled" v-model="branch_name" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="date-expected">Expected Date</label>
                                                <div class="form-control-wrap">
                                                    <date-picker class="form-control disabled" v-model="date_expected" :config="{format: 'DD-MMM-YYYY'}" disabled="true"></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="supplier">Supplier</label>
                                                <input type="text" class="form-control disabled" v-model="supplier" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="po-no">Reference No.</label>
                                                <input type="text" class="form-control disabled" v-model="receiving_no" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="discount-group">Discount Group</label>
                                                <div style="margin-bottom:10px;">
                                                    <span v-for="(discount_group) in discount_groups" :key="discount_group.uuid" class="badge badge-pill badge-info mr-1">
                                                        {{ discount_group.group_name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="po-status">Status</label>
                                                <input type="text" class="form-control disabled" v-model="receiving_status" readonly>
                                            </div>
                                        </div>
                                    
                                    </div>
                                
                            </div>

                            <div class="col-md-5 col-12">

                                <div style="margin-bottom:30px; padding:10px; background:#fafafa; border:1px solid #efefef;" class="po-details">
                                    <h4 style="margin-bottom:20px;">Summary</h4>
                                    <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                        <div>Gross</div>
                                        <div>{{ putSeparator(TOTAL_GROSS_AMOUNT) }}</div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                        <div>Discount</div>
                                        <div>-{{ putSeparator(TOTAL_DISCOUNT_AMOUNT) }}</div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                        <div>Tax</div>
                                        <div>{{ putSeparator(TOTAL_VAT_AMOUNT) }}</div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; font-weight:900;">
                                        <div>Amount</div>
                                        <div>{{ putSeparator(TOTAL_PO_AMOUNT) }}</div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>


                    <br/>
                    <div class="hx-nav-tabs-override">
                        <ul class="nav nav-tabs">    
                            <li class="nav-item">        
                                <a class="nav-link active" data-toggle="tab" href="#item-details">Item</a>    
                            </li>    
                            <li class="nav-item">        
                                <a class="nav-link" data-toggle="tab" href="#discounts">Discount</a>    
                            </li>
                            <li class="nav-item">        
                                <a class="nav-link" data-toggle="tab" href="#tax">Tax</a>    
                            </li>     
                        </ul>

                        <div class="tab-content">    
                            <div class="tab-pane active" id="item-details">

                                <div class="row">
                                    <div class="col-12 col-lg-3">
                                        <input style="margin-bottom:10px;" v-model="selected_item_list_keyword"  class="form-control" type="text" placeholder="Search an Item">
                                    </div>
                                </div>
                                <table class="table mb-0 table-responsive table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="40"></th>
                                            <th width="40">Item Code</th>
                                            <th>Accepted Qty</th>
                                            <th>Barcode</th>
                                            <th>Item Description</th>
                                            <th>Item Group</th>
                                            <th width="80">UOM</th>
                                            
                                            <th>Item Rate</th>
                                            <th>Gross Amount</th>
                                            <th>Discount Rate</th>
                                            <th>Discount Amount</th>
                                            <th>Net</th>
                                            <th>VAT Amount</th>
                                            <th>Total Amount</th>
                                            
                                            <th>Price Rule?</th>
                                            <th>Reason Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr v-for="(item, index) in selectedItems" :key="item.barcode + '-' + index" v-bind:class="{'table-success' : (selectedItem && item.barcode == selectedItem.barcode)}">
                                            <td>{{ (index + 1) }}</td>
                                            <td>{{ item.item_code }}</td>
                                            <td>{{ item.accepted_qty }}</td>
                                            <td>{{ item.barcode }}</td>
                                            <td><a :href="'/items/' + item.uuid + '/view'" target="_blank">{{ item.item_description }}</a></td>
                                            <td>
                                                <span class="badge badge-pill badge-info mr-1" v-for="base_discount in item.base_discounts">{{ base_discount.order_base_discount_group.group_name }}</span>
                                            </td>
                                            <td class="editable">
                                                <span>{{ findUOMByBarcode(item.uoms,item.barcode) }}</span>
                                                <select v-if="(item.quantity <= 0)" @change="changeSelectedItemUOM($event.target.value, item, index)" type="text" class="editable-control" :disabled="view_mode">
                                                    <option v-if="!isItemUOMSelected(uom, item)" v-for="(uom,index) in item.uoms" :key="uom.uuid + '-' + index" :value="uom.barcode" v-bind:selected="uom.barcode == item.barcode">{{ uom.uom }}</option>
                                                </select> 
                                            </td>
                                            <td class="text-right">{{ putSeparator(parseFloat(item.item_rate).toFixed(2)) }}</td>
                                            <td class="text-right">{{ putSeparator(parseFloat(item.gross_amount).toFixed(2))  }}</td>
                                            <td class="text-right">
                                                <a href="javascript:void(0);" @click="showDiscounts(item)">
                                                    {{ item.discount_rate }}%
                                                </a>
                                            </td>
                                            <td class="text-right">{{ putSeparator(parseFloat(item.discount_amount).toFixed(2)) }}</td>
                                            <td class="text-right">{{ putSeparator(parseFloat(item.net_amount).toFixed(2)) }}</td>
                                            <td class="text-right">{{ putSeparator(parseFloat(item.vat_amount).toFixed(2)) }}</td>
                                            <td class="text-right">{{ putSeparator(parseFloat(item.total_amount).toFixed(2)) }}</td>
                                            <td>
                                                <a v-if="item.price_rule_discounts.length > 0" href="javascript:void(0);" @click="showDiscounts(item, 'price-rule')">
                                                    Yes
                                                </a>
                                                <a v-else style="color:#495057;" href="javascript:void(0);">
                                                    No
                                                </a>
                                            </td>
                                            <td>
                                                <span v-if="item.quantity!=0">
                                                    <span v-if="(item.accepted_qty - item.quantity) < 0">
                                                        Under Served
                                                    </span>
                                                    <span v-else-if="(item.accepted_qty - item.quantity) > 0">
                                                        Over Served
                                                    </span>
                                                    <span v-else-if="(item.accepted_qty - item.quantity) === 0">
                                                        Fully Served
                                                    </span>
                                                </span>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="reason-code">Reason Code</label>
                                        <input type="text" class="form-control disabled" v-model="reason_code" readonly>
                                    </div>
                                </div>
                            
    
                            </div>

                            <div class="tab-pane" id="discounts">

                                <div class="row">
                                    <div class="col-12 col-md-7 offset-md-1">
                                        <h4>Discount Summary</h4>
                                        <table class="table-discount-summary table table-striped table-bordered"> 
                                            <thead>
                                                <tr >
                                                    <th width="30">#</th>
                                                    <th width="150">Discount Group</th>
                                                    <th>Discount Name</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(base_discount,index) in order.base_discounts" :key="'base-discount-summary' + index">
                                                    <th style="background:#77ade0;" v-if="index == 0" :rowspan="order.base_discounts.length + 1">1</th>
                                                    <th v-if="index == 0" :rowspan="order.base_discounts.length">Base</th>
                                                    <th>{{ base_discount.discount_name }}</th>
                                                    <th class="text-right">{{ base_discount.discount_rate }}%</th>
                                                    <th class="text-right">{{ parseFloat(base_discount.total_amount).toFixed(2) }}</th>
                                                </tr>
                                                <tr style="background:#abd1f5;">
                                                    <th style="background:#abd1f5;" colspan="2">Base Total</th>
                                                    <th class="text-right">{{ DISCOUNT_BASE_RATE_TOTAL }}%</th>
                                                    <th class="text-right">{{ DISCOUNT_BASE_TOTAL }}</th>
                                                </tr>
                                                <tr v-for="(discount,index) in order.additional_discounts" :key="'additional-discount-summary' + index">
                                                    <th style="background:#77ade0;" v-if="index == 0" :rowspan="order.additional_discounts.length + 1">2</th>
                                                    <th v-if="index == 0" :rowspan="order.additional_discounts.length">Additional</th>
                                                    <th>{{ discount.discount_name }}</th>
                                                    <th class="text-right">{{ parseFloat(discount.discount_rate).toFixed(2) }}%</th>
                                                    <th class="text-right">{{ parseFloat(discount.discount_fixed).toFixed(2) }}</th>
                                                </tr>
                                                <tr style="background:#abd1f5;">
                                                    <th style="background:#abd1f5;"  colspan="2">Additional Total</th>
                                                    <th class="text-right">{{ DISCOUNT_ADDITIONAL_RATE_TOTAL }}%</th>
                                                    <th class="text-right">{{ DISCOUNT_ADDITIONAL_TOTAL }}</th>
                                                </tr>
                                                <tr v-for="(discount,index) in order.price_rule_discounts" :key="'price-rule-discount-summary' + index">
                                                    <th style="background:#77ade0;" v-if="index == 0" :rowspan="order.price_rule_discounts.length + 1">3</th>
                                                    <th v-if="index == 0" :rowspan="order.price_rule_discounts.length">Price Rule</th>
                                                    <th>{{ discount.rule_name }}</th>
                                                    <th class="text-right">{{ discount.rate }}%</th>
                                                    <th class="text-right">{{ parseFloat(discount.total_amount).toFixed(2) }}</th>
                                                </tr>
                                                <tr style="background:#abd1f5;">
                                                    <th colspan="2">Price Rule Total</th>
                                                    <th class="text-right">{{ DISCOUNT_PRICE_RULE_RATE_TOTAL }}%</th>
                                                    <th class="text-right">{{ DISCOUNT_PRICE_RULE_TOTAL }}</th>
                                                </tr>
                                                <tr style="background:#abd1f5;">
                                                    <th style="background:#77ade0;"></th>
                                                    <th colspan="2">TOTAL DISCOUNT</th>
                                                    <th class="text-right">{{ DISCOUNT_SUMMARY_RATE_TOTAL }}%</th>
                                                    <th class="text-right">{{ putSeparator(DISCOUNT_SUMMARY_TOTAL) }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
        
                            </div>

                            <div class="tab-pane" id="tax">
                            

                            </div>   


                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-discounts">
            <div class="modal-dialog modal-md " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Discounts</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modal-discounts');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div v-if="selectedItemDiscountView == 'all' || selectedItemDiscountView == 'base-discount'">
                                <h5><strong>Base Discounts</strong></h5>
                                <table class="table mb-0 table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="40">#</th>
                                            <th>Discount Group</th>
                                            <th>Discount Name</th>
                                            <th>Discount Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="selectedItem">
                                        <tr v-for="(discount, index) in selectedItem.base_discounts" :key="discount.uuid">
                                            <th width="40">{{ index + 1 }}</th>
                                            <th>{{ discount.order_base_discount_group.group_name }}</th>
                                            <th>{{ discount.discount_name }}</th>
                                            <th class="text-right">{{ discount.discount_rate }}%</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr  v-if="selectedItemDiscountView == 'all'" />
                            <div v-if="selectedItemDiscountView == 'all' || selectedItemDiscountView == 'price-rule'">
                            <h5><strong>Price Rule Discounts</strong></h5>
                            <table class="table mb-0 table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="40">#</th>
                                        <th>Discount Name</th>
                                        <th>Discount Rate</th>
                                    </tr>
                                </thead>
                                <tbody v-if="selectedItem">
                                    <tr v-for="(discount, index) in selectedItem.price_rule_discounts" :key="discount.uuid">
                                        <th width="40">{{ index + 1 }}</th>
                                        <th>{{ discount.price_rule.rule_name }}</th>
                                        <th class="text-right">{{ discount.price_rule.rate }}%</th>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button @click="CLOSE_MODAL('#modal-discounts');" type="submit" class="hx-btn hx-btn-gray">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'purchase-receipt-details',
    props: ['properties','view_mode'],
    data: function () {
        return {
            selected_item_list_keyword: '',
            order: null,
            items: [],
            selected_items: [],
            options_items: [],
            selectedItem: null,
            selectedItemDiscountView: 'all',
            additional_discounts: [],

            po_uuid: '',
            item_group: '',
            asset_group: '',
            branch_name: '',
            supplier: '',
            date_purchased: '',
            date_expected: '',
            date_received: '',
            date_billed: '',
            receiving_no: '',
            discount_groups: '',
            po_no:'',

            reason_code: '',
            receiving_reason_code: '',
            receiving_status: '',

            mark_unmark: 0

        }
    },
    computed: {
        selectedItems() {
            var scope = this
            var keyword = scope.selected_item_list_keyword.toLowerCase()
            return this.selected_items.filter((item) => {
                return ((item.barcode.toLowerCase().indexOf(keyword) > -1 ||
                item.item_description.toLowerCase().indexOf(keyword) > -1 ||
                item.item_shortname.toLowerCase().indexOf(keyword) > -1));
            })
        },

        TOTAL_GROSS_AMOUNT: function () {
            var scope = this
            var total_amount = 0.00

            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.selectedItems[i]
                // total_amount += scope.calculateItemGrossAmount(current,'non-formatted')
                total_amount += parseFloat(current.gross_amount)
                
            }
            return total_amount.toFixed(2)
        },
        TOTAL_DISCOUNT_AMOUNT: function () {
            var scope = this
            var total_amount = 0.00
            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.selectedItems[i]
                total_amount += parseFloat(current.discount_amount)
            }

            total_amount += scope.calculateTotalAdditionalDiscountAmount()

            return total_amount.toFixed(2)
        },
        TOTAL_VAT_AMOUNT: function () {
            var scope = this
            var total_amount = 0.00
            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.selectedItems[i]
                total_amount += parseFloat(current.vat_amount)
            }

            return total_amount.toFixed(2)
        },
        TOTAL_PO_AMOUNT: function () {
            var scope = this
            var total_amount = 0.00
            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.selectedItems[i]
                total_amount += parseFloat(current.total_amount)
            }

            total_amount -= scope.calculateTotalAdditionalDiscountAmount()
            return total_amount.toFixed(2)
        },

        DISCOUNT_ADDITIONAL_TOTAL: function () {
            var scope = this
            var total = 0.00
            for (let i = 0; i < scope.order.additional_discounts.length; i++)
            {
                var discount = scope.order.additional_discounts[i]
                total += parseFloat(discount.discount_fixed)
            }

             return total.toFixed(2)
        },
        DISCOUNT_BASE_TOTAL: function () {
            var scope = this
            var total = 0.00
            for (let i = 0; i < scope.order.base_discounts.length; i++)
            {
                var discount = scope.order.base_discounts[i]
                total += parseFloat(discount.total_amount)
            }

             return total.toFixed(2)
        },
        DISCOUNT_PRICE_RULE_TOTAL: function () {
            var scope = this
            var total = 0.00
            for (let i = 0; i < scope.order.price_rule_discounts.length; i++)
            {
                var discount = scope.order.price_rule_discounts[i]
                total += parseFloat(discount.total_amount)
            }

             return total.toFixed(2)
        },
        DISCOUNT_SUMMARY_TOTAL: function () {
            var total = parseFloat(this.DISCOUNT_ADDITIONAL_TOTAL) + parseFloat(this.DISCOUNT_BASE_TOTAL) + parseFloat(this.DISCOUNT_PRICE_RULE_TOTAL)
            return total.toFixed(2)
        },
        DISCOUNT_ADDITIONAL_RATE_TOTAL: function () {
            var scope = this
            var total = 0.00
            for (let i = 0; i < scope.order.additional_discounts.length; i++)
            {
                var discount = scope.order.additional_discounts[i]
                total += parseFloat(discount.discount_rate)
            }

             return total.toFixed(2)
        },
        DISCOUNT_BASE_RATE_TOTAL: function () {
            var scope = this
            var total = 0.00
            for (let i = 0; i < scope.order.base_discounts.length; i++)
            {
                var discount = scope.order.base_discounts[i]
                total += parseFloat(discount.discount_rate)
            }

             return total.toFixed(2)
        },
        DISCOUNT_PRICE_RULE_RATE_TOTAL: function () {
            var scope = this
            var total = 0.00
            for (let i = 0; i < scope.order.price_rule_discounts.length; i++)
            {
                var discount = scope.order.price_rule_discounts[i]
                total += parseFloat(discount.rate)
            }

             return total.toFixed(2)
        },
        DISCOUNT_SUMMARY_TOTAL: function () {
            var total = parseFloat(this.DISCOUNT_ADDITIONAL_TOTAL) + parseFloat(this.DISCOUNT_BASE_TOTAL) + parseFloat(this.DISCOUNT_PRICE_RULE_TOTAL)
            return total.toFixed(2)
        },

        DISCOUNT_SUMMARY_RATE_TOTAL: function () {
            var total = parseFloat(this.DISCOUNT_ADDITIONAL_RATE_TOTAL) + parseFloat(this.DISCOUNT_BASE_RATE_TOTAL) + parseFloat(this.DISCOUNT_PRICE_RULE_RATE_TOTAL)
            return total.toFixed(2)
        }

    },
    methods: {
        
        markUnmark: function () {
            var scope = this
            if (scope.mark_unmark ==0){
                for (let i = 0; i < scope.selected_items.length; i++) {
                    var item = scope.selected_items[i]
                    
                    if (item.accepted_qty < item.quantity){
                        item.accepted_qty = item.quantity
                        scope.calculate(item)
                    }
                }
                
                scope.mark_unmark = 1
            }
            else{

                for (let i = 0; i < scope.selected_items.length; i++) {
                    var item = scope.selected_items[i]
                    
                    if (item.accepted_qty == item.quantity){
                        item.accepted_qty = 0
                        scope.calculate(item)
                    }
                }

                scope.mark_unmark = 0
            }
        },

        putSeparator: function(value) {
            var num_parts = value.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        },

        getOrderDetails: function () {
            var scope = this
            scope.GET('buy-and-pay/receiving/' + scope.$route.params.orderUUID).then(res => {
                scope.po_uuid = res.data.uuid
                scope.item_group = res.data.item_group.item_group
                scope.branch_name = res.data.branch.branch_name
                scope.supplier = res.data.supplier.supplier_shortname
                scope.date_purchased = res.data.date_purchased
                scope.date_expected = res.data.date_expected
                scope.date_received = res.data.date_received
                scope.date_billed = res.data.date_billed
                scope.receiving_no = res.data.receiving_no
                scope.discount_groups =res.data.discount_groups
                scope.asset_group =res.data.asset_group
                scope.po_no = res.data.po_no
                scope.receiving_status = res.data.receiving_status
                scope.additional_discounts = res.data.additional_discounts

                scope.reason_code = res.data.receiving_reason_code

                console.log(res.data)

                scope.order = res.data

                if (res.data.date_billed===null){
                    scope.date_billed = moment() 
                }

            })
        },
        fillAcceptedQty: function (item, value) {
            var scope = this
            if (value === true){
                item.accepted_qty = item.quantity
                scope.calculate(item)
            }
            else{
                item.accepted_qty = 0
                scope.calculate(item)
            }
            
        },


        showDiscounts: function (item, view = 'all') {
            var scope = this
            scope.selectedItem = item
            scope.selectedItemDiscountView = view
            scope.OPEN_MODAL('#modal-discounts');
        },

        removeSelectedItem: function (pointed) {
            var scope = this
            for (let i = 0; i < scope.selected_items.length; i++) {
                var current = scope.selected_items[i]
                if (current.barcode == pointed.barcode) {
                    scope.selected_items.splice(i, 1);
                }
            }

            scope.calculateTotalAdditionalDiscountAmount()
            scope.calculateBaseDiscounSummary();
            scope.calculatePriceRuleDiscountSummary();
        },


        calculate: function(item) {
            var scope = this
            scope.calculateTotalDiscountRate(item,'non-formatted')
            scope.calculateItemGrossAmount(item,'non-formatted')
            scope.calculateItemRate(item,'non-formatted')
            scope.calculateItemDiscountAmount(item,'non-formatted')
            scope.calculateItemNetAmount(item,'non-formatted')
            scope.calculateVATAmount(item,'non-formatted')
            scope.calculateTotalAmount(item,'non-formatted')
        },

        calculateTotalDiscountRate: function (item, type = 'formatted') {
            var base_discounts = item.base_discounts
            var base_discount_total = 0.00
            for (let i = 0; i < base_discounts.length; i++) {
                var current = base_discounts[i]
                base_discount_total += (current.discount_rate) ? parseFloat(current.discount_rate) : 0
            }

            var price_rules = item.price_rule_discounts
            var price_rule_total = 0.00
            for (let i = 0; i < price_rules.length; i++) {
                var current = price_rules[i]
                price_rule_total += (current.price_rule) ? parseFloat(current.price_rule.rate) : 0
            }

            var total = parseFloat(base_discount_total + price_rule_total)

            item.discount_rate = total
            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateItemGrossAmount: function (item, type = 'formatted') {
            var scope = this
            var rate = item.purchase_price
            var qty = item.accepted_qty
            var uom = item.uom
            var packing = scope.getItemUOMPacking(item.uoms, item.uom)
            var total = (qty * packing) * rate
            total = total / 1.12

            item.gross_amount = total
            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateItemRate: function (item) {
            var scope = this
            var rate = item.purchase_price
            var qty = item.accepted_qty
            var uom = item.uom
            var packing = scope.getItemUOMPacking(item.uoms, item.uom)

            var total = (qty * packing) * rate

            item.item_rate = total

            return total.toFixed(2)
        },
        calculateItemDiscountAmount: function (item, type = 'formatted') {
            var scope = this
            
            // var discounts = scope.calculateTotalDiscountRate(item,'non-formatted')
            var discounts = item.discount_rate
            discounts = discounts / 100

            // var gross = scope.calculateItemGrossAmount(item,'non-formatted')
            var gross = item.gross_amount

            var total =  (gross * discounts)

            item.discount_amount = total

            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateItemNetAmount: function (item, type = 'formatted') {
            var scope = this
            
            // var gross = scope.calculateItemGrossAmount(item,'non-formatted') 
            var gross = item.gross_amount 
            var discount = scope.calculateItemDiscountAmount(item,'non-formatted')

            var total = gross - discount

            item.net_amount = total

            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateVATAmount: function (item, type = 'formatted') {
            var scope = this
            var net = item.net_amount
            var total = net * 0.12

            item.vat_amount = total

            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateTotalAmount: function (item, type = 'formatted') {
            var scope = this
            var net = item.net_amount
            var vat = item.vat_amount 
            var total = net + vat

            item.total_amount = total
            
            return (type == 'formatted') ? total.toFixed(2) : total
        },

        calculateTotalAdditionalDiscountAmount: function(discount, gross) {
            var scope = this
            var total = 0.00
            for (let i = 0; i < scope.additional_discounts.length; i++)
            {
                var current = scope.additional_discounts[i]
                total += parseFloat(current.discount_fixed)
            }
            
            return total
        },

        calculateAdditionalDiscounSummary: function() {
            var scope = this

            scope.calculateTotalAdditionalDiscountAmount()
           
        },
        calculateBaseDiscounSummary: function() {
            var scope = this
            
            for (let i = 0; i < scope.order.base_discounts.length; i++)
            {
                var discount = scope.order.base_discounts[i]
                scope.$set(discount,'total_amount',0)

                for (let x = 0; x < scope.selected_items.length; x++) {
                    var item = scope.selected_items[x]
                    
                    for (let y = 0; y < item.base_discounts.length; y++)
                    {
                        var item_discount = item.base_discounts[y]
                       
                        if (item_discount.id == discount.id) {
                            var rate = (parseFloat(discount.discount_rate) / 100)
                            discount.total_amount += (item.gross_amount * rate)
                        }
                    }
                }
            }
        },
        calculatePriceRuleDiscountSummary: function() {
            var scope = this
            
            for (let i = 0; i < scope.order.price_rule_discounts.length; i++)
            {
                var discount = scope.order.price_rule_discounts[i]
                scope.$set(discount,'total_amount',0)

                for (let x = 0; x < scope.selected_items.length; x++) {
                    var item = scope.selected_items[x]
                    
                    if (discount.price_rule_detail.applied_to == 'selected') {
                        for (let y = 0; y < item.price_rule_discounts.length; y++)
                        {
                            var item_discount = item.price_rule_discounts[y]
                        
                            if (item_discount.bp_price_rule_uuid == discount.uuid) {
                                var rate = (parseFloat(discount.rate) / 100)
                                discount.total_amount += (item.gross_amount * rate)
                            }
                        }
                    } else {
                        var rate = (parseFloat(discount.rate) / 100)
                        discount.total_amount += (item.gross_amount * rate)
                    }
                    
                }
            }
        },

        getItemUOMPacking: function (uoms, uuid) {
            var data = uoms.filter((uom) => {
                return uom.uuid.indexOf(uuid) > -1;
            })
            
            if (data.length < 1) {
                return ''
            }

            return data[0].packing_qtty
        },

        findSelectedItems: function (haystack, barcode) {
            for (let i = 0; i < haystack.length; i++) {
                var current = haystack[i]
                if (current.barcode == barcode) {
                    return current
                }
            }

            return null
        },

        findUOMByBarcode: function (haystack, barcode) {
           for (let i = 0; i < haystack.length; i++) {
                var current = haystack[i]
                if (current.barcode == barcode ) {
                    return current.uom
                }
            } 

            return ''
        },
        addSimilarItem: function (item) {
            var scope = this
            for (let i = 0; i < item.uoms.length; i++) {
                var uom = item.uoms[i]
                if (!scope.isItemUOMSelected(uom, item)) {
                    scope.selectItem(uom.barcode);
                    break;
                }
            }
        },
        isItemUOMSelected: function (uom, pointed) {
            var scope = this
            for (let i = 0; i < scope.selected_items.length; i++) {
                var current = scope.selected_items[i]
                if (current.barcode == uom.barcode && uom.barcode != pointed.barcode ) {
                    return true
                }
            }

            return false
        },
        changeSelectedItemUOM: function (barcode, item, index) {
            var scope = this
             for (let i = 0; i < scope.options_items.length; i++) {
                var current = scope.options_items[i]
                var excluded = ['quantity'];
                if (current.barcode == barcode ) {
                    for (var key in current) {
                        if (!excluded.includes(key)) {
                            item[key] = current[key]
                        }
                    }

                    scope.calculate(item)

                }
            } 
            
        },
        getOrderSupplierItems: function () {
            var scope = this
            scope.items = []
            scope.options_items = []
            scope.selected_items = []

            scope.GET('buy-and-pay/receiving/' + scope.$route.params.orderUUID + '/supplier-items').then(res => {
                scope.items = res.rows
                console.log(scope.items)
                var selected = res.selected_items

                res.rows.forEach(function (data) {
                    data.data = data.uuid
                    data.value = data.item_description
                    data.value = data.item_code
                    scope.$set(data,'gross_amount',data.gross_amount)

                    data.uoms.forEach(function (data2) {
                        var option = JSON.parse(JSON.stringify(data));
                        option.barcode = data2.barcode
                        option.uom_label = data2.uom
                        option.uom = data2.uuid
                        option.uom_packing = data2.packing_qtty
                        option.quantity = 0
                        option.accepted_qty = 1
                        option.base_discounts = data.base_discounts
                        option.value = option.barcode + ' ' + option.item_description
                        scope.options_items.push(option)

                        var found = scope.findSelectedItems(selected, option.barcode)

                        if (found) {
                            option.quantity = found.order_qty
                            option.accepted_qty = found.accepted_qty
                            scope.calculate(option)
                            scope.selected_items.push(JSON.parse(JSON.stringify(option)));
                            
                        }
                    })
                    
                    
                })

                scope.is_ready = true

                setTimeout(function(){ 

                    $('#autocomplete').autocomplete({
                        lookup: scope.options_items,
                        onSelect: function (suggestion) {
                            
                            for (let i = 0; i < scope.selected_items.length; i++) {
                                var current = scope.selected_items[i]
                                if (current.barcode == suggestion.barcode) {
                                    scope.selectedItem = current
                                    $('#autocomplete').val('')
                                    return
                                }
                            }
                            suggestion.quantity = 0
                            suggestion.accepted_qty = 1
                            scope.selected_items.push(JSON.parse(JSON.stringify(suggestion)));
                            var index = scope.selected_items.length - 1
                            var latest = scope.selected_items[index]
                            scope.selectedItem = latest
                            scope.calculate(latest)
                            $('#autocomplete').val('')

                            scope.calculateTotalAdditionalDiscountAmount()
                            scope.calculateBaseDiscounSummary();
                            scope.calculatePriceRuleDiscountSummary();
                        },
                        beforeRender: function (container, suggestions) {
                            container.html('Searching..')
                            var html = '<table style="width:100%;"><thead style="padding:2px 3px;"><tr style="background:#51a8f8; color:#fff;"><th style="width:120px;">Barcode</th><th style="width:340px;">Item Description</th><th style="width:80px;">Packing</th><th>UOM</th></tr></thead>'
                            html += '<tbody style="padding:2px 3px;">';
                            for (let i = 0; i < suggestions.length; i++) {
                                var suggestion = suggestions[i]
                                html += '<tr class="autocomplete-suggestion" value="'+ suggestion.value +'" data-barcode="'+ suggestion.barcode +'">'
                                html += '<td style="border-right:1px solid #ccc; padding:0px 10px;">'+suggestion.barcode+'</td>'
                                html += '<td style="border-right:1px solid #ccc; padding:0px 10px;">'+suggestion.item_description+'</td>'
                                html += '<td style="border-right:1px solid #ccc; padding:0px 10px;">'+suggestion.uom_packing+'</td>'
                                html += '<td style="padding:0px 10px;">'+suggestion.uom_label+'</td>'
                                html += '</tr>'
                            }
                            html += '</tbody>'
                            html += '</table>'
                            container.html(html)
                        }
                        
                    });

                    scope.calculateTotalAdditionalDiscountAmount()
                    scope.calculateBaseDiscounSummary();
                    scope.calculatePriceRuleDiscountSummary();
                    
                },100);
                

            })
        },

        selectItem: function (barcode) {
            var scope = this
            for (let i = 0; i < scope.options_items.length; i++) {
                var current = scope.options_items[i]
                if (barcode == current.barcode) {
    
                    var found = scope.findSelectedItems(scope.selected_items, barcode)

                    if (found) {
                        scope.selectedItem = current
                    } else {
                        current.quantity = 0
                        current.accepted_qty = 1
                        scope.calculate(current)
                        scope.selected_items.push(JSON.parse(JSON.stringify(current)));

                        scope.calculateTotalAdditionalDiscountAmount()
                        scope.calculateBaseDiscounSummary();
                        scope.calculatePriceRuleDiscountSummary();
                        
                    }   
                }
            }
        },

        save: function() {
            var scope = this

            var formData = {} 

            formData['date_billed'] = scope.date_billed

            scope.POST('buy-and-pay/billing/' + scope.po_uuid + '/details', {data: formData }).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.ROUTE({path: '/billing-return-main/'})
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        },
        
    },

    mounted() {
        var scope = this
        scope.getOrderDetails()
        scope.getOrderSupplierItems()

        $(document).on('click','.autocomplete-suggestion',function(){
           var barcode = $(this).data('barcode')
           scope.selectItem(barcode ) 
        })
    },
}
</script>

<style scoped>

.nav-tabs-custom .nav-item .nav-link {
    color: white;
}
.nav-tabs-custom .nav-item .nav-link.active {
  color: black !important;
}
.nav-tabs-custom .nav-item .nav-link::after { content: none; }

.table-tranx { table-layout: auto; }
/*.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }*/
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>