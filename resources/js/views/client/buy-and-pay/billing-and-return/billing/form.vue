<template>
    <div>
        <div class="row">
            <div class="col-6 col-lg-4">
                <span>Billing Type</span>
                <select v-model="type" style="margin-top:5px;" class="form-control">
                    <option value="Inventory">Inventory</option>
                    <option value="Fixed Assets">Fixed Assets</option>
                    <option value="Expenses">Expenses</option>
                </select>
            </div>
        </div>
        <br>
        <to-bill-list v-if="type === 'Inventory'"></to-bill-list>
        <expenses-form v-if="type === 'Expenses'"></expenses-form>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'
import ToBillList from './to-bill-list'
import ExpensesForm from './form-expenses'

export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {
            type: 'Inventory'
        }
    },
    components: {
        'to-bill-list' : ToBillList,
        'expenses-form' : ExpensesForm,
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