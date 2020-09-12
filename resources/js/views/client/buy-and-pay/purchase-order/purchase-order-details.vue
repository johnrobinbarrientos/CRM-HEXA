<template>
    <div v-if="is_ready">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Purchase Order</div>
                <div class="mb-3 card-subtitle">
                    
                </div>


                <div class="po-details alert alert-warning fade show" role="alert">
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
                                <strong>Item Group:</strong>
                                <p>{{ order.item_group.item_group }}</p>
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
                            <div>
                                <strong>Term:</strong>
                                <p>{{ order.term || '-' }}</p>
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

                <div class="row">
                    <div class="col-12 col-lg-3">
                        <input style="margin-bottom:10px;" v-model="added_item_list_keyword"  class="form-control" type="text" placeholder="Search an Item">
                    </div>
                    <div class="col-12 col-lg-9">
                        <div style="float:right;">
                            
                            <button @click="addItems()" class="btn btn-sm btn-primary btn btn-secondary">Add Items</button>
                            <button @click="addAllItems()" class="btn btn-sm btn-primary btn btn-secondary">Add All Items</button>
                            <button class="btn btn-sm btn-danger btn btn-secondary">Remove Zero</button>
                        
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
                            <th>Discount</th>
                            <th>Net Sales</th>
                            <th>VAT Amount</th>
                            <th>EWT Amount</th>
                            <th>Total Amount</th>
                            
                            <th>Price Rule?</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in selectedItemList" :key="item.uuid">
                            <td>{{ (index + 1) }}</td>
                            <td>{{ item.item_code }}</td>
                            <td>{{ item.item_description }}</td>
                            <td>{{ order.branch_location.location_name }}</td>
                            <td class="editable text-right">
                                <span>{{ item.quantity }}</span>
                                <input v-model="item.quantity" type="text" class="editable-control">
                            </td>
                            <td class="editable">
                                <span>{{ getItemUOMName(item.uoms, item.uom) }}</span>
                                <select v-model="item.uom" type="text" class="editable-control">
                                    <option v-for="uom in item.uoms" :key="uom.uuid" :value="uom.uuid">{{ uom.uom }}</option>
                                </select>
                            </td>
                            
                            <td class="text-right"> {{ item.purchase_price }}</td>
                            <td class="text-right">{{ processItemCalculations(item).gross_amount }}</td>
                            <td class="text-right">{{ processItemCalculations(item).discount_amount }}</td>
                            <td class="text-right">{{ processItemCalculations(item).net_sales }}</td>
                            <td class="text-right">{{ processItemCalculations(item).vat_amount }}</td>
                            <td class="text-right">{{ processItemCalculations(item).ewt_amount }}</td>
                            <td class="text-right">{{ processItemCalculations(item).total_amount }}</td>
                            <td>No</td>
                        </tr> 
                    </tbody>
                </table>

                <br/>
                <br/>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h3>Regular Discounts</h3>
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
                                <tr v-for="(discount, index) in discounts" :key="index">
                                    <th>{{ discount.discount_name }}</th>
                                    <th class="text-right">{{ calculateTotals().total_gross_amount }}</th>
                                    <th class="text-right">{{ discount.discount_rate }}%</th>
                                    <th class="text-right">{{ calculateDiscountAmount(discount) }}</th>
                                </tr>
                            </tbody>
                        </table>

                        <br/>
                        <br/>

                        <h3>Price Rule Discounts</h3>
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
                                <tr v-for="(discount, index) in price_rules" :key="index">
                                    <th>{{ discount.discount_name }}</th>
                                    <th class="text-right">{{ calculateTotals().total_gross_amount }}</th>
                                    <th class="text-right">{{ discount.discount_rate }}%</th>
                                    <th class="text-right">{{ calculateAdditionalDiscountAmount(discount) }}</th>
                                </tr>
                            </tbody>
                        </table>


                        <br/>
                        <br/>

                        <h3>Additional Discounts</h3>
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
                                        <input v-model="discount.discount_name" type="text" class="editable-control">
                                    </td>
                                    <th class="text-right">{{ calculateTotals().total_gross_amount }}</th>
                                    <td class="editable text-right">
                                        <span>{{ discount.discount_rate }}%</span>
                                        <input v-model="discount.discount_rate" type="text" class="editable-control">
                                    </td>
                                    <th class="text-right">{{ calculateAdditionalDiscountAmount(discount) }}</th>
                                </tr>
                                <tr>
                                    <td colspan="4" @click="addNewDiscount()" style="cursor:pointer; background:#efefef; text-align:center; font-weight:600;">ADD DISCOUNT</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 col-12 offset-md-2">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h2>Total Gross Amount</h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <h2 class="text-right text-warning"><strong>{{ calculateTotals().total_gross_amount }}</strong></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h2>{{ (calculateTotalDiscounts() * 100).toFixed(2) + '%' }}  Discounts</h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <h2 class="text-right text-disabled"><strong> -{{ calculateTotals().total_discount_amount }} </strong></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h2>12% VAT</h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <h2 class="text-right text-danger"><strong> {{ calculateTotals().total_vat_amount }} </strong></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h2>PO Total Amount</h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <h2 class="text-right text-success"><strong>{{ calculateTotals().total_po_amount }}</strong></h2>
                            </div>
                        </div>
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
                                    <tr v-for="(item, index) in itemList" :key="index" v-bind:class="{'table-success' : isSelected(item) }">
                                        <th scope="row">
                                            <i @click="addItem(item)" v-if="!isSelected(item)" class="kx-checkbox bx bx-checkbox"></i>
                                            <i @click="removeItem(item)" v-else class="kx-checkbox checked bx bx-checkbox-checked"></i>
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
                        <button @click="saveTempItems()" type="submit" class="btn btn-lg btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'purchase-order-details',
    props: ['properties'],
    data: function () {
        return {
            is_ready: false,
            order: null,
            selected_supplier: null,
            suppliers: [],
            options_supplier: [],
            items: [],
            temp_selected_items: [],
            selected_items: [],
            item_list_keyword: '',
            added_item_list_keyword: '',
            additional_discounts: [],
        }
    },
    computed: {
        selectedItemList() {
            var scope = this
            var keyword = scope.added_item_list_keyword.toLowerCase()
            return this.selected_items.filter((item) => {
                return (item.item_code.toLowerCase().indexOf(keyword) > -1 ||
                item.item_description.toLowerCase().indexOf(keyword) > -1 ||
                item.item_shortname.toLowerCase().indexOf(keyword) > -1);
            })
        },
        itemList() {
            var scope = this
            var keyword = scope.item_list_keyword.toLowerCase()
            return this.items.filter((item) => {
                return (item.item_code.toLowerCase().indexOf(keyword) > -1 ||
                item.item_description.toLowerCase().indexOf(keyword) > -1 ||
                item.item_shortname.toLowerCase().indexOf(keyword) > -1);
            })
        },
        discounts() {
            return this.order.discounts
        },
        price_rules() {
            return this.order.price_rules
        }
    },
    watch: {
        selected_items: function (val) {
            
        },
    },
    methods: {
        addNewDiscount: function () {
            var scope = this 
            scope.additional_discounts.push({
                discount_name : '',
                discount_rate : 0.00,
                discount_fixed : 0.00
            })
        },
        processItemCalculations: function (item) {
            var scope = this

            var discounts = scope.calculateTotalDiscounts()
            var gross_amount = scope.calculateItemGrossAmount(item)

            var discount_amount = gross_amount * discounts
            var net_sales = gross_amount - discount_amount

            var vat_amount = net_sales * 0.12
            var ewt_amount = 0
            var total_amount = (net_sales + vat_amount) - ewt_amount;
            
            return { 
                discounts : discounts.toFixed(2),
                gross_amount : gross_amount,
                discount_amount : discount_amount.toFixed(2),
                net_sales : net_sales.toFixed(2),
                vat_amount : vat_amount.toFixed(2),
                ewt_amount : ewt_amount.toFixed(2),
                total_amount : total_amount.toFixed(2),
            }
        },
        calculateTotalDiscounts: function() {
            var scope = this
            var discounts = scope.discounts
            var total_discount_rate = 0;
            for (let i = 0; i< discounts.length; i++) {
                var current = discounts[i]

                total_discount_rate += parseFloat(current.discount_rate)

                if (i == (discounts.length - 1)) {

                    var price_rules = scope.calculateTotalPriceRuleDiscounts() * 100
                    var additional_discounts = scope.calculateTotalAdditionalDiscounts() * 100

                    total_discount_rate += price_rules
                    total_discount_rate += additional_discounts
                    return total_discount_rate / 100
                }
            }

            var price_rules = scope.calculateTotalPriceRuleDiscounts() * 100
            total_discount_rate += price_rules

            return total_discount_rate / 100
        },
        calculateTotalPriceRuleDiscounts: function() {
            var scope = this
            var discounts = scope.price_rules
            var total_discount_rate = 0;
            for (let i = 0; i< discounts.length; i++) {
                var current = discounts[i]
                total_discount_rate += parseFloat(current.discount_rate)
                if (i == (discounts.length - 1)) {
                    return total_discount_rate / 100
                }
            }
            return total_discount_rate / 100
        },
        calculateTotalAdditionalDiscounts: function() {
            var scope = this
            var discounts = scope.additional_discounts
            var total_discount_rate = 0;
            for (let i = 0; i< discounts.length; i++) {
                var current = discounts[i]
                total_discount_rate += parseFloat(current.discount_rate)
                if (i == (discounts.length - 1)) {
                    return total_discount_rate / 100
                }
            }
            return total_discount_rate / 100
        },
        calculateItemGrossAmount: function (item) {
            var scope = this
            var rate = item.purchase_price
            var qty = item.quantity
            var uom = item.uom
            var packing = scope.getItemUOMPacking(item.uoms, item.uom)

            var total = (qty * packing) * rate
            total = total / 1.12

            return total.toFixed(2)
        },
        calculateTotals: function () {
            var scope = this
            var items = scope.selected_items

            var total_gross = 0
            var total_po_amount = 0
            var total_discount_amount = 0
            var total_vat_amount = 0

            for (let i = 0; i< items.length; i++) {
                var current = items[i]
                var gross_amount = scope.processItemCalculations(current).gross_amount
                var total_amount = scope.processItemCalculations(current).total_amount
                var discount_amount = scope.processItemCalculations(current).discount_amount
                var vat_amount = scope.processItemCalculations(current).vat_amount
             
                total_gross += parseFloat(gross_amount)
                total_po_amount += parseFloat(total_amount)
                total_discount_amount += parseFloat(discount_amount)
                total_vat_amount += parseFloat(vat_amount)
                
                if (i == (items.length - 1)) {
                    
                    return { 
                        total_po_amount : total_po_amount.toFixed(2),
                        total_gross_amount : total_gross.toFixed(2),
                        total_discount_amount : total_discount_amount.toFixed(2),
                        total_vat_amount : total_vat_amount.toFixed(2) 
                    }
                }
            }
            

            return { 
                total_po_amount : total_po_amount.toFixed(2),
                total_gross_amount : total_gross.toFixed(2),
                total_discount_amount : total_discount_amount.toFixed(2),
                total_vat_amount : total_vat_amount.toFixed(2) 
            }
        },
        calculateDiscountAmount: function(discount) {
            var scope = this
            var total_gross_amount = scope.calculateTotals().total_gross_amount
            var discount_rate = discount.discount_rate
            discount_rate = discount_rate / 100

            var discount_amount = total_gross_amount * discount_rate
            return discount_amount.toFixed(2)
        },
        calculatePriceRuleDiscountAmount: function(discount) {
            var scope = this
            var total_gross_amount = scope.calculateTotals().total_gross_amount
            var discount_rate = discount.discount_rate
            discount_rate = discount_rate / 100

            var discount_amount = total_gross_amount * discount_rate
            return discount_amount.toFixed(2)
        },
        calculateAdditionalDiscountAmount: function(discount) {
            var scope = this
            var total_gross_amount = scope.calculateTotals().total_gross_amount
            var discount_rate = discount.discount_rate
            discount_rate = discount_rate / 100

            var discount_amount = total_gross_amount * discount_rate
            return discount_amount.toFixed(2)
        },
        getSuppliers: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.business_name + '('+ data.business_shortname +')'
                    })
                })

                $(".form-select-suppliers").select2({data: scope.options_supplier});
            })
        },
        getOrderDetails: function (order_uuid) {
            var scope = this
            scope.GET('buy-and-pay/orders/' + order_uuid).then(res => {
                scope.order = res.data
                var supplier_uuid = scope.order.supplier_uuid
                scope.getSupplierItems(supplier_uuid)
                scope.is_ready = true
            })
        },
        getSupplierItems: function(supplier_uuid) {
            var scope = this

            scope.selected_items = []
            var item_discount_group_uuid = scope.order.item_discount_group_uuid
            scope.GET('suppliers/supplier-list/' + supplier_uuid + '/items?is_purchase_item=yes&with_uoms=yes&discount_group_uuid=' + item_discount_group_uuid).then(res => {
                scope.items = res.rows
            })
        },
        addAllItems: function() {
            var scope = this
            scope.selected_items = scope.items
        },
        addItems: function() {
            var scope = this
            scope.temp_selected_items = []
            scope.temp_selected_items = JSON.parse(JSON.stringify(scope.selected_items))

            scope.OPEN_MODAL('#modal-item-list');
        },
        addItem: function(item) {
            var scope = this
            scope.temp_selected_items.push(item)
        },
        removeItem: function(pointed) {
            var scope = this
            for (let i = 0; i < scope.temp_selected_items.length; i++) {
                var current = scope.temp_selected_items[i]
                if (current.uuid == pointed.uuid) {
                    scope.temp_selected_items.splice(i, 1);
                }
            }
        },
        saveTempItems: function () {
            var scope = this
            scope.selected_items = []
            scope.selected_items = JSON.parse(JSON.stringify(scope.temp_selected_items))
            scope.CLOSE_MODAL('#modal-item-list');
        },
        isSelected: function(pointed) {
            var scope = this
            var count = scope.temp_selected_items.filter(item => {
                return item.uuid.indexOf(pointed.uuid) > -1
            }).length
            return (count > 0) ? true : false
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
    },
    mounted() {
        var scope = this
        var order_uuid = scope.$route.params.order_uuid;

        scope.getOrderDetails(order_uuid);

        /*
        $(document).off('change').on('change','.form-select-suppliers', function(e) { 
            scope.selected_supplier = $('.form-select-suppliers').val();
            scope.getSupplierItems(scope.selected_supplier);
        })
        */
    },
}



</script>


