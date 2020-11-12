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
                            <h1 class="title">View Supplier Details</h1>
                        </span>
                        <span v-else>
                            <span v-if ="formdata.is_draft">
                                <h1 class="title">New Supplier Details</h1>
                            </span>
                            <span v-else>
                                <h1 class="title">Edit Supplier Details</h1>
                            </span>
                        </span>
                    </div>
                    <div class="bar-right">
                        <span v-if ="view_mode">
                            <a @click="ROUTE({path: '/suppliers/' + formdata.uuid })" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Edit</a>
                            <a @click="create()" class="btn btn-md btn-danger waves-effect"  href="javascript:void(0)">Delete</a>
                            <a @click="ROUTE({path: '/supplier-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Close</a>
                        </span>
                        <span v-else>
                            <a @click="ROUTE({path: '/supplier-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)"><span>Cancel</span></a>
                            <a v-if="formdata.is_draft" @click="save()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)"><span>Save</span></a>
                            <a v-else @click="update()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Update</a>
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
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_transporter" true-value="1" false-value="0" class="custom-control-input" id="is-transporter" :disabled="view_mode">
                                        <label class="custom-control-label" for="is-transporter">Is Transporter?</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                
                    </div>

                    <br/>
                    <div class="hx-nav-tabs-override">
                            <ul class="nav nav-tabs">  
                                <li class="nav-item">        
                                    <a class="nav-link active" data-toggle="tab" href="#account">Financial Account</a>    
                                </li>    
                                <li class="nav-item">        
                                    <a v-if="formdata.uuid === null" class="nav-link disabled" data-toggle="tab" href="#discounts">Discounts</a> 
                                    <a v-else class="nav-link" data-toggle="tab" href="#discounts">Discounts</a>   
                                </li>
                                <li class="nav-item">        
                                    <a class="nav-link" data-toggle="tab" href="#check-payees">Check Payees</a>    
                                </li>
                                <li class="nav-item">        
                                    <a class="nav-link" data-toggle="tab" href="#address">Address</a>    
                                </li>     
                            </ul>

                            <div class="tab-content">    
                                <div class="tab-pane active" id="account">
                            
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="payables">Default Account Payable</label>
                                            <select class="form-select-payables" v-model="selected_payables" :options="options_payables" name="payables" :disabled="view_mode">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="payment-term">Payment Term</label>
                                            <select class="form-select-payment-term" v-model="selected_payment_term" :options="options_payment_term" name="payment-term" :disabled="view_mode">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-12" style="margin-left: 12px;">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" v-model="with_vat" class="custom-control-input" id="with-vat" :disabled="view_mode">
                                                        <label class="custom-control-label" for="with-vat">With VAT?</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div v-show="with_vat" class="row">
                                                <div class="col-md-4 col-12" style="margin-left: 12px;">
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
                                        <div class="col-12" style="margin-left: 12px;">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" v-model="with_ewt" value="1" class="custom-control-input" id="with-ewt" :disabled="view_mode">
                                                        <label class="custom-control-label" for="with-ewt">With EWT?</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div v-show="with_ewt" class="row">
                                                <div class="col-md-4 col-12" style="margin-left: 12px;">
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

                                <div class="tab-pane" id="discounts">
                                    <Discounts v-if="formdata.uuid" :supplier_uuid="formdata.uuid" :view_mode="view_mode"></Discounts>
                                </div>

                                <div class="tab-pane" id="check-payees">
                                    <check-payees :supplier_uuid="formdata.uuid" :view_mode="view_mode"></check-payees>
                                </div>

                                <div class="tab-pane" id="address">

                                    <div class="row" style="margin-left: 12px;">

                                        <div class="col-md-7 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="address-list"><strong>Select Address</strong></label>
                                                <select class="form-select-address-list" v-model="selected_global_address" :options="options_global_address" name="address-list" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-left: 12px;">
                    
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
                                            <div class="form-group" style="margin-right: 12px;">
                                                <label class="form-label" for="city-municipality"><strong>City/Municipality:</strong><small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                <div class="form-control-wrap">
                                                    <input v-model="city_municipality" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="city-municipality" readonly="true">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-left: 12px;">

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
                                            <div class="form-group" style="margin-right: 12px;">
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

export default {
    name: 'supplier-list',
    props: ['properties','view_mode'],

    data: function () {
        return {
            selected_payables: null,
            options_payables: [],

            selected_supplier_group: null,
            options_supplier_group: [],

            selected_payment_term: null,
            options_payment_term: [],

            selected_vat: null,
            options_vat: [],

            selected_ewt: null,
            options_ewt: [],

            selected_global_address: null,
            options_global_address: [],

            with_vat: 0,
            with_ewt: 0,
            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: '',

            supplierList: [],

            formdata: { 
                uuid: null,
                is_draft: 1,
                supplier_name: '', 
                supplier_shortname: '', 
                tax_identification_no: '',
                supplier_group_uuid: '',
                lead_time: '',
                is_transporter: '',
                vat_uuid: '',
                ewt_uuid: '',
                payment_term_uuid: '',
                coa_payable_account_uuid: '',
                email: '',
                contact_no: '',
                global_address_uuid: '',
                address1: ''
            }

        }
    },
    watch: {

    },
    components: {
        Discounts,
        CheckPayees
    },
    methods: {
        getPayables: function () {
           var scope = this
            scope.GET('company/chart-of-accounts-payables').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_payables.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                })

                $(".form-select-payables").select2({data: scope.options_payables});
                
                scope.selected_payables = scope.options_payables[0].id
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

                
                $(".form-select-supplier-group").select2({data: scope.options_supplier_group});
                scope.selected_supplier_group = scope.options_supplier_group[0].id
                $('.form-select-supplier-group').trigger('change');
                
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
               text: 'None'
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

                $(".form-select-ewt").select2({data: scope.options_ewt});
                
                scope.selected_ewt = scope.options_ewt[0].id
            })

        },

        getAddressList: function () {
            var scope = this
            scope.GET('globals/address-list').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_global_address.push({
                        id: data.uuid,
                        text: data.barangay.toUpperCase() + ', ' + data.city_municipality.toUpperCase() + ', ' + data.province.toUpperCase() + ' ' + data.postal_code.toUpperCase() + ' - ' + data.region.toUpperCase(),
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

            scope.formdata.supplier_group_uuid = scope.selected_supplier_group
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.ewt_uuid = scope.selected_ewt
            scope.formdata.coa_payable_account_uuid = scope.selected_payables
            scope.formdata.global_address_uuid = scope.selected_global_address

            scope.PUT('suppliers/supplier-list', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Supplier Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.ROUTE({path: '/supplier-main/'})
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
            })
        },
        update: function () {
            var scope = this

            scope.formdata.supplier_group_uuid = scope.selected_supplier_group
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.ewt_uuid = scope.selected_ewt
            scope.formdata.coa_payable_account_uuid = scope.selected_payables
            scope.formdata.global_address_uuid = scope.selected_global_address
            window.swal.fire({
                title: 'Update Record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.PUT('suppliers/supplier-list', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Supplier Successfuly Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.ROUTE({path: '/supplier-main/'})
                            })
                        } else {
                            alert('ERROR:' + res.code)
                        }
                    })
                }                              
            })
        },
        getSupplierDetails: function (supplierUUID) {
            var scope = this
            scope.GET('suppliers/supplier-list/' + supplierUUID).then(res => {
            
                let data = res.data

                scope.formdata.uuid = supplierUUID

                if (data.is_draft=== 0) {

                    scope.formdata.is_draft = data.is_draft
                    scope.formdata.supplier_name = data.supplier_name
                    scope.formdata.supplier_shortname = data.supplier_shortname
                    scope.formdata.tax_identification_no = data.tax_identification_no
                    scope.formdata.lead_time = data.lead_time
                    scope.formdata.is_transporter = data.is_transporter
                    scope.formdata.email = data.email
                    scope.formdata.contact_no = data.contact_no
                    scope.formdata.address1 = data.address1

                    if (data.vat_uuid!=null){
                        scope.with_vat = 1
                    }else{
                        scope.with_vat = 0
                    }

                    if (data.ewt_uuid!=null){
                        scope.with_ewt = 1
                    }else{
                        scope.with_ewt = 0
                    }

                    $('.form-select-supplier-group').val(data.supplier_group_uuid);
                    $('.form-select-supplier-group').trigger('change');

                    $('.form-select-vat').val(data.vat_uuid);
                    $('.form-select-vat').trigger('change');

                    $('.form-select-ewt').val(data.ewt_uuid);
                    $('.form-select-ewt').trigger('change');

                    $('.form-select-payment-term').val(data.payment_term_uuid);
                    $('.form-select-payment-term').trigger('change');

                    $('.form-select-payables').val(data.coa_payable_account_uuid);
                    $('.form-select-payables').trigger('change');

            
                    $('.form-select-address-list').val(data.global_address_uuid);
                    $('.form-select-address-list').trigger('change');
                
                
                }
                
            })
        }
    },
    mounted() {
        var scope = this
        
        scope.getPayables()
        scope.getSupplierGroup()
        scope.getPaymentTerm()
        scope.getVat()
        scope.getEwt()
        scope.getAddressList()

        var supplierUUID = scope.$route.params.supplierUUID
        scope.getSupplierDetails(supplierUUID)

        $('.form-select-payables').on("change", function(e) { 
            scope.selected_payables = $('.form-select-payables').val();
        })

        $('.form-select-supplier-group').on("change", function(e) { 
            scope.selected_supplier_group = $('.form-select-supplier-group').val();
        })

        $('.form-select-payment-term').on("change", function(e) { 
            scope.selected_payment_term = $('.form-select-payment-term').val();
        })

        $('.form-select-vat').on("change", function(e) { 
            scope.selected_vat = $('.form-select-vat').val();
        })

        $('.form-select-ewt').on("change", function(e) { 
            scope.selected_ewt = $('.form-select-ewt').val();
        })

        $('.form-select-address-list').on("change", function(e) { 
            scope.selected_global_address = $('.form-select-address-list').val();
            scope.fillAddress()
        })
    },
}
</script>
