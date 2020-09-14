<template>
    <div>
        <br/>
        <br/>

        <div class="row">
            <div v-for="supplier in suppliers" :key="supplier.id" class="col-md-12 col-12">
                <div class="card-title">{{ supplier.business_name }}</div>
                <div v-if="supplier.discount_groups.length > 0" class="table-responsive">
                    <table class="table  table-striped table-bordered table-hover mb-0 table">
                        <tbody>
                            <template v-for="discount_group in supplier.discount_groups">
                                <tr style="background:#ededef; color:#404040" :key="discount_group.id">
                                    <th colspan="3">{{ discount_group.group_name }}</th>
                                </tr>
                                <tr style="background:#fff; color:#404040" v-for="(discount,index) in discount_group.discounts" :key="discount.id">
                                    <th>{{ (index + 1) }}</th>
                                    <th>{{ discount.discount_name }}</th>
                                    <th>{{ discount.discount_rate }}</th>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div v-else style="padding:20px; text-align:center; color:#404040; background:#efefef; font-weight:600;">
                    No Discount Added on <strong>{{ supplier.business_name }}</strong>
                </div>
                <br/>
                <br/>
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
            suppliers: []
        }
    },
    methods: {
       getSupplierDiscounts: function (supplier_ids) {
           var scope = this

            scope.GET('/suppliers/multiple/supplier-base-discount-group/',{supplier_ids: supplier_ids}).then(res => {
               scope.suppliers = res.rows
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