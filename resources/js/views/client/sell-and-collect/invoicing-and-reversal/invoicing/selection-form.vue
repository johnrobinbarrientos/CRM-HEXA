<template>
    <div>
        <div class="row">
            <div class="col-6 col-lg-4">
                <span>Billing Type</span>
                <select v-model="type" style="margin-top:5px;" class="form-control">
                    <option value="Inventory">Inventory</option>
                    <option value="Fixed Assets">Fixed Assets</option>
                    <option value="Expenses">Progress Billing</option>
                </select>
            </div>
        </div>
        <br>
        <to-invoice-list v-if="type === 'Inventory'"></to-invoice-list>
        <progress-billing-form v-if="type === 'Expenses'"></progress-billing-form>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'
import ToInvoiceList from './to-invoice-list'
import ProgressBillingForm from './progress-billing-form'

export default {
    name: 'selection-form',
    props: ['properties'],
    data: function () {
        return {
            type: 'Inventory'
        }
    },
    components: {
        'to-invoice-list' : ToInvoiceList,
        'progress-billing-form' : ProgressBillingForm,
    },
    computed: {

    },
    methods: {

    },
    mounted() {
        var scope = this
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>