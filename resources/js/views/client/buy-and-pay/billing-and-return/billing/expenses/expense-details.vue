<template>
<div v-if="ready">
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>

            <div class="card-body" >
                <div class="actions-bar">
                    <div class="w-100">
                        <h1 class="title">Expenses</h1>
                    </div>
                    <div class="bar-right">
                            <a @click="ROUTE({path: '/buy-and-pay/bills' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                                <span>Back</span>
                            </a>

                            <!-- <a @click="test()" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                                <span>Test</span>
                            </a> -->
                            
                            <a v-if ="!bill.uuid" @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                                <span>Bill</span>
                            </a>

                            <a v-if ="bill.uuid && ACTION == 'edit'"  @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                                <span>Update</span>
                            </a>

                            <a v-if="bill.uuid &&  bill.status =='To Pay' && ACTION == 'view'"  @click="ROUTE({path: '/buy-and-pay/bills/' + bill.uuid + '/edit'})" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                                <span>Edit</span>
                            </a>

                    </div>
                </div>

                <form action="#" class="form-validate is-alter">
                        <div v-if="AMOUNT_TO_ALLOCATE < 0" class="alert alert-danger" ><i class="fas fa-exclamation-triangle"></i> 
                            You exceed the amount to allocate by: <strong>{{ PUT_SEPARATOR(Math.abs(AMOUNT_TO_ALLOCATE)) }}</strong>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-12">

                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="item-group">Transaction No.</label>
                                                <input type="text" class="form-control disabled" v-model="bill.transaction_no" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="branch-name">Transaction Date</label>
                                                <div class="form-control-wrap">
                                                    <date-picker class="form-control disabled" v-model="bill.transaction_date" :config="{format: 'DD-MMM-YYYY'}" disabled></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="supplier">Supplier</label>
                                                <input type="text" class="form-control disabled" v-model="bill.supplier.supplier_shortname" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12">
                                            <div class="row">
                                                <div class="col-md-8 col-12">
                                                     <div class="form-group">
                                                        <label class="form-label" for="supplier">Amount Payable</label>
                                                        <input type="text" class="form-control" v-model="temp_amount" v-bind:class="{'disabled' : ACTION != 'edit'}" :disabled="ACTION != 'edit'">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <button type="button" @click="updateAmountPayable()" style="margin-top:28px;" class="hx-btn hx-btn-shineblue" v-bind:class="{'disabled' : ACTION != 'edit'}" :disabled="ACTION != 'edit'">Apply</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div v-if="bill.projects.length > 0" class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="project">Project</label>
                                                <multiselect  v-model="selected_projects" :options="options_projects" :multiple="true" track-by="uuid" label="text" deselect-label="Deselect" selectLabel="Select" :disabled="true">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>


                                    </div>
                                
                            </div>

                            <div class="col-md-3 col-12">

                                <div class="buy-and-pay-summary">
                                    <h4>Summary:</h4>
                                    <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                        <div><span>Gross</span></div>
                                        <div><span>{{ PUT_SEPARATOR(TAXES.AMOUNT.toFixed(2)) }}</span></div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                        <div><span>Tax</span></div>
                                        <div><span>{{ PUT_SEPARATOR(TAXES.VAT.AMOUNT.toFixed(2)) }}</span></div>
                                    </div>
                                    <hr>
                                    <div style="display:flex; justify-content: space-between; font-weight:900;">
                                        <div><span>Amount</span></div>
                                        <div><span>{{ PUT_SEPARATOR(bill.amount) }}</span></div>
                                    </div>
                                    <hr style="margin-bottom: 2px">
                                    <hr>
                                </div>
                            
                            </div>
                        </div>


                    <br/>
   
                    <div class="hx-tab-2 tabbed round">
                        <ul class="nav nav-tabs">    
                            <li class="nav-item">        
                                <a data-toggle="tab" href="#tax">Tax</a>    
                            </li>
                            <li class="nav-item">        
                                <a class="active" data-toggle="tab" href="#expese-details">Expense</a>    
                            </li>  
                        </ul>

                        <div class="clearfix"></div>
                        
                        <div class="tab-content">    

                            <div class="tab-pane active" id="expese-details">

                                <div style="margin-bottom:10px;" v-if="ACTION == 'edit'">
                                    <div class="text-right">
                                        <button type="button"  @click="add()" class="btn btn-sm hx-btn-shineblue" :disabled="AMOUNT_TO_ALLOCATE <= 0">Add Row</button>
                                    </div>
                                </div>


                                <table v-if="bill.projects.length < 1" class="table table-bordered mb-0">
                                    <thead class="th-nowrap">
                                        <tr>
                                            <th width="40" >Action</th>
                                            <th>Account</th>
                                            <th>Amount</th> 
                                            <th>Memo</th>
                                            <th>Memo</th>
                                            <th>Memo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="td-border-bottom-black-2">
                                        <tr v-for="(expense,index) in expenses" :key="'expense-' + index">
                                            <td class="text-center">
                                                <b-button @click="removeSelected(index)" type="button" size ="sm" class="m-2" :disabled="ACTION != 'edit'">Delete</b-button>
                                            </td>
                                            <td width="250">
                                                <select style="width:100%; border:none;" v-model="expense.coa_uuid" class="editable-control" :disabled="ACTION != 'edit'">
                                                    <option value="null">Select an Account</option>
                                                    <option v-for="coa_expense in options_coa_expense" :value="coa_expense.id" :key="'coa-' + coa_expense.id">
                                                        {{ coa_expense.text }}
                                                    </option>
                                                </select>
                                            </td>

                                        
                                            <td width="150">
                                                <input v-on:keyup.enter="onEnter(index)" v-model="expense.amount" type="text" style="width:100%; border:none; text-align:right;"  :disabled="ACTION != 'edit'">
                                            </td>

                                            <td>
                                                <input v-model="expense.memo_1" type="text" style="width:100%; border:none;" :disabled="ACTION != 'edit'">
                                            </td>
                                            <td>
                                                <input v-model="expense.memo_2" type="text" style="width:100%; border:none;"  :disabled="ACTION != 'edit'">
                                            </td>
                                            <td>
                                                <input v-model="expense.memo_3" type="text" style="width:100%; border:none;"  :disabled="ACTION != 'edit'">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">Total</td>
                                            <td v-if="AMOUNT_TO_ALLOCATE >= 0" class="text-right"><strong>{{ PUT_SEPARATOR(AMOUNT_ALLOCATED.toFixed(2)) }}</strong></td>
                                            <td v-if="AMOUNT_TO_ALLOCATE < 0" class="text-right text-danger"><strong>{{ PUT_SEPARATOR(AMOUNT_ALLOCATED.toFixed(2)) }}</strong></td>
                                            <td colspan="2"></td>
                                            
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

                                <table v-else class="table table-bordered mb-0">
                                    <thead class="th-nowrap">
                                        <tr>
                                            <th width="40" >Action</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                            <th>Project</th>
                                            <th>Project Scope</th>
                                            <th>Details</th>
                                            <th>Memo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="td-border-bottom-black-2">
                                        <tr v-for="(expense,index) in expenses" :key="'expense-' + index">

                                            <td class="text-center">
                                                <b-button @click="removeSelected(index)" type="button" size ="sm" class="m-2" :disabled="ACTION != 'edit'">Delete</b-button>
                                            </td>

                                            <td width="250">
                                                <select style="width:100%; border:none;" v-model="expense.coa_uuid" class="editable-control" :disabled="ACTION != 'edit'">
                                                    <option value="null">Select an Account</option>
                                                    <option v-for="coa_expense in options_coa_expense" :value="coa_expense.id" :key="'coa-' + coa_expense.id">
                                                        {{ coa_expense.text }}
                                                    </option>
                                                </select>
                                            </td>

                                        
                                            <td width="150">
                                                <input v-on:keyup.enter="onEnter(index)" v-model="expense.amount" type="text" style="width:100%; border:none; text-align:right;"  :disabled="ACTION != 'edit'">
                                            </td>

                                            <td>
                                                <select style="width:100%; border:none;" v-model="expense.project_uuid" @change="getProjectScopes(expense,index)" class="editable-control" :disabled="ACTION != 'edit'">
                                                    <option v-for="project in options_projects" :value="project.id" :key="'project-' + project.id">
                                                        {{ project.text }}
                                                    </option>
                                                </select>
                                            </td>

                                            <td>
                                                <select style="width:100%; border:none;" v-model="expense.project_scope_uuid" @change="getScopeDetails(expense,index)" class="editable-control" :disabled="ACTION != 'edit'">
                                                    <option v-for="prj_scope in expense.prjScopes" :value="prj_scope.id" :key="'prj_scope-' + prj_scope.id">
                                                        {{ prj_scope.text }}
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <select style="width:100%; border:none;" v-model="expense.scope_details_uuid" class="editable-control" :disabled="ACTION != 'edit'">
                                                    <option v-for="scope_detail in expense.prjScopeDetails" :value="scope_detail.id" :key="'scope_detail-' + scope_detail.id">
                                                        {{ scope_detail.text }}
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input v-model="expense.memo_1" type="text" style="width:100%; border:none;"  :disabled="ACTION != 'edit'">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">Total</td>
                                            <td v-if="AMOUNT_TO_ALLOCATE >= 0" class="text-right"><strong>{{ PUT_SEPARATOR(AMOUNT_ALLOCATED.toFixed(2)) }}</strong></td>
                                            <td v-if="AMOUNT_TO_ALLOCATE < 0" class="text-right text-danger"><strong>{{ PUT_SEPARATOR(AMOUNT_ALLOCATED.toFixed(2)) }}</strong></td>
                                            <td colspan="2"></td>
                                            
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

                            <div class="tab-pane" id="tax">
                               <div class="col-md-4 col-12">
                                    <h4>Tax Summary</h4>
                                    <table class="table-discount-summary table table-striped table-bordered"> 
                                        <thead>
                                            <tr>
                                                <th width="200">Tax Type</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Input Tax</strong></td>
                                                <td class="text-right">{{ TAXES.VAT.RATE }}%</td>
                                                <td class="text-right">{{ PUT_SEPARATOR(TAXES.VAT.AMOUNT.toFixed(2)) }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Expanded Withholding Tax</strong></td>
                                                <td class="text-right">{{ TAXES.EWT.RATE }}%</td>
                                                <td class="text-right">{{ PUT_SEPARATOR(TAXES.EWT.AMOUNT.toFixed(2)) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                        </div>

                        
                    </div>
                
                </form>
            </div>

    </div>
</div>

</template>


<script>

import moment from 'moment'

export default {
    name: 'expenses-details',
    data: function () {
        return {
            prerequiste: {
                getBillDetails: false,
                getCOAExpense: false
            },

            bill: [],

            DRAFT: true,
            ACTION: 'view',

            temp_amount: 0.00,

            expenses: [],

            options_coa_expense: [],
            options_project_scope: [],
            options_scope_detail: [],

            selected_projects: [],
            options_projects: [],

            TAXES: {
                EWT: {
                    RATE: 0.00,
                    AMOUNT: 0.00
                },
                VAT: {
                    RATE: 0.00,
                    AMOUNT: 0.00
                },
                AMOUNT: 0.00
            },

        }
    },
    watch: {
        ready: function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){

                    if(scope.bill.projects.length < 1 ){
                        scope.getExpenses()
                    }else{
                        scope.getProjectExpenses()
                    }
                    
                    
                },500)
            }
        },
        
    },
    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getBillDetails) {
                return true
            }

            return false
        },
        AMOUNT_ALLOCATED: function () {
            var scope = this
            return scope.expenses.reduce(function (r, a) {
                return r + parseFloat(a['amount']);
            }, 0);
        },
        AMOUNT_TO_ALLOCATE: function () {
            var scope = this
            var amount = scope.TAXES.AMOUNT

            amount  = parseFloat(amount)
            amount = amount - scope.AMOUNT_ALLOCATED
            amount = amount.toFixed(2)

            return amount
        }
    },
    methods: {
        calculateTax: function () {
            var scope = this

            var scope = this
            var vat_rate = (scope.bill.supplier.v_a_t) ? scope.bill.supplier.v_a_t.tax_rate : 0.00 ;
            var ewt_rate = (scope.bill.supplier.e_w_t) ? scope.bill.supplier.e_w_t.tax_rate : 0.00 ;


            var vat = vat_rate / 100 // e.g converts 12% to 0.12
            var ewt = ewt_rate / 100


            var tax_base = scope.bill.amount / (1 + vat) // e.g 1.12 if VAT = 12%

            scope.TAXES.VAT.RATE = vat_rate
            scope.TAXES.EWT.RATE = ewt_rate
            scope.TAXES.VAT.AMOUNT = tax_base * vat
            scope.TAXES.EWT.AMOUNT = tax_base * ewt
            scope.TAXES.AMOUNT = tax_base
        },

        getBillDetails: function (bill_uuid) {
            var scope = this
  
            var URL = (!scope.DRAFT) ? 'buy-and-pay/bills/' + bill_uuid + '/expenses' : 'buy-and-pay/bills/draft' + window.location.search;

            scope.GET(URL).then(res => {

                scope.bill = res.data

                scope.bill.transaction_no = (!scope.bill.transaction_no || scope.bill.transaction_no == '') ? 'To be generated' : scope.bill.transaction_no
                scope.bill.transaction_date = (!scope.bill.transaction_date || scope.bill.transaction_date == '') ? moment() : scope.bill.transaction_date
                scope.temp_amount = parseFloat(scope.bill.amount)


                if(scope.bill.projects.length > 0){
                    scope.bill.projects.forEach(function (data) {
                        scope.options_projects.push({
                            id: data.uuid,
                            text: data.project_name,
                            project_type_uuid: data.project_type_uuid
                        })

                        scope.selected_projects.push({
                            id: data.uuid,
                            text: data.project_name,
                        })
                    
                    })
                }


                // console.log(scope.bill)

                
                scope.calculateTax();

                scope.prerequiste.getBillDetails = true
            })
        },

        // test: function () {
        //     var scope = this;
        //     console.log(scope.expenses)
        // },


        add: function () {
            var scope = this;

            var amount = scope.AMOUNT_TO_ALLOCATE

            if (scope.bill.projects.length < 1) {
                            
                scope.expenses.push({
                    uuid: null,
                    coa_uuid: scope.bill.supplier.coa_expense_account_uuid,
                    amount: amount,
                    memo_1: null,
                    memo_2: null,
                    memo_3: null,
                })
            
            }else{

                scope.expenses.push({
                    uuid: null,
                    coa_uuid: scope.bill.supplier.coa_expense_account_uuid,
                    amount: amount,
                    project_uuid: (scope.options_projects!= null) ? scope.options_projects[0].id : null,
                    project_scope_uuid: null,
                    scope_details_uuid: null,
                    prjScopes:[],
                    prjScopeDetails: [],
                    memo_1: null,
                })


                scope.getProjectScopes(scope.expenses[scope.expenses.length -1], scope.expenses.length -1, true)
                
            }
        },

        updateAmountPayable: function () {
            var scope = this
            window.swal.fire({
                title: 'Update Allocated?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.bill.amount = scope.temp_amount
                    scope.calculateTax()
                }                              
            })
           
        },


        onEnter: function (index) { 
            var scope = this
            var current = index + 1

            if (current >= scope.expenses.length && scope.AMOUNT_TO_ALLOCATE > 0) {
                scope.add();
            } 
        },

        removeSelected: function (i) {
            var scope = this
            scope.expenses.splice(i, 1);
        },

        getExpenses: function() {
            var scope = this

            scope.GET('buy-and-pay/bills/' + scope.bill.uuid + '/expenses/details').then(res => {
                scope.expenses = res.rows
                if (scope.expenses.length < 1) {
                    scope.add();
                }
            })
        },

        getProjectExpenses: function() {
            var scope = this
            
            var x = 0

            scope.GET('buy-and-pay/bills/' + scope.bill.uuid + '/project-expenses/details').then(res => {
                scope.expenses = res.rows

                res.rows.forEach(function (data) {
                    
                    data.scopeDetails.forEach(function (details) {
                        scope.expenses[x].prjScopeDetails.push({ id: details.uuid,text: details.detail})
                    })

                    data.porjectScopes.forEach(function (prjScope) {
                        scope.expenses[x].prjScopes.push({ id: prjScope.type_scope.uuid, text: prjScope.type_scope.scope_of_work})
                    })

                    x++
                })

                if (scope.expenses.length < 1) {
                    scope.add();
                }
            })
        },

        getCOAExpense: function () {
            var scope = this

            scope.GET('company/chart-of-accounts-expenses').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_coa_expense.push({
                        id: data.uuid,
                        text: data.account_name
                    })

                    scope.prerequiste.getCOAExpense = true
                })
            })
        },

        getProjectScopes: function (expense, index) {
            var scope = this

            var project_type_uuid = null
            scope.options_project_scope = []

            scope.bill.projects.forEach(function (project) {
                if (project.uuid == expense.project_uuid){
                    project_type_uuid = project.project_type_uuid
                    
                }
            })


            scope.GET('projects/project-type-scope/' + project_type_uuid).then(res => {

                res.rows.forEach(function (data) {
                    scope.options_project_scope.push({
                        id: data.type_scope.uuid,
                        text: data.type_scope.scope_of_work
                    })

                    scope.expenses[index].prjScopes = scope.options_project_scope
                })


                if(scope.options_project_scope.length < 1){
                    
                    scope.expenses[index].project_scope_uuid  = null
                    scope.expenses[index].prjScopes = []

                }else{
                    
                    scope.expenses[index].project_scope_uuid  = scope.options_project_scope[0].id

                }

                scope.getScopeDetails(scope.expenses[index], index)
                
            })

            
        },


        getScopeDetails: function (expense, index) {
            var scope = this

            scope.options_scope_detail = []
            
            scope.GET('projects/project-scope-details/' + expense.project_scope_uuid).then(res => {
                res.rows.forEach(function (data) {
                    scope.options_scope_detail.push({
                        id: data.uuid,
                        text: data.detail
                    })

                    scope.expenses[index].prjScopeDetails = scope.options_scope_detail
                })

                if(scope.options_scope_detail.length < 1){
                    
                    scope.expenses[index].scope_details_uuid  = null
                    scope.expenses[index].prjScopeDetails = []

                }else{
                    
                    scope.expenses[index].scope_details_uuid  = scope.options_scope_detail[0].id
                }

            })
        },

        save: function () {
            var scope = this

            var URL = (scope.bill.projects.length < 1) ? 'buy-and-pay/bills/expenses': 'buy-and-pay/bills/project-expenses';

            if (scope.bill.uuid){

                window.swal.fire({
                    title: 'Update?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#548235',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {

                        scope.POST(URL, {bill: scope.bill, expenses: scope.expenses }).then(res => {
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
                })
            }else{

                scope.POST(URL, {bill: scope.bill, expenses: scope.expenses }).then(res => {
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


        }

    },
    mounted() {
        var scope = this

        var bill_uuid = scope.$route.params.bill_uuid;

        //scope.ACTION = ( scope.$route.params.action) ? scope.$route.params.action : 'edit';
        scope.ACTION = scope.$route.params.action
        console.log(scope.ACTION)
        scope.DRAFT = (!bill_uuid) ? true : false

        scope.getBillDetails(bill_uuid)

        scope.getCOAExpense()
    },
}
</script>



<style scoped>

</style>