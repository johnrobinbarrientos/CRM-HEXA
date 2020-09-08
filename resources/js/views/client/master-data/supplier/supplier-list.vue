<template>
    <div>
        <div v-show="!show_form">
        <div class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Supplier">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="toggleForm();resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Supplier</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
        
        <br/>
        <div v-show="!show_form">          
            <div class="row">
                <div class="col-12">
                    <div class="card card-bordered card-preview">
                        <div style="overflow-x:auto;"> 
                        <table class="table table-tranx table-items">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <!-- <th class="table-fixed-column" style="left:0px; width:150px; background: #f5f6fa;"><span class="">Actions</span></th>
                                    <th class="table-fixed-column" style="left:150px; width:100px; background: #f5f6fa;"><span class="">#</span></th>
                                    <th class="table-fixed-column" style="left:250px; width:200px; background: #f5f6fa; border-right:1px solid #dbdfea;"><span class="">Shortname</span></th> -->
                                    <th><span class="">Actions</span></th>
                                    <th><span class="">#</span></th>
                                    <th><span class="">Business Name</span></th>
                                    <th><span class="">Business Shortname</span></th>
                                    <th><span class="">Check Payee</span></th>
                                    <th><span class="">Is Transporter?</span></th>
                                    <th><span class="">Lead Time (Days)</span></th>
                                    <th><span class="">Group Name</span></th>
                                    <th><span class="">Contact No</span></th>
                                    <th><span class="">Payment Term</span></th>
                                    <th><span class="">Tax Identification No</span></th>
                                    <th><span class="">Account Payable</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(supplier, index) in supplierList" :key="supplier.uuid" class="tb-tnx-supplier">
                                    <!-- <th class="table-fixed-column" style="border-top:1px solid #dbdfea; left:0px; width:150px; background:#fff;"><span class="">Actions</span></th>
                                    <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:150px; width:100px; background:#fff;"><span class="">#</span></td>
                                    <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:250px; width:200px; background:#fff; border-right:1px solid #dbdfea;"><span class="">Shortname Tide</span></td> -->
                                    <td>
                                    <span class="">
                                        <a href="javascript:void(0)"  @click="setData(supplier); toggleForm() " class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                        <a href="javascript:void(0)"  @click="remove(supplier)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                    </span>
                                    </td>
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">{{supplier.business_name}}</span></td>
                                    <td><span class="">{{supplier.business_shortname}}</span></td>
                                    <td><span class="">{{supplier.check_payee}}</span></td>
                                    <td v-if="supplier.is_transporter === 1">Yes</td>
                                    <td v-else>No</td>
                                    <td><span class="">{{supplier.lead_time}}</span></td>
                                    <td><span class="">{{supplier.supplier_group.group_name}}</span></td>
                                    <td><span class="">{{supplier.contact_no}}</span></td>
                                    <td><span class="">{{supplier.payment_term.term}}</span></td>
                                    <td><span class="">{{supplier.tax_identification_no}}</span></td>
                                    <td><span class="">{{supplier.account_payable.account_name}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div v-show="show_form">
            <form action="#" class="form-validate is-alter">

                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Business Name</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.business_name" type="text" class="form-control" id="business-name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-shortname">Business Shortname</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.business_shortname" type="text" class="form-control" id="business-shortname" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="check-payee">Check Payee</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.check_payee" type="text" class="form-control" id="check-payee" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="formdata.is_transporter" true-value="1" false-value="0" class="custom-control-input" id="is-transporter">
                                    <label class="custom-control-label" for="is-transporter">Is Transporter?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="lead-time">Lead Time (Days)</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.lead_time" type="text" class="form-control" id="lead-time" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="group-name">Group Name</label>
                            <select class="form-select-supplier-group" v-model="selected_supplier_group" :options="options_supplier_group" name="supplier-group">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.email" type="text" class="form-control" id="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="contact-no">Contact No</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.contact_no" type="text" class="form-control" id="contact-no" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="tax-identification-no">Tax Identification No</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.tax_identification_no" type="text" class="form-control" id="tax-identification-no" required>
                            </div>
                        </div>
                    </div>
                    
                          
                </div>

                <br/>
                <ul class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="nav-link active" data-toggle="tab" href="#account">Financial Account</a>    
                        </li>    
                        <li class="nav-item">        
                            <a v-if="formdata.uuid === null" class="nav-link disabled" data-toggle="tab" href="#discounts">Discounts</a> 
                            <a v-else class="nav-link" data-toggle="tab" href="#discounts">Discounts</a>   
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
                                    <select class="form-select-payables" v-model="selected_payables" :options="options_payables" name="payables">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="payment-term">Payment Term</label>
                                    <select class="form-select-payment-term" v-model="selected_payment_term" :options="options_payment_term" name="payment-term">
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input v-model="formdata.is_sales_item" type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Applied VAT?</label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="is_vat" value="1" class="custom-control-input" id="is-vat">
                                                <label class="custom-control-label" for="is-vat">Is Vat?</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-show="is_vat" class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="vat">VAT</label>
                                                <select class="form-select-vat" v-model="selected_vat" :options="options_vat" name="vat">
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
                                                <input type="checkbox" v-model="is_ewt" value="1" class="custom-control-input" id="is-ewt">
                                                <label class="custom-control-label" for="is-ewt">Is Ewt?</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-show="is_ewt" class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="ewt">EWT</label>
                                                <select class="form-select-ewt" v-model="selected_ewt" :options="options_ewt" name="ewt">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
 
                        </div>

                        <div class="tab-pane" id="discounts">

                            <div id="accordion">
                                <div class="card mb-1 shadow-none">
                                    <div class="card-header" id="headingOne">
                                        <h6 class="m-0">
                                            <a href="#collapseOne" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                                Regular Discounts
                                            </a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                                        <div class="card-body">
                                            <supplier-regular-discount :properties="formdata.uuid"></supplier-regular-discount> 
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-1 shadow-none">
                                    <div class="card-header" id="headingTwo">
                                        <h6 class="m-0">
                                            <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                                Price Rules
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <supplier-price-rule :properties="formdata.uuid"></supplier-price-rule>
                                        </div>
                                    </div>
                                </div>
                            </div>
           
                        </div>

                        <div class="tab-pane" id="address"> 
         
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="address1">Purok/Street/Zone</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.address1" type="text" class="form-control" id="address1" required>
                                    </div>
                                </div>
                            </div>
         
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select class="form-select-address-list" v-model="selected_global_address" :options="options_global_address" name="address-list">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="barangay">Barangay</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="barangay">{{barangay}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="city-municipality">City/Municipality</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="city-municipality">{{city_municipality}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="province">Province</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="province">{{province}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="region">Region</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="region">{{region}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="postal-code">Postal Code</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="postal-code">{{postal_code}}</label>
                                    </div>
                                </div>
                            </div>
                
                        </div>     
                    </div>
                
            </form>
            <div style="margin-top:30px; text-align:right;">
                <button @click="toggleForm()" type="submit" class="btn btn-lg btn-primary">Back</button>
                <button v-if="formdata.uuid === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Save Changes</button>
            </div>
        </div>        
             
    </div>
</template>

<script>
import SupplierRegularDiscount from './supplier-regular-discount'
import SupplierPriceRule from './supplier-price-rule'

import Swal from 'sweetalert2'

export default {
    name: 'supplier-list',
    props: ['properties'],

    components: {
        'supplier-regular-discount': SupplierRegularDiscount,
        'supplier-price-rule': SupplierPriceRule
    },

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

            show_form: false,

            is_vat: 0,
            is_ewt: 0,
            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: '',

            supplierList: [],

            formdata: { 
                uuid: null, 
                business_name: '', 
                business_shortname: '', 
                check_payee: '',
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
    methods: {
        toggleForm() {
            var scope = this
            scope.show_form = !scope.show_form
        },
        getSupplierList: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                scope.supplierList = res.rows
            })
        },
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

        getEwt: function () {
           var scope = this

           scope.options_ewt.push({
               id: '',
               text: 'NONE'
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
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.business_name = ''
            scope.formdata.business_shortname = ''
            scope.formdata.check_payee = ''
            scope.formdata.tax_identification_no = ''
            scope.formdata.supplier_group_uuid = ''
            scope.formdata.lead_time = ''
            scope.formdata.is_transporter = ''
            scope.formdata.vat_uuid = ''
            scope.formdata.ewt_uuid = ''
            scope.formdata.payment_term_uuid = ''
            scope.formdata.coa_payable_account_uuid = ''
            scope.formdata.email = ''
            scope.formdata.contact_no = ''
            scope.formdata.global_address_uuid = ''
            scope.formdata.address1 = ''


            scope.is_vat = 0
            scope.is_ewt = 0

        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.business_name = data.business_name
            scope.formdata.business_shortname = data.business_shortname
            scope.formdata.check_payee = data.check_payee
            scope.formdata.tax_identification_no = data.tax_identification_no
            scope.formdata.lead_time = data.lead_time
            scope.formdata.is_transporter = data.is_transporter
            scope.formdata.email = data.email
            scope.formdata.contact_no = data.contact_no
            scope.formdata.address1 = data.address1

            if (data.vat_uuid!=null){
                scope.is_vat = 1
            }else{
                scope.is_vat = 0
            }

            if (data.ewt_uuid!=null){
                scope.is_ewt = 1
            }else{
                scope.is_ewt = 0
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
        },
        save: function () {
            var scope = this
            scope.formdata.supplier_group_uuid = scope.selected_supplier_group
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.ewt_uuid = scope.selected_ewt
            scope.formdata.coa_payable_account_uuid = scope.selected_payables
            scope.formdata.global_address_uuid = scope.selected_global_address

            scope.POST('suppliers/supplier-list', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Supplier Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getSupplierList()
                        scope.toggleForm()
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
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('suppliers/supplier-list', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Supplier Successfuly Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getSupplierList()
                                scope.toggleForm()
                            })
                        } else {
                            alert('ERROR:' + res.code)
                        }
                    })
                }                              
            })
        },


    },
    mounted() {
        var scope = this
        scope.getSupplierList()

        scope.getPayables()
        scope.getSupplierGroup()
        scope.getPaymentTerm()
        scope.getVat()
        scope.getEwt()
        scope.getAddressList()

        
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

<style scoped>
.table-tranx { table-layout: auto; }
.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>