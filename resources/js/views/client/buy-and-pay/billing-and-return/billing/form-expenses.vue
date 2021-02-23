<template>
    <div>
        <div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Supplier</label>
                        <select class="form-select-supplier" v-model="formdata.supplier_uuid" :options="options_supplier" name="supplier"></select>
                    </div>
                </div>


                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Branch</label>
                        <input type="text" class="form-control disabled" v-model="branch_name" readonly >
                    </div>
                </div>


                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Amount payable</label>
                        <input v-model="formdata.amount" type="text" class="form-control" >
                    </div>
                </div>
                




                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Location</label>
                        <select class="form-select-branch-location" v-model="formdata.branch_location_uuid" :options="options_branch_location" name="branch-location"></select>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <table style="display:none;" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th>No</th>
                    <th>Account</th>
                    <th>Project</th>
                    <th>Amount</th>
                    <th>Memo 1</th>
                    <th>Memo 2</th>
                    <th>Memo 3</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(expense,index) in expenses" :key="'expense-' + index">
                    <td><a href="javascript:void(0)" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-eye" title="View"></i></a></td>
                    <td>{{ (index + 1) }}</td>
                    <td class="editable">
                        <span>{{ getAccountNameByUUID(expense.coa_uuid) }}</span>
                        <select v-model="expense.coa_uuid" class="editable-control">
                            <option v-for="chart_of_account in options_chart_of_accounts" :value="chart_of_account.id" :key="'coa-' + chart_of_account.id">
                                {{ chart_of_account.text }}
                            </option>
                        </select>
                    </td>
                    <td class="editable">
                        <span>{{ getProjectNameByUUID(expense.project_uuid) }}</span>
                        <select v-model="expense.project_uuid" class="editable-control">
                            <option v-for="project in options_project" :value="project.id" :key="'project-' + project.id">
                                {{ project.text }}
                            </option>
                        </select>
                    </td>
                  
                    <td class="editable text-right">
                        <span>{{ expense.amount }}</span>
                        <input v-model="expense.amount" type="text" class="editable-control">
                    </td>

                    <td class="editable">
                        <span>{{ expense.memo_1 }}</span>
                        <input v-model="expense.memo_1" type="text" class="editable-control">
                    </td>
                    <td class="editable">
                        <span>{{ expense.memo_2 }}</span>
                        <input v-model="expense.memo_2" type="text" class="editable-control">
                    </td>
                    <td class="editable">
                        <span>{{ expense.memo_3 }}</span>
                        <input v-model="expense.memo_3" type="text" class="editable-control">
                    </td>
                </tr>
                <tr>
                    <td @click="add()" style="text-align:center; background:#efefef; padding:8px; cursor:pointer; font-weight:600;" colspan="8">
                        Add Row
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="padding:10px 0px; text-align:right;">
            <a style="max-width:150px; display:inline-block;" @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                <span>Bill</span>
            </a>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'buy-and-pay-expenses-form',
    props: ['properties'],
    data: function () {
        return {
            formdata: {
                type: 'Expenses',
                uuid: null,
                amount: 0.00,
                supplier_uuid: null,
                branch_location_uuid: null,
            },
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

            expenses: [],
        }
    },
    computed: {
      
    },
    methods: {
        add: function () {
            var scope = this;
            scope.expenses.push({
                uuid: null,
                coa_uuid: null,
                project_uuid: null,
                amount: null,
                memo_1: null,
                memo_2: null,
                memo_3: null,
            });
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

                //$(".form-select-chart-of-accounts").select2({data: scope.options_chart_of_accounts});
                //scope.selected_chart_of_accounts = scope.options_chart_of_accounts[0].id

                // scope.prerequisite.getBranchLocations = true
            })
        },
        getBranches: function () {
           var scope = this
            scope.GET('users/get-branch').then(res => {
                //scope.formdata.branch_uuid = res.rows.branch_uuid
                scope.branch_name = res.rows.branch_name
                scope.formdata.branch_uuid = res.rows.branch_uuid
            })
        },
        getBranchLocations: function () {
           var scope = this
            scope.GET('users/get-branch-locations').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_branch_location.push({
                        id: data.uuid,
                        text: data.location_name
                    })
                
                })

                $(".form-select-branch-location").select2({data: scope.options_branch_location});
                scope.selected_branch_location = scope.options_branch_location[0].id
                scope.formdata.branch_location_uuid = scope.options_branch_location[0].uuid
                // scope.prerequisite.getBranchLocations = true
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

                // scope.prerequisite.getBranchLocations = true
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

                //$(".form-select-chart-of-accounts").select2({data: scope.options_chart_of_accounts});
                //scope.selected_chart_of_accounts = scope.options_chart_of_accounts[0].id

                // scope.prerequisite.getBranchLocations = true
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
        getSupplier: function () {
           var scope = this
            scope.GET('suppliers').then(res => {

                res.rows.forEach(function (data) {

                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.supplier_shortname,
                        lead_time: data.lead_time,
                        vat_uuid: data.vat_uuid
                    })
                
                })

                scope.formdata.supplier_uuid = scope.options_supplier[0].uuid

                if (scope.options_supplier[0].vat_uuid!==null){
                    //scope.formdata.is_apply_tax = 1
                    /*
                    scope.GET('company/taxation/' + scope.options_supplier[0].vat_uuid).then(res => {
                        scope.formdata.supplier_tax_rate = res.rows.tax_rate
                    })
                    */
                } else{
                   //  scope.formdata.is_apply_tax = 0
                   //  scope.formdata.supplier_tax_rate = 0
                }
                
                // scope.formdata.term = scope.options_supplier[0].lead_time
                // scope.formdata.date_expected = moment().add(parseInt(scope.options_supplier[0].lead_time) ,'days').format('YYYY-MM-DD')

                setTimeout(function(){
                    $(".form-select-supplier").select2({data: scope.options_supplier});
                    $(".form-select-supplier").trigger('change');
                },300);
                

                /*
                if (scope.order && scope.order.supplier_uuid) {
                    $(".form-select-supplier").val(scope.order.supplier_uuid).trigger('change');
                } else {
                    $(".form-select-supplier").trigger('change');
                }
               
                
               

                scope.prerequisite.getSupplier = true
                 */
            })
        },
        save: function() {
            var scope = this
            var qs = jQuery.param( scope.formdata );
            scope.ROUTE({path: '/buy-and-pay/bills/create?' + qs })
            return
            scope.POST('buy-and-pay/bills', {type: 'Expenses', expenses: scope.expenses, data: scope.formdata}).then(res => {
                if (res.success) {
                    // scope.$refs.items.saveOrderItems()
                    scope.CLOSE_MODAL('#modalItemReceipts');
                    scope.ROUTE({path: '/buy-and-pay/bills' });
                }
            })
        },
    },
    mounted() {
        var scope = this
       scope.getSupplier();
       scope.getBranches();
       scope.getBranchLocations();
       scope.getProjects();
       // scope.getCostCenters();
       scope.getChartOfAccountByGroup('expenses');
       scope.add();

       $(".form-select-supplier").on('change',function(){
            var id = $(".form-select-supplier").val()
            scope.formdata.supplier_uuid = id
        });

       $(".form-select-branch-location").on('change',function(){
            var id = $(".form-select-branch-location").val()
            scope.formdata.branch_location_uuid = id
        });

        
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>