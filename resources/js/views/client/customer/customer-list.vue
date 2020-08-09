<template>
    <div>
        <div v-show="!show_form">
        <div class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Customer">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="toggleForm();resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Customer</span>
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
                                    <th><span class="">Sold To Name</span></th>
                                    <th><span class="">Business Group Name</span></th>
                                    <th><span class="">Business Shortname</span></th>
                                    <th><span class="">Chain</span></th>
                                    <th><span class="">Group Name</span></th>
                                    <th><span class="">Contact Person</span></th>
                                    <th><span class="">Contact No</span></th>
                                    <th><span class="">Applied VAT?</span></th>
                                    <th><span class="">Payment Term</span></th>
                                    <th><span class="">Channel</span></th>
                                    <th><span class="">Customer Type</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(customer, index) in customerList" :key="customer.uuid" class="tb-tnx-customer">
                                    <!-- <th class="table-fixed-column" style="border-top:1px solid #dbdfea; left:0px; width:150px; background:#fff;"><span class="">Actions</span></th>
                                    <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:150px; width:100px; background:#fff;"><span class="">#</span></td>
                                    <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:250px; width:200px; background:#fff; border-right:1px solid #dbdfea;"><span class="">Shortname Tide</span></td> -->
                                    <td>
                                    <span class="">
                                        <a href="javascript:void(0)"  @click="setData(customer); toggleForm() " class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                        <a href="javascript:void(0)"  @click="remove(customer)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                    </span>
                                    </td>
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">{{customer.sold_to_name}}</span></td>
                                    <td><span class="">{{customer.business_group_name}}</span></td>
                                    <td><span class="">{{customer.business_shortname}}</span></td>
                                    <td><span class="">{{customer.customer_chain.chain}}</span></td>
                                    <td><span class="">{{customer.customer_group.group_name}}</span></td>
                                    <td><span class="">{{customer.contact_person}}</span></td>
                                    <td><span class="">{{customer.contact_no}}</span></td>
                                    <td v-if="customer.is_applied_vat === 1">Yes</td>
                                    <td v-else>No</td>
                                    <td><span class="">{{customer.payment_term.term}}</span></td>
                                    <td><span class="">{{customer.customer_channel.channel}}</span></td>
                                    <td><span class="">{{customer.customer_type.customer_type}}</span></td>
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
                            <label class="form-label" for="sold-to-name">Sold To Name</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.sold_to_name" type="text" class="form-control" id="sold-to-name" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-group-name">Business Group Name</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.business_group_name" type="text" class="form-control" id="business-group-name" required>
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
                            <label class="form-label" for="tax_id">Tax ID</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.tax_id_no" type="text" class="form-control" id="tax_id" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="customer-group">Customer Group</label>
                            <select class="form-select-customer-group" v-model="selected_customer_group" :options="options_customer_group" name="customer-group">
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
                            <label class="form-label" for="contact-person">Contact Person</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.contact_person" type="text" class="form-control" id="contact-person" required>
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
                            <label class="form-label" for="customer-chain">Customer Chain</label>
                            <select class="form-select-customer-chain" v-model="selected_customer_chain" :options="options_customer_chain" name="customer-chain">
                            </select>
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
                            <a class="nav-link" data-toggle="tab" href="#classification">Classification</a>    
                        </li> 
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#address">Address</a>    
                        </li>     
                    </ul>

                    <div class="tab-content">    
                        <div class="tab-pane active" id="account">
                    
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="recievables">Default Account Receivable</label>
                                    <select class="form-select-recievables" v-model="selected_coa_recievable" :options="options_coa_recievable" name="recievables">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_applied_vat" true-value="1" false-value="0" class="custom-control-input" id="is-applied-vat">
                                        <label class="custom-control-label" for="is-applied-vat">Applied VAT?</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="payment-term">Payment Term</label>
                                    <select class="form-select-payment-term" v-model="selected_payment_term" :options="options_payment_term" name="payment-term">
                                    </select>
                                </div>
                            </div>

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
                                                <label class="form-label" for="vat">Tax</label>
                                                <select class="form-select-vat" v-model="selected_vat" :options="options_vat" name="vat">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>            
 
                        </div>

                        <div class="tab-pane" id="discounts">
                            

                            <div class="row">
                              

                                <div class="col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="discount-name">Discount Name</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="customerDiscountFormData.discount_name" type="text" class="form-control" id="discount-name" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="discount-rate">Discount Rate</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="customerDiscountFormData.discount_rate" type="text" class="form-control" id="discount-rate" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div style="padding:10px 0px; text-align:right;">
                                                <button v-if="customerDiscountFormData.uuid !== null" @click="updateCustomerDiscount()" type="button" class="btn btn-lg btn-primary">Update</button>
                                                <button v-if="customerDiscountFormData.uuid === null && customerDiscountFormData.index !== null "  @click="saveTempCustomerDiscount()" type="button" class="btn btn-lg btn-primary">Update</button>
                                                <button v-if="customerDiscountFormData.uuid === null && customerDiscountFormData.index === null " @click="saveTempCustomerDiscount()" type="button" class="btn btn-lg btn-primary">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="card card-bordered card-preview">
                                        <table class="table table-items">
                                            <thead>
                                                <tr class="tb-tnx-head">
                                                    <th><span class="">Discount Name</span></th>
                                                    <th><span class="">Discount Rate</span></th>
                                                    <th><span>Actions</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(tempCustomerDiscount, index) in tempCustomerDiscounts" :key="index">
                                                    <td><span class="">{{ tempCustomerDiscount.discount_name }}</span></td>
                                                    <td><span class="">{{ tempCustomerDiscount.discount_rate }}</span></td>
                                                    <td>
                                                        <a href="javascript:void(0);" @click="editTempCustomerDiscount(index)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                        <a href="javascript:void(0);" @click="removeTempCustomerDiscount(index)" class="btn btn-sm btn-danger"><em class="icon ni ni-cross"></em></a>
                                                    </td>
                                                </tr>
                                                <tr v-for="(customerDiscount, index) in customerDiscounts" :key="index">
                                                    <td><span class="">{{ customerDiscount.discount_name }}</span></td>
                                                    <td><span class="">{{ customerDiscount.discount_rate }}</span></td>
                                                    <td>
                                                        <a href="javascript:void(0);" @click="editCustomerDiscount(customerDiscount, index)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                        <a href="javascript:void(0);" @click="removeCustomerDiscount(customerDiscount, index)" class="btn btn-sm btn-danger"><em class="icon ni ni-cross"></em></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
    
                        </div>

                        <div class="tab-pane" id="classification">
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="customer-channel">Customer Channel</label>
                                    <select class="form-select-customer-channel" v-model="selected_customer_channel" :options="options_customer_channel" name="customer-channel">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="customer-type">Customer Type</label>
                                    <select class="form-select-customer-type" v-model="selected_customer_type" :options="options_customer_type" name="customer-type">
                                    </select>
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

import Swal from 'sweetalert2'

export default {
    name: 'customer-list',
    props: ['properties'],
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
                sold_to_name: '', 
                business_group_name: '', 
                business_shortname: '',
                tax_id_no: '',
                customer_group_uuid: '',
                global_customer_chain_uuid: '',
                global_customer_channel_uuid: '',
                global_customer_type_uuid: '',
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
        toggleForm() {
            var scope = this
            scope.show_form = !scope.show_form
        },
        getCustomerList: function () {
           var scope = this
            scope.GET('customers/customer-list').then(res => {
                scope.customerList = res.rows
            })
        },
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
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.sold_to_name = ''
            scope.formdata.business_group_name = ''
            scope.formdata.business_shortname = ''
            scope.formdata.tax_id_no = ''
            scope.formdata.customer_group_uuid = ''
            scope.formdata.global_customer_chain_uuid = ''
            scope.formdata.global_customer_channel_uuid = ''
            scope.formdata.global_customer_type_uuid = ''
            scope.formdata.vat_uuid = ''
            scope.formdata.payment_term_uuid = ''
            scope.formdata.coa_receivable_account_uuid = ''
            scope.formdata.is_applied_vat = ''
            scope.formdata.email = ''
            scope.formdata.contact_person = ''
            scope.formdata.contact_no = ''
            scope.formdata.global_address_uuid = ''
            scope.formdata.address1 = ''


            scope.is_vat = 0
            scope.customerDiscounts = []

        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
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

            $('.form-select-vat').val(data.vat_uuid);
            $('.form-select-vat').trigger('change');

            $('.form-select-payment-term').val(data.payment_term_uuid);
            $('.form-select-payment-term').trigger('change');

            $('.form-select-recievables').val(data.coa_receivable_account_uuid);
            $('.form-select-recievables').trigger('change');

            $('.form-select-address-list').val(data.global_address_uuid);
            $('.form-select-address-list').trigger('change');
        },
        save: function () {
            var scope = this
            
            scope.formdata.customer_group_uuid = scope.selected_customer_group
            scope.formdata.global_customer_chain_uuid = scope.selected_customer_chain
            scope.formdata.global_customer_channel_uuid = scope.selected_customer_channel
            scope.formdata.global_customer_type_uuid = scope.selected_customer_type
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.coa_receivable_account_uuid = scope.selected_coa_recievable
            scope.formdata.global_address_uuid = scope.selected_global_address

            scope.formdata.discounts = scope.tempCustomerDiscounts

            scope.POST('customers/customer-list', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Customer Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getCustomerList()
                        scope.toggleForm()
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
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.payment_term_uuid = scope.selected_payment_term
            scope.formdata.coa_receivable_account_uuid = scope.selected_coa_recievable
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
            
                    scope.POST('customers/customer-list', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Customer Successfuly Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getCustomerList()
                                scope.toggleForm()
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
                confirmButtonColor: '#3085d6',
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
    },
    mounted() {
        var scope = this
        scope.getCustomerList()

        scope.getRecievables()
        scope.getCustomerType()
        scope.getCustomerChannel()
        scope.getCustomerChain()
        scope.getCustomerGroup()
        scope.getPaymentTerm()
        scope.getVat()
        scope.getAddressList()

        
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

<style scoped>
.table-tranx { table-layout: auto; }
.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>