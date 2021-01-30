<template>
    <div v-if="is_ready">
        <form action="#" class="form-validate is-alter">
            <div id="item-details">

                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <input style="margin-bottom:10px;" v-model="selected_item_list_keyword"  class="form-control" type="text" placeholder="Search an Item">
                        </div>
                        <div class="col-12 col-lg-9">
                            <div style="float:right;">
                                
                                <button @click="addItems()" type="button" class="btn btn-sm hx-btn-shineblue" :disabled="view_mode">Add Items</button>
                                <button @click="addAllItems()" type="button" class="btn btn-sm hx-btn-shineblue" :disabled="view_mode">Add All Items</button>
                                <button @click="removeAllZero()" type="button" class="btn btn-sm btn-danger btn btn-secondary" :disabled="view_mode">Remove Zero</button>
                            
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead class="th-nowrap">
                            <tr>
                                <th width="40">Action</th>
                                <th width="40"></th>
                                <th>Barcode</th>
                                <th width="50">Qty</th>
                                <th width="50">UOM</th>
                                <th>Item Description</th>
                                <th>Item Group</th>
                                <th>Location</th>
                                <th width="60">Packing</th>
                                <th>Item Rate</th>
                                <!-- <th>Subtotal</th> -->
                                <th>Gross</th>
                                <th>Discount</th>
                                <th>Net</th>
                                <th>VAT</th>
                                <th>Total</th>
                                
                                <th>Price Rule?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in SELECTED_ITEMS" :key="item.barcode + '-' + index" v-bind:class="{'table-success' : (selectedItem && item.barcode == selectedItem.barcode)}">
                                <td class="text-center">
                                    <span class="hx-table-actions w-auto">
                                        <button @click="removeSelectedItem(item)" type="button" class="btn btn-sm btn-danger" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                    </span>
                                </td>
                                <td>{{ (index + 1) }}</td>
                                <td>{{ item.barcode }}</td>

                                <td  @click="setSelectedItem(item)" class="editable text-right">
                                    <span>{{ item.quantity }}</span>
                                    <input @keyup="calculate(item);changeSelectedItemQTY(item)" v-model="item.quantity" type="text" class="editable-control" :disabled="view_mode">
                                </td>

                                <td  @click="setSelectedItem(item)" class="editable">
                                    <span>{{ findUOMByBarcode(item.uoms,item.barcode) }}</span>
                                    <select @change="changeSelectedItemUOM($event.target.value, item, index)" type="text" class="editable-control" :disabled="view_mode">
                                        <option v-if="!isItemUOMSelected(uom, item)" v-for="(uom,index) in item.uoms" :key="uom.uuid + '-' + index" :value="uom.barcode" v-bind:selected="uom.barcode == item.barcode">{{ uom.uom }}</option>
                                    </select>
                                </td>

                                <td><a :href="'/items/' + item.uuid + '/view'" target="_blank">{{ item.item_description }}</a></td>
                                <td>
                                    <span class="badge badge-pill badge-info mr-1">
                                        {{ findDiscountGroup(item) }}
                                    </span>
                                </td>
                                <td>{{ order.branch_location.location_shortname }}</td>


                                
                                <td class="text-right">{{ item.uom_packing }}</td>
                                <td class="text-right">{{ PUT_SEPARATOR(parseFloat(item.packing_rate).toFixed(2)) }}</td>
                                <!-- <td class="text-right">{{ PUT_SEPARATOR(parseFloat(item.item_rate).toFixed(2)) }}</td> -->
                                <td class="text-right">{{ PUT_SEPARATOR(parseFloat(item.gross_amount).toFixed(2))  }}</td>

                                <td class="text-right">{{ PUT_SEPARATOR(parseFloat(item.discount_amount_total).toFixed(2)) }}</td>
                                <td class="text-right">{{ PUT_SEPARATOR(parseFloat(item.net_amount).toFixed(2)) }}</td>
                                <td class="text-right">{{ PUT_SEPARATOR(parseFloat(item.vat_amount).toFixed(2)) }}</td>
                                <td class="text-right">{{ PUT_SEPARATOR(parseFloat(item.total_amount).toFixed(2)) }}</td>
                                <td>
                                    {{ itemHasPriceRule(item) }}
                                </td>
                            </tr>

                                <tr>
                                <td colspan="10" class="text-right">Total:</td>
                                <!-- <td class="text-right"><strong>{{ TOTALS.QUANTITY }}</strong></td> -->
                                
                                <!-- <td class="text-right"><strong>{{ PUT_SEPARATOR(parseFloat(TOTALS.PACKING).toFixed(2)) }}</strong></td> -->
                                <!-- <td class="text-right"><strong>{{ PUT_SEPARATOR(parseFloat(TOTALS.RATE).toFixed(2)) }}</strong></td> -->
                                <!-- <td class="text-right"><strong>{{ PUT_SEPARATOR(parseFloat(TOTALS.SUBTOTAL).toFixed(2)) }}</strong></td> -->
                                <td class="text-right"><strong>{{ PUT_SEPARATOR(parseFloat(TOTALS.GROSS).toFixed(2)) }}</strong></td>

                                <td class="text-right"><strong>{{ PUT_SEPARATOR(parseFloat(TOTALS.DISCOUNT_AMOUNT).toFixed(2)) }}</strong></td>
                                <td class="text-right"><strong>{{ PUT_SEPARATOR(parseFloat(TOTALS.NET).toFixed(2)) }}</strong></td>
                                <td class="text-right"><strong>{{ PUT_SEPARATOR(parseFloat(TOTALS.VAT).toFixed(2)) }}</strong></td>
                                <td class="text-right"><strong>{{ PUT_SEPARATOR(parseFloat(TOTALS.AMOUNT).toFixed(2)) }}</strong></td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="18">
                                    <div class="pb-1"></div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="18" style="padding: 10px;">
                                    <input type="text" id="autocomplete" class="form-control" placeholder="Search item here.." :disabled="view_mode" style="width: 60%;">
                                </td>
                            </tr> 
                        </tbody>
                    </table>

                    <form style="margin-top:30px;">
                        <div class="form-group">
                            <label for="memo-po">Memo:</label>
                            <textarea v-model="memo_po" class="form-control" id="memo-po"></textarea>
                        </div>
                    </form>
                
                </div>
        </form>
    

        <div class="modal fade" tabindex="-1" id="modal-item-list">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Item List</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modal-item-list');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-5 offset-lg-7">
                                <div style="padding-bottom:10px;">
                                    <input v-model="item_list_keyword"  class="form-control" type="text" placeholder="Search an Item">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30">#</th>
                                        <th>Barcode</th>
                                        <th>Description</th>
                                        <th>Short Name</th>
                                        <th>UOM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in itemList" :key="index" v-bind:class="{'table-success' : isTempSelected(item) }">
                                        <th scope="row">
                                            <i @click="addTempItem(item)" v-if="!isTempSelected(item)" class="kx-checkbox bx bx-checkbox"></i>
                                            <i @click="removeTempItem(item)" v-else class="kx-checkbox checked bx bx-checkbox-checked"></i>
                                        </th>
                                        <td>{{ item.barcode }}</td>
                                        <td>{{ item.item_description }}</td>
                                        <td>{{ item.item_shortname }}</td>
                                        <td>{{ item.uom_label }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button @click="saveTempItems()" type="button" class="btn hx-btn-shineblue">Save</button>
                        <button @click="CLOSE_MODAL('#modal-item-list');" type="button" class="btn hx-btn-gray">Close</button>
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
    name: 'purchase-order',
    props: ['properties','view_mode','order','VAT'],
    data: function () {
        return {
            is_ready: false,
            items: [],
            selected_items: [],
            options_items: [],
            option_items_selected: null,
            selectedItem: null,
            selectedItemDiscountView: 'all',
            temp_selected_items: [],
            item_list_keyword: '',
            selected_item_list_keyword: '',
            memo_po: '',
            VAT: null,
            __BASE_DISCOUNTS__: [],
            __PRICE_RULES__: [],
            __ADDITIONALS__: [],
            /* BASE */
            DISCOUNT_BASE_AMOUNT_TOTAL: 0.00,
            DISCOUNT_BASE_RATE_TOTAL: 0.00,
            /* PRICE RULE */
            DISCOUNT_PRICE_RULE_AMOUNT_TOTAL: 0.00,
            DISCOUNT_PRICE_RULE_RATE_TOTAL: 0.00,
            /* ADDITIONAL */
            DISCOUNT_ADDITIONAL_AMOUNT_TOTAL: 0.00,
            DISCOUNT_ADDITIONAL_RATE_TOTAL: 0.00,
            QTY_TIMER: null,
            RECALCULATE_TIMER: null,
        }
    },
    components: {

    },
    computed: {
        itemList() {
            var scope = this
            var keyword = scope.item_list_keyword.toLowerCase()
            return this.options_items.filter((item) => {
                return (item.item_code.toLowerCase().indexOf(keyword) > -1 ||
                item.item_description.toLowerCase().indexOf(keyword) > -1 ||
                item.item_shortname.toLowerCase().indexOf(keyword) > -1);
            })
        },
        SELECTED_ITEMS() {
            var scope = this
            var keyword = scope.selected_item_list_keyword.toLowerCase()
            return this.selected_items.filter((item) => {
                return ((item.barcode.toLowerCase().indexOf(keyword) > -1 ||
                item.item_description.toLowerCase().indexOf(keyword) > -1 ||
                item.item_shortname.toLowerCase().indexOf(keyword) > -1));
            }).sort(function(a, b){
                if(a.item_description < b.item_description) { return -1; }
                if(a.item_description > b.item_description) { return 1; }
                return 0;
            })
        },
        APPLIED_BASE_DISCOUNTS: function () {
            var DISCOUNT_BASE_AMOUNT_TOTAL = this.DISCOUNT_BASE_AMOUNT_TOTAL
            return  this.__BASE_DISCOUNTS__.filter(discount => {
                return parseFloat(discount.discount_amount) > 0
            })
        },
        APPLIED_PRICE_RULE_DISCOUNTS: function () {
            var DISCOUNT_PRICE_RULE_AMOUNT_TOTAL = this.DISCOUNT_PRICE_RULE_AMOUNT_TOTAL
            return this.__PRICE_RULES__.filter(discount => {
                return discount.discount_amount && discount.discount_amount > 0
            })
        },
        TOTALS: function () {
            
            var scope = this
            var TOTAL = {
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
            }

            var gross = 0.00

            for (let i = 0; i < scope.SELECTED_ITEMS.length; i++) {
                var current = scope.SELECTED_ITEMS[i]
                TOTAL.RATE += parseFloat(current.purchase_price)
                TOTAL.GROSS += parseFloat(current.gross_amount)
                TOTAL.SUBTOTAL += parseFloat(current.item_rate) // rate * price
                TOTAL.DISCOUNT_AMOUNT += parseFloat(current.discount_amount_total)
                TOTAL.DISCOUNT_RATE += parseFloat(current.discount_rate_total)
                TOTAL.NET += parseFloat(current.net_amount)
                TOTAL.VAT += parseFloat(current.vat_amount)
                TOTAL.AMOUNT += parseFloat(current.total_amount)
                TOTAL.QUANTITY += parseFloat(current.quantity)
                TOTAL.PACKING += parseFloat(current.uom_packing)
            }

            return TOTAL
        },
        DISCOUNT_SUMMARY_TOTAL: function () {
            var total = parseFloat(this.DISCOUNT_ADDITIONAL_AMOUNT_TOTAL) + parseFloat(this.DISCOUNT_BASE_AMOUNT_TOTAL) + parseFloat(this.DISCOUNT_PRICE_RULE_AMOUNT_TOTAL)
            return total.toFixed(2)
        },
        DISCOUNT_SUMMARY_RATE_TOTAL: function () {
            var total = parseFloat(this.DISCOUNT_ADDITIONAL_RATE_TOTAL) + parseFloat(this.DISCOUNT_BASE_RATE_TOTAL) + parseFloat(this.DISCOUNT_PRICE_RULE_RATE_TOTAL)
            return total.toFixed(2)
        }
    },
    methods: {
        calculate: function(item) {
            var scope = this

            var rate = item.purchase_price
            var qty = item.quantity
            var uom = item.uom
            var packing = item.uom_packing
            var total = (qty * packing) * rate

            // if supplier has no vat or supplier is vatable but item is not vatable = 0
            var VAT = (!scope.order.is_apply_tax || !scope.VAT || (scope.VAT && item.without_vat)) ? 0.00 : parseFloat(scope.VAT.tax_rate)
            VAT = VAT / 100
           
            item.item_rate = (qty * packing) * rate
            item.vat_amount = item.item_rate * VAT
            item.gross_amount = item.item_rate / (1 + VAT)
            
            item.packing_rate = packing * rate
            

            scope.calculateItemBaseDiscount(item)
            scope.calculateItemPriceRuleDiscount(item)
            scope.calculateItemAdditionalDiscount(item)

            
            item.discount_rate_total = parseFloat(item.discount_base_rate) + parseFloat(item.discount_price_rule_rate) + parseFloat(item.discount_additional_rate)
            item.discount_amount_total = parseFloat(item.discount_base_amount) + parseFloat(item.discount_price_rule_amount) + parseFloat(item.discount_additional_amount)
            

            item.net_amount = item.gross_amount - item.discount_amount_total
            item.total_amount = item.net_amount + item.vat_amount 

            //scope.calculateDiscounts();

            scope.$parent.updateItemList()
            
        },
        recalculateItems: function () {

            var scope = this  
            if (scope.RECALCULATE_TIMER) {
                clearTimeout(scope.RECALCULATE_TIMER);
                scope.RECALCULATE_TIMER = null;
            }

            scope.RECALCULATE_TIMER = setTimeout(() => {
                for (let i = 0; i < scope.selected_items.length; i++) {
                    var current = scope.selected_items[i]
                    scope.calculate(current)
                    scope.calculateDiscounts()
                }
            }, 500);
        },
        calculateItemBaseDiscount: function (item) {
            var scope = this
            var discounts = scope.__BASE_DISCOUNTS__.filter(discount => {
                return discount.items.includes(item.uuid)
            })
            
            var RATE = 0.00

            for (let i = 0; i < discounts.length; i++) {
                var discount = discounts[i]
                RATE += parseFloat(discount.discount_rate)
            }

            RATE = parseFloat(RATE/100)
            item.discount_base_rate = RATE
            item.discount_base_amount = item.gross_amount * RATE

        },
        calculateItemPriceRuleDiscount: function (item) {
            var scope = this
            
            var discounts = scope.__PRICE_RULES__.filter(discount => {
                return (discount.applied_to == 'selected' && discount.items.includes(item.uuid)) || discount.applied_to == 'all'
            })
            
            var RATE = 0.00

            for (let i = 0; i < discounts.length; i++) {
                var discount = discounts[i]
                RATE += parseFloat(discount.price_rule_supplier.rate)
            }

            RATE = parseFloat(RATE/100)
            item.discount_price_rule_rate = RATE
            item.discount_price_rule_amount = item.gross_amount * RATE

        },
        calculateItemAdditionalDiscount: function (item) {
            var scope = this
            
            var scope = this
            var RATE = 0.00
            for (let i = 0; i < scope.__ADDITIONALS__.length; i++)
            {
                var discount = scope.__ADDITIONALS__[i]
                if (discount.discount_type == 'rate') {
                    discount.discount_rate = discount.discount_rate.replace(/[^\d.]/g,'');
                    var rate = parseFloat(discount.discount_rate) / 100
                    discount.discount_fixed = scope.TOTALS.GROSS * rate
                    discount.discount_fixed = (!isNaN(discount.discount_fixed)) ? discount.discount_fixed : 0.00
                } else {
                    discount.discount_fixed = discount.discount_fixed.replace(/[^\d.]/g,'');
                    discount.discount_rate = (parseFloat(discount.discount_fixed ) /  scope.TOTALS.GROSS ) * 100
                    discount.discount_rate = (!isNaN(discount.discount_rate)) ? discount.discount_rate : 0.00
                }

                RATE += parseFloat(discount.discount_rate)
            }

            RATE = parseFloat(RATE/100)
            item.discount_additional_rate = RATE
            item.discount_additional_amount = item.gross_amount * RATE
        },
        calculateDiscounts: function () {
            var scope = this

            /* BASE DISCOUNT */
            scope.DISCOUNT_BASE_RATE_TOTAL = 0.00
            scope.DISCOUNT_BASE_AMOUNT_TOTAL = 0.00

            for (let i = 0; i < scope.__BASE_DISCOUNTS__.length; i++) {
                var discount =  scope.__BASE_DISCOUNTS__[i]
         
                discount.discount_amount = 0.00

                var items = scope.SELECTED_ITEMS.filter(item => {
                    return (discount.items.includes(item.uuid))
                })

                if (items.length) {
                    scope.DISCOUNT_BASE_RATE_TOTAL +=  parseFloat(discount.discount_rate)
                    for (let x = 0; x < items.length; x++) {
                        var item = items[x]
                        discount.discount_amount += item.gross_amount * (discount.discount_rate / 100)
                    }
                }

               
                scope.DISCOUNT_BASE_AMOUNT_TOTAL +=  discount.discount_amount
            }


            /* PRICE RULE DISCOUNT */
            scope.DISCOUNT_PRICE_RULE_RATE_TOTAL = 0.00
            scope.DISCOUNT_PRICE_RULE_AMOUNT_TOTAL = 0.00
            var RATE = 0.00

            for (let i = 0; i < scope.__PRICE_RULES__.length; i++) {
                var discount =  scope.__PRICE_RULES__[i]
         
                discount.discount_amount = 0.00

                var items = scope.SELECTED_ITEMS.filter(item => {
                    return (discount.applied_to == 'selected' && discount.items.includes(item.uuid)) || discount.applied_to == 'all'
                })

                if (items.length) {
                    scope.DISCOUNT_PRICE_RULE_RATE_TOTAL +=  parseFloat(discount.price_rule_supplier.rate)
                    for (let x = 0; x < items.length; x++) {
                        var item = items[x]
                        discount.discount_amount += item.gross_amount * (discount.price_rule_supplier.rate / 100)
                    }
                }

               
                scope.DISCOUNT_PRICE_RULE_AMOUNT_TOTAL +=  discount.discount_amount
            } 


            /* ADDITIONAL DISCOUNT */
            scope.DISCOUNT_ADDITIONAL_RATE_TOTAL = 0.00
            scope.DISCOUNT_ADDITIONAL_AMOUNT_TOTAL= 0.00

            for (let i = 0; i < scope.__ADDITIONALS__.length; i++)
            {
                var discount = scope.__ADDITIONALS__[i]
                if (discount.discount_type == 'rate') {
                    discount.discount_rate = discount.discount_rate.replace(/[^\d.]/g,'');
                    var rate = parseFloat(discount.discount_rate) / 100
                    discount.discount_fixed = scope.TOTALS.GROSS * rate
                    discount.discount_fixed = (!isNaN(discount.discount_fixed)) ? discount.discount_fixed : 0.00
                } else {
                    discount.discount_fixed = discount.discount_fixed.replace(/[^\d.]/g,'');
                    discount.discount_rate = (parseFloat(discount.discount_fixed ) /  scope.TOTALS.GROSS ) * 100
                    discount.discount_rate = (!isNaN(discount.discount_rate)) ? discount.discount_rate : 0.00
                }

                RATE += parseFloat(discount.discount_rate)
            }

            scope.DISCOUNT_ADDITIONAL_RATE_TOTAL +=  RATE
            scope.DISCOUNT_ADDITIONAL_AMOUNT_TOTAL +=  scope.TOTALS.GROSS * parseFloat(RATE/100)
           
        },
        itemHasPriceRule: function (item) {
            var scope = this
            var price_rules = scope.APPLIED_PRICE_RULE_DISCOUNTS
            var found = false

            for (let i = 0; i < price_rules.length; i++) {
                var current = price_rules[i]
                if (current.applied_to == 'all' || current.applied_to == 'selected' && current.items.includes(item.uuid)) {
                    found = true;
                    break;
                }
            }

            return (found) ? 'Yes' : 'No'
            
        },
        findDiscountGroup: function (item) {
            var scope = this
            for (let i = 0; i < scope.__BASE_DISCOUNTS__.length; i++) {
                var discount =  scope.__BASE_DISCOUNTS__[i]
    
                if (discount.items.includes(item.uuid)) {
                    return discount.purchase_order_base_discount_group.group_name
                }
            }

            return 'NONE'
            
        },
        addAllItems: function() {
            var scope = this
            scope.selected_items = []
            for (let i = 0; i < scope.options_items.length; i++) {
                var current = scope.options_items[i]
                scope.selected_items.push(current);
                scope.calculate(current)
                scope.calculateDiscounts()
            }
        },
        addItems: function() {
            var scope = this
            scope.temp_selected_items = []
            scope.temp_selected_items = JSON.parse(JSON.stringify(scope.SELECTED_ITEMS))

            scope.OPEN_MODAL('#modal-item-list');
        },
        isTempSelected: function(pointed) {
            var scope = this
            var count = scope.temp_selected_items.filter(item => {
                return item.barcode.indexOf(pointed.barcode) > -1
            }).length
            return (count > 0) ? true : false
        },
        addTempItem: function(item) {
            var scope = this
            scope.temp_selected_items.push(item)
        },
        removeTempItem: function(pointed) {
            var scope = this
            for (let i = 0; i < scope.temp_selected_items.length; i++) {
                var current = scope.temp_selected_items[i]
                if (current.barcode == pointed.barcode) {
                    scope.temp_selected_items.splice(i, 1);
                }
            }
        },
        clearSelectedItems: function() {
            var scope = this

            for (let i = 0; i < scope.selected_items.length; i++) {
                scope.selected_items.splice(i, 1);
            }
        },
        saveTempItems: function () {
            var scope = this
            scope.selected_items = []

            for (let i = 0; i < scope.temp_selected_items.length; i++) {
                var current = scope.temp_selected_items[i]
                scope.selected_items.push(current);
                scope.calculate(current)
                scope.calculateDiscounts()
            }

            scope.CLOSE_MODAL('#modal-item-list')
        },
        removeAllZero: function () {
            var scope = this

            for (var i = scope.SELECTED_ITEMS.length - 1; i >= 0; i--) {
               var quantity = scope.SELECTED_ITEMS[i].quantity

                if (quantity <= 0) {
                    scope.selected_items.splice(i, 1);
                }
            }
        },
        removeSelectedItem: function (pointed) {
            var scope = this
            for (let i = 0; i < scope.selected_items.length; i++) {
                var current = scope.selected_items[i]
                if (current.barcode == pointed.barcode) {
                    scope.selected_items.splice(i, 1);
                    scope.recalculateItems();
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
                    scope.calculateDiscounts()
                }
            } 
            
        },
        changeSelectedItemQTY: function (item) {
            var scope = this  
            if (scope.QTY_TIMER) {
                clearTimeout(scope.QTY_TIMER);
                scope.QTY_TIMER = null;
            }

            scope.QTY_TIMER = setTimeout(() => {
                scope.calculate(item)
            }, 300);
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
        findUOMPackingByBarcode: function (haystack, barcode) {
           for (let i = 0; i < haystack.length; i++) {
                var current = haystack[i]
                if (current.barcode == barcode ) {
                    return current.packing_qtty
                }
            } 

            return ''
        },
        findItemByBarcode: function (pointed) {
           for (let i = 0; i < scope.options_items.length; i++) {
                var current = scope.options_items[i]
                if (current.barcode == pointed.barcode ) {
                    return current
                }
            } 

            return
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
        setSelectedItem: function (item) {
            this.selectedItem = item
        },
        getOrderSupplierItems: function (order_uuid) {
            var scope = this
            scope.items = []
            scope.options_items = []
            scope.selected_items = []

            scope.GET('buy-and-pay/orders/' + order_uuid + '/items').then(res => {
                scope.items = res.rows
                var selected = res.selected_items

                scope.__BASE_DISCOUNTS__ = res.base_discounts
                scope.__PRICE_RULES__ = res.price_rules
                scope.__ADDITIONALS__ = res.additional_discounts

                res.rows.forEach(function (data) {
                    data.data = data.uuid
                    data.value = data.item_description 
                    scope.$set(data,'gross_amount',data.gross_amount)

                    // scope.options_items.push(data)
                    data.uoms.forEach(function (data2) {
                        var option = JSON.parse(JSON.stringify(data));
                        option.barcode = data2.barcode
                        option.uom_label = data2.uom
                        option.uom = data2.uuid
                        option.uom_packing = data2.packing_qtty
                        option.quantity = 0
                        option.base_discounts = data.base_discounts
                        option.value = option.barcode + ' ' + option.item_description
                        scope.options_items.push(option)

                        var found = scope.findSelectedItems(selected, option.barcode)

                        if (found) {
                            option.quantity = found.order_qty
                            scope.calculate(option)
                            scope.selected_items.push(JSON.parse(JSON.stringify(option)));
                            scope.calculateDiscounts()
                        }
                    })
                })

                scope.is_ready = true

                setTimeout(function(){ 
                    /*
                    $(".search-items").select2({allowClear: true, placeholder: "Select an Item", data: scope.options_items, matcher: matchCustom}); 
                    $('.search-items').on('select2:select', function (e) {
                        var data = e.params.data;
                    });
                    */

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
                            suggestion.quantity = 1

                          
                            if (!scope.VAT && suggestion.without_vat) {
                                alert('You cannot add vatable item on non-vatable supplier...')
                                return;
                            }

                            scope.selected_items.push(JSON.parse(JSON.stringify(suggestion)));
                            var index = scope.selected_items.length - 1
                            var latest = scope.selected_items[index]
                            scope.selectedItem = latest
                            scope.calculate(latest)
                            scope.calculateDiscounts()
                           
                            $('#autocomplete').val('')


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

                },100);
                

            })
        },
        getItemUOMName: function (uoms, uuid) {
            var data = uoms.filter((uom) => {
                return uom.uuid.indexOf(uuid) > -1;
            })
            
            if (data.length < 1) {
                return ''
            }

            return data[0].uom
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
                        current.quantity = 1
                        var item = JSON.parse(JSON.stringify(current))
                        scope.selected_items.push(item);
                        scope.selectedItem = item
                        scope.calculate(item)
                        scope.calculateDiscounts()
                    }   
                }
            }
        },
        showDiscounts: function (item, view = 'all') {
            var scope = this
            scope.selectedItem = item
            scope.selectedItemDiscountView = view
            scope.OPEN_MODAL('#modal-discounts');
        },
        saveOrderItems: function() {
            var scope = this
            scope.POST('buy-and-pay/orders/' + scope.order.uuid + '/items', {items: scope.SELECTED_ITEMS, discounts: scope.__ADDITIONALS__, memo: scope.memo_po }).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Orders Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.ROUTE({path: '/purchase-order-main' });
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        },
        getSelectedItems: function () {
            return this.selected_items
        }
    },
    mounted() {
        var scope = this
        scope.getOrderSupplierItems(scope.order.uuid)


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
.table-tranx { table-layout: auto; width: 200%;}
.autocomplete-suggestion:hover { cursor:pointer !important; }

.table-discount-summary thead th { background:#398cdb !important; color:#fff;  }
</style>