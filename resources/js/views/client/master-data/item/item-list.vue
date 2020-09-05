<template>
    <div>
        
        <div v-show="!show_form">
            <div class="actions-bar">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <input type="text" class="form-control" placeholder="Search Item">
                    </div>
                    <div class="col-12 col-md-2 offset-md-7">
                        <a href="javascript:void(0)" @click="toggleForm();resetData()" class="btn btn-block btn-primary" style="display: inline-block; padding-left: 15px; padding-right: 15px; width: auto; float: right;" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Item</span>
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-striped table-bordered responsiveTable">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th data-priority="1">#</th>
                                <th data-priority="3">Item Description</th>
                                <th data-priority="1">Item Code</th>
                                <th data-priority="3">Item Barcode</th>
                                <th data-priority="3">Case/Box Barcode</th>
                                <th data-priority="6">Item Group</th>
                                <th data-priority="6">Re-order Qty / ICO</th>
                                <th data-priority="6">Supplier</th>
                                <th data-priority="6">Is Expiry?</th>
                                <th data-priority="6">Purchase Cost</th>
                                <th data-priority="6">Sales Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in itemList" :key="item.uuid">
                                <td>
                                    <a href="javascript:void(0)"  @click="setData(item); toggleForm() " class="btn btn-light btn-sm waves-effect"><i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(item)" class="btn btn-sm btn-danger waves-effect"><i class="mdi mdi-trash-can"></i></a>
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">#</div>
                                {{ (index + 1) }}
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Item Description</div>
                                    {{ item.item_description }}
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Item Code</div>
                                    {{ item.item_code }}
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Item Barcode</div>
                                    {{ item.item_barcode }}
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Case/Box Barcode</div>
                                    {{ item.cs_barcode }}
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Item Group</div>
                                    {{ item.item_group.item_group }}
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Re-order Qtyy / ICO</div>
                                    {{ item.reorder_qty }}
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Supplier</div>
                                    <span v-if="item.suppliers.length > 0">
                                        <span v-for="item_supplier in item.suppliers" :key="item_supplier.uuid">
                                            <span  class="badge badge-dim badge-outline-secondary">{{ item_supplier.supplier.business_shortname }}</span> &nbsp;
                                        </span>
                                    </span>
                                    <span v-else>
                                        NOT SPECIFIED
                                    </span>
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Is Expiry?</div>
                                    <span v-if="item.is_expiry === 1">Yes</span>
                                    <span v-else>No</span>
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Purchase Cost</div>
                                    {{ item.purchase_price }}
                                </td>
                                <td class=" pivoted">
                                    <div class="tdBefore">Sales Cost</div>
                                    {{ item.sales_price }}
                                </td>
                                
                            </tr>
                            
                        </tbody>
                    </table>         
                </div>         
            </div>
           
        </div>  

        <div v-show="show_form">
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
                            <a v-if="formdata.uuid === null" class="nav-link disabled" data-toggle="tab" href="#pricing">Pricing</a> 
                            <a v-else class="nav-link" data-toggle="tab" href="#pricing">Pricing</a>           
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#asset">Asset</a>    
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
                        </div>

                        <div class="tab-pane" id="category">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category-1">Category 1</label>
                                    <select class="form-select-category-1" v-model="selected_category1" :options="options_category1" name="category-1">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category-2">Category 2</label>
                                    <select class="form-select-category-2" v-model="selected_category2" :options="options_category2" name="category-2">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category-3">Category 3</label>
                                    <select class="form-select-category-3" v-model="selected_category3" :options="options_category3" name="category-3">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category-4">Category 4</label>
                                    <select class="form-select-category-4" v-model="selected_category4" :options="options_category4" name="category-4">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="category-5">Category 5</label>
                                    <select class="form-select-category-5" v-model="selected_category5" :options="options_category5" name="category-5">
                                    </select>
                                </div>
                            </div>        
      
                        </div>

                        <div class="tab-pane" id="unit-of-measure">
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="base-uom">Base UOM</label>
                                        <select class="form-select-base-uom" v-model="selected_base_uom" :options="options_base_uom" name="base-uom">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="packing-uom">Packing UOM</label>
                                        <select class="form-select-packing-uom" v-model="selected_packing_uom" :options="options_packing_uom" name="packing-uom">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="packing-qtty">Packing Qtty</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.packing_qtty" type="text" class="form-control" id="packing-qtty" required>
                                        </div>
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
                                                            <label class="form-label" for="transfer-price">Transfer Price</label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="formdata.transfer_price" type="text" class="form-control" id="transfer-price" required>
                                                            </div>
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


                        <div class="tab-pane" id="asset">
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="asset-group">Asset Group</label>
                                    <select class="form-select-asset-group" v-model="selected_asset_group" :options="options_asset_group" name="asset-group">
                                    </select>
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

            selected_vat: null,
            options_vat: [],

            selected_category1: null,
            options_category1: [],

            selected_category2: null,
            options_category2: [],

            selected_category3: null,
            options_category3: [],

            selected_category4: null,
            options_category4: [],

            selected_category5: null,
            options_category5: [],

            selected_asset_group: null,
            options_asset_group: [],

            selected_customer_group: null,
            options_customer_group: [],

            selected_base_uom: null,
            options_base_uom: [],

            selected_packing_uom: null,
            options_packing_uom: [],    

            input_markup_rate: '',
            customer_markup_rate: '',

            is_vat: 0,
            compute_selection: 'manual',

            show_form: false,

            itemList: [],

            formdata: { 
                uuid: null, 
                item_group_uuid: '', 
                item_code: '', 
                item_barcode: '',
                cs_barcode: '',
                item_description: '',
                item_shortname: '',

                base_uom_uuid: '',
                packing_uom_uuid: '',
                packing_qtty: '',

                supplier_uuid: '',
                is_purchase_item: 0,
                purchase_price: '',
                is_sales_item: 0,
                sales_price: '',

                transfer_price: '',

                manual_rate: '',
                customer_group_uuid: '',
                option_rate: '',

                is_expiry: 0,
                vat_uuid: '',
                is_maintain_stock: 0,
                is_active: 0,
                coa_income_account_uuid: '',
                coa_cos_account_uuid: '',
                reorder_qty: '',
                item_asset_group_uuid: '',
                category1_uuid: '',
                category2_uuid: '',
                category3_uuid: '',
                category4_uuid: '',
                category5_uuid: ''
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
      }
    },

    methods: {
        toggleForm() {
            var scope = this
            scope.show_form = !scope.show_form
        },
        getItemList: function () {
           var scope = this
            scope.GET('items/item-list').then(res => {
                scope.itemList = res.rows
            })
        },

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
                
            })
        },

        getCategory1: function () {
           var scope = this
            scope.GET('items/category1').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_category1.push({
                        id: data.uuid,
                        text: data.category1
                    })
                
                })

                $(".form-select-category-1").select2({data: scope.options_category1});
                scope.selected_category1 = scope.options_category1[0].id
                
            })

        },


        getCategory2: function () {
           var scope = this
            scope.GET('items/category2').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_category2.push({
                        id: data.uuid,
                        text: data.category2
                    })
                
                })

                $(".form-select-category-2").select2({data: scope.options_category2});
                scope.selected_category2 = scope.options_category2[0].id
            })

        },

        getCategory3: function () {
           var scope = this
            scope.GET('items/category3').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_category3.push({
                        id: data.uuid,
                        text: data.category3
                    })
                
                })

                $(".form-select-category-3").select2({data: scope.options_category3});
                scope.selected_category3 = scope.options_category3[0].id
            })

        },

        getCategory4: function () {
           var scope = this
            scope.GET('items/category4').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_category4.push({
                        id: data.uuid,
                        text: data.category4
                    })
                
                })

                $(".form-select-category-4").select2({data: scope.options_category4});
                scope.selected_category4 = scope.options_category4[0].id
            })

        },

        getCategory5: function () {
           var scope = this
            scope.GET('items/category5').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_category5.push({
                        id: data.uuid,
                        text: data.category5
                    })
                
                })

                $(".form-select-category-5").select2({data: scope.options_category5});
                scope.selected_category5 = scope.options_category5[0].id
                
            })

        },

        getAssetGroup: function () {
           var scope = this
           
           scope.options_asset_group.push({
               id: '',
               text: 'NONE'
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

        getBaseUom: function () {
           var scope = this
            scope.GET('globals/base-uom').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_base_uom.push({
                        id: data.uuid,
                        text: data.uom
                    })
                
                })

                $(".form-select-base-uom").select2({data: scope.options_base_uom});
                scope.selected_base_uom = scope.options_base_uom[0].id
                
            })

        },

        getPackingUom: function () {
           var scope = this
            scope.GET('globals/packing-uom').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_packing_uom.push({
                        id: data.uuid,
                        text: data.uom
                    })
                })

                $(".form-select-packing-uom").select2({data: scope.options_packing_uom});
                scope.selected_packing_uom = scope.options_packing_uom[0].id
                
            })

        },

        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.item_group_uuid = ''
            scope.formdata.item_code = ''
            scope.formdata.item_barcode = ''
            scope.formdata.cs_barcode = ''
            scope.formdata.item_description = ''
            scope.formdata.item_shortname = ''

            scope.formdata.base_uom_uuid = ''
            scope.formdata.packing_uom_uuid =  ''
            scope.formdata.packing_qtty = ''

            scope.formdata.supplier_uuid = ''
            scope.formdata.is_purchase_item = 0
            scope.formdata.purchase_price = ''
            scope.formdata.is_sales_item = 0
            scope.formdata.sales_price = ''
            scope.formdata.transfer_price = ''

            scope.formdata.manual_rate = ''
            scope.formdata.customer_group_uuid = ''
            scope.formdata.option_rate = ''

            scope.formdata.is_expiry = 0
            scope.formdata.vat_uuid = ''
            scope.formdata.is_maintain_stock = 0
            scope.formdata.is_active = 0
            scope.formdata.coa_income_account_uuid = ''
            scope.formdata.coa_cos_account_uuid = ''
            scope.formdata.reorder_qty = ''
            scope.formdata.item_asset_group_uuid = ''
            scope.formdata.category1_uuid = ''
            scope.formdata.category2_uuid = ''
            scope.formdata.category3_uuid = ''
            scope.formdata.category4_uuid = ''
            scope.formdata.category5_uuid = ''

            scope.input_markup_rate = ''
            scope.customer_markup_rate = ''

            scope.is_vat = 0
            
            scope.compute_selection = 'manual'

        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.item_code = data.item_code
            scope.formdata.item_barcode = data.item_barcode
            scope.formdata.cs_barcode = data.cs_barcode
            scope.formdata.item_description = data.item_description
            scope.formdata.item_shortname = data.item_shortname
            scope.formdata.is_purchase_item = data.is_purchase_item

            scope.formdata.purchase_price = data.purchase_price
            scope.formdata.is_sales_item = data.is_sales_item

            scope.formdata.sales_price = data.sales_price
            scope.formdata.transfer_price = data.transfer_price
            scope.formdata.is_expiry = data.is_expiry
            scope.formdata.reorder_qty = data.reorder_qty

            scope.formdata.is_maintain_stock = data.is_maintain_stock
            scope.formdata.is_active = data.is_active


            var suppliers = [];

            if (data.vat_uuid!=null){
                scope.is_vat = 1
            }else{
                scope.is_vat = 0
            }
            

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

            $('.form-select-vat').val(data.vat_uuid);
            $('.form-select-vat').trigger('change');

            $('.form-select-category-1').val(data.category1_uuid);
            $('.form-select-category-1').trigger('change');

            $('.form-select-category-2').val(data.category2_uuid);
            $('.form-select-category-2').trigger('change');

            $('.form-select-category-3').val(data.category3_uuid);
            $('.form-select-category-3').trigger('change');

            $('.form-select-category-4').val(data.category4_uuid);
            $('.form-select-category-4').trigger('change');

            $('.form-select-category-5').val(data.category5_uuid);
            $('.form-select-category-5').trigger('change');

            $('.form-select-asset-group').val(data.item_asset_group_uuid);
            $('.form-select-asset-group').trigger('change');

            $('.form-select-base-uom').val(data.base_uom_uuid);
            $('.form-select-base-uom').trigger('change');

            $('.form-select-packing-uom').val(data.packing_uom_uuid);
            $('.form-select-packing-uom').trigger('change');


        },
        save: function () {
            var scope = this
            scope.formdata.item_group_uuid = scope.selected_item_group
            scope.formdata.supplier_uuids = scope.selected_suppliers
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.coa_income_account_uuid = scope.selected_income_account
            scope.formdata.coa_cos_account_uuid = scope.selected_cost_of_sales
            scope.formdata.item_asset_group_uuid = scope.selected_asset_group

            scope.formdata.category1_uuid = scope.selected_category1
            scope.formdata.category2_uuid = scope.selected_category2
            scope.formdata.category3_uuid = scope.selected_category3
            scope.formdata.category4_uuid = scope.selected_category4
            scope.formdata.category5_uuid = scope.selected_category5

            scope.formdata.base_uom_uuid = scope.selected_base_uom
            scope.formdata.packing_uom_uuid = scope.selected_packing_uom


            scope.POST('items/item-list', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Item Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getItemList()
                        scope.toggleForm()
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
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.coa_income_account_uuid = scope.selected_income_account
            scope.formdata.coa_cos_account_uuid = scope.selected_cost_of_sales
            scope.formdata.item_asset_group_uuid = scope.selected_asset_group

            scope.formdata.category1_uuid = scope.selected_category1
            scope.formdata.category2_uuid = scope.selected_category2
            scope.formdata.category3_uuid = scope.selected_category3
            scope.formdata.category4_uuid = scope.selected_category4
            scope.formdata.category5_uuid = scope.selected_category5

            scope.formdata.base_uom_uuid = scope.selected_base_uom
            scope.formdata.packing_uom_uuid = scope.selected_packing_uom

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
                    scope.POST('items/item-list', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Item Successfuly Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getItemList()
                                scope.toggleForm()
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
                            scope.getItemList()
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
        }
    },
    mounted() {
        var scope = this
        scope.getItemList()

        scope.getItemGroup()
        scope.getSupplier()
        scope.getIncomeAccount()
        scope.getCostofSales()
        scope.getVat()
        scope.getCategory1()
        scope.getCategory2()
        scope.getCategory3()
        scope.getCategory4()
        scope.getCategory5()
        scope.getAssetGroup()

        scope.getBaseUom()
        scope.getPackingUom()

        scope.getCustomerGroup()


        $('.form-select-base-uom').on("change", function(e) { 
            scope.selected_base_uom = $('.form-select-base-uom').val();
        })

        $('.form-select-packing-uom').on("change", function(e) { 
            scope.selected_packing_uom = $('.form-select-packing-uom').val();
        })

        $('.form-select-item-group').on("change", function(e) { 
            scope.selected_item_group = $('.form-select-item-group').val();
        })

        $('.form-select-suppliers').on("change", function(e) { 
            scope.selected_suppliers = $('.form-select-suppliers').val();
        })

        $('.form-select-income-account').on("change", function(e) { 
            scope.selected_income_account = $('.form-select-income-account').val();
        })

        $('.form-select-cost-of-sales').on("change", function(e) { 
            scope.selected_cost_of_sales = $('.form-select-cost-of-sales').val();
        })

        $('.form-select-vat').on("change", function(e) { 
            scope.selected_vat = $('.form-select-vat').val();
        })

        $('.form-select-category-1').on("change", function(e) { 
            scope.selected_category1 = $('.form-select-category-1').val();
        })

        $('.form-select-category-2').on("change", function(e) { 
            scope.selected_category2 = $('.form-select-category-2').val();
        })

        $('.form-select-category-3').on("change", function(e) { 
            scope.selected_category3 = $('.form-select-category-3').val();
        })

        $('.form-select-category-4').on("change", function(e) { 
            scope.selected_category4 = $('.form-select-category-4').val();
        })

        $('.form-select-category-5').on("change", function(e) { 
            scope.selected_category5 = $('.form-select-category-5').val();
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