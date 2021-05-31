<template>
<div v-if="ready">
    <div class="card hx-card-override">
        <div class="card-header">
            <h5 class="mb-0">General Information</h5>
        </div>

        <div class="card-body" >
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title">Progress Billings</h1>
                </div>
                <div class="bar-right">
                        <a @click="ROUTE({path: '/sell-and-collect/invoicing-reversal' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                            <span>Back</span>
                        </a>

                </div>
            </div>

            <form action="#" class="form-validate is-alter">
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
                                    <label class="form-label" for="customer">Customer</label>
                                    <input type="text" class="form-control disabled" v-model="bill.customer.business_name" readonly>
                                </div>
                            </div>


                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="project">Project</label>
                                    <input type="text" class="form-control disabled" v-model="bill.project.project_name" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">

                        <div class="buy-and-pay-summary">
                            <h4>Summary:</h4>
                            <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                <div><span>Gross</span></div>
                                <!-- <div><span>{{ PUT_SEPARATOR(TAXES.AMOUNT.toFixed(2)) }}</span></div> -->
                            </div>
                            <div style="display:flex; justify-content: space-between; margin-bottom:5px;">
                                <div><span>Tax</span></div>
                                <!-- <div><span>{{ PUT_SEPARATOR(TAXES.VAT.AMOUNT.toFixed(2)) }}</span></div> -->
                            </div>
                            <hr>
                            <div style="display:flex; justify-content: space-between; font-weight:900;">
                                <div><span>Amount</span></div>
                                <!-- <div><span>{{ PUT_SEPARATOR(bill.amount) }}</span></div> -->
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
                                <a data-toggle="tab" href="#additional-charge">Additional Charge</a>    
                            </li>
                            <li class="nav-item">        
                                <a data-toggle="tab" href="#is-reversal">Is Reversal</a>    
                            </li>
                            <li class="nav-item">        
                                <a class="active" data-toggle="tab" href="#expese-details">Expense</a>    
                            </li>  
                        </ul>

                        <div class="clearfix"></div>
                        
                        <div class="tab-content">    

                            <div class="tab-pane active" id="expese-details">

                                <div style="margin-bottom:10px;">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-sm hx-btn-shineblue">Get Charges</button>
                                    </div>
                                <table class="table table-bordered mb-0">
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

                            </div>

                            <div class="tab-pane" id="additional-charge">

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label" for="profit">Profit</label>
                                        <div class="form-control-wrap">
                                            <input v-model="bill.project.profit" style="text-transform: uppercase;  font-weight: bold; " type="text" class="form-control" id="profit" :readonly="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label" for="ocm">OCM</label>
                                        <div class="form-control-wrap">
                                            <input v-model="bill.project.ocm" style="text-transform: uppercase; font-weight: bold;" type="text" class="form-control" id="ocm" :readonly="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label" for="tax-charge">Tax/Charge</label>
                                        <div class="form-control-wrap">
                                            <input v-model="bill.project.tax_charge" style="text-transform: uppercase;  font-weight: bold; " type="text" class="form-control" id="tax-charge" :readonly="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label" for="other">Other</label>
                                        <div class="form-control-wrap">
                                            <input v-model="bill.project.other" style="text-transform: uppercase;  font-weight: bold; " type="text" class="form-control" id="other" :readonly="true">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="is-reversal">

                            </div>   

                            <div class="tab-pane" id="tax">

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
    name: 'progress-billing-details',
    data: function () {
        return {
            prerequiste: {
                getBillDetails: false,
            },

            bill: [],

            DRAFT: true,
            ACTION: 'view',

        }
    },
    watch: {
        ready: function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){

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
    },
    methods: {


        getBillDetails: function (bill_uuid) {
            var scope = this
  
            var URL = (!scope.DRAFT) ? 'sell-and-collect/bills/' + bill_uuid + '/progress-bilings' : 'sell-and-collect/bills/draft' + window.location.search;

            scope.GET(URL).then(res => {

                scope.bill = res.data
                scope.bill.transaction_no = (!scope.bill.transaction_no || scope.bill.transaction_no == '') ? 'To be generated' : scope.bill.transaction_no
                scope.bill.transaction_date = (!scope.bill.transaction_date || scope.bill.transaction_date == '') ? moment() : scope.bill.transaction_date

                console.log(scope.bill)

                scope.prerequiste.getBillDetails = true
            })
        },


    },
    mounted() {
        var scope = this

        var bill_uuid = scope.$route.params.bill_uuid;

        scope.ACTION = ( scope.$route.params.action) ? scope.$route.params.action : 'edit';
        scope.DRAFT = (!bill_uuid) ? true : false

        scope.getBillDetails(bill_uuid)

    },
}
</script>



<style scoped>

</style>