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
                            <a class="nav-link" data-toggle="tab" href="#discounts">Discounts</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#address">Address</a>    
                        </li>     
                    </ul>

                    <div class="tab-content">    
                        <div class="tab-pane active" id="account">
                    
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Default Account Payable</label>
                                    <select class="form-select-payables" v-model="selected_payables" :options="options_payables" name="payables">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Payment Term</label>
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

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Tax</label>
                                    <select class="form-select-tax" v-model="selected_tax" :options="options_tax" name="tax">
                                    </select>
                                </div>
                            </div>
 
                        </div>

                        <div class="tab-pane" id="discounts">
                            

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Discount Name</label>
                                    <div class="form-control-wrap">
                                        <input v-model="supplierDiscounts.discount_name" type="text" class="form-control" id="discount-name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Discount Rate</label>
                                    <div class="form-control-wrap">
                                        <input v-model="supplierDiscounts.discount_rate" type="text" class="form-control" id="discount-rate" required>
                                    </div>
                                </div>
                            </div>
    
                        </div>

                        <div class="tab-pane" id="address"> 
         
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Address</label>
                                    <select class="form-select-address-list" v-model="selected_global_address" :options="options_global_address" name="address-list">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Address1</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.Address1" type="text" class="form-control" id="address1" required>
                                    </div>
                                </div>
                            </div>
                
                        </div>     
                    </div>
                
            </form>
            <div style="margin-top:30px; text-align:right;">
                <button v-if="formdata.uuid === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Save Changes</button>
            </div>
        </div>        
             
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'home',
    props: ['properties'],
    data: function () {
        return {
            selected_payables: null,
            options_payables: [],

            selected_supplier_group: null,
            options_supplier_group: [],

            selected_payment_term: null,
            options_payment_term: [],

            selected_tax: null,
            options_tax: [],

            selected_global_address: null,
            options_global_address: [],

            show_form: false,


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
                payment_term_uuid: '',
                coa_payable_account_uuid: '',
                email: '',
                contact_no: '',
                global_address_uuid: '',
                Address1: ''
            },

            supplierDiscounts:{
                uuid: null,
                supplier_uuid: null,
                discount_name: '',
                discount_rate: ''
            }

        }
    },
    methods: {
        toggleForm() {
            var scope = this
            scope.show_form = !scope.show_form
        },
        getSupplier: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                scope.supplierList = res.rows
            })
        },
        getAllPayables: function () {
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
        getAllSupplierGroup: function () {
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
        getAllPaymentTerm: function () {
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
        getAllTax: function () {
           var scope = this
            scope.GET('company/taxation').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_tax.push({
                        id: data.uuid,
                        text: data.tax_name
                    })
                
                })

                $(".form-select-tax").select2({data: scope.options_tax});
                
                scope.selected_tax = scope.options_tax[0].id
            })

        },
        getAllAddressList: function () {
           var scope = this
            scope.GET('globals/address-list').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_global_address.push({
                        id: data.uuid,
                        text: data.barangay + ' ' + data.city_municipality + ' ' + data.province + ' ' + data.region
                    })
                
                })

                $(".form-select-address-list").select2({data: scope.options_global_address});
                
                scope.selected_global_address = scope.options_global_address[0].id
            })

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
            scope.formdata.payment_term_uuid = ''
            scope.formdata.coa_payable_account_uuid = ''
            scope.formdata.email = ''
            scope.formdata.contact_no = ''
            scope.formdata.global_address_uuid = ''
            scope.formdata.Address1 = ''

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
            scope.formdata.Address1 = data.Address1

            $('.form-select-supplier-group').val(data.supplier_group_uuid);
            $('.form-select-supplier-group').trigger('change');

            $('.form-select-tax').val(data.vat_uuid);
            $('.form-select-tax').trigger('change');

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
            scope.formdata.vat_uuid = scope.selected_tax
            scope.formdata.coa_payable_account_uuid = scope.selected_payables
            scope.formdata.global_address_uuid = scope.selected_global_address

            scope.POST('suppliers/supplier-list/save', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Supplier Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getSupplier()
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
            scope.formdata.vat_uuid = scope.selected_tax
            scope.formdata.coa_payable_account_uuid = scope.selected_payables
            scope.formdata.global_address_uuid = scope.selected_global_address
            
            scope.PUT('suppliers/supplier-list/update', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Supplier Successfuly Updated',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getSupplier()
                        scope.toggleForm()
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        }
    },
    mounted() {
        var scope = this
        scope.getSupplier()

        scope.getAllPayables()
        scope.getAllSupplierGroup()
        scope.getAllPaymentTerm()
        scope.getAllTax()
        scope.getAllAddressList()

        
        $('.form-select-payables').on("change", function(e) { 
            scope.selected_payables = $('.form-select-payables').val();
        })

        $('.form-select-supplier-group').on("change", function(e) { 
            scope.selected_supplier_group = $('.form-select-supplier-group').val();
        })

        $('.form-select-payment-term').on("change", function(e) { 
            scope.selected_payment_term = $('.form-select-payment-term').val();
        })

        $('.form-select-tax').on("change", function(e) { 
            scope.selected_tax = $('.form-select-tax').val();
        })

        $('.form-select-address-list').on("change", function(e) { 
            scope.selected_global_address = $('.form-select-address-list').val();
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