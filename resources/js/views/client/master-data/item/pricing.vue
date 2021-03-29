<template>
<div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div>
                <div style="background:#fafafa; border:1px solid #efefef; padding:0px 5px; padding-left:25px; font-weight:600; height:25px; line-height:25px; position:relative;">
                    <input style="position:absolute; top:5px; left:5px; " type="checkbox" v-model="item.is_purchase_item" value="1" id="is-purchase-item">
                    Is Purchase Item?
                </div>
                <table v-show="item.is_purchase_item" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Purchase Price</th>
                            <th>Discount Group</th>
                            <th>Discount Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="supplier,index in suppliers" :key="'supplier-' + index">
                            <td width="15">
                                <input v-model="supplier.selected" type="checkbox" :checked="supplier.selected">
                            </td>
                            <td width="80" class="text-center">
                                <button type="button" class="btn-gray-small" @click="edit(supplier,index)" v-bind:class="{'disabled': !supplier.selected }">Edit</button>
                            </td>
                            <td><strong >{{ supplier.supplier_name }}</strong></td>
                            <td width="100" class="text-right">
                                <strong v-if="supplier.selected">{{ supplier.purchase_price || 0.00 }}</strong>
                            </td>
                            <td width="150" ><strong >{{ supplier.selected_discount_group.name || '' }}</strong></td>
                            <td width="150" class="text-right"><strong >{{ supplier.selected_discount_group.total_rate || 0 }}%</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <div style="background:#fafafa; border:1px solid #efefef; padding:0px 5px; padding-left:25px; font-weight:600; height:25px; line-height:25px; position:relative;">
                    <input style="position:absolute; top:5px; left:5px; " type="checkbox" v-model="item.is_sales_item" value="1" id="is-purchase-item">
                    Is Sales Item?
                </div>
                <div v-show="item.is_sales_item" style="padding:10px; background:#fafafa; border:1px solid #efefef;">
                    <div class="d-flex">
                        <div class="d-flex align-items-center ml-3 mr-3">
                            <i class="fas fa-long-arrow-alt-right" style="font-size: 24px; color: var(--warning);"></i>
                        </div>
                        <div class="form-group" style="display: flex; align-items: center; margin: 0 !important;">
                            <label class="form-label m-0 mr-2" for="sales-price">Sales Price <small style="color: #999; font-style: italic">(optional)</small>:</label>
                            <div class="form-control-wrap">
                                <input v-model="item.sales_price" type="text" class="form-control" id="sales-price">
                            </div>
                        </div>
                
                        <div class="form-group pl-3" style="margin: 0 !important; display: flex; align-items: center;">
                            <label class="form-label m-0 mr-2" for="transfer-price">Transfer Price:</label>
                            <div class="form-control-wrap">
                                <input v-model="item.sales_price" type="text" class="form-control" id="transfer-price" readonly="disabled">
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
                    <h5 v-if="selected_supplier" class="modal-title">
                        <span>{{ selected_supplier.supplier_name }}</span>
                    </h5>
                    <a href="javascript:void(0)"  @click="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <form v-if="selected_supplier" action="#" class="form-validate is-alter">

                        <div class="row">
                            <div class="col-md-12 col-12">

             
                                <div style="margin-top:0px;">
                                    <strong>Purchase Price</strong>
                                    <input v-model="selected_supplier.purchase_price" class="form-control-gray-medium"  v-bind:class="{'error' : selected_supplier.purchase_price_error}" type="text" placeholder="Enter Purchase Price">
                                </div>
        
                                <div style="margin-top:10px;">
                                    <strong>Discount Group</strong>
                                    <select v-model="selected_supplier.bd_supplier_uuid" class="form-control-gray-medium"  v-bind:class="{'error' : selected_supplier.bd_supplier_uuid_error}" placeholder="Enter Purchase Price">
                                        <option :value="null">Select Discount Group</option>
                                        <option v-for="discount_group,index in selected_supplier.discount_groups" :key="'option-discount-group-' + index" :value="discount_group.uuid">
                                            {{ discount_group.name }}
                                        </option>
                                    </select>
                                </div>

                                <div v-if="selected_supplier.bd_supplier_uuid" style="padding:10px; padding-bottom:20px; margin-top:15px; background:#fafafa; border:1px solid #efefef;">
                                    
                                    <span style="font-weight:600; display:inline-block;">Discount List</span>
                                    <table style="margin-top:5px;" class="table table-bordered table-hover">
                                        <thead>
                                            <tr style="background:#fff;">
                                                <th>Name</th>
                                                <th>Rate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background:#fff;" v-for="(discount,discount_index) in getSelectedDiscountGroupDetails(selected_supplier.bd_supplier_uuid,selected_supplier.discount_groups).discounts " :key="'edit-group-discount-' + discount_index ">

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
        }
    },
    methods: {
        edit: function (data,index) {
            var scope = this

            if (!data.selected) {
                return;
            }

            scope.$set(data,'edit', true)
            var copy = JSON.parse(JSON.stringify(data))
           
            scope.selected_supplier_index = index
            scope.selected_supplier = copy
            console.log( scope.selected_supplier)
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
                var bd_supplier_uuid = scope.selected_supplier.bd_supplier_uuid
                var discount_groups = scope.selected_supplier.discount_groups

                scope.selected_supplier.selected_discount_group = scope.getSelectedDiscountGroupDetails(bd_supplier_uuid,discount_groups)

                scope.suppliers.push(scope.selected_supplier);
            } else {

                var bd_supplier_uuid = scope.selected_supplier.bd_supplier_uuid
                var discount_groups = scope.selected_supplier.discount_groups

                scope.selected_supplier.selected_discount_group = scope.getSelectedDiscountGroupDetails(bd_supplier_uuid,discount_groups)
                
                var copy = JSON.parse(JSON.stringify(scope.selected_supplier))
                scope.suppliers[scope.selected_supplier_index] = copy
            }

            scope.selected_supplier = null
            scope.selected_supplier_index = null
            scope.CLOSE_MODAL('#modalSuppliers');
        },
        getSuppliers: function () {
           var scope = this
            scope.GET('suppliers?discounts=included').then(res => {
                scope.suppliers = res.rows

                scope.suppliers.forEach(function (data) {
                    var selected_supplier = scope.findSelectedSuppliers(data)
                    if (selected_supplier !== false){
                        scope.$set(data,'selected',true)
                        scope.$set(data,'bd_supplier_uuid',selected_supplier.bd_supplier_uuid)
                        scope.$set(data,'purchase_price',selected_supplier.purchase_price)

                        var bd_supplier_uuid = data.bd_supplier_uuid
                        var discount_groups = data.discount_groups
                        scope.$set(data,'selected_discount_group',scope.getSelectedDiscountGroupDetails(bd_supplier_uuid,discount_groups))
                    } else {
                        scope.$set(data,'selected',false)
                        scope.$set(data,'bd_supplier_uuid',null)
                        scope.$set(data,'purchase_price',null)

                        var bd_supplier_uuid = data.bd_supplier_uuid
                        var discount_groups = data.discount_groups
                        scope.$set(data,'selected_discount_group',scope.getSelectedDiscountGroupDetails(bd_supplier_uuid,discount_groups))
                    }
                })
            })
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
        getSelectedDiscountGroupDetails: function (bd_supplier_uuid, haystack = []) {
            var scope = this

            var details = {name: '', total_rate: '', discounts: []}
            for (let i = 0; i < haystack.length; i++) {
                var current = haystack[i]

                if (current.uuid == bd_supplier_uuid) {
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
        getSelectedSuppliers: function ()
        {
            var scope = this
            var result = scope.suppliers.filter(obj => {
                return obj.selected === true
            })

            return result
        }
    },
    mounted() {
        var scope = this
        scope.getSuppliers()
    },
}
</script>