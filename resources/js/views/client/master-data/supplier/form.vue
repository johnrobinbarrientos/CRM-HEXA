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
                            <h1 class="title">
                                <i class="bx bx-data" @click="ROUTE({path: '/supplier-main/' })"></i>
                                <span @click="ROUTE({path: '/supplier-main/' })">Supplier</span>
                                <i class="las la-angle-right"></i>
                                View
                            </h1>
                        </span>
                        <span v-else>
                            <span v-if="!formdata.uuid">
                                <h1 class="title">
                                    <i class="bx bx-data" @click="ROUTE({path: '/supplier-main/' })"></i>
                                    <span @click="ROUTE({path: '/supplier-main/' })">Supplier</span>
                                    <i class="las la-angle-right"></i>
                                    New
                                </h1>
                            </span>
                            <span v-else>
                                <h1 class="title">
                                    <i class="bx bx-data" @click="ROUTE({path: '/supplier-main/' })"></i>
                                    <span @click="ROUTE({path: '/supplier-main/' })">Supplier</span>
                                    <i class="las la-angle-right"></i>
                                    Edit
                                </h1>
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
                                <multiselect  v-model="selected_supplier_group" :options="options_supplier_group" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="supplier_new_mode">
                                    <span slot="noResult">No Results</span>
                                </multiselect>
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
                                <multiselect  v-model="selected_cost_center" :options="options_cost_center" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="supplier_new_mode">
                                    <span slot="noResult">No Results</span>
                                </multiselect>
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
                                                    <multiselect  v-model="selected_expenses" :options="options_expenses" track-by="uuid" label="text" deselect-label="Deselect" selectLabel="Select">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="payables">Default Account Payable</label>
                                                    <multiselect  v-model="selected_payables" :options="options_payables" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="supplier_new_mode">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="payment-term">Payment Term</label>
                                                    <multiselect  v-model="selected_payment_term" :options="options_payment_term" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="supplier_new_mode">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="vat">VAT</label>
                                                    <multiselect  v-model="selected_vat" :options="options_vat" track-by="uuid" label="text" deselect-label="Deselect" selectLabel="Select">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="ewt">EWT</label>
                                                    <multiselect  v-model="selected_ewt" :options="options_ewt" track-by="uuid" label="text" deselect-label="Deselect" selectLabel="Select">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
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
                                                    <multiselect  v-model="selected_address" :options="options_address" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="supplier_new_mode">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
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

            supplier_new_mode: true,

            selected_payables: [],
            options_payables: [],

            selected_expenses: [],
            options_expenses: [],

            selected_supplier_group: [],
            options_supplier_group: [],

            selected_payment_term: [],
            options_payment_term: [],

            selected_vat: [],
            options_vat: [],

            selected_ewt: [],
            options_ewt: [],

            selected_address: [],
            options_address: [],

            selected_cost_center: [],
            options_cost_center: [],


            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: '',

            supplierList: [],


            formdata: { 
                uuid: null,
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
                    
                    scope.getSupplierDetails(scope.formdata.uuid)

                },500)
            }
        },
        
        selected_address: function () {
            var scope = this
            scope.fillAddress()

        },

    },
    methods: {

        getPayables: function () {
           var scope = this

            scope.GET('company/chart-of-accounts?group1=accounts-payable').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_payables.push({
                        uuid: data.uuid,
                        text: data.account_name
                    })
                })

                scope.prerequiste.getPayables = true
            })

        },

        getExpenses: function () {
            var scope = this

            scope.GET('company/chart-of-accounts-expenses').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_expenses.push({
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
                        text: data.cost_center_name
                    })
                })

                scope.prerequiste.getCostCenter = true
            })
        },

        getVat: function () {
           var scope = this

            scope.GET('company/taxation-vat').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_vat.push({
                        uuid: data.uuid,
                        text: data.tax_name
                    })
                
                })

                scope.prerequiste.getVat = true
            })
        },

        getEwt: function () {
           var scope = this

            scope.GET('company/taxation-ewt').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_ewt.push({
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                if(scope.options_address[i].uuid==scope.selected_address.uuid){
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


            scope.formdata.supplier_group_uuid= (scope.selected_supplier_group == null) ? null : scope.selected_supplier_group.uuid

            scope.formdata.coa_expense_account_uuid= (scope.selected_expenses == null) ? null : scope.selected_expenses.uuid

            scope.formdata.coa_payable_account_uuid = (scope.selected_payables == null) ? null : scope.selected_payables.uuid

            scope.formdata.payment_term_uuid = (scope.selected_payment_term == null) ? null : scope.selected_payment_term.uuid

            scope.formdata.cost_center_uuid = (scope.selected_cost_center == null) ? null : scope.selected_cost_center.uuid

            scope.formdata.address_uuid = (scope.selected_address == null) ? null : scope.selected_address.uuid

            scope.formdata.vat_uuid = (scope.selected_address == null) ? null : scope.selected_address.uuid
            
            scope.formdata.vat_uuid = (scope.selected_vat == null) ? null : scope.selected_vat.uuid

            scope.formdata.ewt_uuid = (scope.selected_ewt == null) ? null : scope.selected_ewt.uuid


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
            
            if (supplierUUID == null) {
                return;
            } 

            scope.GET('suppliers/' + supplierUUID).then(res => {
            
                let data = res.data

                scope.supplier_new_mode = false

                scope.formdata.uuid = supplierUUID

                scope.formdata.supplier_name = data.supplier_name
                scope.formdata.supplier_shortname = data.supplier_shortname
                scope.formdata.tax_identification_no = data.tax_identification_no
                scope.formdata.lead_time = data.lead_time
                scope.formdata.is_transporter = data.is_transporter
                scope.formdata.is_active = data.is_active
                scope.formdata.email = data.email
                scope.formdata.contact_no = data.contact_no
                scope.formdata.address1 = data.address1


                if (data.supplier_group !== null){
                    scope.selected_supplier_group = {
                            uuid: data.supplier_group.uuid,
                            text: data.supplier_group.group_name
                        }
                }

                if (data.account_expense !== null){
                    scope.selected_expenses = {
                        uuid: data.account_expense.uuid,
                        text: data.account_expense.account_name
                    }
                }

                if (data.account_payable !== null){
                    scope.selected_payables = {
                            uuid: data.account_payable.uuid,
                            text: data.account_payable.account_name
                        }
                }

                if (data.payment_term !== null){
                    scope.selected_payment_term = {
                            uuid: data.payment_term.uuid,
                            text: data.payment_term.term
                        }
                }

                if (data.cost_center !== null){
                    scope.selected_cost_center = {
                            uuid: data.cost_center.uuid,
                            text: data.cost_center.cost_center_name
                        }
                }

                if (data.address_list !== null){
                    scope.selected_address = {
                            uuid: data.address_list.uuid,
                            text: data.address_list.barangay.toUpperCase() + ', ' + data.address_list.city_municipality.toUpperCase() + ', ' + data.address_list.province.toUpperCase() + ' ' + data.address_list.postal_code.toUpperCase() + ' - ' + data.address_list.region.toUpperCase()
                        }
                }

                if (data.supplier_v_a_t !== null){
                    scope.selected_vat = {
                            uuid: data.supplier_v_a_t.uuid,
                            text: data.supplier_v_a_t.tax_name
                        }
                }

                if (data.supplier_e_w_t !== null){
                    scope.selected_ewt = {
                            uuid: data.supplier_e_w_t.uuid,
                            text: data.supplier_e_w_t.tax_name
                        }
                }

                
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

    },
}
</script>
