<template>
    <div v-if="ready">
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>
            <div class="card-body">
                <div class="actions-bar">
                    <div class="w-100">
                        <span v-if="view_mode">
                            <h1 class="title">View Details</h1>
                        </span>
                        <span v-else>
                            <span v-if="formdata.is_draft">
                                <h1 class="title">New Details</h1>
                            </span>
                            <span v-else>
                                <h1 class="title">Edit Details</h1>
                            </span>
                        </span>
                    </div>
                    <div class="bar-right">
                        <span v-if="view_mode">
                            <a @click="ROUTE({path: '/supplier-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Close</a>
                            <a @click="ROUTE({path: '/suppliers/' + formdata.uuid })" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Edit</a>
                        </span>
                        <span v-else>
                            <a @click="ROUTE({path: '/supplier-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)"><span>Close</span></a>
                            <a @click="save()" type="button" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">
                                <template v-if="formdata.uuid">Update</template>
                                <template v-else>Save</template>
                            </a>
                        </span> 
                    </div>
                </div>

                <form action="#" class="form-validate is-alter">

                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="supplier-name">Supplier Name</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.supplier_name" type="text" class="form-control" id="supplier-name" :readonly="view_mode">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="supplier-shortname">Supplier Shortname</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.supplier_shortname" type="text" class="form-control" id="supplier-shortname" :readonly="view_mode">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="lead-time">Lead Time (Days)</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.lead_time" type="text" class="form-control" id="lead-time" :readonly="view_mode">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.email" type="text" class="form-control" id="email" :readonly="view_mode">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="group-name">Group Name</label>
                                <select class="form-select-supplier-group" v-model="selected_supplier_group" :options="options_supplier_group" name="supplier-group" :disabled="view_mode">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="contact-no">Contact No</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.contact_no" type="text" class="form-control" id="contact-no" :readonly="view_mode">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="tax-identification-no">Tax Identification No</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.tax_identification_no" type="text" class="form-control" id="tax-identification-no" :readonly="view_mode">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="cost-center">Cost Center</label>
                                <select class="form-select-cost-center" v-model="selected_cost_center" :options="options_cost_center" name="cost-center" :disabled="view_mode">
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_transporter" true-value="1" false-value="0" class="custom-control-input" id="is-transporter" :disabled="view_mode">
                                        <label class="custom-control-label" for="is-transporter">Is Transporter?</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_active" true-value="1" false-value="0" class="custom-control-input" id="is-active" :disabled="view_mode">
                                        <label class="custom-control-label" for="is-active">Is Active?</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                
                    </div>

                    <br/>
                    <div id="suppliers-settings-tab" class="hx-tab-2 round">
                            <ul class="nav nav-tabs">
                                <li>        
                                    <a data-toggle="tab" href="#address-tab">Address</a>    
                                </li>
                                                                <li>        
                                    <a data-toggle="tab" href="#contact-tab">Contact</a>    
                                </li> 
                                <li>        
                                    <a data-toggle="tab" href="#check-payees-tab">Check Payee</a>    
                                </li>
                                <li>        
                                    <a data-toggle="tab" href="#discounts-tab">Discount</a>   
                                </li>
                                <li>        
                                    <a class="active" data-toggle="tab" href="#account-tab">Financial Account</a>    
                                </li>     
                            </ul>

                            <div class="clearfix"></div>

                            <div class="tab-content">    
                                <div class="tab-pane active" id="account-tab">
                                        <div class="row">
                                            <div class="col-md-4 col-12">

                                                <div class="form-group">
                                                    <label class="form-label" for="expenses">Default Account Expense</label>
                                                    <select class="form-select-expenses" v-model="selected_expenses" :options="options_expenses" name="expenses" :disabled="view_mode">
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="payables">Default Account Payable</label>
                                                    <select class="form-select-payables" v-model="selected_payables" :options="options_payables" name="payables" :disabled="view_mode">
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="payment-term">Payment Term</label>
                                                    <select class="form-select-payment-term" v-model="selected_payment_term" :options="options_payment_term" name="payment-term" :disabled="view_mode">
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" v-model="is_vat" class="custom-control-input" id="is-vat-supplier" :disabled="view_mode">
                                                            <label class="custom-control-label" for="is-vat-supplier">Is VAT?</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div v-show="is_vat" class="row">
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="vat">VAT</label>
                                                            <select class="form-select-vat" v-model="selected_vat" :options="options_vat" name="vat" :disabled="view_mode">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" v-model="is_ewt" value="1" class="custom-control-input" id="is-ewt-supplier" :disabled="view_mode">
                                                            <label class="custom-control-label" for="is-ewt-supplier">Is EWT?</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div v-show="is_ewt" class="row">
                                                    <div class="col-md-4 col-12" >
                                                        <div class="form-group">
                                                            <label class="form-label" for="ewt">EWT</label>
                                                            <select class="form-select-ewt" v-model="selected_ewt" :options="options_ewt" name="ewt" :disabled="view_mode">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane" id="discounts-tab">
                                    <Discounts ref="discounts" :supplier_uuid="formdata.uuid" :view_mode="view_mode" :properties="{ table_responsive: false }"></Discounts>
                                </div>

                                <div class="tab-pane" id="check-payees-tab">
                                    <check-payees ref="payees" :supplier_uuid="formdata.uuid" :view_mode="view_mode" :properties="{ table_responsive: false }"></check-payees>
                                </div>

                                <div class="tab-pane" id="contact-tab">
                                    <contacts ref="contacts" :supplier_uuid="formdata.uuid" :view_mode="view_mode" :properties="{ table_responsive: false }"></contacts>
                                </div>

                                <div class="tab-pane" id="address-tab">
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="form-group mb-4">
                                                    <label class="form-label" for="address-list"><strong>Select Address</strong></label>
                                                    <select class="form-select-address-list" v-model="selected_address" :options="options_address" name="address-list" :disabled="view_mode">
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                        
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="address1"><strong>Purok/Street/Zone</strong></label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.address1" style="text-transform: uppercase; font-weight: bold;" type="text" class="form-control" id="address1" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="barangay"><strong>Barangay:</strong><small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="barangay" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="barangay" readonly="true">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="city-municipality"><strong>City/Municipality:</strong><small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="city_municipality" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="city-municipality" readonly="true">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="province"><strong>Province:</strong><small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="province" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="province" readonly="true">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="region"><strong>Region:</strong><small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="region" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="region" readonly="true">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="postal-code"><strong>Postal Code:</strong><small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="postal_code" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="postal-code" readonly="true">
                                                    </div>
                                                </div>
                                            </div>

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


import Swal from 'sweetalert2'

import Discounts from './discounts'
import CheckPayees from './check-payees'
import Contacts from './contacts'

export default {
    name: 'supplier-list',
    props: ['properties','view_mode'],

    data: function () {
        return {
            prerequiste: {
                getPayables: false,
                getExpenses: false,
                getSupplierGroup: false,
                getPaymentTerm: false,
                getVat: false,
                getEwt: false,
                getAddressList: false,
                getCostCenter: false,
            },
            selected_payables: null,
            options_payables: [],

            selected_expenses: null,
            options_expenses: [],

            selected_supplier_group: null,
            options_supplier_group: [],

            selected_payment_term: null,
            options_payment_term: [],

            selected_vat: null,
            options_vat: [],

            selected_ewt: null,
            options_ewt: [],

            selected_address: null,
            options_address: [],

            selected_cost_center: null,
            options_cost_center: [],

            is_vat: 0,
            is_ewt: 0,
            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: '',

            supplierList: [],

            reference_vat_uuid: '',
            reference_ewt_uuid: '',

            formdata: { 
                uuid: null,
                is_draft: 1,
                supplier_name: '', 
                supplier_shortname: '', 
                tax_identification_no: '',
                supplier_group_uuid: '',
                lead_time: '',
                is_transporter: '',
                is_active: 1,
                vat_uuid: '',
                ewt_uuid: '',
                payment_term_uuid: '',
                coa_payable_account_uuid: '',
                coa_expense_account_uuid: '',
                email: '',
                contact_no: '',
                address_uuid: '',
                address1: '',
                cost_center_uuid: '',
                is_vat: 0,
                is_ewt: 0,

                children: {
                    discount_groups: [],
                    payees: [],
                    contacts: []
                }
            }

        }
    },
    components: {
        Discounts,
        CheckPayees,
        Contacts
    },
    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getPayables && scope.prerequiste.getExpenses && scope.prerequiste.getSupplierGroup && scope.prerequiste.getPaymentTerm 
                && scope.prerequiste.getVat && scope.prerequiste.getEwt && scope.prerequiste.getAddressList && scope.prerequiste.getCostCenter) {
                return true
            }

            return false
        }
    },
    watch: {
        ready: function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){
                    $(".form-select-expenses").select2({data: scope.options_expenses});
                    scope.selected_expenses = scope.options_expenses[0].id

                    $(".form-select-supplier-group").select2({data: scope.options_supplier_group});
                    scope.selected_supplier_group = scope.options_supplier_group[0].id
                    $('.form-select-supplier-group').trigger('change');

                    $(".form-select-payment-term").select2({data: scope.options_payment_term});
                    scope.selected_payment_term = scope.options_payment_term[0].id
                    $(".form-select-payment-term").trigger('change');

                    $(".form-select-ewt").select2({data: scope.options_ewt});
                    scope.selected_ewt = scope.options_ewt[0].id

                    $(".form-select-vat").select2({data: scope.options_vat});
                    scope.selected_vat = scope.options_vat[0].id

                    $(".form-select-address-list").select2({data: scope.options_address});
                    scope.selected_address = scope.options_address[0].id
                    scope.fillAddress()

                    $(".form-select-payables").select2({data: scope.options_payables});
                    scope.selected_payables = scope.options_payables[0].id

                    $(".form-select-cost-center").select2({data: scope.options_cost_center});
                    scope.selected_cost_center = scope.options_cost_center[0].id

                    
                    scope.getSupplierDetails(scope.formdata.uuid)
                },500)
                
            }
            
        },
        is_vat: function () {
            var scope = this

            if (scope.formdata.is_draft == 1){

                if (scope.is_vat == 1){
                    scope.selected_vat = scope.options_vat[2].id
                    
                    $('.form-select-vat').val(scope.selected_vat);
                    $('.form-select-vat').trigger('change');
                    
                }else{
                    scope.selected_vat = scope.options_vat[0].id

                    $('.form-select-vat').val(scope.selected_vat);
                    $('.form-select-vat').trigger('change');

                }

            }
            else {

                if (scope.is_vat == 1){
                    
                    if (scope.reference_vat_uuid == null){

                        scope.selected_vat = scope.options_vat[2].id

                        $('.form-select-vat').val(scope.selected_vat);
                        $('.form-select-vat').trigger('change');

                    }else{
                        scope.selected_vat = scope.reference_vat_uuid
                        $('.form-select-vat').val(scope.reference_vat_uuid);
                        $('.form-select-vat').trigger('change');
                    }   

                }else{
                    scope.selected_vat = scope.options_vat[0].id

                    $('.form-select-vat').val(scope.selected_vat);
                    $('.form-select-vat').trigger('change');
                }

            }
        },

        is_ewt: function () {
            var scope = this

            if (scope.formdata.is_draft == 1){

                if (scope.is_ewt == 1){
                    scope.selected_ewt = scope.options_ewt[1].id
                    
                    $('.form-select-ewt').val(scope.selected_ewt);
                    $('.form-select-ewt').trigger('change');
                    
                }else{
                    scope.selected_ewt = scope.options_ewt[0].id

                    $('.form-select-ewt').val(scope.selected_ewt);
                    $('.form-select-ewt').trigger('change');

                }

            }
            else {

                if (scope.is_vat == 1){
                    
                    if (scope.reference_ewt_uuid == null){

                        scope.selected_ewt = scope.options_ewt[1].id

                        $('.form-select-ewt').val(scope.selected_ewt);
                        $('.form-select-ewt').trigger('change');

                    }else{
                        scope.selected_ewt = scope.reference_ewt_uuid
                        $('.form-select-ewt').val(scope.reference_ewt_uuid);
                        $('.form-select-ewt').trigger('change');
                    }   

                }else{
                    scope.selected_ewt = scope.options_ewt[0].id

                    $('.form-select-ewt').val(scope.selected_ewt);
                    $('.form-select-ewt').trigger('change');
                }

            }
        }
    },
    methods: {
        getPayables: function () {
           var scope = this
            scope.GET('company/chart-of-accounts?group1=accounts-payable').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_payables.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                })

                scope.prerequiste.getPayables = true
            })

        },
        getExpenses: function () {
            var scope = this

            scope.options_expenses.push({
               id: '',
               text: 'None'
           });

            scope.GET('company/chart-of-accounts-expenses').then(res => {
              
                res.rows.forEach(function (data) {
                    scope.options_expenses.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                })

                
                scope.prerequiste.getExpenses = true

            })
        },
        getSupplierGroup: function () {
           var scope = this
            scope.GET('suppliers/supplier-group').then(res => {

                res.rows.forEach(function (data) {
                    scope.options_supplier_group.push({
                        id: data.uuid,
                        text: data.group_name
                    })
                })

                scope.prerequiste.getSupplierGroup = true
                
            })

        },
        getPaymentTerm: function () {
           var scope = this
            scope.GET('company/payment-term').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_payment_term.push({
                        id: data.uuid,
                        text: data.term
                    })
                
                })

                
                scope.prerequiste.getPaymentTerm = true
            })

        },

        getCostCenter: function () {
           var scope = this
            scope.GET('company/cost-center').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_cost_center.push({
                        id: data.uuid,
                        text: data.cost_center_name
                    })
                })

                scope.prerequiste.getCostCenter = true
                
            })

        },

        getVat: function () {
           var scope = this

           scope.options_vat.push({
               id: '',
               text: 'None'
           });

            scope.GET('company/taxation-vat').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_vat.push({
                        id: data.uuid,
                        text: data.tax_name
                    })
                
                })

                scope.prerequiste.getVat = true
            })

        },

        getEwt: function () {
           var scope = this

           scope.options_ewt.push({
               id: '',
               text: 'None'
           });

            scope.GET('company/taxation-ewt').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_ewt.push({
                        id: data.uuid,
                        text: data.tax_name
                    })
                
                })

                
                scope.prerequiste.getEwt = true
            })

        },

        getAddressList: function () {
            var scope = this
            scope.GET('company/address-list').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_address.push({
                        id: data.uuid,
                        text: data.barangay.toUpperCase() + ', ' + data.city_municipality.toUpperCase() + ', ' + data.province.toUpperCase() + ' ' + data.postal_code.toUpperCase() + ' - ' + data.region.toUpperCase(),
                        barangay: data.barangay,
                        city_municipality: data.city_municipality,
                        province: data.province,
                        region: data.region,
                        postal_code: data.postal_code
                    })
                
                })

                

                scope.prerequiste.getAddressList = true
            })

        },

        fillAddress: function () {
           var scope = this
            for (var i = 0; i < scope.options_address.length; i++) {
                if(scope.options_address[i].id==scope.selected_address){
                    scope.barangay = scope.options_address[i].barangay
                    scope.city_municipality = scope.options_address[i].city_municipality
                    scope.province = scope.options_address[i].province
                    scope.region = scope.options_address[i].region
                    scope.postal_code = scope.options_address[i].postal_code
                }
            }
        },

        save: function () {
            var scope = this
     
            scope.formdata.children.discount_groups = scope.$refs.discounts.getDiscountGroups();
            scope.formdata.children.payees = scope.$refs.payees.getPayees();
            scope.formdata.children.contacts = scope.$refs.contacts.getContacts();
      
            scope.formdata.supplier_group_uuid = scope.selected_supplier_group
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.ewt_uuid = scope.selected_ewt
            scope.formdata.coa_payable_account_uuid = scope.selected_payables
            scope.formdata.coa_expense_account_uuid = scope.selected_expenses
            scope.formdata.address_uuid = scope.selected_address
            scope.formdata.cost_center_uuid = scope.selected_cost_center
            scope.formdata.is_vat = scope.is_vat
            scope.formdata.is_ewt = scope.is_ewt

            if (scope.formdata.uuid) {
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
                        scope.PUT('suppliers/' + scope.formdata.uuid, scope.formdata).then(res => {
                            if (res.success) {
                                window.swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Updated',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    scope.ROUTE({path: '/supplier-main/'})
                                })
                            } else {
                                if (res.errors > 0 && res.tab == 'discounts') {
                                    scope.$refs.discounts.updateDiscountGroups(res.groups)
                                    $('#suppliers-settings-tab .nav-tabs').find('a[href="#discount-tab"]').trigger('click');
                                }
                            }
                        })
                    }                              
                })
            } else {
                scope.POST('suppliers', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.ROUTE({path: '/supplier-main/'})
                        })
                    } else {
                        if (res.errors > 0 && res.tab == 'discounts') {
                            scope.$refs.discounts.updateDiscountGroups(res.groups)
                            $('#suppliers-settings-tab .nav-tabs').find('a[href="#discounts-tab"]').trigger('click');
                        }
                            
                        
                    }
                })
            }
            
        },
        getSupplierDetails: function (supplierUUID) {
            var scope = this
            
            if (supplierUUID == 'create') {
                return;
            } 

            scope.GET('suppliers/' + supplierUUID).then(res => {
            
                let data = res.data

                scope.formdata.uuid = supplierUUID

                scope.formdata.is_draft = data.is_draft
                scope.formdata.supplier_name = data.supplier_name
                scope.formdata.supplier_shortname = data.supplier_shortname
                scope.formdata.tax_identification_no = data.tax_identification_no
                scope.formdata.lead_time = data.lead_time
                scope.formdata.is_transporter = data.is_transporter
                scope.formdata.is_active = data.is_active
                scope.formdata.email = data.email
                scope.formdata.contact_no = data.contact_no
                scope.formdata.address1 = data.address1

                if (data.vat_uuid != null){
                    scope.is_vat = 1
                }else{
                    scope.is_vat = 0
                }

                if (data.ewt_uuid != null){
                    scope.is_ewt = 1
                }else{
                    scope.is_ewt = 0
                }

                $('.form-select-supplier-group').val(data.supplier_group_uuid);
                $('.form-select-supplier-group').trigger('change');

                $('.form-select-vat').val(data.vat_uuid);
                $('.form-select-vat').trigger('change');

                scope.reference_vat_uuid = data.vat_uuid;

                $('.form-select-ewt').val(data.ewt_uuid);
                $('.form-select-ewt').trigger('change');

                scope.reference_ewt_uuid = data.ewt_uuid;

                $('.form-select-payment-term').val(data.payment_term_uuid);
                $('.form-select-payment-term').trigger('change');

                $('.form-select-payables').val(data.coa_payable_account_uuid);
                $('.form-select-payables').trigger('change');

                $('.form-select-expenses').val(data.coa_expense_account_uuid);
                $('.form-select-expenses').trigger('change');

            
                $('.form-select-address-list').val(data.address_uuid);
                $('.form-select-address-list').trigger('change');
                
                $('.form-select-cost-center').val(data.cost_center_uuid);
                $('.form-select-cost-center').trigger('change');
                
                
            })
        }
    },
    mounted() {
        var scope = this
        
        scope.getPayables()

        scope.getExpenses()

        scope.getSupplierGroup()
        scope.getPaymentTerm()
        scope.getVat()
        scope.getEwt()
        scope.getAddressList()
        scope.getCostCenter()
        
        
        scope.formdata.uuid = (scope.$route.params.supplierUUID != 'create') ? scope.$route.params.supplierUUID : null

        $(document).on('change','.form-select-payables', function(e) { 
            scope.selected_payables = $('.form-select-payables').val();
        })

        $(document).on('change','.form-select-expenses', function(e) { 
            scope.selected_expenses = $('.form-select-expenses').val();
        })

        $(document).on('change','.form-select-supplier-group', function(e) { 
            scope.selected_supplier_group = $('.form-select-supplier-group').val();
        })

        $(document).on('change','.form-select-payment-term', function(e) { 
            scope.selected_payment_term = $('.form-select-payment-term').val();
        })

        $(document).on('change','.form-select-vat', function(e) { 
            scope.selected_vat = $('.form-select-vat').val();

            if (scope.selected_vat == ''){
                scope.is_vat = 0
            }
        })

        $(document).on('change','.form-select-ewt', function(e) { 
            scope.selected_ewt = $('.form-select-ewt').val();

            if (scope.selected_ewt == ''){
                scope.is_ewt = 0
            }
        })

        $(document).on('change','.form-select-address-list', function(e) { 
            scope.selected_address = $('.form-select-address-list').val();

            scope.fillAddress()
        })

        $(document).on('change','.form-select-cost-center', function(e) { 
            scope.selected_cost_center = $('.form-select-cost-center').val();
        })
    },
}
</script>
