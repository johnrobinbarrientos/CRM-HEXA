<template>
    <div v-if="is_ready">
        <div class="hx-tab">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Purchase Orders</h1>
                </div>
                <div class="bar-right">
                    <a @click="ROUTE({path: '/purchase-orders' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-x"></i> <span>Back</span>
                    </a>
                    <a @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-pluss"></i> <span>Update</span>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-12">
                     <purchase-order-form :form="'inline'" :order="order"></purchase-order-form>
                </div>

                <div class="col-md-4 col-12">
                    <div style="margin-bottom:30px; padding:10px; background:#fafafa; border:1px solid #efefef;" class="po-details">
                        <h4 style="margin-bottom:20px;">Summary</h4>
                        <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                            <div>Gross Amount</div>
                            <div>{{ TOTAL_GROSS_AMOUNT }}</div>
                        </div>
                        <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                            <div>Discount</div>
                            <div>-{{ TOTAL_DISCOUNT_AMOUNT }}</div>
                        </div>
                        <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                            <div>Tax Amount</div>
                            <div>{{ TOTAL_VAT_AMOUNT }}</div>
                        </div>
                        <div style="display:flex; justify-content: space-between; font-weight:900;">
                            <div>PO Amount</div>
                            <div>{{ TOTAL_PO_AMOUNT }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-3">
                    <input style="margin-bottom:10px;" v-model="selected_item_list_keyword"  class="form-control" type="text" placeholder="Search an Item">
                </div>
                <div class="col-12 col-lg-9">
                    <div style="float:right;">
                        
                        <button @click="addItems()" class="btn btn-sm hx-btn-shineblue">Add Items</button>
                        <button @click="addAllItems()" class="btn btn-sm hx-btn-shineblue">Add All Items</button>
                        <button @click="removeAllZeroAmount()" class="btn btn-sm btn-danger btn btn-secondary">Remove Zero</button>
                    
                    </div>
                </div>
            </div>
            <table class="table mb-0 table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="40">Action</th>
                        <th width="40">#</th>
                        <th>Barcode</th>
                        <th>Item Description</th>
                        <th>Item Group</th>
                        <th>Location</th>
                        <th width="100">Quantity</th>
                        <th width="80">UOM</th>
                        
                        <th>Item Rate</th>
                        <th>Gross Amount</th>
                        <th>Discount Rate</th>
                        <th>Discount Amount</th>
                        <th>Net</th>
                        <th>VAT Amount</th>
                        <th>Total Amount</th>
                        
                        <th>Price Rule?</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="(item, index) in selectedItems" :key="item.barcode + '-' + index" v-bind:class="{'table-success' : (selectedItem && item.barcode == selectedItem.barcode)}">
                        <td><button @click="removeSelectedItem(item)" type="button" class="btn btn-sm btn-danger"><i class="bx bx-trash-alt"></i></button></td>
                        <td>{{ (index + 1) }}</td>
                        <td>{{ item.barcode }}</td>
                        <td><a :href="'/items/' + item.uuid + '/view'" target="_blank">{{ item.item_description }}</a></td>
                        <td>
                            <span class="badge badge-pill badge-info mr-1" v-for="base_discount in item.base_discounts">{{ base_discount.order_base_discount_group.group_name }}</span>
                        </td>
                        <td>{{ order.branch_location.location_name }}</td>
                        <td class="editable text-right">
                            <span>{{ item.quantity }}</span>
                            <input @keyup="calculate(item)" v-model="item.quantity" type="text" class="editable-control">
                        </td>
                        <td class="editable">
                            <span>{{ findUOMByBarcode(item.uoms,item.barcode) }}</span>
                            <select @change="changeSelectedItemUOM($event.target.value, item, index)" type="text" class="editable-control">
                                <option v-if="!isItemUOMSelected(uom, item)" v-for="(uom,index) in item.uoms" :key="uom.uuid + '-' + index" :value="uom.barcode" v-bind:selected="uom.barcode == item.barcode">{{ uom.uom }}</option>
                            </select>
                        </td>
                        <td class="text-right">{{ parseFloat(item.item_rate).toFixed(2) }}</td>
                        <td class="text-right">{{ parseFloat(item.gross_amount).toFixed(2)  }}</td>
                        <td class="text-right">
                            <a href="javascript:void(0);" @click="showDiscounts(item)">
                                {{ item.discount_rate }}%
                            </a>
                        </td>
                        <td class="text-right">{{ parseFloat(item.discount_amount).toFixed(2) }}</td>
                        <td class="text-right">{{ parseFloat(item.net_amount).toFixed(2) }}</td>
                        <td class="text-right">{{ parseFloat(item.vat_amount).toFixed(2) }}</td>
                        <td class="text-right">{{ parseFloat(item.total_amount).toFixed(2) }}</td>
                        <td>
                            <a v-if="item.price_rule_discounts.length > 0" href="javascript:void(0);" @click="showDiscounts(item, 'price-rule')">
                                Yes
                            </a>
                            <a v-else style="color:#495057;" href="javascript:void(0);">
                                No
                            </a>
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="16"> 
                            <!-- <select class="search-items" v-model="option_items_selected" :options="options_items" name="item-group"></select> -->
                            <input type="text" id="autocomplete" class="form-control">
                        </td>
                    </tr> 
                </tbody>
            </table>

            <br/>
            <br/>

            <div class="row">
            <div class="col-md-6 col-12">
                <h4>Additional Discounts</h4>
                <table class="table mb-0 table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Discount Name</th>
                            <th>Gross Amount</th>
                            <th>Discount Rate</th>
                            <th>Discount Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(discount, index) in additional_discounts" :key="index">
                            
                            <td class="editable text-right">
                                <span>{{ discount.discount_name }}</span>
                                <select @change="changeAdditionalDiscountName(discount)" v-model="discount.discount_name" type="text" class="editable-control">
                                    <option :value="additional_discount.name " v-for="(additional_discount,index) in additional_discount_options" :key="index">{{ additional_discount.name }}</option>
                                </select>
                            </td>
                            <th class="text-right">{{ TOTAL_GROSS_AMOUNT }}</th>
                            <td v-bind:class="{'editable' : discount.discount_type == 'rate'}" class="text-right">
                                <span v-if="discount.discount_type == 'rate'">{{ discount.discount_rate }}% <i class="bx bx-pencil"></i></span>
                                <span v-else style="padding-right:11px;">{{ calculateAdditionalDiscountRate(discount, TOTAL_GROSS_AMOUNT).toFixed(2) }}%</span>
                                <input v-if=" discount.discount_type == 'rate'" v-model="discount.discount_rate" type="text" class="editable-control">
                            </td>
                            <td v-bind:class="{'editable' : discount.discount_type == 'fixed'}" class="text-right">
                                <span v-if="discount.discount_type == 'fixed'">{{ discount.discount_fixed }} <i class="bx bx-pencil"></i></span>
                                <span v-else style="padding-right:11px;">{{ calculateAdditionalDiscountAmount(discount, TOTAL_GROSS_AMOUNT).toFixed(2) }}</span>
                                <input  v-if="discount.discount_type == 'fixed'" v-model="discount.discount_fixed" type="text" class="editable-control">
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                            <td class="text-right"><strong style="padding-right:12px;">{{ calculateTotalAdditionalDiscountAmount().toFixed(2) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4" @click="addAdditionalDiscount()" style="cursor:pointer; background:#efefef; text-align:center; font-weight:600;">ADD DISCOUNT</td>
                        </tr>
                    </tbody>
                </table>
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
    </div>
</template>

<script>

import Swal from 'sweetalert2'
import moment from 'moment'
import PurchaseOrderCreate from './purchase-order-form'

export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {
            is_ready: false,
            order: null,
            items: [],
            selected_items: [],
            options_items: [],
            option_items_selected: null,
            selectedItem: null,
            selectedItemDiscountView: 'all',
            temp_selected_items: [],
            item_list_keyword: '',
            selected_item_list_keyword: '',
            additional_discounts: [],
            additional_discount_options: [
                { name: 'Price Off Discount', type: 'rate' },
                { name: 'Volume Discount', type: 'rate' },
                { name: 'Move-out Discount', type: 'rate' },
                { name: 'Seasonal Discount ', type: 'rate' },
                { name: 'Other Peso Discount', type: 'fixed' },
            ]
        }
    },
    components: {
        'purchase-order-form': PurchaseOrderCreate
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
    },
    methods: {
        addAdditionalDiscount: function () {
            var scope = this 
            scope.additional_discounts.push({
                uuid: null,
                discount_type: 'rate',
                discount_name : 'Price Off Discount',
                discount_rate : 0.00,
                discount_fixed : 0.00
            })
        },
        getAdditonalDiscountOptionDetail: function(name = '', detail = 'all') {
            var scope = this
            var pointed = null;

            for (let i = 0; i < scope.additional_discount_options.length; i++) 
            {
                var current = scope.additional_discount_options[i]

                if (name == current.name) {
                    pointed = current
                    break 
                }
            }

            pointed = (!pointed) ? {name: 'Unknown', type: 'rate'} : pointed ;
            return (detail == 'all') ? pointed : pointed[detail]
        },
        changeAdditionalDiscountName: function (discount) {
            var scope = this
            discount.discount_type = scope.getAdditonalDiscountOptionDetail(discount.discount_name,'type')
        },
        calculateAdditionalDiscountAmount: function(discount, gross) {
            var scope = this
            var rate = parseFloat(discount.discount_rate/100)
            var total = rate * gross

            discount.discount_fixed = total
            
            return total
        },
        calculateAdditionalDiscountRate: function(discount, gross) {
            var scope = this
            var rate = parseFloat(discount.discount_fixed / gross)
            var total = rate * 100
            
    
            discount.discount_rate = total
            
            return total
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
        addAllItems: function() {
            var scope = this
            scope.selected_items = []
            for (let i = 0; i < scope.options_items.length; i++) {
                var current = scope.options_items[i]
                scope.selected_items.push(current);
                scope.calculate(current)
            }
        },
        addItems: function() {
            var scope = this
            scope.temp_selected_items = []
            scope.temp_selected_items = JSON.parse(JSON.stringify(scope.selectedItems))

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
            }

            scope.CLOSE_MODAL('#modal-item-list')
        },
        removeAllZeroAmount: function () {
            var scope = this
            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.selectedItems[i]
                var total_amount = current.total_amount

                if (total_amount <= 0) {
                    console.log('THIS', i)
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
        findUOMByBarcode: function (haystack, barcode) {
           for (let i = 0; i < haystack.length; i++) {
                var current = haystack[i]
                if (current.barcode == barcode ) {
                    return current.uom
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
            console.log('SSSSSSSS', item.discount_rate)
            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateItemGrossAmount: function (item, type = 'formatted') {
            var scope = this
            var rate = item.purchase_price
            var qty = item.quantity
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
            var qty = item.quantity
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
        
        getOrderDetails: function (order_uuid) {
            var scope = this
            scope.GET('buy-and-pay/orders/' + order_uuid).then(res => {
                scope.order = res.data
                scope.additional_discounts =  res.data.additional_discounts
                var supplier_uuid = scope.order.supplier_uuid
                // scope.getSupplierItems(supplier_uuid)
            })
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
        getOrderSupplierItems: function (order_uuid) {
            var scope = this
            scope.options_items = []
            scope.selected_items = []
            scope.GET('buy-and-pay/orders/' + order_uuid + '/supplier-items').then(res => {
                scope.items = res.rows
                var selected = res.selected_items

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
                            scope.selected_items.push(JSON.parse(JSON.stringify(suggestion)));
                            var index = scope.selected_items.length - 1
                            var latest = scope.selected_items[index]
                            scope.selectedItem = latest
                            scope.calculate(latest)
                            $('#autocomplete').val('')
                        },
                        beforeRender: function (container, suggestions) {
                            container.html('Searching..')
                            var html = '<table style="width:100%;"><thead style="padding:2px 3px;"><tr style="background:#51a8f8; color:#fff;"><th>Barcode</th><th>Item Description</th><th>Packing</th><th>UOM</th></tr></thead>'
                            html += '<tbody style="padding:2px 3px;">';
                            for (let i = 0; i < suggestions.length; i++) {
                                var suggestion = suggestions[i]
                                html+= '<tr class="autocomplete-suggestion" value="'+ suggestion.value +'">'
                                html += '<td>'+suggestion.barcode+'</td>'
                                html += '<td>'+suggestion.item_description+'</td>'
                                html += '<td>'+suggestion.uom_packing+'</td>'
                                html += '<td>'+suggestion.uom_label+'</td>'
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
        getItemUOMPacking: function (uoms, uuid) {
            var data = uoms.filter((uom) => {
                return uom.uuid.indexOf(uuid) > -1;
            })
            
            if (data.length < 1) {
                return ''
            }

            return data[0].packing_qtty
        },
        showDiscounts: function (item, view = 'all') {
            var scope = this
            scope.selectedItem = item
            scope.selectedItemDiscountView = view
            scope.OPEN_MODAL('#modal-discounts');
        },
        save: function() {
            var scope = this

            scope.POST('buy-and-pay/orders/' + scope.order.uuid + '/details', {items: scope.selectedItems }).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Orders Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })

            // save addtional discounts
            scope.POST('buy-and-pay/orders/' + scope.order.uuid + '/additional-discounts', {discounts: scope.additional_discounts }).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Orders Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        if (res.success) {
                            scope.additional_discounts = res.rows
                        }
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        },
        loadData: function () {
            var scope = this
            var order_uuid = scope.$route.params.order_uuid;
            scope.getOrderDetails(order_uuid)
            scope.getOrderSupplierItems(order_uuid)
        }
    },
    mounted() {
        var scope = this
        scope.loadData()

        $(document).on('blur','#autocomplete',function(){
            $(this).val('')
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

</style>