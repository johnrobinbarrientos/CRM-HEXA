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
                            <h1 class="title">View Item Details</h1>
                        </span>
                        <span v-else>
                            <span v-if ="formdata.is_draft">
                                <h1 class="title">New Item Details</h1>
                            </span>
                            <span v-else>
                                <h1 class="title">Edit Item Details</h1>
                            </span>
                        </span>
                    </div>
                    <div class="bar-right">
                        <span v-if ="view_mode">
                            <a @click="ROUTE({path: '/item-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Close</a>
                            <a @click="ROUTE({path: '/items/' + formdata.uuid })" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Edit</a>
                        </span>
                        <span v-else>
                            <a @click="ROUTE({path: '/item-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Cancel</a>
                            <a v-if="formdata.is_draft" @click="save()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Save</a>
                            <a v-else @click="update()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Update</a>
                        </span>
                    </div>
                </div>

                <form action="#" class="form-validate is-alter">

                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-group">Item Group</label>
                                <select class="form-select-item-group" v-model="selected_item_group" :options="options_item_group" name="item-group" :disabled="view_mode">
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-code">Item Code</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.item_code" type="text" class="form-control" id="item-code" :readonly="view_mode">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-barcode">Item Barcode</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.item_barcode" type="text" class="form-control" id="item-barcode" :readonly="view_mode">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="base-uom">Base UOM</label>
                                <select class="form-select-base-uom" v-model="selected_base_uom" :options="options_base_uom" name="base-uom" :disabled="view_mode">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-description">Item Description</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.item_description" type="text" class="form-control" id="item-description" :readonly="view_mode">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-shortname">Shortname</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.item_shortname" type="text" class="form-control" id="item-shortname" :readonly="view_mode">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="supplier">Supplier Name</label>
                                <select class="form-select-suppliers" v-model="selected_suppliers" :options="options_supplier" name="supplier"  multiple="multiple" :disabled="view_mode">
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="reorder-qty">ICO</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.reorder_qty" type="text" class="form-control" id="reorder-qty" :readonly="view_mode">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_expiry" value="1" class="custom-control-input" id="is-expiry" :disabled="view_mode">
                                        <label class="custom-control-label" for="is-expiry">Is Expiry?</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_maintain_stock" value="1" class="custom-control-input" id="is-maintain-stock" :disabled="view_mode">
                                        <label class="custom-control-label" for="is-maintain-stock">Is Maintain Stock?</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="formdata.is_active" value="1" class="custom-control-input" id="is-active" :disabled="view_mode">
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
                                <a class="" data-toggle="tab" href="#supplier-discounts">Discount</a>    
                            </li>  
                            <li v-show="show_asset_group">        
                                <a class="" data-toggle="tab" href="#asset">Asset</a>    
                            </li> 
                            <li> 
                                <a class="" data-toggle="tab" href="#pricing">Pricing</a>           
                            </li>
                            <li>
                                <a class="" data-toggle="tab" href="#unit-of-measure">Unit of Measure</a>    
                            </li>
                            <li>
                                <a class="" data-toggle="tab" href="#category">Category</a>    
                            </li>
                            <li>
                                <a class="active" data-toggle="tab" href="#account">Financial Account</a>    
                            </li>    
                        </ul>
                        <div class="clearfix"></div>
                        <div class="tab-content">    
                            <div class="tab-pane active" id="account">
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="income-account">Income Account</label>
                                                <select class="form-select-income-account" v-model="selected_income_account" :options="options_income_account" name="income-account" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cost-of-sales">Cost Of Sales</label>
                                                <select class="form-select-cost-of-sales" v-model="selected_cost_of_sales" :options="options_cost_of_sales" name="cost-of-sales" :disabled="view_mode">
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

                            <div class="tab-pane" id="category">
                                    <div class="row">

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-department">Department</label>
                                                <select class="form-select-cat-department" v-model="selected_cat_department" :options="options_cat_department" name="cat-department" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-manufacturer">Manufacturer</label>
                                                <select class="form-select-cat-manufacturer" v-model="selected_cat_manufacturer" :options="options_cat_manufacturer" name="cat-manufacturer" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-form">Form</label>
                                                <select class="form-select-cat-form" v-model="selected_cat_form" :options="options_cat_form" name="cat-form" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-section">Section</label>
                                                <select class="form-select-cat-section" v-model="selected_cat_section" :options="options_cat_section" name="cat-section" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-item-type">Item Type</label>
                                                <select class="form-select-cat-item-type" v-model="selected_cat_item_type" :options="options_cat_item_type" name="cat-item-type" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-packing-type">Packing Type</label>
                                                <select class="form-select-cat-packing-type" v-model="selected_cat_packing_type" :options="options_cat_packing_type" name="cat-packing-type" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-category">Category</label>
                                                <select class="form-select-cat-category" v-model="selected_cat_category" :options="options_cat_category" name="cat-category" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-brand">Brand</label>
                                                <select class="form-select-cat-brand" v-model="selected_cat_brand" :options="options_cat_brand" name="cat-brand" :disabled="view_mode">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-size">Size</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="formdata.cat_size" type="text" class="form-control" id="cat-size" :readonly="view_mode">
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                            </div>

                            <div class="tab-pane" id="unit-of-measure">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>UOM</th>
                                                            <th width="100">Barcode</th>
                                                            <th width="100">Packing</th>
                                                            <th>Sales Description</th>
                                                            <th>Remarks</th>
                                                            <th width="50">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(item_uom, index) in item_uoms" :key="item_uom.uuid + '-' + index">
                                                            <td class="editable">
                                                                <span>{{ getGlobalUOMName(item_uom.uuid) }}</span>
                                                                <select v-model="item_uom.uuid" class="editable-control" :disabled="view_mode">
                                                                    <option v-for="(uom,index_uom) in globalUOMs" :key="'base-' + uom.uuid + '-' + index_uom" :value="uom.uuid">{{ uom.uom}}</option>
                                                                </select>
                                                            </td>

                                                            <td class="editable text-right">
                                                                <input v-model="item_uom.barcode" type="text" class="editable-control" :readonly="view_mode">
                                                                <span>{{ item_uom.barcode }}</span>
                                                            </td>
                                                            <td class="editable text-right">
                                                                <input v-model="item_uom.packing" type="text" class="editable-control" :readonly="view_mode">
                                                                <span>{{ item_uom.packing }}</span>
                                                            </td>
                                                            <td class="editable text-right">
                                                                <input v-model="item_uom.sales_description" type="text" class="editable-control" :readonly="view_mode">
                                                                <span>{{ item_uom.sales_description }}</span>
                                                            </td>
                                                            <td class="editable text-right">
                                                                <input v-model="item_uom.remarks" type="text" class="editable-control" :readonly="view_mode">
                                                                <span>{{ item_uom.remarks }}</span>
                                                            </td>
                                                    

                                                            <td>
                                                                <button @click="removeItemUom(index)" type="button" class="btn btn-sm btn-danger waves-effect" :disabled="view_mode"><i class="mdi mdi-trash-can"></i></button>
                                                            </td>
                                                        
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center; cursor:pointer; font-weight:600; border-color: var(--shine-blue) !important;" colspan="6" class="p-0">
                                                                <button @click="addItemUom()" type="button" style="font-weight:600; border:none; width: 100%; padding: 6px;" class="hx-btn-shineblue" :disabled="view_mode"><i class="las la-plus"></i> New UOM</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                            </div>   

                            <div class="tab-pane" id="pricing" style="padding: 0 15px 15px;"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="d-flex">
                                            <div>
                                                <div class="form-group" style="height: 100%; margin: 0 !important; display: flex; align-items: center;">
                                                    <div class="form-control-wrap">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" v-model="formdata.is_purchase_item" value="1" class="custom-control-input" id="is-purchase-item" :disabled="view_mode">
                                                            <label class="custom-control-label" for="is-purchase-item">Is Purchase Item?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-show="formdata.is_purchase_item">
                                                <div class="d-flex">
                                                    <div class="d-flex align-items-center ml-3 mr-3">
                                                        <i class="fas fa-long-arrow-alt-right" style="font-size: 24px; color: var(--warning);"></i>
                                                    </div>
                                                    <div class="form-group" style="display: flex; align-items: center; margin:0 !important;">
                                                        <label class="form-label m-0 mr-2" for="purchase-price">Price <small style="color: red; font-style: italic">(*required):</small></label>
                                                        <div class="form-control-wrap">
                                                            <input v-model="formdata.purchase_price" type="text" class="form-control" id="purchase-price" :readonly="view_mode" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div v-show="formdata.is_purchase_item">
                                            <hr>
                                            <div class="d-flex">
                                                <div class="form-group" style="display: flex; align-items: center; margin: 0 !important;">
                                                    <div class="form-control-wrap">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" v-model="formdata.is_sales_item" value="1" class="custom-control-input" id="is-sales-item" :disabled="view_mode">
                                                            <label class="custom-control-label" for="is-sales-item">Is Sales Item?</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div v-show="formdata.is_sales_item">
                                                    <div class="d-flex">
                                                        <div class="d-flex align-items-center ml-3 mr-3">
                                                            <i class="fas fa-long-arrow-alt-right" style="font-size: 24px; color: var(--warning);"></i>
                                                        </div>
                                                        <div class="form-group" style="display: flex; align-items: center; margin: 0 !important;">
                                                            <label class="form-label m-0 mr-2" for="sales-price">Sales Price <small style="color: #999; font-style: italic">(optional)</small>:</label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="formdata.sales_price" type="text" class="form-control" id="sales-price" :readonly="view_mode">
                                                            </div>
                                                        </div>
                                                   
                                                        <div class="form-group pl-3" style="margin: 0 !important; display: flex; align-items: center;">
                                                            <label class="form-label m-0 mr-2" for="transfer-price">Transfer Price:</label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="formdata.sales_price" type="text" class="form-control" id="transfer-price" readonly="disabled">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>    


                            <div class="tab-pane" id="asset" v-show="show_asset_group">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="asset-group">Asset Group</label>
                                        <select class="form-select-asset-group" v-model="selected_asset_group" :options="options_asset_group" name="asset-group" :disabled="view_mode">
                                        </select>
                                    </div>
                                </div>   

                            </div> 


                            <div class="tab-pane" id="supplier-discounts">
                                <discounts v-if="ready" :properties="{data:formdata}" :view_mode="view_mode" ref="itemDiscounts"></discounts>
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

export default {
    name: 'item-list',
    props: ['properties','view_mode'],
    data: function () {
        return {
            prerequiste: {
                getItemGroup: false,
                getSupplier: false,
                getIncomeAccount: false,
                getCostofSales: false,
                getCatDepartment: false,
                getCatSection: false,
                getCatCategory: false,
                getCatManufacturer: false,
                getCatItemType: false,
                getCatBrand: false,
                getCatForm: false,
                getCatPackingType: false,
                getAssetGroup: false,
                getGlobalUoms: false,
                getGlobalBaseUOM: false,
                getAssetGroup: false,
                getTaxationItem:false,
                
            },

            selected_vat: null,
            options_vat: [],

            is_vat: 0,

            reference_vat_uuid: '',

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

            selected_asset_group: null,
            options_asset_group: [],


            selected_base_uom: null,
            options_base_uom: [],

            
            compute_selection: 'manual',

            show_asset_group: false,
            show_discounts: false,

            show_form: false,

            itemList: [],

            global_uoms: [],
            item_uoms: [],

            transfer_price: '',

            formdata: { 
                uuid: null,
                is_draft: 1,
                item_group_uuid: '', 
                item_code: '', 
                item_barcode: '',
                global_base_uom_uuid: '',
                item_description: '',
                item_shortname: '',

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
                cat_size: '',
                is_vat: 0,
                vat_uuid: '',

            }

        }
    },
    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getItemGroup && scope.prerequiste.getSupplier && scope.prerequiste.getIncomeAccount && scope.prerequiste.getCostofSales 
                && scope.prerequiste.getCatDepartment && scope.prerequiste.getCatSection && scope.prerequiste.getCatCategory && scope.prerequiste.getCatManufacturer
                && scope.prerequiste.getCatItemType && scope.prerequiste.getCatBrand && scope.prerequiste.getCatForm && scope.prerequiste.getCatPackingType
                && scope.prerequiste.getAssetGroup && scope.prerequiste.getGlobalUoms && scope.prerequiste.getGlobalBaseUOM && scope.prerequiste.getTaxationItem) {
                return true
            }

            return false
        },
        
        globalUOMs() {
            return this.global_uoms
        }
    },
    watch: {
        ready: function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){
                    

                    $(".form-select-item-group").select2({data: scope.options_item_group});
                    scope.selected_item_group = scope.options_item_group[0].id

                    $(".form-select-suppliers").select2({data: scope.options_supplier});

                    $(".form-select-income-account").select2({data: scope.options_income_account});
                    scope.selected_income_account = scope.options_income_account[0].id

                    $(".form-select-cost-of-sales").select2({data: scope.options_cost_of_sales});
                    scope.selected_cost_of_sales = scope.options_cost_of_sales[0].id

                    $(".form-select-cat-department").select2({data: scope.options_cat_department});
                    scope.selected_cat_department = scope.options_cat_department[0].id

                    $(".form-select-cat-section").select2({data: scope.options_cat_section});
                    scope.selected_cat_section = scope.options_cat_section[0].id

                    $(".form-select-cat-category").select2({data: scope.options_cat_category});
                    scope.selected_cat_category = scope.options_cat_category[0].id

                    $(".form-select-cat-manufacturer").select2({data: scope.options_cat_manufacturer});
                    scope.selected_cat_manufacturer = scope.options_cat_manufacturer[0].id

                    $(".form-select-cat-item-type").select2({data: scope.options_cat_item_type});
                    scope.selected_cat_item_type = scope.options_cat_item_type[0].id

                    $(".form-select-cat-brand").select2({data: scope.options_cat_brand});
                    scope.selected_cat_brand = scope.options_cat_brand[0].id

                    $(".form-select-cat-form").select2({data: scope.options_cat_form});
                    scope.selected_cat_form = scope.options_cat_form[0].id

                    $(".form-select-cat-packing-type").select2({data: scope.options_cat_packing_type});
                    scope.selected_cat_packing_type = scope.options_cat_packing_type[0].id

                    $(".form-select-base-uom").select2({data: scope.options_base_uom});
                    scope.selected_base_uom = scope.options_base_uom[0].id

                    $(".form-select-asset-group").select2({data: scope.options_asset_group});

                    $(".form-select-vat").select2({data: scope.options_vat});
                    scope.selected_vat = scope.options_vat[0].id


                    var itemUUID = scope.$route.params.itemUUID
                    scope.getItemDetails(itemUUID)

                },500)
                
            }
        },

        is_vat: function () {
            var scope = this

            if (scope.formdata.is_draft == 1){

                if (scope.is_vat == 1){
                    scope.selected_vat = scope.options_vat[1].id
                    
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

                        scope.selected_vat = scope.options_vat[1].id

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

    components: {
        'discounts' : Discounts
    },
    methods: {

        getTaxationItem: function () {
           var scope = this

           scope.options_vat.push({
               id: '',
               text: 'None'
           });

            scope.GET('company/taxation-item-options').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_vat.push({
                        id: data.uuid,
                        text: data.tax_name
                    })
                
                })

                scope.prerequiste.getTaxationItem = true
                
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

                scope.prerequiste.getItemGroup = true
                
            })
        },

        getSupplier: function () {
           var scope = this
            scope.GET('suppliers').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.supplier_shortname
                    })
                })

                scope.prerequiste.getSupplier = true
                
            })
        },

        getIncomeAccount: function () {
           var scope = this
            scope.GET('company/chart-of-accounts?group1=income').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_income_account.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                })

                scope.prerequiste.getIncomeAccount = true
                
            })
        },

        getCostofSales: function () {
           var scope = this
            scope.GET('company/chart-of-accounts?group1=cost-of-sales').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_cost_of_sales.push({
                        id: data.uuid,
                        text: data.account_name
                    })
                })

                scope.prerequiste.getCostofSales = true

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

                scope.prerequiste.getCatDepartment = true
                
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

                scope.prerequiste.getCatSection = true
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

                scope.prerequiste.getCatCategory = true
                
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

                scope.prerequiste.getCatManufacturer = true
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

                scope.prerequiste.getCatItemType = true
                
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

                scope.prerequiste.getCatBrand = true
                
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

                scope.prerequiste.getCatForm = true
                
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

                scope.prerequiste.getCatPackingType = true
                
            })

        },

        getGlobalBaseUOM: function () {
           var scope = this
            scope.GET('globals/base-uom').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_base_uom.push({
                        id: data.uuid,
                        text: data.uom
                    })
                })

                scope.prerequiste.getGlobalBaseUOM = true
                
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

                scope.prerequiste.getAssetGroup = true
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
            scope.item_uoms.push({uuid: 'PACK', uom: '', barcode: '', sales_description: '', remarks: '', packing: 1});
            $('#uombarcode').css("background-color", "red")
        },
        removeItemUom: function(index) {
            var scope = this
            scope.item_uoms.splice(index,1)
        },

        getGlobalUoms: function () {
           var scope = this
            scope.GET('globals/uom').then(res => {
                scope.global_uoms = res.rows

                scope.prerequiste.getGlobalUoms = true
            })
        },

        getItemUoms: function () {
           var scope = this
             scope.item_uoms = [];

            scope.GET('items/'+ scope.formdata.uuid +'/uoms').then(res => {
                // we use global UOM UUID as uuid instead
                res.rows.forEach(function (data) {
                    scope.item_uoms.push({
                        uuid: data.global_uom_uuid,
                        uom: data.global_uom_uuid, 
                        barcode: data.barcode, 
                        packing: data.packing_qtty, 
                        sales_description:  data.sales_description, 
                        remarks: data.remarks, 
                    })
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

            scope.formdata.global_base_uom_uuid = scope.selected_base_uom

            scope.formdata.cat_department_uuid = scope.selected_cat_department
            scope.formdata.cat_section_uuid = scope.selected_cat_section
            scope.formdata.cat_category_uuid = scope.selected_cat_category
            scope.formdata.cat_manufacturer_uuid = scope.selected_cat_manufacturer
            scope.formdata.cat_item_type_uuid = scope.selected_cat_item_type
            scope.formdata.cat_brand_uuid = scope.selected_cat_brand
            scope.formdata.cat_form_uuid = scope.selected_cat_form
            scope.formdata.cat_packing_type_uuid = scope.selected_cat_packing_type

            scope.formdata.is_vat = scope.is_vat
            scope.formdata.vat_uuid = scope.selected_vat

            scope.formdata.item_uoms = scope.item_uoms


            scope.PUT('items', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.ROUTE({path: '/item-main/'})
                        scope.tempItemUOMs = []
                        scope.formdata.uoms = []
                    })
                } else {
                    //alert('ERROR:' + res.code)
                    window.swal.fire({
                        icon: "error",
                        message: res.message
                    })
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

            scope.formdata.global_base_uom_uuid = scope.selected_base_uom

            scope.formdata.cat_department_uuid = scope.selected_cat_department
            scope.formdata.cat_section_uuid = scope.selected_cat_section
            scope.formdata.cat_category_uuid = scope.selected_cat_category
            scope.formdata.cat_manufacturer_uuid = scope.selected_cat_manufacturer
            scope.formdata.cat_item_type_uuid = scope.selected_cat_item_type
            scope.formdata.cat_brand_uuid = scope.selected_cat_brand
            scope.formdata.cat_form_uuid = scope.selected_cat_form
            scope.formdata.cat_packing_type_uuid = scope.selected_cat_packing_type

            scope.formdata.is_vat = scope.is_vat
            scope.formdata.vat_uuid = scope.selected_vat

            scope.formdata.item_uoms = scope.item_uoms

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
                    scope.PUT('items', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.ROUTE({path: '/item-main/'})
                            })
                        } else{
                            console.log(res)
                            window.swal.fire({
                                icon: "error",
                                text: res.message
                            })
                        }
                    })            
                }                              
            })
            
        },
        remove: function (data) {
            var scope = this

            window.swal.fire({
                title: 'Delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.DELETE('items' + data.uuid).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
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

        setSupplierIDs: function (supplier_ids) {
            this.$refs.itemDiscounts.getSupplierDiscounts(supplier_ids);
        },
        getItemDetails: function (itemUUID) {
            var scope = this
            scope.GET('items/' + itemUUID).then(res => {
                let data = res.data

                console.log('asdasdds')

                scope.formdata.uuid = itemUUID

                if (data.is_draft=== 0) {

                    scope.formdata.is_draft = data.is_draft
                    scope.formdata.item_code = data.item_code
                    scope.formdata.item_barcode = data.item_barcode
                    scope.formdata.item_description = data.item_description
                    scope.formdata.item_shortname = data.item_shortname
                    scope.formdata.is_purchase_item = data.is_purchase_item

                    scope.formdata.purchase_price = data.purchase_price
                    scope.formdata.is_sales_item = data.is_sales_item

                    scope.formdata.sales_price = data.sales_price
                    scope.formdata.is_expiry = data.is_expiry
                    scope.formdata.reorder_qty = data.reorder_qty

                    scope.formdata.is_maintain_stock = data.is_maintain_stock
                    scope.formdata.is_active = data.is_active

                    scope.formdata.cat_size = data.cat_size

                    if (data.vat_uuid!=null){
                        scope.is_vat = 1
                    }else{
                        scope.is_vat = 0
                    }

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

                    $('.form-select-asset-group').val(data.item_asset_group_uuid);
                    $('.form-select-asset-group').trigger('change');

                    $('.form-select-base-uom').val(data.global_base_uom_uuid);
                    $('.form-select-base-uom').trigger('change');

                    $('.form-select-vat').val(data.vat_uuid);
                    $('.form-select-vat').trigger('change');

                    scope.reference_vat_uuid = data.vat_uuid;

                }
                
            })
        }
    },
    mounted() {
        var scope = this
        scope.getTaxationItem()
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

        scope.getAssetGroup()

        scope.getGlobalUoms()

        scope.getGlobalBaseUOM()
        

        $(document).on('change','.form-select-item-group', function(e) { 
            scope.selected_item_group = $('.form-select-item-group').val();
            scope.checkAsset()
        })

        $(document).on('change','.form-select-suppliers', function(e) { 
            scope.selected_suppliers = $('.form-select-suppliers').val();
            scope.setSupplierIDs(scope.selected_suppliers)
        })

        $(document).on('change','.form-select-income-account', function(e) { 
            scope.selected_income_account = $('.form-select-income-account').val();
        })

        $(document).on('change','.form-select-cost-of-sales', function(e) { 
            scope.selected_cost_of_sales = $('.form-select-cost-of-sales').val();
        })

        $(document).on('change','.form-select-cat-department', function(e) { 
            scope.selected_cat_department = $('.form-select-cat-department').val();
        })

        $(document).on('change','.form-select-cat-section', function(e) { 
            scope.selected_cat_section = $('.form-select-cat-section').val();
        })

        $(document).on('change','.form-select-cat-category', function(e) { 
            scope.selected_cat_category = $('.form-select-cat-category').val();
        })

        $(document).on('change','.form-select-cat-manufacturer', function(e) { 
            scope.selected_cat_manufacturer = $('.form-select-cat-manufacturer').val();
        })

        $(document).on('change','.form-select-cat-item-type', function(e) { 
            scope.selected_cat_item_type = $('.form-select-cat-item-type').val();
        })

        $(document).on('change','.form-select-cat-brand', function(e) { 
            scope.selected_cat_brand = $('.form-select-cat-brand').val();
        })

        $(document).on('change','.form-select-cat-form', function(e) { 
            scope.selected_cat_form = $('.form-select-cat-form').val();
        })

        $(document).on('change','.form-select-cat-packing-type', function(e) { 
            scope.selected_cat_packing_type = $('.form-select-cat-packing-type').val();
        })

        $(document).on('change','.form-select-asset-group', function(e) { 
            scope.selected_asset_group = $('.form-select-asset-group').val();
        })

        $(document).on('change','.form-select-base-uom', function(e) { 
            scope.selected_base_uom = $('.form-select-base-uom').val();
        })

        $(document).on('change','.form-select-vat', function(e) { 
            scope.selected_vat = $('.form-select-vat').val();

            if (scope.selected_vat == ''){
                scope.is_vat = 0
            }
        })

    },
}
</script>

<style scoped></style>