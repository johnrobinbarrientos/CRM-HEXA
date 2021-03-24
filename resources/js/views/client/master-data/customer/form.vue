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
                                <h1 class="title">View Customer Details</h1>
                            </span>
                            <span v-else>
                                <span v-if ="formdata.is_draft">
                                    <h1 class="title">New Customer Details</h1>
                                </span>
                                <span v-else>
                                    <h1 class="title">Edit Customer Details</h1>
                                </span>
                            </span>
                        </div>
                        <div class="bar-right">
                            <span v-if ="view_mode">
                                <a @click="ROUTE({path: '/customer-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Close</a>
                                <a @click="ROUTE({path: '/customers/' + formdata.uuid })" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Edit</a>
                            </span>
                            <span v-else>
                                <!-- <a @click="ROUTE({path: '/customer-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Cancel</a>
                                <a v-if="formdata.is_draft" @click="save()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Save</a>
                                <a v-else @click="update()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Update</a> -->
                                
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
                                    <label class="form-label" for="sold-to-name">Sold To Name</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.sold_to_name" type="text" class="form-control" id="sold-to-name" :readonly="view_mode">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-group-name">Business Group Name</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.business_group_name" type="text" class="form-control" id="business-group-name" :readonly="view_mode">
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
                                    <select class="form-select-customer-group" v-model="selected_customer_group" :options="options_customer_group" name="customer-group" :disabled="view_mode">
                                    </select>
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
                                    <select class="form-select-customer-chain" v-model="selected_customer_chain" :options="options_customer_chain" name="customer-chain" :disabled="view_mode">
                                    </select>
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
                                    <a class="" data-toggle="tab" href="#discounts-tab">Discount</a>    
                                </li>   
                                <li>        
                                    <a class="" data-toggle="tab" href="#branch-tab">Branch</a>    
                                </li>
                                <li>        
                                    <a class="" data-toggle="tab" href="#address">Address</a>    
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
                                                    <select class="form-select-recievables" v-model="selected_coa_recievable" :options="options_coa_recievable" name="recievables" :disabled="view_mode">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
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
                                                            <input type="checkbox" v-model="is_vat" value="1" class="custom-control-input" id="is-vat" :disabled="view_mode">
                                                            <label class="custom-control-label" for="is-vat">Is Vat?</label>
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
                                </div>

                                <div class="tab-pane" id="classification">
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="customer-channel">Customer Channel</label>
                                                    <select class="form-select-customer-channel" v-model="selected_customer_channel" :options="options_customer_channel" name="customer-channel" :disabled="view_mode">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="customer-type">Customer Type</label>
                                                    <select class="form-select-customer-type" v-model="selected_customer_type" :options="options_customer_type" name="customer-type" :disabled="view_mode">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane" id="discounts-tab">
                                    <Discounts ref="discounts" :customer_uuid="formdata.uuid" :view_mode="view_mode" :properties="{ table_responsive: false }"></Discounts>
                                </div>

                                <div class="tab-pane" id="branch-tab">
                                    <customer-branch ref="branches" :customer_uuid="formdata.uuid" :view_mode="view_mode" :properties="{ table_responsive: false }"></customer-branch>
                                </div>

                                
                                <div class="tab-pane" id="address">

                                        <div class="row mb-3 mt-2">
                                            <div class="col-md-6 offset-lg-3 col-12">
                                                <div class="form-group">
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

            selected_customer_group: null,
            options_customer_group: [],

            selected_customer_chain: null,
            options_customer_chain: [],

            selected_customer_channel: null,
            options_customer_channel: [],

            selected_customer_type: null,
            options_customer_type: [],

            selected_cost_center: null,
            options_cost_center: [],

            selected_coa_recievable: null,
            options_coa_recievable: [],

            selected_vat: null,
            options_vat: [],

            selected_payment_term: null,
            options_payment_term: [],

            selected_address: null,
            options_address: [],

            show_form: false,

            reference_vat_uuid: '',

            is_vat: 0,
            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: '',


            customerList: [],


            formdata: { 
                uuid: null,
                is_draft: 1,
                sold_to_name: '', 
                business_group_name: '', 
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
                is_vat: 0,

                children: {
                    discount_groups: [],
                    branches: []
                }
            },

        }
    },
    components: {
        Discounts,
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

                    $(".form-select-recievables").select2({data: scope.options_coa_recievable});
                    scope.selected_coa_recievable = scope.options_coa_recievable[0].id

                    $(".form-select-cost-center").select2({data: scope.options_cost_center});
                    scope.selected_cost_center = scope.options_cost_center[0].id

                    $(".form-select-customer-type").select2({data: scope.options_customer_type});
                    scope.selected_customer_type = scope.options_customer_type[0].id

                    $(".form-select-customer-channel").select2({data: scope.options_customer_channel});
                    scope.selected_customer_channel = scope.options_customer_channel[0].id

                    $(".form-select-customer-chain").select2({data: scope.options_customer_chain});
                    scope.selected_customer_chain = scope.options_customer_chain[0].id

                    $(".form-select-customer-group").select2({data: scope.options_customer_group});
                    scope.selected_customer_group = scope.options_customer_group[0].id

                    $(".form-select-payment-term").select2({data: scope.options_payment_term});
                    scope.selected_payment_term = scope.options_payment_term[0].id

                    $(".form-select-vat").select2({data: scope.options_vat});
                    scope.selected_vat = scope.options_vat[0].id

                    $(".form-select-address-list").select2({data: scope.options_address});
                    scope.selected_address = scope.options_address[0].id
                    scope.fillAddress()
                    

                    var customerUUID = scope.$route.params.customerUUID
                    scope.getCustomerDetails(customerUUID)

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
    },
    methods: {
        getRecievables: function () {
           var scope = this
            scope.GET('company/chart-of-accounts?group1=receivable').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_coa_recievable.push({
                        id: data.uuid,
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
                        id: data.uuid,
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
                        id: data.uuid,
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
                        id: data.uuid,
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
                        id: data.uuid,
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
                        id: data.uuid,
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
                        id: data.uuid,
                        text: data.term
                    })
                })

                scope.prerequiste.getPaymentTerm = true
                
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
        getAddressList: function () {
           var scope = this
            scope.GET('company/address-list').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_address.push({
                        id: data.uuid,
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
            scope.formdata.children.branches = scope.$refs.branches.getBranches();
      
            scope.formdata.customer_group_uuid = scope.selected_customer_group
            scope.formdata.customer_chain_uuid = scope.selected_customer_chain
            scope.formdata.customer_channel_uuid = scope.selected_customer_channel
            scope.formdata.customer_type_uuid = scope.selected_customer_type
            scope.formdata.cost_center_uuid = scope.selected_cost_center
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.coa_receivable_account_uuid = scope.selected_coa_recievable

            scope.formdata.address_uuid = scope.selected_address

            scope.formdata.is_vat = scope.is_vat

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
                                // if (res.errors > 0 && res.tab == 'discounts') {
                                //     scope.$refs.discounts.updateDiscountGroups(res.groups)
                                //     $('#suppliers-settings-tab .nav-tabs').find('a[href="#discount-tab"]').trigger('click');
                                // }
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
                        // if (res.errors > 0 && res.tab == 'discounts') {
                        //     scope.$refs.discounts.updateDiscountGroups(res.groups)
                        //     $('#suppliers-settings-tab .nav-tabs').find('a[href="#discounts-tab"]').trigger('click');
                        // }
                        
                    }
                })
            }
            
        },



        getCustomerDetails: function (customerUUID) {
            var scope = this

            if (customerUUID == 'create') {
                return;
            } 

            scope.GET('customers/' + customerUUID).then(res => {
                let data = res.data

                scope.formdata.uuid = customerUUID

                    scope.formdata.is_draft = data.is_draft
                    scope.formdata.sold_to_name = data.sold_to_name
                    scope.formdata.business_group_name = data.business_group_name
                    scope.formdata.business_shortname = data.business_shortname
                    scope.formdata.tax_id_no = data.tax_id_no
                    scope.formdata.is_active = data.is_active
                    scope.formdata.email = data.email
                    scope.formdata.contact_person = data.contact_person
                    scope.formdata.contact_no = data.contact_no
                    scope.formdata.address1 = data.address1

                    if (data.vat_uuid!=null){
                        scope.is_vat = 1
                    }else{
                        scope.is_vat = 0
                    }


                    $('.form-select-customer-group').val(data.customer_group_uuid);
                    $('.form-select-customer-group').trigger('change');

                    $('.form-select-customer-chain').val(data.customer_chain_uuid);
                    $('.form-select-customer-chain').trigger('change');

                    $('.form-select-customer-channel').val(data.customer_channel_uuid);
                    $('.form-select-customer-channel').trigger('change');

                    $('.form-select-customer-type').val(data.customer_type_uuid);
                    $('.form-select-customer-type').trigger('change');

                    $('.form-select-cost-center').val(data.cost_center_uuid);
                    $('.form-select-cost-center').trigger('change');

                    $('.form-select-vat').val(data.vat_uuid);
                    $('.form-select-vat').trigger('change');

                    scope.reference_vat_uuid = data.vat_uuid;

                    $('.form-select-payment-term').val(data.payment_term_uuid);
                    $('.form-select-payment-term').trigger('change');

                    $('.form-select-recievables').val(data.coa_receivable_account_uuid);
                    $('.form-select-recievables').trigger('change');

                    $('.form-select-address-list').val(data.address_uuid);
                    $('.form-select-address-list').trigger('change');

                
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


        $(document).on('change','.form-select-customer-group', function(e) { 
            scope.selected_customer_group = $('.form-select-customer-group').val();
        })

        $(document).on('change','.form-select-customer-chain', function(e) { 
            scope.selected_customer_chain = $('.form-select-customer-chain').val();
        })

        $(document).on('change','.form-select-customer-channel', function(e) { 
            scope.selected_customer_channel = $('.form-select-customer-channel').val();
        })

        $(document).on('change','.form-select-customer-type', function(e) { 
            scope.selected_customer_type = $('.form-select-customer-type').val();
        })

        $(document).on('change','.form-select-cost-center', function(e) { 
            scope.selected_cost_center = $('.form-select-cost-center').val();
        })

        $(document).on('change','.form-select-vat', function(e) { 
            scope.selected_vat = $('.form-select-vat').val();

            if (scope.selected_vat == ''){
                scope.is_vat = 0
            }
        })

        $(document).on('change','.form-select-payment-term', function(e) { 
            scope.selected_payment_term = $('.form-select-payment-term').val();
        })

        $(document).on('change','.form-select-recievables', function(e) { 
            scope.selected_coa_recievable = $('.form-select-recievables').val();
        })

        $(document).on('change','.form-select-address-list', function(e) { 
            scope.selected_address = $('.form-select-address-list').val();
            scope.fillAddress()
        })
        
    },
}
</script>
