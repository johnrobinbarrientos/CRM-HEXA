<template>
    <div>
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
                                <a @click="ROUTE({path: '/customers/' + formdata.uuid })" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Edit</a>
                                <a @click="create()" class="btn btn-md btn-danger waves-effect"  href="javascript:void(0)">Delete</a>
                                <a @click="ROUTE({path: '/customer-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Close</a>
                            </span>
                            <span v-else>
                                <a @click="ROUTE({path: '/customer-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Cancel</a>
                                <a v-if="formdata.is_draft" @click="save()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Save</a>
                                <a v-else @click="update()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Update</a>
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
                            
                                
                        </div>

                        <br/>
                        <div class="hx-nav-tabs-override">
                            <ul class="nav nav-tabs">    
                                <li class="nav-item">        
                                    <a class="nav-link active" data-toggle="tab" href="#account">Financial Account</a>    
                                </li>    
                                <!-- <li class="nav-item">        
                                    <a class="nav-link" data-toggle="tab" href="#discounts">Discounts</a>    
                                </li> -->
                                <li class="nav-item">        
                                    <a class="nav-link" data-toggle="tab" href="#classification">Classification</a>    
                                </li> 
                                <li class="nav-item">        
                                    <a class="nav-link" data-toggle="tab" href="#address">Address</a>    
                                </li>     
                            </ul>

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
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" v-model="formdata.is_applied_vat" true-value="1" false-value="0" class="custom-control-input" id="is-applied-vat" :disabled="view_mode">
                                                        <label class="custom-control-label" for="is-applied-vat">Applied VAT?</label>
                                                    </div>
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
                                                            <label class="form-label" for="vat">Tax</label>
                                                            <select class="form-select-vat" v-model="selected_vat" :options="options_vat" name="vat" :disabled="view_mode">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>            
                                </div>

                                <!-- <div class="tab-pane" id="discounts">
                                    
                                        <div class="row">

                                            <div class="col-lg-3">
                                                <div style="border: 1px solid #ddd; border-radius: 4px; padding: 15px; background: #eee">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="discount-name">Discount Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input v-model="customerDiscountFormData.discount_name" type="text" class="form-control" id="discount-name" :readonly="view_mode">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="discount-rate">Discount Rate</label>
                                                                <div class="form-control-wrap">
                                                                    <input v-model="customerDiscountFormData.discount_rate" type="text" class="form-control" id="discount-rate" :readonly="view_mode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div style="padding:10px 0px; text-align:right;">
                                                                <button v-if="customerDiscountFormData.uuid !== null" @click="updateCustomerDiscount()" type="button" class="btn btn-primary btn-block font-weight-bold" :disabled="view_mode">UPDATE</button>
                                                                <button v-if="customerDiscountFormData.uuid === null && customerDiscountFormData.index !== null "  @click="saveTempCustomerDiscount()" type="button" class="btn btn-primary btn-block font-weight-bold" :disabled="view_mode">UPDATE</button>
                                                                <button v-if="customerDiscountFormData.uuid === null && customerDiscountFormData.index === null " @click="saveTempCustomerDiscount()" type="button" class="btn btn-primary btn-block font-weight-bold hx-btn-shineblue" :disabled="view_mode">ADD</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="card card-bordered card-preview">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Discount Name</th>
                                                                    <th>Discount Rate</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(tempCustomerDiscount, index) in tempCustomerDiscounts" :key="index">
                                                                    <td>{{ tempCustomerDiscount.discount_name }}</td>
                                                                    <td>{{ tempCustomerDiscount.discount_rate }}</td>
                                                                    <td width="100"><span class="d-block text-center">
                                                                        <button @click="editTempCustomerDiscount(index)" type="button" class="btn btn-sm btn-light"><em class="mdi mdi-pen"></em></button>
                                                                        <button @click="removeTempCustomerDiscount(index)" type="button" class="btn btn-sm btn-danger"><em class="mdi mdi-trash-can"></em></button>
                                                                    </span></td>
                                                                </tr>
                                                                <tr v-for="(customerDiscount, index) in customerDiscounts" :key="index">
                                                                    <td>{{ customerDiscount.discount_name }}</td>
                                                                    <td>{{ customerDiscount.discount_rate }}</td>
                                                                    <td width="100"><span class="d-block text-center">
                                                                        <button @click="editCustomerDiscount(customerDiscount, index)" class="btn btn-sm hx-btn-shineblue"><em class="mdi mdi-pen"></em></button>
                                                                        <button @click="removeCustomerDiscount(customerDiscount, index)" class="btn btn-sm btn-danger"><em class="mdi mdi-trash-can"></em></button>
                                                                    </span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                </div>
                                            </div>
                                        </div>
                                </div> -->

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

                                
                                <div class="tab-pane" id="address">

                                        <div class="row mb-3 mt-2">
                                            <div class="col-md-6 offset-lg-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="address-list"><strong>Select Address</strong></label>
                                                    <select class="form-select-address-list" v-model="selected_global_address" :options="options_global_address" name="address-list" :disabled="view_mode">
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

export default {
    name: 'customer-list',
    props: ['properties','view_mode'],
    data: function () {
        return {
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

            selected_global_address: null,
            options_global_address: [],

            show_form: false,

            is_vat: 0,
            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: '',


            customerList: [],

            customerDiscounts: [],
            tempCustomerDiscounts: [],

            formdata: { 
                uuid: null,
                is_draft: 1,
                sold_to_name: '', 
                business_group_name: '', 
                business_shortname: '',
                tax_id_no: '',
                customer_group_uuid: '',
                global_customer_chain_uuid: '',
                global_customer_channel_uuid: '',
                global_customer_type_uuid: '',
                global_cost_center_uuid: '',
                vat_uuid: '',
                payment_term_uuid: '',
                coa_receivable_account_uuid: '',
                is_applied_vat: '',
                email: '',
                contact_person: '',
                contact_no: '',
                global_address_uuid: '',
                address1: ''
            },

            customerDiscountFormData:{
                index: null, 
                uuid: null,
                customer_uuid: null,
                discount_name: '',
                discount_rate: ''
            }

        }
    },
    methods: {
        getRecievables: function () {
           var scope = this
            scope.GET('company/chart-of-accounts-recievables').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_coa_recievable.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                })

                $(".form-select-recievables").select2({data: scope.options_coa_recievable});
                
                scope.selected_coa_recievable = scope.options_coa_recievable[0].id
            })

        },
        getCostCenter: function () {
           var scope = this
            scope.GET('globals/cost-center').then(res => {
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
        getCustomerType: function () {
           var scope = this
            scope.GET('globals/customer-type').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_customer_type.push({
                        id: data.uuid,
                        text: data.customer_type
                    })
                })

                $(".form-select-customer-type").select2({data: scope.options_customer_type});
                
                scope.selected_customer_type = scope.options_customer_type[0].id
            })

        },
        getCustomerChannel: function () {
           var scope = this
            scope.GET('globals/customer-channel').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_customer_channel.push({
                        id: data.uuid,
                        text: data.channel
                    })
                })

                $(".form-select-customer-channel").select2({data: scope.options_customer_channel});
                
                scope.selected_customer_channel = scope.options_customer_channel[0].id
            })

        },
        getCustomerChain: function () {
           var scope = this
            scope.GET('globals/customer-chain').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_customer_chain.push({
                        id: data.uuid,
                        text: data.chain
                    })
                })

                $(".form-select-customer-chain").select2({data: scope.options_customer_chain});
                
                scope.selected_customer_chain = scope.options_customer_chain[0].id
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

                $(".form-select-customer-group").select2({data: scope.options_customer_group});
                
                scope.selected_customer_group = scope.options_customer_group[0].id
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

                $(".form-select-payment-term").select2({data: scope.options_payment_term});
                
                scope.selected_payment_term = scope.options_payment_term[0].id
            })

        },
        getVat: function () {
           var scope = this

           scope.options_vat.push({
               id: '',
               text: 'NONE'
           });

            scope.GET('company/taxation-vat').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_vat.push({
                        id: data.uuid,
                        text: data.tax_name
                    })
                
                })

                $(".form-select-vat").select2({data: scope.options_vat});
                
                scope.selected_vat = scope.options_vat[0].id
            })

        },
        getAddressList: function () {
           var scope = this
            scope.GET('globals/address-list').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_global_address.push({
                        id: data.uuid,
                        text: data.barangay + ' ' + data.city_municipality + ' ' + data.province + ' ' + data.region + ' ' + data.postal_code,
                        barangay: data.barangay,
                        city_municipality: data.city_municipality,
                        province: data.province,
                        region: data.region,
                        postal_code: data.postal_code
                    })
                
                })

                $(".form-select-address-list").select2({data: scope.options_global_address});
                scope.selected_global_address = scope.options_global_address[0].id
                scope.fillAddress()
            })

        },
        fillAddress: function () {
           var scope = this
            for (var i = 0; i < scope.options_global_address.length; i++) {
                if(scope.options_global_address[i].id==scope.selected_global_address){
                    scope.barangay = scope.options_global_address[i].barangay
                    scope.city_municipality = scope.options_global_address[i].city_municipality
                    scope.province = scope.options_global_address[i].province
                    scope.region = scope.options_global_address[i].region
                    scope.postal_code = scope.options_global_address[i].postal_code
                }
            }
        },

        save: function () {
            var scope = this
            
            scope.formdata.customer_group_uuid = scope.selected_customer_group
            scope.formdata.global_customer_chain_uuid = scope.selected_customer_chain
            scope.formdata.global_customer_channel_uuid = scope.selected_customer_channel
            scope.formdata.global_customer_type_uuid = scope.selected_customer_type
            scope.formdata.global_cost_center_uuid = scope.selected_cost_center
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.coa_receivable_account_uuid = scope.selected_coa_recievable
            scope.formdata.global_address_uuid = scope.selected_global_address

            scope.formdata.discounts = scope.tempCustomerDiscounts

            scope.PUT('customers/', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.ROUTE({path: '/customer-main/'})
                        scope.tempCustomerDiscounts = []
                        scope.formdata.discounts = []
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.formdata.customer_group_uuid = scope.selected_customer_group
            scope.formdata.global_customer_chain_uuid = scope.selected_customer_chain
            scope.formdata.global_customer_channel_uuid = scope.selected_customer_channel
            scope.formdata.global_customer_type_uuid = scope.selected_customer_type
            scope.formdata.global_cost_center_uuid = scope.selected_cost_center
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.coa_receivable_account_uuid = scope.selected_coa_recievable
            scope.formdata.global_address_uuid = scope.selected_global_address

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
            
                    scope.PUT('customers/', scope.formdata).then(res => {
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
                            alert('ERROR:' + res.code)
                        }
                    })

                }                              
            })

        },
        saveTempCustomerDiscount() {
            var scope = this
            
            // this means the customer was previously added, no need to put discounts on temporary array
            if (scope.formdata.uuid !== null) {

                if (scope.customerDiscountFormData.uuid === null) {
                    scope.saveCustomerDiscount();
                } else {
                    scope.updateCustomerDiscount();
                } 

                return;
            }

            if (scope.customerDiscountFormData.uuid == null && scope.customerDiscountFormData.index !== null) {
                var index = scope.customerDiscountFormData.index
                scope.tempCustomerDiscounts[index].discount_name = scope.customerDiscountFormData.discount_name
                scope.tempCustomerDiscounts[index].discount_rate = scope.customerDiscountFormData.discount_rate 
            } else {
                scope.tempCustomerDiscounts.push({
                    discount_name: scope.customerDiscountFormData.discount_name, 
                    discount_rate: scope.customerDiscountFormData.discount_rate 
                })
            }
            
            // reset form
            scope.customerDiscountFormData.index = null
            scope.customerDiscountFormData.uuid  = null
            scope.customerDiscountFormData.discount_name = ''
            scope.customerDiscountFormData.discount_rate = ''
        },
        editTempCustomerDiscount(index) {
            var scope = this
            
            scope.customerDiscountFormData.index = index
            scope.customerDiscountFormData.uuid = null
            scope.customerDiscountFormData.discount_name = scope.tempCustomerDiscounts[index].discount_name
            scope.customerDiscountFormData.discount_rate =  scope.tempCustomerDiscounts[index].discount_rate
        },
        editCustomerDiscount(data, index) {
            var scope = this
            
            scope.customerDiscountFormData.index = index
            scope.customerDiscountFormData.uuid = data.uuid
            scope.customerDiscountFormData.discount_name = data.discount_name
            scope.customerDiscountFormData.discount_rate =  data.discount_rate
        },
        removeTempCustomerDiscount(index) {
            var scope = this
            scope.tempCustomerDiscounts.splice(index, 1)
        },
        updateCustomerDiscount: function () {
            var scope = this

            scope.customerDiscountFormData.customer_uuid = scope.formdata.uuid
            scope.POST('customers/customer-discount-regular', scope.customerDiscountFormData).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Discount Successfuly Updated',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        var index = scope.customerDiscountFormData.index
                        scope.customerDiscounts[index].discount_name = res.data.discount_name
                        scope.customerDiscounts[index].discount_rate = res.data.discount_rate

                        // reset form
                        scope.customerDiscountFormData.index = null
                        scope.customerDiscountFormData.uuid  = null
                        scope.customerDiscountFormData.discount_name = ''
                        scope.customerDiscountFormData.discount_rate = ''
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        },
        saveCustomerDiscount: function () {
            var scope = this

            // append the customer UUID to the request payload
            scope.customerDiscountFormData.customer_uuid = scope.formdata.uuid
            scope.POST('customers/customer-discount-regular', scope.customerDiscountFormData).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Discount Successfuly Added',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                         scope.customerDiscounts.push(res.data)

                        // reset form
                        scope.customerDiscountFormData.index = null
                        scope.customerDiscountFormData.uuid  = null
                        scope.customerDiscountFormData.discount_name = ''
                        scope.customerDiscountFormData.discount_rate = ''
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        },
        removeCustomerDiscount(data,index) {
            var scope = this
            window.swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    scope.POST('customers/customer-discount-regular/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Discount Successfuly Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.customerDiscounts.splice(index, 1)
                            })
                        } else {
                            alert('ERROR:' + res.code)
                        } 
                    })
                }
            })
        },

        getCustomerDetails: function (customerUUID) {
            var scope = this
            scope.GET('customers/' + customerUUID).then(res => {
                let data = res.data

                scope.formdata.uuid = customerUUID

                if (data.is_draft=== 0) {

                    scope.formdata.is_draft = data.is_draft
                    scope.formdata.sold_to_name = data.sold_to_name
                    scope.formdata.business_group_name = data.business_group_name
                    scope.formdata.business_shortname = data.business_shortname
                    scope.formdata.tax_id_no = data.tax_id_no
                    scope.formdata.is_applied_vat = data.is_applied_vat
                    scope.formdata.email = data.email
                    scope.formdata.contact_person = data.contact_person
                    scope.formdata.contact_no = data.contact_no
                    scope.formdata.address1 = data.address1

                    if (data.vat_uuid!=null){
                        scope.is_vat = 1
                    }else{
                        scope.is_vat = 0
                    }

                    scope.customerDiscounts = []
                    scope.customerDiscounts = data.discounts

                    $('.form-select-customer-group').val(data.customer_group_uuid);
                    $('.form-select-customer-group').trigger('change');

                    $('.form-select-customer-chain').val(data.global_customer_chain_uuid);
                    $('.form-select-customer-chain').trigger('change');

                    $('.form-select-customer-channel').val(data.global_customer_channel_uuid);
                    $('.form-select-customer-channel').trigger('change');

                    $('.form-select-customer-type').val(data.global_customer_type_uuid);
                    $('.form-select-customer-type').trigger('change');

                    $('.form-select-cost-center').val(data.global_cost_center_uuid);
                    $('.form-select-cost-center').trigger('change');

                    $('.form-select-vat').val(data.vat_uuid);
                    $('.form-select-vat').trigger('change');

                    $('.form-select-payment-term').val(data.payment_term_uuid);
                    $('.form-select-payment-term').trigger('change');

                    $('.form-select-recievables').val(data.coa_receivable_account_uuid);
                    $('.form-select-recievables').trigger('change');

                    $('.form-select-address-list').val(data.global_address_uuid);
                    $('.form-select-address-list').trigger('change');

                }
                
            })
        }
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

        var customerUUID = scope.$route.params.customerUUID
        scope.getCustomerDetails(customerUUID)

        
        $('.form-select-customer-group').on("change", function(e) { 
            scope.selected_customer_group = $('.form-select-customer-group').val();
        })

        $('.form-select-customer-chain').on("change", function(e) { 
            scope.selected_customer_chain = $('.form-select-customer-chain').val();
        })

        $('.form-select-customer-channel').on("change", function(e) { 
            scope.selected_customer_channel = $('.form-select-customer-channel').val();
        })

        $('.form-select-customer-type').on("change", function(e) { 
            scope.selected_customer_type = $('.form-select-customer-type').val();
        })

        $('.form-select-cost-center').on("change", function(e) { 
            scope.selected_cost_center = $('.form-select-cost-center').val();
        })

        $('.form-select-vat').on("change", function(e) { 
            scope.selected_vat = $('.form-select-vat').val();
        })

        $('.form-select-payment-term').on("change", function(e) { 
            scope.selected_payment_term = $('.form-select-payment-term').val();
        })

        $('.form-select-recievables').on("change", function(e) { 
            scope.selected_coa_recievable = $('.form-select-recievables').val();
        })


        $('.form-select-address-list').on("change", function(e) { 
            scope.selected_global_address = $('.form-select-address-list').val();
            scope.fillAddress()
        })
        
    },
}
</script>
