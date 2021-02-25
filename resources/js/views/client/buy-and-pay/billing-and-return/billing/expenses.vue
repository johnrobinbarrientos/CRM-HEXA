<template>
    <div id="Expenses">

        <div style="margin-bottom:10px;" v-if="action == 'edit'">
            <div class="text-right">
                <button type="button"  @click="add()" class="btn btn-sm hx-btn-shineblue" :disabled="AMOUNT_TO_ALLOCATE <= 0">Add Row</button>
            </div>
        </div>


        <table class="table table-bordered mb-0">
            <thead class="th-nowrap">
                <tr>
                    <th width="40" >Action</th>
                    <th>Account</th>
                    <th>Project</th>
                    <th>Amount</th> 
                    <th>Memo</th>
                    <th>Memo</th>
                    <th>Memo</th>
                </tr>
            </thead>
            <tbody class="td-border-bottom-black-2">
                <tr v-for="(expense,index) in expenses" :key="'expense-' + index">
                    <td class="text-center">
                        <b-button @click="removeSelected(index)" type="button" size ="sm" class="m-2" :disabled="action != 'edit'">Delete</b-button>
                    </td>
                    <td width="250">
                        <select style="width:100%; border:none;" v-model="expense.coa_uuid" class="editable-control" :disabled="action != 'edit'">
                            <option value="null">Select an Account</option>
                            <option v-for="chart_of_account in options_chart_of_accounts" :value="chart_of_account.id" :key="'coa-' + chart_of_account.id">
                                {{ chart_of_account.text }}
                            </option>
                        </select>
                    </td>
                    <td width="250">
                        <select v-model="expense.project_uuid" style="width:100%; border:none;" :disabled="action != 'edit'">
                            <option value="null">Select a Project</option>
                            <option v-for="project in options_project" :value="project.id" :key="'project-' + project.id">
                                {{ project.text }}
                            </option>
                        </select>
                    </td>
                
                    <td width="150">
                        <input v-on:keyup.enter="onEnter(index)" v-model="expense.amount" type="text" style="width:100%; border:none; text-align:right;"  :disabled="action != 'edit'">
                    </td>

                    <td>
                        <input v-model="expense.memo_1" type="text" style="width:100%; border:none;" :disabled="action != 'edit'">
                    </td>
                    <td>
                        <input v-model="expense.memo_2" type="text" style="width:100%; border:none;"  :disabled="action != 'edit'">
                    </td>
                    <td>
                        <input v-model="expense.memo_3" type="text" style="width:100%; border:none;"  :disabled="action != 'edit'">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td v-if="AMOUNT_TO_ALLOCATE >= 0" class="text-right"><strong>{{ PUT_SEPARATOR(AMOUNT_ALLOCATED.toFixed(2)) }}</strong></td>
                    <td v-if="AMOUNT_TO_ALLOCATE < 0" class="text-right text-danger"><strong>{{ PUT_SEPARATOR(AMOUNT_ALLOCATED.toFixed(2)) }}</strong></td>
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
    props: ['bill','action'],
    data: function () {
        return {
            expenses: [],
            selected_supplier: [],
            options_supplier: [],

            selected_branch: [],
            options_branch: [],

            selected_branch_location: null,
            options_branch_location: [],

            selected_cost_center: null,
            options_cost_center: [],

            selected_chart_of_accounts: null,
            options_chart_of_accounts: [],

            selected_project: null,
            options_project: [],

            branch_name: '',
        }
    },
    components: {

    },
    computed: {
        AMOUNT_ALLOCATED: function () {
            var scope = this
            return scope.expenses.reduce(function (r, a) {
                return r + parseFloat(a['amount']);
            }, 0);
        },
        AMOUNT_TO_ALLOCATE: function () {
            var scope = this
            var amount = scope.$parent.getTaxBaseAmount() 
            amount  = parseFloat(amount)
            amount = amount - scope.AMOUNT_ALLOCATED
            amount = amount.toFixed(2)

            return amount
        }
    },
    methods: {
        add: function () {
            var scope = this;

            var amount = scope.AMOUNT_TO_ALLOCATE

            scope.expenses.push({
                uuid: null,
                coa_uuid: null,
                project_uuid: null,
                amount: amount,
                memo_1: null,
                memo_2: null,
                memo_3: null,
            });
        },
        clear: function () {
            var scope = this
            scope.expenses = []
            scope.add();
            scope.$parent.updateAmountToAllocate()
        },
        onEnter: function (index) { 
            var scope = this
            var current = index + 1

            if (current >= scope.expenses.length && scope.AMOUNT_TO_ALLOCATE > 0) {
                scope.add();
            } 

            scope.$parent.updateAmountToAllocate()
        },
        removeSelected: function (i) {
            var scope = this
            scope.expenses.splice(i, 1);
        },
        getAmountToAllocate: function () {
            return  this.AMOUNT_TO_ALLOCATE;
        },
        getExpensesList: function () {
            return this.expenses;
        },
        getExpenses: function() {
            var scope = this
            scope.GET('buy-and-pay/bills/' + scope.bill.uuid + '/expenses').then(res => {
                scope.expenses = res.rows
                if (scope.expenses.length < 1) {
                    scope.add();
                }
            })
        },
        getProjects: function () {
            var scope = this
            scope.GET('projects').then(res => {
              
                res.rows.forEach(function (data) {

                    scope.options_project.push({
                        id: data.uuid,
                        text: data.project_name
                    })
                
                })
            })
        },
        getCostCenters: function () {
           var scope = this
            scope.GET('admin/cost-center').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_cost_center.push({
                        id: data.uuid,
                        text: data.cost_center_name
                    })
                
                })

                $(".form-select-cost-center").select2({data: scope.options_cost_center});
                scope.selected_cost_center = scope.options_cost_center[0].id
            })
        },
        getChartOfAccountByGroup: function (group) {
            var scope = this
            scope.GET('company/chart-of-accounts?group=' + group + '&take=100').then(res => {
              
                res.rows.forEach(function (data) {
                    scope.options_chart_of_accounts.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                })
            })
        },
        getAccountNameByUUID: function (uuid) {
            var scope = this
            var result = scope.options_chart_of_accounts.filter(obj => {
                return obj.id === uuid
            })

            return (result.length > 0) ? result[0].text : ''
        },
        getProjectNameByUUID: function (uuid) {
            var scope = this
            var result = scope.options_project.filter(obj => {
                return obj.id === uuid
            })

            return (result.length > 0) ? result[0].text : ''
        },
        saveBillExpenses: function (bill_uuid) {
            var scope = this
            var URL = 'buy-and-pay/bills/' + bill_uuid + '/expenses'
            
            scope.POST(URL, {expenses: scope.expenses }).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.ROUTE({path: '/buy-and-pay/bills'});
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        }
    },
    mounted() {
        var scope = this
        scope.getExpenses();
        scope.getProjects();
        scope.getChartOfAccountByGroup('expenses');
    },
}
</script>



<style scoped>

</style>