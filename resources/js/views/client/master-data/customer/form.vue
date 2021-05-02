<template>
    <div v-if="ready">
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>
            <div class="card-body">
                    <div class="actions-bar">
                        <div class="w-100">
                            <span v-if ="view_mode">
                                <h1 class="title">
                                    <i class="bx bx-data" @click="ROUTE({path: '/customer-main/' })"></i>
                                    <span @click="ROUTE({path: '/customer-main/' })">Customer</span>
                                    <i class="las la-angle-right"></i>
                                    View
                                </h1>
                            </span>
                            <span v-else>
                                <span v-if ="!formdata.uuid">
                                    <h1 class="title">
                                        <i class="bx bx-data" @click="ROUTE({path: '/customer-main/' })"></i>
                                        <span @click="ROUTE({path: '/customer-main/' })">Customer</span>
                                        <i class="las la-angle-right"></i>
                                        New
                                    </h1>
                                </span>
                                <span v-else>
                                    <h1 class="title">
                                        <i class="bx bx-data" @click="ROUTE({path: '/customer-main/' })"></i>
                                        <span @click="ROUTE({path: '/customer-main/' })">Customer</span>
                                        <i class="las la-angle-right"></i>
                                        Edit
                                    </h1>
                                </span>
                            </span>
                        </div>
                        <div class="bar-right">
                            <span v-if ="view_mode">
                                <a @click="ROUTE({path: '/customer-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Close</a>
                                <a @click="ROUTE({path: '/customers/' + formdata.uuid })" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Edit</a>
                            </span>
                            <span v-else>
                                
                                <a @click="ROUTE({path: '/customer-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)"><span>Close</span></a>
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
                                    <label class="form-label" for="business-name">Business Name</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.business_name" type="text" class="form-control" id="business-name" :readonly="view_mode">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-shortname">Business Shortname</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.business_shortname" type="text" class="form-control" id="business-shortname" :readonly="view_mode">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="tax_id">Tax ID</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.tax_id_no" type="text" class="form-control" id="tax_id" :readonly="view_mode">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="customer-group">Customer Group</label>
                                    <multiselect  v-model="selected_customer_group" :options="options_customer_group" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="customer_new_mode">
                                        <span slot="noResult">No Results</span>
                                    </multiselect>
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
                                    <label class="form-label" for="contact-person">Contact Person</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.contact_person" type="text" class="form-control" id="contact-person" :readonly="view_mode">
                                    </div>
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
                                    <label class="form-label" for="customer-chain">Customer Chain</label>
                                    <multiselect  v-model="selected_customer_chain" :options="options_customer_chain" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="customer_new_mode">
                                        <span slot="noResult">No Results</span>
                                    </multiselect>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="cost-center">Cost Center</label>
                                    <multiselect  v-model="selected_cost_center" :options="options_cost_center" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="customer_new_mode">
                                        <span slot="noResult">No Results</span>
                                    </multiselect>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group" style="margin-top: 30px;">
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
                        <div class="hx-tab-2 round">
                            <ul class="nav nav-tabs">
                                <li>        
                                    <a class="" data-toggle="tab" href="#address">Address</a>    
                                </li>
                                <li>        
                                    <a class="" data-toggle="tab" href="#branch-tab">Branch</a>    
                                </li>
                                <li>        
                                    <a class="" data-toggle="tab" href="#discounts-tab">Discount</a>    
                                </li> 
                                <li>        
                                    <a class="" data-toggle="tab" href="#classification">Classification</a>    
                                </li> 
                                <li>        
                                    <a class="active" data-toggle="tab" href="#account">Financial Account</a>    
                                </li> 
                            </ul>
                            
                            <div class="clearfix"></div>
                            <div class="tab-content">    
                                <div class="tab-pane active" id="account">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="recievables">Default Account Receivable</label>
                                                    <multiselect  v-model="selected_coa_recievable" :options="options_coa_recievable" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="customer_new_mode">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="payment-term">Payment Term</label>
                                                    <multiselect  v-model="selected_payment_term" :options="options_payment_term" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="customer_new_mode">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="vat">VAT</label>
                                                    <multiselect  v-model="selected_vat" :options="options_vat" track-by="uuid" label="text" deselect-label="Deselect" selectLabel="Select">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                                <div class="tab-pane" id="classification">
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="customer-channel">Customer Channel</label>
                                                    <multiselect  v-model="selected_customer_channel" :options="options_customer_channel" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="customer_new_mode">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="customer-type">Customer Type</label>
                                                    <multiselect  v-model="selected_customer_type" :options="options_customer_type" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="customer_new_mode">
                                                        <span slot="noResult">No Results</span>
                                                    </multiselect>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane" id="discounts-tab">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="base-discount">Base</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.base_discount" type="text" class="form-control" id="base-discount" :readonly="view_mode">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="logistic-discount">Logistic</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.logistic_discount" type="text" class="form-control" id="logistic-discount" :readonly="view_mode">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="term-discount">Term</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.term_discount" type="text" class="form-control" id="term-discount" :readonly="view_mode">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="branch-tab">
                                    <customer-branch ref="branches" :customer_uuid="formdata.uuid" :view_mode="view_mode" :properties="{ table_responsive: false }"></customer-branch>
                                </div>

                                
                                <div class="tab-pane" id="address">
                                        
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group mb-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="address-list"><strong>Select Address</strong></label>
                                                        <multiselect  v-model="selected_address" :options="options_address" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="customer_new_mode">
                                                            <span slot="noResult">No Results</span>
                                                        </multiselect>
                                                    </div>
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
import Branches from './customer-branch'

export default {
    name: 'customer-list',
    props: ['properties','view_mode'],
    data: function () {
        return {
            prerequiste: {
                getRecievables: false,
                getCustomerType: false,
                getCustomerChannel: false,
                getCustomerChain: false,
                getCustomerGroup: false,
                getCostCenter: false,
                getPaymentTerm: false,
                getVat: false,
                getAddressList: false,
            },

            customer_new_mode: true,

            selected_customer_group: [],
            options_customer_group: [],

            selected_customer_chain: [],
            options_customer_chain: [],

            selected_customer_channel: [],
            options_customer_channel: [],

            selected_customer_type: [],
            options_customer_type: [],

            selected_cost_center: [],
            options_cost_center: [],

            selected_coa_recievable: [],
            options_coa_recievable: [],

            selected_vat: [],
            options_vat: [],

            selected_payment_term: [],
            options_payment_term: [],

            selected_address: [],
            options_address: [],


            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: '',


            customerList: [],


            formdata: { 
                uuid: null,
                business_name: '', 
                business_shortname: '',
                tax_id_no: '',
                customer_group_uuid: '',
                customer_chain_uuid: '',
                customer_channel_uuid: '',
                customer_type_uuid: '',
                cost_center_uuid: '',
                vat_uuid: '',
                payment_term_uuid: '',
                coa_receivable_account_uuid: '',
                is_active: 1,
                email: '',
                contact_person: '',
                contact_no: '',
                address_uuid: '',
                address1: '',
                base_discount: '',
                logistic_discount: '',
                term_discount: '',

                children: {
                    branches: []
                }
            },

        }
    },
    components: {
        'customer-branch' : Branches
    },
    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getRecievables && scope.prerequiste.getCustomerType && scope.prerequiste.getCustomerChannel && scope.prerequiste.getCustomerChain 
                && scope.prerequiste.getCustomerGroup && scope.prerequiste.getCostCenter && scope.prerequiste.getPaymentTerm && scope.prerequiste.getVat
                && scope.prerequiste.getAddressList) {
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

                    scope.getCustomerDetails(scope.formdata.uuid)

                },500)
            }
        },

        selected_address: function () {
            var scope = this
            scope.fillAddress()

        },

    },
    methods: {

        getRecievables: function () {
           var scope = this

            scope.GET('company/chart-of-accounts?group1=receivable').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_coa_recievable.push({
                        uuid: data.uuid,
                        text: data.account_name
                    })
                })

                scope.prerequiste.getRecievables = true
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

        getCustomerType: function () {
           var scope = this

            scope.GET('customers/get-customer-types').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_customer_type.push({
                        uuid: data.uuid,
                        text: data.customer_type
                    })
                })

                scope.prerequiste.getCustomerType = true
            })
        },

        getCustomerChannel: function () {
           var scope = this

            scope.GET('customers/get-customer-channels').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_customer_channel.push({
                        uuid: data.uuid,
                        text: data.channel
                    })
                })

                scope.prerequiste.getCustomerChannel = true
            })
        },

        getCustomerChain: function () {
           var scope = this

            scope.GET('customers/get-customer-chains').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_customer_chain.push({
                        uuid: data.uuid,
                        text: data.chain
                    })
                })

                scope.prerequiste.getCustomerChain = true
            })
        },

        getCustomerGroup: function () {
           var scope = this

            scope.GET('customers/customer-group').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_customer_group.push({
                        uuid: data.uuid,
                        text: data.group_name
                    })
                })

                scope.prerequiste.getCustomerGroup = true
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

        getAddressList: function () {
           var scope = this

            scope.GET('company/address-list').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_address.push({
                        uuid: data.uuid,
                        text: data.barangay + ' ' + data.city_municipality + ' ' + data.province + ' ' + data.region + ' ' + data.postal_code,
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
     
            scope.formdata.children.branches = scope.$refs.branches.getBranches();

            scope.formdata.customer_group_uuid= (scope.selected_customer_group == null) ? null : scope.selected_customer_group.uuid

            scope.formdata.customer_chain_uuid= (scope.selected_customer_chain == null) ? null : scope.selected_customer_chain.uuid

            scope.formdata.cost_center_uuid= (scope.selected_cost_center == null) ? null : scope.selected_cost_center.uuid

            scope.formdata.customer_channel_uuid= (scope.selected_customer_channel == null) ? null : scope.selected_customer_channel.uuid

            scope.formdata.customer_type_uuid= (scope.selected_customer_type == null) ? null : scope.selected_customer_type.uuid

            scope.formdata.vat_uuid= (scope.selected_vat == null) ? null : scope.selected_vat.uuid

            scope.formdata.payment_term_uuid= (scope.selected_payment_term == null) ? null : scope.selected_payment_term.uuid

            scope.formdata.coa_receivable_account_uuid= (scope.selected_coa_recievable == null) ? null : scope.selected_coa_recievable.uuid

            scope.formdata.address_uuid= (scope.selected_address == null) ? null : scope.selected_address.uuid


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
                        scope.PUT('customers/' + scope.formdata.uuid, scope.formdata).then(res => {
                            if (res.success) {
                                window.swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Updated',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    scope.ROUTE({path: '/customer-main/'})
                                })
                            } else {

                            }
                        })
                    }                              
                })
            } else {
                scope.POST('customers', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.ROUTE({path: '/customer-main/'})
                        })
                    } else {
                        
                    }
                })
            }
            
        },

        getCustomerDetails: function (customerUUID) {
            var scope = this

            if (customerUUID == null) {
                return;
            } 

            scope.GET('customers/' + customerUUID).then(res => {
                let data = res.data

                scope.formdata.uuid = customerUUID

                    scope.formdata.business_name = data.business_name
                    scope.formdata.business_shortname = data.business_shortname
                    scope.formdata.tax_id_no = data.tax_id_no
                    scope.formdata.is_active = data.is_active
                    scope.formdata.email = data.email
                    scope.formdata.contact_person = data.contact_person
                    scope.formdata.contact_no = data.contact_no
                    scope.formdata.address1 = data.address1

                    scope.formdata.base_discount = data.base_discount
                    scope.formdata.logistic_discount = data.logistic_discount
                    scope.formdata.term_discount = data.term_discount

                    console.log(data)

                    if (data.customer_group !== null){
                        scope.selected_customer_group = {
                                uuid: data.customer_group.uuid,
                                text: data.customer_group.group_name
                            }
                    }

                    if (data.customer_chain !== null){
                        scope.selected_customer_chain = {
                                uuid: data.customer_chain.uuid,
                                text: data.customer_chain.chain
                            }
                    }

                    if (data.cost_center !== null){
                        scope.selected_cost_center = {
                                uuid: data.cost_center.uuid,
                                text: data.cost_center.cost_center_name
                            }
                    }

                    if (data.payment_term !== null){
                        scope.selected_payment_term = {
                                uuid: data.payment_term.uuid,
                                text: data.payment_term.term
                            }
                    }

                    if (data.account_receivable !== null){
                        scope.selected_coa_recievable = {
                                uuid: data.account_receivable.uuid,
                                text: data.account_receivable.account_name
                            }
                    }

                    if (data.customer_v_a_t !== null){
                        scope.selected_vat = {
                                uuid: data.customer_v_a_t.uuid,
                                text: data.customer_v_a_t.tax_name
                            }
                    }

                    if (data.customer_channel !== null){
                        scope.selected_customer_channel = {
                                uuid: data.customer_channel.uuid,
                                text: data.customer_channel.channel
                            }
                    }

                    if (data.customer_type !== null){
                        scope.selected_customer_type = {
                                uuid: data.customer_type.uuid,
                                text: data.customer_type.customer_type
                            }
                    }

                    if (data.address_list !== null){
                        scope.selected_address = {
                                uuid: data.address_list.uuid,
                                text: data.address_list.barangay.toUpperCase() + ', ' + data.address_list.city_municipality.toUpperCase() + ', ' + data.address_list.province.toUpperCase() + ' ' + data.address_list.postal_code.toUpperCase() + ' - ' + data.address_list.region.toUpperCase()
                            }
                    }
                
            })
        },

    },
    mounted() {
        var scope = this

        scope.getRecievables()
        scope.getCustomerType()
        scope.getCustomerChannel()
        scope.getCustomerChain()
        scope.getCustomerGroup()
        scope.getCostCenter()
        scope.getPaymentTerm()
        scope.getVat()
        scope.getAddressList()

        scope.formdata.uuid = (scope.$route.params.customerUUID != 'create') ? scope.$route.params.customerUUID : null

    },
}
</script>
