<template>
    <div>
        <br/>
        <div class="row" style="margin-left: 12px;">
            <div class="col-md-4 col-12">
                <div v-for="supplier in suppliers" :key="supplier.id" style="margin-bottom:5px;">
                    <div style="font-weight:900;">{{ supplier.supplier_name }}</div>
                    <div  style="padding:10px 0px;">
                        <select @change="changeSelectedSupplierDiscountGroup(supplier)" v-model="supplier.selected_discount_group_uuid" class="form-control">
                            <option value="0">None</option>
                            <option v-for="discount_group in supplier.discount_groups" :key="discount_group.uuid" :value="discount_group.uuid">{{ discount_group.group_name }}</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="col-md-6 col-12 offset-md-1">
                <table class="table table-bordered table-hover mb-0 table">
                    <tbody>
                        <template v-for="supplier in suppliers">
                            <tr class="table-info" :key="'supplier' + supplier.id">
                                <th  colspan="2" >{{ supplier.supplier_name }}</th>
                            </tr>
                            <template v-if="supplier.selected_discount_group">
                                <tr class="table-success" :key="'supplier-selected-group-' + supplier.id">
                                    <th style="padding-left:50px;" colspan="2" >{{ supplier.selected_discount_group.group_name }}</th>
                                </tr>
                                <tr  v-for="(discount,index2) in supplier.selected_discount_group.discounts" :key="'discount' + index2" >
                                    <th style="padding-left:60px;"><i class="mdi mdi-arrow-right"></i> &nbsp; {{ discount.discount_name }}</th>
                                    <th class="text-right">{{ parseFloat(discount.discount_rate).toFixed(2) }}%</th>
                                </tr>
                                <tr :key="'supplier-selected-group-total-' + supplier.id">
                                    <th class="text-right">Total:</th>
                                    <th class="text-right">{{ calclateTotalSupplierDiscount(supplier) }}%</th>
                                </tr> 
                            </template>
                            <template v-else>
                                <tr>
                                    <th style="text-align:center;" colspan="2">No Discount as of this moment</th>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
                <br/>
            </div>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'item-discounts',
    props: ['properties', 'view_mode'],
    data: function () {
        return {
            suppliers: []
        }
    },
    computed: {
        item: function() {
            return this.properties.data
        },
        grand_total: function () {
            var scope = this
            
            var total = 0.00
            for (let x = 0; x < scope.suppliers.length; x++) {
                var supplier = scope.suppliers[x]
                
                var groups = supplier.discount_groups
                for (let i = 0; i < groups.length; i++) {
                    var group = groups[i]
                    
                    if(!group.selected) {
                        continue;
                    }

                    var discounts = group.discounts
                    for (let y = 0; y < discounts.length; y++) {
                        var discount = discounts[y]
                        total += parseFloat(discount.discount_rate)
                    }
                }
                
            }
            return total.toFixed(2)
        },
    },
    methods: {
        changeSelectedSupplierDiscountGroup: function (supplier) {
            var scope = this

            for (let i = 0; i < scope.suppliers.length; i++) {
                var current = scope.suppliers[i]

                if (current.uuid != supplier.uuid) {
                    continue;
                }

                for (let x = 0; x < current.discount_groups.length; x++) {
                    var group = current.discount_groups[x]
                    if (group.uuid != supplier.selected_discount_group_uuid) {
                        continue;
                    }

                    supplier.selected_discount_group = group
                    scope.saveItemDiscountGroup(group)
                    return
                }
            } 

            supplier.selected_discount_group = null
        },
        calclateTotalSupplierDiscount: function(supplier) {
            var scope = this
            var total = 0.00
            if (!supplier.selected_discount_group) {
                return total;
            }

            for (let x = 0; x < supplier.selected_discount_group.discounts.length; x++) {
                var discount = supplier.selected_discount_group.discounts[x]
                total += parseFloat(discount.discount_rate);
            }

            return total.toFixed(2);
        },
        getSupplierDiscounts: function (supplier_ids) {
           var scope = this
            scope.suppliers  = []

            scope.GET('suppliers/multiple/supplier-base-discount-group',{supplier_ids: supplier_ids, item_uuid: scope.item.uuid }).then(res => {
               scope.suppliers = res.rows
            })
        },
        selectGroup: function (group) {
           var scope = this
           var selected = (!group.selected) ? true : false 
           //  scope.$set(group,'selected', selected)
   
           if (group.selected) {
               scope.saveItemDiscountGroup(group);
           } else {
               scope.deleteItemDiscountGroup(group)
           }
        },
        totalRate: function (group) {
            var total = 0.00
            for (let i = 0; i < group.discounts.length; i++) {
                var current = group.discounts[i]
                total += parseFloat(current.discount_rate)

                if (i == (group.discounts.length - 1) )  {
                    return total.toFixed(2)
                }
            }

            return total.toFixed(2)
        },
        saveItemDiscountGroup: function (group) {
            var scope = this
            var payload = group
            payload.item_uuid = scope.item.uuid

            scope.POST('suppliers/item-supplier-discounts', payload).then(res => {

                
            })
        },
        deleteItemDiscountGroup: function (group) {
            var scope = this
            var payload = group
            payload.item_uuid = scope.item.uuid

            scope.DELETE('suppliers/item-supplier-discounts', payload).then(res => {

                
            })
        }
    },
    mounted() {
        var scope = this
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>