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
                    <div style="margin-bottom:30px; padding:10px; background:#fafafa; border:1px solid #efefef;" class="po-details">
                        <h4 style="margin-bottom:20px;">Information</h4>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <div>
                                    <strong>Transaction Type:</strong>
                                    <p>Purchase Order</p>
                                </div>

                                <div>
                                    <strong>Reference #:</strong>
                                    <p>{{ order.po_no }}</p>
                                </div>
                                
                                <div>
                                    <strong>Supplier:</strong>
                                    <p>{{ order.supplier.business_name }}</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div>
                                    <strong>Term:</strong>
                                    <p>{{ order.term || '-' }}</p>
                                </div>
                                <div>
                                    <strong>Branch:</strong>
                                    <p>{{ order.branch.branch_name }}</p>
                                </div>
                                <div>
                                    <strong>Branch Location:</strong>
                                    <p>{{ order.branch_location.location_name }}</p>
                                </div>
                            </div>


                            <div class="col-md-3 col-12">
                                <div>
                                    <strong>Date Purchased:</strong>
                                    <p>{{ order.date_purchased }}</p>
                                </div>
                                <div>
                                    <strong>Date Expected:</strong>
                                    <p>{{ order.date_expected }}</p>
                                </div>
                                
                            </div>

                            <div class="col-md-3 col-12">
                                <div>
                                    <strong>Status:</strong>
                                    <p>{{ order.status }}</p>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    <div style="margin-bottom:30px; padding:10px; background:#fafafa; border:1px solid #efefef;" class="po-details">
                        <h4 style="margin-bottom:20px;">Summary</h4>
                        <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                            <div>Gross Amount</div>
                            <div>{{ calculateTotalGrossAmount() }}</div>
                        </div>
                        <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                            <div>Discount</div>
                            <div>-{{ calculateTotalDiscountAmount() }}</div>
                        </div>
                        <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                            <div>Tax Amount</div>
                            <div>{{ calculateTotalVATAmount() }}</div>
                        </div>
                        <div style="display:flex; justify-content: space-between; font-weight:900;">
                            <div>PO Amount</div>
                            <div>{{ calculateTotalPOAmount() }}</div>
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
                        <th width="120">#</th>
                        <th>Item Code</th>
                        <th>Item Description</th>
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
                        <tr v-for="(item, index) in selectedItems" :key="item.uuid">
                        <td>{{ (index + 1) }}</td>
                        <td>{{ item.item_code }}</td>
                        <td><a :href="'/items/' + item.uuid" target="_blank">{{ item.item_description }}</a></td>
                        <td>{{ order.branch_location.location_name }}</td>
                        <td class="editable text-right">
                            <span>{{ item.quantity }}</span>
                            <input @keyup="calculate(item)" v-model="item.quantity" type="text" class="editable-control">
                        </td>
                        <td class="editable">
                            <span>{{ getItemUOMName(item.uoms, item.uom) }}</span>
                            <select @change="calculate(item)" v-model="item.uom" type="text" class="editable-control">
                                <option v-for="uom in item.uoms" :key="uom.uuid" :value="uom.uuid">{{ uom.uom }}</option>
                            </select>
                        </td>
                        <td class="text-right">{{ parseFloat(item.item_rate).toFixed(2) }}</td>
                        <td class="text-right">{{ parseFloat(item.gross_amount).toFixed(2)  }}</td>
                        <td class="text-right">
                            <a href="javascript:void(0);" @click="showDiscounts(item)">
                                {{ calculateTotalDiscountRate(item,'formatted') }}%
                            </a>
                        </td>
                        <td class="text-right">{{ parseFloat(item.discount_amount).toFixed(2) }}</td>
                        <td class="text-right">{{ parseFloat(item.net_amount).toFixed(2) }}</td>
                        <td class="text-right">{{ parseFloat(item.vat_amount).toFixed(2) }}</td>
                        <td class="text-right">{{ parseFloat(item.total_amount).toFixed(2) }}</td>
                        <td>{{ (item.price_rule_discounts.length > 0) ? 'Yes' : 'No'}}</td>
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
                            <th>Discount Type</th>
                            <th>Gross Amount</th>
                            <th>Discount Rate</th>
                            <th>Discount Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(discount, index) in additional_discounts" :key="index">
                            
                            <td class="editable text-right">
                                <span>{{ discount.discount_name }}</span>
                                <input v-model="discount.discount_name" type="text" class="editable-control">
                            </td>
                            <td class="editable">
                                <span>{{ discount.discount_type }}</span>
                                <select v-model="discount.discount_type" type="text" class="editable-control">
                                    <option value="rate">rate</option>
                                    <option value="fixed">fixed</option>
                                </select>
                            </td>
                            <th class="text-right">{{ calculateTotalGrossAmount() }}</th>
                            <td v-bind:class="{'editable' : discount.discount_type == 'rate'}" class="text-right">
                                <span v-if="discount.discount_type == 'rate'">{{ discount.discount_rate }}%</span>
                                <span v-else style="padding-right:11px;">{{ calculateAdditionalDiscountRate(discount, calculateTotalGrossAmount()).toFixed(2) }}%</span>
                                <input v-if=" discount.discount_type == 'rate'" v-model="discount.discount_rate" type="text" class="editable-control">
                            </td>
                            <td v-bind:class="{'editable' : discount.discount_type == 'fixed'}" class="text-right">
                                <span v-if="discount.discount_type == 'fixed'">{{ discount.discount_fixed }}</span>
                                <span v-else style="padding-right:11px;">{{ calculateAdditionalDiscountAmount(discount, calculateTotalGrossAmount()).toFixed(2) }}</span>
                                <input  v-if="discount.discount_type == 'fixed'" v-model="discount.discount_fixed" type="text" class="editable-control">
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total</strong></td>
                            <td class="text-right"><strong style="padding-right:12px;">{{ calculateTotalAdditionalDiscountAmount().toFixed(2) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" @click="addAdditionalDiscount()" style="cursor:pointer; background:#efefef; text-align:center; font-weight:600;">ADD DISCOUNT</td>
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

                                <hr/>

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
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Short Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in itemList" :key="index" v-bind:class="{'table-success' : isTempSelected(item) }">
                                        <th scope="row">
        
                                            <i @click="addTempItem(item)" v-if="!isTempSelected(item)" class="kx-checkbox bx bx-checkbox"></i>
                                            <i @click="removeTempItem(item)" v-else class="kx-checkbox checked bx bx-checkbox-checked"></i>
       
                                        </th>
                                        <td>{{ item.item_code }}</td>
                                        <td>{{ item.item_description }}</td>
                                        <td>{{ item.item_shortname }}</td>
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

export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {
            is_ready: false,
            order: null,
            items: [],
            selectedItem: null,
            temp_selected_items: [],
            item_list_keyword: '',
            selected_item_list_keyword: '',
            additional_discounts: []
        }
    },
    computed: {
        itemList() {
            var scope = this
            var keyword = scope.item_list_keyword.toLowerCase()
            return this.items.filter((item) => {
                return (item.item_code.toLowerCase().indexOf(keyword) > -1 ||
                item.item_description.toLowerCase().indexOf(keyword) > -1 ||
                item.item_shortname.toLowerCase().indexOf(keyword) > -1);
            })
        },
        selectedItems() {
            var scope = this
            var keyword = scope.selected_item_list_keyword.toLowerCase()
            return this.items.filter((item) => {
                return (item.selected && (item.item_code.toLowerCase().indexOf(keyword) > -1 ||
                item.item_description.toLowerCase().indexOf(keyword) > -1 ||
                item.item_shortname.toLowerCase().indexOf(keyword) > -1));
            })
        },
    },
    methods: {
        addAdditionalDiscount: function () {
            var scope = this 
            scope.additional_discounts.push({
                uuid: null,
                discount_type: 'rate',
                discount_name : '',
                discount_rate : 0.00,
                discount_fixed : 0.00
            })
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
            for (let i = 0; i < scope.items.length; i++) {
                var current = scope.items[i]
                current.selected = true
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
                return item.uuid.indexOf(pointed.uuid) > -1
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
                if (current.uuid == pointed.uuid) {
                    scope.temp_selected_items.splice(i, 1);
                }
            }
        },
        clearSelectedItems: function() {
            var scope = this
            for (let i = 0; i < scope.items.length; i++) {
                var current = scope.items[i]
                current.selected = false
            }
        },
        saveTempItems: function () {
            var scope = this
            scope.clearSelectedItems()
            for (let i = 0; i < scope.temp_selected_items.length; i++) {
                var current = scope.temp_selected_items[i]
                scope.items.filter((item) => {
                    if (current.uuid == item.uuid) {
                        item.selected = true
                        console.log(item)
                    }
                })
            }

            scope.CLOSE_MODAL('#modal-item-list')
        },
        removeAllZeroAmount: function () {
            var scope = this
            for (let i = 0; i < scope.items.length; i++) {
                var current = scope.items[i]
                var total_amount = scope.calculateTotalAmount(current,'non-formatted')

                if (total_amount <= 0) {
                    current.selected = false
                }
            }
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
            
            var discounts = scope.calculateTotalDiscountRate(item,'non-formatted')
            discounts = discounts / 100

            var gross = scope.calculateItemGrossAmount(item,'non-formatted')

            var total =  (gross * discounts)

            item.discount_amount = total

            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateItemNetAmount: function (item, type = 'formatted') {
            var scope = this
            
            var gross = scope.calculateItemGrossAmount(item,'non-formatted') 
            var discount = scope.calculateItemDiscountAmount(item,'non-formatted')

            var total = gross - discount

            item.net_amount = total

            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateVATAmount: function (item, type = 'formatted') {
            var scope = this
            var net = scope.calculateItemNetAmount(item, 'non-formatted')
            var total = net * 0.12

            item.vat_amount = total

            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateTotalAmount: function (item, type = 'formatted') {
            var scope = this
            var net = scope.calculateItemNetAmount(item, 'non-formatted')
            var vat = scope.calculateVATAmount(item, 'non-formatted')
            var total = net + vat

            item.total_amount = total
            
            return (type == 'formatted') ? total.toFixed(2) : total
        },
        calculateTotalGrossAmount: function () {
            var scope = this
            var total_amount = 0.00
            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.items[i]
                total_amount += scope.calculateItemGrossAmount(current,'non-formatted')
            }

            return total_amount.toFixed(2)
        },
        calculateTotalDiscountAmount: function () {
            var scope = this
            var total_amount = 0.00
            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.items[i]
                total_amount += parseFloat(scope.calculateItemDiscountAmount(current,'formatted'))
            }

            total_amount += scope.calculateTotalAdditionalDiscountAmount()

            return total_amount.toFixed(2)
        },
        calculateTotalVATAmount: function () {
            var scope = this
            var total_amount = 0.00
            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.items[i]
                total_amount += scope.calculateVATAmount(current,'non-formatted')
            }

            return total_amount.toFixed(2)
        },
        calculateTotalPOAmount: function () {
            var scope = this
            var total_amount = 0.00
            for (let i = 0; i < scope.selectedItems.length; i++) {
                var current = scope.items[i]
                total_amount += scope.calculateTotalAmount(current,'non-formatted')
            }

            total_amount -= scope.calculateTotalAdditionalDiscountAmount()
            return total_amount.toFixed(2)
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
        getOrderSupplierItems: function (order_uuid) {
            var scope = this
            scope.GET('buy-and-pay/orders/' + order_uuid + '/supplier-items').then(res => {
                scope.items = res.rows
                 scope.is_ready = true
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
        showDiscounts: function (item) {
            var scope = this
            scope.selectedItem = item
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
    },
    mounted() {
        var scope = this
        var order_uuid = scope.$route.params.order_uuid;
        scope.getOrderDetails(order_uuid)
        scope.getOrderSupplierItems(order_uuid)
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>