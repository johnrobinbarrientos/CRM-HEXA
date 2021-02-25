<template>
    <div id="tax">
        <div v-if="is_ready" class="row">
            <div class="col-md-4 col-12">
                <h4>Tax Summary</h4>
                <table class="table-discount-summary table table-striped table-bordered"> 
                    <thead>
                        <tr>
                            <th width="150">Tax Type</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Tax Base</strong></td>
                            <td class="text-right">{{ TAXES.VAT.RATE }}%</td>
                            <td class="text-right">{{ PUT_SEPARATOR(TAXES.AMOUNT.toFixed(2)) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Input Tax</strong></td>
                            <td class="text-right">{{ TAXES.VAT.RATE }}%</td>
                            <td class="text-right">{{ PUT_SEPARATOR(TAXES.VAT.AMOUNT.toFixed(2)) }}</td>
                        </tr>
                        <tr>
                            <td><strong>EWT</strong></td>
                            <td class="text-right">{{ TAXES.EWT.RATE }}%</td>
                            <td class="text-right">{{ PUT_SEPARATOR(TAXES.EWT.AMOUNT.toFixed(2)) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</template>


<script>

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'purchase-order',
    props: ['properties',''],
    data: function () {
        return {
            is_ready: false,
            view_mode: false,
            TAXES: null
        }
    },
    components: {

    },
    computed: {
        
    },
    methods: {
        updateTAXES: function (taxes) {
            var scope = this
            console.log(taxes)
            scope.TAXES = taxes

            scope.is_ready = true
        }
    },
    mounted() {
        var scope = this
    },
}
</script>