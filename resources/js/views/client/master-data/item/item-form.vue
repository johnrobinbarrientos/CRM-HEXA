<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="actions-bar">
                    <div class="w-100">
                        <h1 class="title">Item Details</h1>
                    </div>
                    <div class="bar-right">
                        <a v-if="formdata.is_draft" @click="save()" type="submit" class="hx-btn hx-btn-primary" href="javascript:void(0)">Save</a>
                        <a v-else @click="update()" type="submit" class="hx-btn hx-btn-primary" href="javascript:void(0)">Update</a>
                        <a href="javascript:void(0)"  @click="ROUTE({path: '/item-main/' })" class="hx-btn hx-btn-danger">Cancel</a> 
                    </div>
                </div>

                <form action="#" class="form-validate is-alter">

                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-group">Item Group</label>
                                <select class="form-select-item-group" v-model="selected_item_group" :options="options_item_group" name="item-group">
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-code">Item Code</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.item_code" type="text" class="form-control" id="item-code" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-description">Item Description</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.item_description" type="text" class="form-control" id="item-description" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-shortname">Shortname</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.item_shortname" type="text" class="form-control" id="item-shortname" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-barcode">Item Barcode</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.item_barcode" type="text" class="form-control" id="item-barcode" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-cs-barcode-code">Case/Box Barcode</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.cs_barcode" type="text" class="form-control" id="item-cs-barcode-code" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="supplier">Supplier Name</label>
                                <select class="form-select-suppliers" v-model="selected_suppliers" :options="options_supplier" name="supplier"  multiple="multiple">
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="reorder-qty">Re-Order Qty</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.reorder_qty" type="text" class="form-control" id="reorder-qty" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_expiry" value="1" class="custom-control-input" id="is-expiry">
                                        <label class="custom-control-label" for="is-expiry">Is Expiry?</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_maintain_stock" value="1" class="custom-control-input" id="is-maintain-stock">
                                        <label class="custom-control-label" for="is-maintain-stock">Maintain Stock?</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_active" value="1" class="custom-control-input" id="is-active">
                                        <label class="custom-control-label" for="is-active">Is Active?</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                                
                    </div>

                    <br/>
                    <ul class="nav nav-tabs nav-tabs-custom">    
                            <li class="nav-item">        
                                <a class="nav-link active" data-toggle="tab" href="#account">Financial Account</a>    
                            </li>    
                            <li class="nav-item">        
                                <a class="nav-link" data-toggle="tab" href="#category">Category</a>    
                            </li>
                            <li class="nav-item">        
                                <a class="nav-link" data-toggle="tab" href="#unit-of-measure">Unit of Measure</a>    
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#pricing">Pricing</a>           
                            </li>
                            <li class="nav-item" v-show="show_asset_group">        
                                <a class="nav-link" data-toggle="tab" href="#asset">Asset 2</a>    
                            </li> 
                            <li class="nav-item">        
                                <a class="nav-link" data-toggle="tab" href="#supplier-discounts">Discounts</a>    
                            </li>   
                        </ul>

                        <div class="tab-content">    
                            <div class="tab-pane active" id="account">
                        
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="income-account">Income Account</label>
                                        <select class="form-select-income-account" v-model="selected_income_account" :options="options_income_account" name="income-account">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cost-of-sales">Cost Of Sales</label>
                                        <select class="form-select-cost-of-sales" v-model="selected_cost_of_sales" :options="options_cost_of_sales" name="cost-of-sales">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" v-model="formdata.without_vat" value="1" class="custom-control-input" id="without-vat">
                                                        <label class="custom-control-label" for="without-vat">Without VAT</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="category">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-department">Department</label>
                                        <select class="form-select-cat-department" v-model="selected_cat_department" :options="options_cat_department" name="cat-department">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-section">Section</label>
                                        <select class="form-select-cat-section" v-model="selected_cat_section" :options="options_cat_section" name="cat-section">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-category">Category</label>
                                        <select class="form-select-cat-category" v-model="selected_cat_category" :options="options_cat_category" name="cat-category">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-manufacturer">Manufacturer</label>
                                        <select class="form-select-cat-manufacturer" v-model="selected_cat_manufacturer" :options="options_cat_manufacturer" name="cat-manufacturer">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-item-type">Item Type</label>
                                        <select class="form-select-cat-item-type" v-model="selected_cat_item_type" :options="options_cat_item_type" name="cat-item-type">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-brand">Brand</label>
                                        <select class="form-select-cat-brand" v-model="selected_cat_brand" :options="options_cat_brand" name="cat-brand">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-form">Form</label>
                                        <select class="form-select-cat-form" v-model="selected_cat_form" :options="options_cat_form" name="cat-form">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-packing-type">Packing Type</label>
                                        <select class="form-select-cat-packing-type" v-model="selected_cat_packing_type" :options="options_cat_packing_type" name="cat-packing-type">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cat-sizes">Sizes</label>
                                        <select class="form-select-cat-sizes" v-model="selected_cat_sizes" :options="options_cat_sizes" name="cat-sizes">
                                        </select>
                                    </div>
                                </div>    

                            </div>

                            <div class="tab-pane" id="unit-of-measure">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div style="padding:20px 0px;">
                                            <table class="table mb-0 table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>UOM</th>
                                                        <th width="100">Packing</th>
                                                        <th width="50">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item_uom, index) in item_uoms" :key="item_uom.uuid" v-bind:class="{'table-success' : index == 0}">
                                                        <td class="editable">
                                                            <span>{{ getGlobalUOMName(item_uom.uuid) }}</span>
                                                            <select v-if="index === 0" v-model="item_uom.uuid" class="editable-control">
                                                                <option v-for="uom in globalBaseUOM" :key="'base-' + uom.uuid" :value="uom.uuid">{{ uom.uom}}</option>
                                                            </select>
                                                            <select v-else v-model="item_uom.uuid" class="editable-control">
                                                                <option value="PACK">Select a UOM</option>
                                                                <option v-for="uom in globalNonBaseUOM" v-if="!itemUomExists(uom.uuid) || uom.uuid == item_uom.uuid" :key="'pack-' + uom.uuid" :value="uom.uuid">{{ uom.uom}}</option>
                                                            </select>
                                                        </td>

                                                        <td  v-if="index !== 0" class="editable text-right">
                                                            <input v-model="item_uom.packing" type="text" class="editable-control">
                                                            <span>{{ item_uom.packing }}</span>
                                                        </td>
                                                        <td v-else class="text-right">
                                                            <span>{{ item_uom.packing }}</span>
                                                        </td>

                                                        <td v-if="index !== 0">
                                                            <a @click="removeItemUom(index)" href="javascript:void(0)" class="btn btn-sm btn-danger waves-effect"><i class="mdi mdi-trash-can"></i></a>
                                                        </td>
                                                        <td v-else>
                                                            <span>N/A</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td @click="addItemUom()" style="text-align:center; cursor:pointer; font-weight:600;" colspan="3">NEW UOM</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>   

                            <div class="tab-pane" id="pricing"> 
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" v-model="formdata.is_purchase_item" value="1" class="custom-control-input" id="is-purchase-item">
                                                    <label class="custom-control-label" for="is-purchase-item">Is Purchase Item?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-show="formdata.is_purchase_item" class="row">

                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="purchase-price">Purchase Price</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.purchase_price" type="text" class="form-control" id="purchase-price" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" v-model="formdata.is_sales_item" value="1" class="custom-control-input" id="is-sales-item">
                                                                <label class="custom-control-label" for="is-sales-item">Is Sales Item?</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div v-show="formdata.is_sales_item" class="row">

                                                        <div class="col-md-3 col-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="sales-price">Sales Price</label>
                                                                <div class="form-control-wrap">
                                                                    <input v-model="formdata.sales_price" type="text" class="form-control" id="sales-price" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 col-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="transfer-price">Transfer Price:</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-4 col-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="mark-up-rate">Markup Rate</label>
                                                                <div class="custom-control custom-radio">    
                                                                    <input v-model="compute_selection" value = "manual" type="radio" id="manual-compute" class="custom-control-input">    
                                                                    <label class="custom-control-label" for="manual-compute">Manual</label>
                                                                </div>  
                                                                <div class="form-control-wrap">
                                                                    <input v-model="input_markup_rate" :disabled="isDisabledManual" type="text" class="form-control" id="mark-up-rate" required>
                                                                    <button @click="computePrice()" :disabled="isDisabledManual" type="button" class="btn btn-lg btn-primary">Apply</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 col-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="customer-group">Customer Group</label>
                                                                <div class="custom-control custom-radio">    
                                                                    <input v-model="compute_selection" value="auto" type="radio" id="auto-compute" class="custom-control-input">    
                                                                    <label class="custom-control-label" for="auto-compute">Auto</label>
                                                                </div>  
                                                                <select class="form-select-customer-group" :disabled="isDisabledAuto" v-model="selected_customer_group" :options="options_customer_group" name="customer-group">
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>

                            </div>   


                            <div class="tab-pane" id="asset" v-show="show_asset_group">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="asset-group">Asset Group</label>
                                        <select class="form-select-asset-group" v-model="selected_asset_group" :options="options_asset_group" name="asset-group">
                                        </select>
                                    </div>
                                </div>   

                            </div> 


                            <div class="tab-pane" id="supplier-discounts">
                                <item-discounts :properties="{data:formdata, view:false}" ref="itemDiscounts"></item-discounts>
                            </div>   
                        </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'
import ItemDiscounts from './item-discounts'

export default {
    name: 'item-list',
    props: ['properties'],
    data: function () {
        return {
            selected_item_group: null,
            options_item_group: [],

            selected_suppliers: [],
            options_supplier: [],

            selected_income_account: null,
            options_income_account: [],

            selected_cost_of_sales: null,
            options_cost_of_sales: [],

            selected_cat_department: null,
            options_cat_department: [],

            selected_cat_section: null,
            options_cat_section: [],

            selected_cat_category: null,
            options_cat_category: [],

            selected_cat_manufacturer: null,
            options_cat_manufacturer: [],

            selected_cat_item_type: null,
            options_cat_item_type: [],

            selected_cat_brand: null,
            options_cat_brand: [],

            selected_cat_form: null,
            options_cat_form: [],

            selected_cat_packing_type: null,
            options_cat_packing_type: [],

            selected_cat_sizes: null,
            options_cat_sizes: [],


            selected_asset_group: null,
            options_asset_group: [],

            selected_customer_group: null,
            options_customer_group: [],

            input_markup_rate: '',
            customer_markup_rate: '',

            
            compute_selection: 'manual',

            show_asset_group: false,
            show_discounts: false,

            show_form: false,

            itemList: [],

            global_uoms: [],
            item_uoms: [],

            formdata: { 
                uuid: null,
                is_draft: 1,
                item_group_uuid: '', 
                item_code: '', 
                item_barcode: '',
                cs_barcode: '',
                item_description: '',
                item_shortname: '',

                without_vat: 1,

                supplier_uuid: '',
                is_purchase_item: 0,
                purchase_price: '',
                is_sales_item: 0,
                sales_price: '',

                manual_rate: '',
                customer_group_uuid: '',
                option_rate: '',

                is_expiry: 0,
                is_maintain_stock: 0,
                is_active: 1,
                coa_income_account_uuid: '',
                coa_cos_account_uuid: '',
                reorder_qty: '',
                item_asset_group_uuid: '',
                cat_department_uuid: '',
                cat_section_uuid: '',
                cat_category_uuid: '',
                cat_manufacturer_uuid: '',
                cat_item_type_uuid: '',
                cat_brand_uuid: '',
                cat_form_uuid: '',
                cat_packing_type_uuid: '',
                cat_sizes_uuid: ''
            }

        }
    },
    computed: {
      isDisabledManual() {
        var scope = this
        if (scope.compute_selection=='manual'){
            return false
        }
        else{
            scope.input_markup_rate = ''
            return true
        }  
      },
      isDisabledAuto() {
        var scope = this
        if (scope.compute_selection=='auto'){
            return false
        }
        else{
            return true
        }  
      },
      globalBaseUOM() {
        return this.global_uoms.filter((uom) => {
            return uom.type.toLowerCase().indexOf("base") > -1;
        })
      },
      globalNonBaseUOM() {
        return this.global_uoms.filter((uom) => {
            return uom.type.toLowerCase().indexOf("pack") > -1;
        })
      }
    },
    components: {
        'item-discounts' : ItemDiscounts
    },
    methods: {

        getItemGroup: function () {
           var scope = this
            scope.GET('items/item-group').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_item_group.push({
                        id: data.uuid,
                        text: data.item_group
                    })
                
                })

                $(".form-select-item-group").select2({data: scope.options_item_group});
                scope.selected_item_group = scope.options_item_group[0].id
                
            })
        },

        getSupplier: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.business_shortname
                    })
                
                })

                $(".form-select-suppliers").select2({data: scope.options_supplier});
            })
        },

        getIncomeAccount: function () {
           var scope = this
            scope.GET('company/chart-of-accounts-income').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_income_account.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                
                })

                $(".form-select-income-account").select2({data: scope.options_income_account});
                scope.selected_income_account = scope.options_income_account[0].id
                
            })
        },

        getCostofSales: function () {
           var scope = this
            scope.GET('company/chart-of-accounts-cost-of-sales').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_cost_of_sales.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                
                })

                $(".form-select-cost-of-sales").select2({data: scope.options_cost_of_sales});
                scope.selected_cost_of_sales = scope.options_cost_of_sales[0].id
            })
        },


        getCatDepartment: function () {
           var scope = this
            scope.GET('items/cat-department').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_department.push({
                        id: data.uuid,
                        text: data.department
                    })
                
                })

                $(".form-select-cat-department").select2({data: scope.options_cat_department});
                scope.selected_cat_department = scope.options_cat_department[0].id
                
            })

        },


        getCatSection: function () {
           var scope = this
            scope.GET('items/cat-section').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_section.push({
                        id: data.uuid,
                        text: data.section
                    })
                
                })

                $(".form-select-cat-section").select2({data: scope.options_cat_section});
                scope.selected_cat_section = scope.options_cat_section[0].id
            })

        },

        getCatCategory: function () {
           var scope = this
            scope.GET('items/cat-category').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_category.push({
                        id: data.uuid,
                        text: data.category
                    })
                
                })

                $(".form-select-cat-category").select2({data: scope.options_cat_category});
                scope.selected_cat_category = scope.options_cat_category[0].id
            })

        },

        getCatManufacturer: function () {
           var scope = this
            scope.GET('items/cat-manufacturer').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_manufacturer.push({
                        id: data.uuid,
                        text: data.manufacturer
                    })
                
                })

                $(".form-select-cat-manufacturer").select2({data: scope.options_cat_manufacturer});
                scope.selected_cat_manufacturer = scope.options_cat_manufacturer[0].id
            })

        },

        getCatItemType: function () {
           var scope = this
            scope.GET('items/cat-item-type').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_item_type.push({
                        id: data.uuid,
                        text: data.item_type
                    })
                
                })

                $(".form-select-cat-item-type").select2({data: scope.options_cat_item_type});
                scope.selected_cat_item_type = scope.options_cat_item_type[0].id
                
            })

        },

        getCatBrand: function () {
           var scope = this
            scope.GET('items/cat-brand').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_brand.push({
                        id: data.uuid,
                        text: data.brand
                    })
                
                })

                $(".form-select-cat-brand").select2({data: scope.options_cat_brand});
                scope.selected_cat_brand = scope.options_cat_brand[0].id
                
            })

        },

        getCatForm: function () {
           var scope = this
            scope.GET('items/cat-form').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_form.push({
                        id: data.uuid,
                        text: data.form
                    })
                
                })

                $(".form-select-cat-form").select2({data: scope.options_cat_form});
                scope.selected_cat_form = scope.options_cat_form[0].id
                
            })

        },

        getCatPackingType: function () {
           var scope = this
            scope.GET('items/cat-packing-type').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_packing_type.push({
                        id: data.uuid,
                        text: data.packing_type
                    })
                
                })

                $(".form-select-cat-packing-type").select2({data: scope.options_cat_packing_type});
                scope.selected_cat_packing_type = scope.options_cat_packing_type[0].id
                
            })

        },

        getCatSizes: function () {
           var scope = this
            scope.GET('items/cat-sizes').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_cat_sizes.push({
                        id: data.uuid,
                        text: data.sizes
                    })
                
                })

                $(".form-select-cat-sizes").select2({data: scope.options_cat_sizes});
                scope.selected_cat_sizes = scope.options_cat_sizes[0].id
                
            })

        },

        getAssetGroup: function () {
           var scope = this
           
           scope.options_asset_group.push({
               id: '',
               text: 'None'
           });

            scope.GET('items/item-asset-group').then(res => {
                
                res.rows.forEach(function (data) {
                    scope.options_asset_group.push({
                        id: data.uuid,
                        text: data.asset_group
                    })
                })

                $(".form-select-asset-group").select2({data: scope.options_asset_group});
            })

        },


        getCustomerGroup: function () {
           var scope = this
            scope.GET('customers/customer-group').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_customer_group.push({
                        id: data.uuid,
                        text: data.group_name + ' with ' + parseFloat(data.markup_rate).toFixed(0) + '%' + ' markup rate',
                        markup_rate: data.markup_rate
                    })
                
                })

                $(".form-select-customer-group").select2({data: scope.options_customer_group});

                $('.form-select-customer-group').val(null);
                $('.form-select-customer-group').trigger('change');
            })
        },

        itemUomExists: function(uuid) {
            var scope = this
            var data = this.item_uoms.filter((uom) => {
                return uom.uuid.indexOf(uuid) > -1;
            })
            
            if (data.length < 1) {
                return false
            }

            return true
        },
        addItemUom: function(uuid) {
            var scope = this
            scope.item_uoms.push({uuid: 'PACK', uom: '', packing: 1});
        },
        removeItemUom: function(index) {
            var scope = this
            scope.item_uoms.splice(index,1)
        },

        getGlobalUoms: function () {
           var scope = this
            scope.GET('globals/uom').then(res => {
                scope.global_uoms = res.rows 
            })
        },

        getItemUoms: function () {
           var scope = this
             scope.item_uoms = [];
            if (!scope.formdata.uuid) {
                scope.item_uoms.push({uuid: 'BASE', uom: '', packing: 1});
                return
            }
            
            scope.GET('items/'+ scope.formdata.uuid +'/uoms').then(res => {
                // we use global UOM UUID as uuid instead
                res.rows.forEach(function (data) {
                    scope.item_uoms.push({uuid: data.global_uom_uuid, uom: data.global_uom_uuid, packing: data.packing_qtty})
                })
            })
        },


        getGlobalUOMName: function (uuid) {
            var data = this.global_uoms.filter((uom) => {
                return uom.uuid.indexOf(uuid) > -1;
            })
            
            if (data.length < 1) {
                return ''
            }

            return data[0].uom
        },

        checkAsset: function () {
           var scope = this
           for (var i = 0; i < scope.options_item_group.length; i++) {
                if(scope.options_item_group[i].id==scope.selected_item_group){
                    if (scope.options_item_group[i].text === 'Asset'){
                        scope.show_asset_group = true
                    }
                    else{
                        scope.show_asset_group = false
                        scope.selected_asset_group = ''
                        $('.form-select-asset-group').val(null);
                        $('.form-select-asset-group').trigger('change');
                    }

                }
            }
        },

        save: function () {
            var scope = this
            scope.formdata.item_group_uuid = scope.selected_item_group
            scope.formdata.supplier_uuids = scope.selected_suppliers
            scope.formdata.coa_income_account_uuid = scope.selected_income_account
            scope.formdata.coa_cos_account_uuid = scope.selected_cost_of_sales
            scope.formdata.item_asset_group_uuid = scope.selected_asset_group

            scope.formdata.cat_department_uuid = scope.selected_cat_department
            scope.formdata.cat_section_uuid = scope.selected_cat_section
            scope.formdata.cat_category_uuid = scope.selected_cat_category
            scope.formdata.cat_manufacturer_uuid = scope.selected_cat_manufacturer
            scope.formdata.cat_item_type_uuid = scope.selected_cat_item_type
            scope.formdata.cat_brand_uuid = scope.selected_cat_brand
            scope.formdata.cat_form_uuid = scope.selected_cat_form
            scope.formdata.cat_packing_type_uuid = scope.selected_cat_packing_type
            scope.formdata.cat_sizes_uuid = scope.selected_cat_sizes

            scope.formdata.item_uoms = scope.item_uoms


            scope.PUT('items/item-list', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Item Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.ROUTE({path: '/item-main/'})
                        scope.tempItemUOMs = []
                        scope.formdata.uoms = []
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.formdata.item_group_uuid = scope.selected_item_group
            scope.formdata.supplier_uuids = scope.selected_suppliers
            scope.formdata.coa_income_account_uuid = scope.selected_income_account
            scope.formdata.coa_cos_account_uuid = scope.selected_cost_of_sales
            scope.formdata.item_asset_group_uuid = scope.selected_asset_group

            scope.formdata.cat_department_uuid = scope.selected_cat_department
            scope.formdata.cat_section_uuid = scope.selected_cat_section
            scope.formdata.cat_category_uuid = scope.selected_cat_category
            scope.formdata.cat_manufacturer_uuid = scope.selected_cat_manufacturer
            scope.formdata.cat_item_type_uuid = scope.selected_cat_item_type
            scope.formdata.cat_brand_uuid = scope.selected_cat_brand
            scope.formdata.cat_form_uuid = scope.selected_cat_form
            scope.formdata.cat_packing_type_uuid = scope.selected_cat_packing_type
            scope.formdata.cat_sizes_uuid = scope.selected_cat_sizes

            scope.formdata.item_uoms = scope.item_uoms

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
                    scope.PUT('items/item-list', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Item Successfuly Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.ROUTE({path: '/item-main/'})
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
            
        },
        remove: function (data) {
            var scope = this

            window.swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.DELETE('items/item-list/' + data.uuid).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Item Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {

                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        },
        computePrice: function () {
            var scope = this
            scope.formdata.sales_price = (scope.input_markup_rate/100) * scope.formdata.purchase_price
        },
        setSupplierIDs: function (supplier_ids) {
            this.$refs.itemDiscounts.getSupplierDiscounts(supplier_ids);
        },
        getItemDetails: function (itemUUID) {
            var scope = this
            scope.GET('items/item-list/' + itemUUID).then(res => {
                let data = res.data

                scope.formdata.uuid = itemUUID

                if (data.is_draft=== 0) {

                    scope.formdata.is_draft = data.is_draft
                    scope.formdata.item_code = data.item_code
                    scope.formdata.item_barcode = data.item_barcode
                    scope.formdata.cs_barcode = data.cs_barcode
                    scope.formdata.item_description = data.item_description
                    scope.formdata.item_shortname = data.item_shortname
                    scope.formdata.is_purchase_item = data.is_purchase_item

                    scope.formdata.without_vat = data.without_vat

                    scope.formdata.purchase_price = data.purchase_price
                    scope.formdata.is_sales_item = data.is_sales_item

                    scope.formdata.sales_price = data.sales_price
                    scope.formdata.is_expiry = data.is_expiry
                    scope.formdata.reorder_qty = data.reorder_qty

                    scope.formdata.is_maintain_stock = data.is_maintain_stock
                    scope.formdata.is_active = data.is_active

                    scope.getItemUoms()

                    var suppliers = [];
                    

                    for(var i = 0; i < data.suppliers.length; i++) {
                        suppliers.push(data.suppliers[i].supplier_uuid)
                    }
                    

                    $('.form-select-item-group').val(data.item_group_uuid);
                    $('.form-select-item-group').trigger('change');

                    $('.form-select-suppliers').val(suppliers);
                    $('.form-select-suppliers').trigger('change');

                    $('.form-select-income-account').val(data.coa_income_account_uuid);
                    $('.form-select-income-account').trigger('change');
                    
                    $('.form-select-cost-of-sales').val(data.coa_cos_account_uuid);
                    $('.form-select-cost-of-sales').trigger('change');

                    $('.form-select-cat-department').val(data.cat_department_uuid);
                    $('.form-select-cat-department').trigger('change');

                    $('.form-select-cat-section').val(data.cat_section_uuid);
                    $('.form-select-cat-section').trigger('change');

                    $('.form-select-cat-category').val(data.cat_category_uuid);
                    $('.form-select-cat-category').trigger('change');

                    $('.form-select-cat-manufacturer').val(data.cat_manufacturer_uuid);
                    $('.form-select-cat-manufacturer').trigger('change');

                    $('.form-select-cat-item-type').val(data.cat_item_type_uuid);
                    $('.form-select-cat-item-type').trigger('change');

                    $('.form-select-cat-brand').val(data.cat_brand_uuid);
                    $('.form-select-cat-brand').trigger('change');

                    $('.form-select-cat-form').val(data.cat_form_uuid);
                    $('.form-select-cat-form').trigger('change');

                    $('.form-select-cat-packing-type').val(data.cat_packing_type_uuid);
                    $('.form-select-cat-packing-type').trigger('change');

                     $('.form-select-cat-sizes').val(data.cat_sizes_uuid);
                    $('.form-select-cat-sizes').trigger('change');

                    $('.form-select-asset-group').val(data.item_asset_group_uuid);
                    $('.form-select-asset-group').trigger('change');

                }
                
            })
        }
    },
    mounted() {
        var scope = this

        scope.getItemGroup()
        scope.getSupplier()
        scope.getIncomeAccount()
        scope.getCostofSales()

        scope.getCatDepartment()
        scope.getCatSection()
        scope.getCatCategory()
        scope.getCatManufacturer()
        scope.getCatItemType()
        scope.getCatBrand()
        scope.getCatForm()
        scope.getCatPackingType()
        scope.getCatSizes()

        scope.getAssetGroup()

        scope.getGlobalUoms()
        
        scope.getCustomerGroup()


        var itemUUID = scope.$route.params.itemUUID
        scope.getItemDetails(itemUUID)

        $('.form-select-item-group').on("change", function(e) { 
            scope.selected_item_group = $('.form-select-item-group').val();
            scope.checkAsset()
        })

        $('.form-select-suppliers').on("change", function(e) { 
            scope.selected_suppliers = $('.form-select-suppliers').val();
            scope.setSupplierIDs(scope.selected_suppliers)
        })

        $('.form-select-income-account').on("change", function(e) { 
            scope.selected_income_account = $('.form-select-income-account').val();
        })

        $('.form-select-cost-of-sales').on("change", function(e) { 
            scope.selected_cost_of_sales = $('.form-select-cost-of-sales').val();
        })

        $('.form-select-cat-department').on("change", function(e) { 
            scope.selected_cat_department = $('.form-select-cat-department').val();
        })

        $('.form-select-cat-section').on("change", function(e) { 
            scope.selected_cat_section = $('.form-select-cat-section').val();
        })

        $('.form-select-cat-category').on("change", function(e) { 
            scope.selected_cat_category = $('.form-select-cat-category').val();
        })

        $('.form-select-cat-manufacturer').on("change", function(e) { 
            scope.selected_cat_manufacturer = $('.form-select-cat-manufacturer').val();
        })

        $('.form-select-cat-item-type').on("change", function(e) { 
            scope.selected_cat_item_type = $('.form-select-cat-item-type').val();
        })

        $('.form-select-cat-brand').on("change", function(e) { 
            scope.selected_cat_brand = $('.form-select-cat-brand').val();
        })

        $('.form-select-cat-form').on("change", function(e) { 
            scope.selected_cat_form = $('.form-select-cat-form').val();
        })

        $('.form-select-cat-packing-type').on("change", function(e) { 
            scope.selected_cat_packing_type = $('.form-select-cat-packing-type').val();
        })

        $('.form-select-cat-sizes').on("change", function(e) { 
            scope.selected_cat_sizes = $('.form-select-cat-sizes').val();
        })

        $('.form-select-asset-group').on("change", function(e) { 
            scope.selected_asset_group = $('.form-select-asset-group').val();
        })


        $('.form-select-customer-group').on("change", function(e) { 
            scope.selected_customer_group = $('.form-select-customer-group').val();

            for (var i = 0; i < scope.options_customer_group.length; i++) {
                if(scope.options_customer_group[i].id==scope.selected_customer_group){
                    scope.customer_markup_rate = scope.options_customer_group[i].markup_rate
                    scope.formdata.sales_price = (scope.customer_markup_rate/100) * scope.formdata.purchase_price
                }
            }

        })
    },
}
</script>

<style scoped>
.form-group { margin-top:10px !important; }
</style>