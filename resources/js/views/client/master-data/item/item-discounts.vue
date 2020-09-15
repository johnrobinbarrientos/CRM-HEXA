<template>
    <div>
        <br/>
        <br/>

        <div class="row">
            <div class="col-md-5 col-12">
                <div v-for="supplier in suppliers" :key="supplier.id" >
                    <div style="background:#cee6fb; color:#404040; padding:8px 12px;">{{ supplier.business_name }}</div>
                    <div v-if="supplier.discount_groups.length > 0" class="table-responsive">
                        <table class="table table-striped table-bordered table-hover mb-0 table">
                            <tbody>
                                <template v-for="discount_group in supplier.discount_groups">
                                    <tr :key="discount_group.id" v-bind:class="{'table-success' : discount_group.selected}">
                                        <th width="40" colspan="1">
                                            <div class="form-check mb-3">
                                                <input @change="selectGroup(discount_group)" v-model="discount_group.selected" class="form-check-input" type="checkbox" :id="'check-' + discount_group.id" value="">
                                            </div>
                                        </th>
                                        <th colspan="2">{{ discount_group.group_name }}</th>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div v-else style="padding:20px; text-align:center; color:#404040; background:#f8f9fa; font-weight:600;">
                        No Discount Added on <strong>{{ supplier.business_name }}</strong>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 offset-md-1">
                <table class="table table-striped table-bordered table-hover mb-0 table">
                    <tbody>
                        <template v-for="supplier in suppliers" v-if="hasSelected(supplier)">
                            <tr class="table-info" :key="'supplier' + supplier.id"><th  colspan="2" >{{ supplier.business_name }}</th></tr>
                            <template v-for="discount_group in supplier.discount_groups" v-if="discount_group.selected">
                                <tr  class="table-success" :key="'group' + discount_group.id"><th   style="padding-left:50px;" colspan="2" >{{ discount_group.group_name }}</th></tr>
                                <tr   :key="'discount' + discount.id" v-for="(discount,index2) in discount_group.discounts" >
                                    <th style="padding-left:60px;"><i class="mdi mdi-arrow-right"></i> &nbsp; {{ discount.discount_name }}</th>
                                    <th class="text-right">{{ parseFloat(discount.discount_rate).toFixed(2) }}%</th>
                                </tr>
                                <tr>
                                    <th class="text-right">Total:</th>
                                    <th class="text-right">{{ totalRate(discount_group) }}%</th>
                                </tr>

                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'item-discounts',
    props: ['properties'],
    data: function () {
        return {
            suppliers: [],
            
        }
    },
    computed: {
        item: function() {
            return this.properties
        }
    },
    methods: {
        getSupplierDiscounts: function (supplier_ids) {
           var scope = this
            scope.suppliers  = []

            scope.DELETE('items/item-supplier-discounts-batch/',{ supplier_ids: supplier_ids, item_uuid: scope.item.uuid }).then(res => {
               
            })

            scope.GET('suppliers/multiple/supplier-base-discount-group/',{supplier_ids: supplier_ids, item_uuid: scope.item.uuid }).then(res => {
               scope.suppliers = res.rows
            })
        },
        hasSelected: function (supplier) {
            for (let x = 0; x < supplier.discount_groups.length; x++) {
                var discount_group = supplier.discount_groups[x]

                if (discount_group.selected) { 
                    return true; 
                }
                
                if (x == (supplier.discount_groups - 1) )  {
                    return false
                }
            }

            return false
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

            scope.POST('items/item-supplier-discounts', payload).then(res => {

                
            })
        },
        deleteItemDiscountGroup: function (group) {
            var scope = this
            var payload = group
            payload.item_uuid = scope.item.uuid

            scope.DELETE('items/item-supplier-discounts', payload).then(res => {

                
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