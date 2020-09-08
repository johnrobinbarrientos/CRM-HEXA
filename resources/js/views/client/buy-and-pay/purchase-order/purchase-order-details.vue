<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">Purchase Order</div>
                <div class="mb-3 card-subtitle">
                    
                </div>

                <div class="row">
                    <div class="col-12 col-lg-3">
                        <input v-model="added_item_list_keyword"  class="form-control" type="text" placeholder="Search an Item">
                    </div>
                    <div class="col-12 col-lg-9">
                        <div style="float:right; padding-bottom:10px;">
                            <div class="btn-group btn-group-sm mt-2" role="group" aria-label="Basic example">
                                <button @click="addItems()" class="btn btn-primary btn btn-secondary">Add Items</button>
                                <button @click="addAllItems()" class="btn btn-primary btn btn-secondary">Add All Items</button>
                            </div>
                            <div class="btn-group btn-group-sm mt-2" role="group" aria-label="Basic example">
                                <button class="btn btn-danger btn btn-secondary">Remove Zero</button>
                            </div>
                        </div>
                    </div>
                </div>
   
                <table class="table mb-0 table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="120">#</th>
                            <th>Item Code</th>
                            <th>Item Description</th>
                            <th>UOM</th>
                            <th width="120">Quantity</th>
                            
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Net Sales</th>
                            <th>VAT</th>
                            <th>Total Amount</th>
                            <th>Location</th>
                            <th>Price Rule?</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in selectedItemList" :key="item.uuid">
                            <td>{{ (index + 1) }}</td>
                            <td>{{ item.item_code }}</td>
                            <td>{{ item.item_description }}</td>
                            <td class="editable">
                                <span>{{ getItemUOMName(item.uoms, item.uom) }}</span>
                                <select v-model="item.uom" type="text" class="editable-control">
                                    <option v-for="uom in item.uoms" :key="uom.uuid" :value="uom.uuid">{{ uom.uom }}</option>
                                </select>
                            </td>
                            <td class="editable text-right">
                                <span>{{ item.quantity }}</span>
                                <input v-model="item.quantity" type="text" class="editable-control">
                            </td>
                            
                            <td class="text-right">
                                {{   (item.purchase_price * getItemUOMPacking(item.uoms, item.uom)) }}
                            </td>
                            <td class="text-right">{{ (item.purchase_price * (item.quantity * getItemUOMPacking(item.uoms, item.uom))) || '0.00' }}</td>
                            
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>12%</td>
                            <td>0</td>
                            <td>N/A</td>
                            <td>N/A</td>
                        </tr> 
                    </tbody>
                </table>
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
            order: null,
            selected_supplier: null,
            suppliers: [],
            options_supplier: [],
            items: [],
            temp_selected_items: [],
            selected_items: [],
            item_list_keyword: '',
            added_item_list_keyword: '',
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
        }
    },
    methods: {
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
            })
        },
        getSupplierItems: function(supplier_uuid) {
            var scope = this

            scope.selected_items = []
            scope.GET('suppliers/supplier-list/' + supplier_uuid + '/items?is_purchase_item=yes&with_uoms=yes').then(res => {
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


