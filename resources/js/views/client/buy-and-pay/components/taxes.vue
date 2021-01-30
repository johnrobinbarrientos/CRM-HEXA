<template>
    <div id="tax">
        <div class="col-md-4 col-12">
                <h4>Tax Summary</h4>
                <table class="table-discount-summary table table-striped table-bordered"> 
                    <thead>
                        <tr >
                            <th width="150">Tax Type</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th >
                                <span>Value Added Tax</span>
                            </th>
                            <th>{{ VAT_RATE }}%</th>
                            <th><div>{{ PUT_SEPARATOR(VAT_AMOUNT.toFixed(2)) }}</div></th>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div style="margin-top:10px; margin-left:15px;" class="form-check">
                <input @change="recalculateItems()" class="form-check-input" type="checkbox" id="defaultCheck1" v-model="order.is_apply_tax">
                <label class="form-check-label" for="defaultCheck1">Apply Tax</label>
            </div>
    

    </div> 
</template>


<script>

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'purchase-order',
    props: ['properties','order'],
    data: function () {
        return {
            is_ready: false,
            view_mode: false,
            VAT_RATE: 0.00,
            VAT_AMOUNT: 0.00
        }
    },
    components: {

    },
    computed: {
        
    },
    methods: {
        updateTAXES: function (TAXES) {
            var scope = this
            scope.VAT_RATE = TAXES.VAT_RATE
            scope.VAT_AMOUNT = TAXES.VAT_AMOUNT
        }
    },
    mounted() {
        var scope = this
        // scope.$parent.$refs.items.diiiissscccouunnnt();
        // console.log('__BASE_DISCOUNTS__ ====> ', scope.discounts)
    },
}
</script>