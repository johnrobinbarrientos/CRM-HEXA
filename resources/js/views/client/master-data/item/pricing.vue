<template>
<div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div>
                <div style="background:#fafafa; border:1px solid #efefef; padding:5px 5px; font-weight:600; height:35px; line-height:25px;">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div style="position:relative; padding-left:25px; ">
                                <input style="position:absolute; top:5px; left:5px; " type="checkbox" v-model="item.is_purchase_item" value="1" id="is-purchase-item">
                                Is Purchase Item?
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <button @click="addSupplier()" type="button" v-if="item.is_purchase_item"  style="font-size: 11px; border: 1px solid rgb(204, 204, 204); padding: 0px 10px; float: right; height: 25px; line-height:25px; color: #333; border-radius: 3px;">Add Supplier</button>
                        </div>
                    </div>
                </div>
                <div v-if="item.is_purchase_item" >
                    <div v-if="selected_suppliers.length < 1" style="background:#fafafa; padding:20px 20px; text-align:center;  border:1px solid #efefef; border-top:none;">
                        No Supplier
                    </div>
                    <div v-else>
                        <table v-show="item.is_purchase_item" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Purchase Price</th>
                                    <th>Discount Group</th>
                                    <th>Discount Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item_supplier,index in selected_suppliers" :key="'supplier-' + index">
                                    <td width="80" class="text-center">
                                        <button type="button" class="btn-gray-small" @click="edit(item_supplier,index)">Edit</button>
                                    </td>
                                    <td><strong >{{ item_supplier.supplier.supplier_name }}</strong></td>
                                    <td width="100" class="text-right">
                                        <strong>{{ item_supplier.purchase_price || 0.00 }}</strong>
                                    </td>
                                    <td width="150" ><strong v-if="item_supplier.selected_discount_group">{{ item_supplier.selected_discount_group.name || 'None' }}</strong></td>
                                    <td width="150" class="text-right"><strong v-if="item_supplier.selected_discount_group">{{ item_supplier.selected_discount_group.total_rate || 0 }}%</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div>
                <div style="background:#fafafa; border:1px solid #efefef; padding:5px 5px; font-weight:600; height:35px; line-height:25px;">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div style="position:relative; padding-left:25px; ">
                                <input style="position:absolute; top:5px; left:5px; " type="checkbox" v-model="item.is_sales_item" value="1" id="is-sales-item">
                                Is Sales Item?
                            </div>
                        </div>
                    </div>
                </div>
                <div v-show="item.is_sales_item" style="padding:10px; background:#fafafa; border:1px solid #efefef;">
                    <div class="d-flex">
                        <div class="form-group" style="display: flex; align-items: center; margin: 0 !important;">
                            <label class="form-label m-0 mr-2" for="sales-price">Sales Price:</label>
                            <div class="form-control-wrap">
                                <input v-model="item.sales_price" type="text" class="form-control" id="sales-price">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade modal-md-form" tabindex="-1" id="modalSuppliers">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span v-if="selected_supplier">{{ selected_supplier.supplier_name }}</span>
                        <span v-else>New Supplier</span>
                    </h5>
                    <a href="javascript:void(0)"  @click="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <form v-if="selected_supplier" action="#" class="form-validate is-alter">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div v-if="selected_supplier_index === null" style="margin-bottom:10px;">
                                    <strong>Supplier</strong>
                                    <multiselect v-model="selected_supplier.supplier" @search-change="search()" :loading="option_suppliers_loading" :options="option_suppliers"  label="supplier_name" track-by="uuid" :allow-empty="false" deselect-label="Selected" selectLabel="Select">
                                        <span slot="noResult">No Results</span>
                                    </multiselect>
                                </div>

                                <div style="margin-bottom:10px;">
                                    <strong>Purchase Price</strong>
                                    <input v-model="selected_supplier.purchase_price" class="form-control-gray-medium"  v-bind:class="{'error' : selected_supplier.purchase_price_error}" type="text" placeholder="Enter Purchase Price">
                                </div>

                                <template v-if="selected_supplier.supplier">
                                    <div style="margin-bottom:10px;">
                                        <strong>Discount Group</strong>
                                        <select v-model="selected_supplier.bd_group_supplier_uuid" class="form-control-gray-medium"  v-bind:class="{'error' : selected_supplier.bd_group_supplier_uuid_error}" placeholder="Enter Purchase Price">
                                            <option :value="null">Select Discount Group</option>
                                            <option v-for="discount_group,index in selected_supplier.supplier.discount_groups" :key="'option-discount-group-' + index" :value="discount_group.uuid">
                                                {{ discount_group.name }}
                                            </option>
                                        </select>
                                    </div>

                                    <div v-if="selected_supplier.bd_group_supplier_uuid" style="padding:10px; padding-bottom:20px; margin-top:15px; background:#fafafa; border:1px solid #efefef;">
                                        
                                        <span style="font-weight:600; display:inline-block;">Discount List</span>
                                        <table style="margin-top:5px;" class="table table-bordered table-hover">
                                            <thead>
                                                <tr style="background:#fff;">
                                                    <th>Name</th>
                                                    <th>Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="background:#fff;" v-for="(discount,discount_index) in getSelectedDiscountGroupDetails(selected_supplier.bd_group_supplier_uuid,selected_supplier.supplier.discount_groups).discounts " :key="'edit-group-discount-' + discount_index ">

                                                    <td style="padding:0px 2px;">
                                                        {{ discount.name }}
                                                    </td>
                                                    <td style="padding:0px 2px; text-align:right;"  width="70">
                                                        {{ discount.rate }}%
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </template>
    
                            </div>                                           
                        </div>                                    
                        
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button @click="save()" type="button" class="btn btn-sm btn-primary">Update</button>
                    <button @click="cancel()" type="button" class="btn btn-sm btn-default">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>



<script>

import Swal from 'sweetalert2'

export default {
    name: 'supplier-group',
    props: ['properties','item','view_mode'],
    data: function () {
        return {
            item_uuid: null,
            selected_supplier: null,
            selected_supplier_index: null,
            suppliers: [],
            option_suppliers: [],
            option_suppliers_loading: false,
            selected_supplier_uuids: [],
            selected_suppliers: []
        }
    },

    methods: {
        search: function() {
            var scope = this
            scope.DEBOUNCE(() => {
               scope.getSuppliers();
            },300)
        },
        getSuppliers: function () {
            var scope = this
            scope.option_suppliers_loading = true
            scope.GET('suppliers?discounts=included&notIn=' + scope.selected_supplier_uuids).then(res => {
                scope.option_suppliers_loading = false
                scope.option_suppliers = res.rows
            })
        },
        addSupplier: function () {
            var scope = this
            scope.selected_supplier_index = null

            scope.selected_supplier = {
                supplier_uuid: null,
                supplier: null,
                purchase_price:   0.00,
                bd_group_supplier_uuid:  null,
            }

            scope.OPEN_MODAL('#modalSuppliers');
        },
        edit: function (data,index) {
            var scope = this

            var copy = JSON.parse(JSON.stringify(data))
 
            scope.selected_supplier_index = index
            scope.selected_supplier = copy

            console.log(copy)
 
            scope.OPEN_MODAL('#modalSuppliers');
        },
        cancel: function (data,index) {
            var scope = this

            scope.selected_supplier = null 
            scope.selected_supplier_index = null    
            scope.CLOSE_MODAL('#modalSuppliers'); 
        },
        save: function () {
            var scope = this

            var error = 0
            scope.$set(scope.selected_supplier,'purchase_price_error',false);

            if (!scope.selected_supplier.purchase_price || scope.selected_supplier.purchase_price == '') {
                error++;
                scope.selected_supplier.purchase_price_error = true
            }

            if (error) {
                return
            }

            if (scope.selected_supplier_index === null) {
                var bd_group_supplier_uuid = scope.selected_supplier.bd_group_supplier_uuid
                var discount_groups = scope.selected_supplier.supplier.discount_groups

                scope.selected_supplier.supplier_uuid = scope.selected_supplier.supplier.uuid
                scope.selected_supplier.selected_discount_group = scope.getSelectedDiscountGroupDetails(bd_group_supplier_uuid,discount_groups)

                var copy = JSON.parse(JSON.stringify(scope.selected_supplier))
                scope.selected_suppliers.push(copy)
            } else {
                var bd_group_supplier_uuid = scope.selected_supplier.bd_group_supplier_uuid
                var discount_groups = scope.selected_supplier.supplier.discount_groups
                scope.selected_supplier.selected_discount_group = scope.getSelectedDiscountGroupDetails(bd_group_supplier_uuid,discount_groups)

                var copy = JSON.parse(JSON.stringify(scope.selected_supplier))

                var index = scope.selected_supplier_index
                scope.selected_suppliers[index] = copy
            }

            scope.selected_supplier = null
            scope.selected_supplier_index = null
            scope.CLOSE_MODAL('#modalSuppliers');
        },
        findSelectedSuppliers : function (supplier) {
            var scope = this
            var exists = false
            for (let i = 0; i < scope.item.suppliers.length; i++) {
                var current = scope.item.suppliers[i]
                if (current.supplier_uuid == supplier.uuid) {
                    exists = current
                    return exists
                }
            }
            return exists
        },
        getSelectedDiscountGroupDetails: function (bd_group_supplier_uuid, haystack = []) {
            var scope = this

            var details = {name: '', total_rate: '', discounts: []}
            for (let i = 0; i < haystack.length; i++) {
                var current = haystack[i]

                if (current.uuid == bd_group_supplier_uuid) {
                    var total_rate = scope.calculateDiscountGroupTotalRate(current.discounts);

                    details.name = current.name
                    details.total_rate = total_rate
                    details.discounts = current.discounts
     
                    return details
                }
            }

            return details
        },
        calculateDiscountGroupTotalRate: function (discounts) {
            var scope = this

            var total = 0.00
            for (let i = 0; i < discounts.length; i++) {
                var current = discounts[i]
                total += parseFloat(current.rate)
            }

            return total

        },
        getSelectedSuppliers: function () {
            var scope = this
            return scope.selected_suppliers
        },
        setSelectedSuppliers: function () {
            var scope = this
            scope.selected_supplier_uuids = [];
            console.log(scope.item.suppliers)
            for (let i = 0; i < scope.item.suppliers.length; i++) {
                var current = scope.item.suppliers[i]
                var selected_discount_group = scope.getSelectedDiscountGroupDetails(current.bd_group_supplier_uuid,current.supplier.discount_groups)
           
                var data = {
                    supplier_uuid: current.supplier.uuid,
                    supplier: current.supplier,
                    purchase_price: current.purchase_price,
                    bd_group_supplier_uuid: current.bd_group_supplier_uuid,
                    selected_discount_group: selected_discount_group
                }

                scope.selected_supplier_uuids.push(data.supplier_uuid)
                scope.selected_suppliers.push(data)
            }
            scope.getSuppliers()
        }
    },
    mounted() {
        var scope = this
        scope.setSelectedSuppliers();
    },
}
</script>