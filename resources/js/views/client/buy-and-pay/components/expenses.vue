<template>
    <div id="Expenses">
        <table class="table table-bordered mb-0">
            <thead class="th-nowrap">
                <tr>
                    <th>Account</th>
                    <th>Project</th>
                    <th>Amount</th>
                    <th>Memo 1</th>
                    <th>Memo 2</th>
                    <th>Memo 3</th>
                </tr>
            </thead>
            <tbody class="td-border-bottom-black-2">
                <tr v-for="expense in expenses" :key="'expense-' + expense.id">
                    <td>{{ expense.account.account_name }}</td>
                    <td>
                        <span v-if="expense.project">{{ expense.project.project_name }}</span>
                    </td>
                    <td class="text-right">{{ PUT_SEPARATOR(expense.amount,2) }}</td>
                    <td>{{ expense.memo_1 }}</td>
                    <td>{{ expense.memo_2 }}</td>
                    <td>{{ expense.memo_3 }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">Total</td>
                    <td class="text-right">1000</td>
                    <td colspan="3"></td>
                    
                </tr>
                <tr>
                    <td colspan="20">
                        <div style="margin-bottom:2px;"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="20">
                        <div style="margin-bottom:2px;"></div>
                    </td>
                </tr>
               
            </tbody>
        </table>
    </div>
</template>


<script>

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'expenses-list',
    props: ['bill'],
    data: function () {
        return {
            expenses: []
        }
    },
    components: {

    },
    computed: {
        
    },
    methods: {
        getExpenses: function()
        {
            var scope = this
            scope.GET('buy-and-pay/bills/' + scope.bill.uuid + '/expenses').then(res => {
                scope.expenses = res.rows
            })
        }
    },
    mounted() {
        var scope = this
        scope.getExpenses();
    },
}
</script>



<style scoped>

</style>