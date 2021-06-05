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
                                <i class="bx bx-data" @click="ROUTE({path: '/item-main/' })"></i>
                                <span @click="ROUTE({path: '/item-main/' })">Item</span>
                                <i class="las la-angle-right"></i>
                                View
                            </h1>
                        </span>
                        <span v-else>
                            <span v-if="!formdata.uuid">
                                <h1 class="title">
                                    <i class="bx bx-data" @click="ROUTE({path: '/item-main/' })"></i>
                                    <span @click="ROUTE({path: '/item-main/' })">Item</span>
                                    <i class="las la-angle-right"></i>
                                    New
                                </h1>
                            </span>
                            <span v-else>
                                <h1 class="title">
                                    <i class="bx bx-data" @click="ROUTE({path: '/item-main/' })"></i>
                                    <span @click="ROUTE({path: '/item-main/' })">Item</span>
                                    <i class="las la-angle-right"></i>
                                    Edit
                                </h1>
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
                            <a  @click="save()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">
                                <template v-if="!formdata.uuid">Save</template>
                                <template v-else>Update</template>
                            </a>
                        </span>
                    </div>
                </div>

                <form action="#" class="form-validate is-alter">

                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="item-group">Item Group</label>
                                <multiselect  v-model="selected_item_group" :options="options_item_group" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                    <span slot="noResult">No Results</span>
                                </multiselect>
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
                                <multiselect  v-model="selected_base_uom" :options="options_base_uom" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                    <span slot="noResult">No Results</span>
                                </multiselect>
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
                                <label class="form-label" for="reorder-qty">ICO</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.ico" type="text" class="form-control" id="reorder-qty" :readonly="view_mode">
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
                                                <multiselect  v-model="selected_income_account" :options="options_income_account" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cost-of-sales">Cost Of Sales</label>
                                                <multiselect  v-model="selected_cost_of_sales" :options="options_cost_of_sales" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="vat">VAT</label>
                                                <multiselect  v-model="selected_vat" :options="options_vat" track-by="uuid" label="text" deselect-label="Deselect" selectLabel="Select" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>
                                    </div>

                            </div>

                            <div class="tab-pane" id="category">
                                    <div class="row">

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-department">Department</label>
                                                <multiselect  v-model="selected_cat_department" :options="options_cat_department" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-manufacturer">Manufacturer</label>
                                                <multiselect  v-model="selected_cat_manufacturer" :options="options_cat_manufacturer" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-form">Form</label>
                                                <multiselect  v-model="selected_cat_form" :options="options_cat_form" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-section">Section</label>
                                                <multiselect  v-model="selected_cat_section" :options="options_cat_section" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-item-type">Item Type</label>
                                                <multiselect  v-model="selected_cat_item_type" :options="options_cat_item_type" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-packing-type">Packing Type</label>
                                                <multiselect  v-model="selected_cat_packing_type" :options="options_cat_packing_type" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-category">Category</label>
                                                <multiselect  v-model="selected_cat_category" :options="options_cat_category" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="cat-brand">Brand</label>
                                                <multiselect  v-model="selected_cat_brand" :options="options_cat_brand" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                                    <span slot="noResult">No Results</span>
                                                </multiselect>
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
                                <UOMS v-if="load_ready"  :item="formdata" :view_mode="view_mode" ref="uoms"></UOMS>
                            </div>   

                            <div class="tab-pane" id="pricing" style="padding: 0 15px 15px;"> 
                                <pricing v-if="load_ready" :item="formdata"  ref="pricing"></pricing>
                            </div>    


                            <div class="tab-pane" id="asset" v-show="show_asset_group">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="asset-group">Asset Group</label>
                                        <multiselect  v-model="selected_asset_group" :options="options_asset_group" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="item_new_mode" :disabled="view_mode">
                                            <span slot="noResult">No Results</span>
                                        </multiselect>
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

import UOMS from './uoms'
import pricing from './pricing'

export default {
    name: 'item-list',
    props: ['properties','view_mode'],
    data: function () {
        return {
            prerequiste: {
                getItemGroup: false,
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
                getGlobalBaseUOM: false,
                getAssetGroup: false,
                getTaxationItem:false
                
            },

            item_new_mode: true,

            selected_vat: [],
            options_vat: [],

            selected_item_group: [],
            options_item_group: [],

            selected_income_account: [],
            options_income_account: [],

            selected_cost_of_sales: [],
            options_cost_of_sales: [],

            selected_cat_department: [],
            options_cat_department: [],

            selected_cat_section: [],
            options_cat_section: [],

            selected_cat_category: [],
            options_cat_category: [],

            selected_cat_manufacturer: [],
            options_cat_manufacturer: [],

            selected_cat_item_type: [],
            options_cat_item_type: [],

            selected_cat_brand: [],
            options_cat_brand: [],

            selected_cat_form: [],
            options_cat_form: [],

            selected_cat_packing_type: [],
            options_cat_packing_type: [],

            selected_asset_group: [],
            options_asset_group: [],


            selected_base_uom: [],
            options_base_uom: [],


            show_asset_group: false,
            show_discounts: false,
            load_ready: false,


            itemList: [],

 
            formdata: { 
                uuid: null,
                item_group_uuid: '', 
                item_code: '', 
                item_barcode: '',
                global_base_uom_uuid: '',
                item_description: '',
                item_shortname: '',

                is_purchase_item: 0,
                is_sales_item: 0,
                sales_price: '',

                is_expiry: 0,
                is_maintain_stock: 0,
                is_active: 1,
                coa_income_account_uuid: '',
                coa_cos_account_uuid: '',
                ico: '',
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
                vat_uuid: '',
                suppliers: [],
                uoms: []
            }

        }
    },
    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getItemGroup && scope.prerequiste.getIncomeAccount && scope.prerequiste.getCostofSales 
                && scope.prerequiste.getCatDepartment && scope.prerequiste.getCatSection && scope.prerequiste.getCatCategory && scope.prerequiste.getCatManufacturer
                && scope.prerequiste.getCatItemType && scope.prerequiste.getCatBrand && scope.prerequiste.getCatForm && scope.prerequiste.getCatPackingType
                && scope.prerequiste.getAssetGroup && scope.prerequiste.getGlobalBaseUOM && scope.prerequiste.getTaxationItem) {
                return true
            }

            return false
        },
    },
    watch: {
        ready: function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){

                    scope.getItemDetails(scope.formdata.uuid)

                },500)
                
            }
        }, 
        
        selected_item_group: function(){
            var scope = this
            scope.checkAsset()
        }

    },

    components: {
        'UOMS' : UOMS,
        'pricing' : pricing,
    },

    methods: {

        getTaxationItem: function () {
           var scope = this

            scope.GET('company/taxation-item-options').then(res => {

                res.rows.forEach(function (data) {

                    scope.options_vat.push({
                        uuid: data.uuid,
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
                        uuid: data.uuid,
                        text: data.item_group
                    })
                })

                scope.prerequiste.getItemGroup = true
            })
        },

        getIncomeAccount: function () {
           var scope = this

            scope.GET('company/chart-of-accounts?group1=income').then(res => {

                res.rows.forEach(function (data) {

                    scope.options_income_account.push({
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
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
                        uuid: data.uuid,
                        text: data.uom
                    })
                })

                scope.prerequiste.getGlobalBaseUOM = true
            })
        },

        getAssetGroup: function () {
           var scope = this

            scope.GET('items/item-asset-group').then(res => {
                
                res.rows.forEach(function (data) {
                    scope.options_asset_group.push({
                        uuid: data.uuid,
                        text: data.asset_group
                    })
                })

                scope.prerequiste.getAssetGroup = true
            })
        },

        checkAsset: function () {
           var scope = this

           for (var i = 0; i < scope.options_item_group.length; i++) {
                if(scope.options_item_group[i].uuid==scope.selected_item_group.uuid){
                    if (scope.options_item_group[i].text === 'Asset'){
                        scope.show_asset_group = true
                    }
                    else{
                        scope.show_asset_group = false
                    }

                }
            }
        },

        save: function () {
            var scope = this

            scope.formdata.suppliers =  this.$refs.pricing.getSelectedSuppliers()
            scope.formdata.uoms =  this.$refs.uoms.getUOMS()


            scope.formdata.item_group_uuid= (scope.selected_item_group == null) ? null : scope.selected_item_group.uuid
            scope.formdata.coa_income_account_uuid= (scope.selected_income_account == null) ? null : scope.selected_income_account.uuid
            scope.formdata.coa_cos_account_uuid= (scope.selected_cost_of_sales == null) ? null : scope.selected_cost_of_sales.uuid

            //08f9498a-8aa3-447a-90df-c7b78fb22a5c uuid for Asset
            scope.formdata.item_asset_group_uuid= (scope.selected_item_group.uuid != '08f9498a-8aa3-447a-90df-c7b78fb22a5c' || scope.selected_asset_group == null) ? null : scope.selected_asset_group.uuid

            scope.formdata.global_base_uom_uuid= (scope.selected_base_uom == null) ? null : scope.selected_base_uom.uuid
            scope.formdata.cat_department_uuid= (scope.selected_cat_department == null) ? null : scope.selected_cat_department.uuid
            scope.formdata.cat_section_uuid= (scope.selected_cat_section == null) ? null : scope.selected_cat_section.uuid
            scope.formdata.cat_category_uuid= (scope.selected_cat_category == null) ? null : scope.selected_cat_category.uuid
            scope.formdata.cat_manufacturer_uuid= (scope.selected_cat_manufacturer == null) ? null : scope.selected_cat_manufacturer.uuid
            scope.formdata.cat_item_type_uuid= (scope.selected_cat_item_type == null) ? null : scope.selected_cat_item_type.uuid
            scope.formdata.cat_brand_uuid= (scope.selected_cat_brand == null) ? null : scope.selected_cat_brand.uuid
            scope.formdata.cat_form_uuid= (scope.selected_cat_form == null) ? null : scope.selected_cat_form.uuid
            scope.formdata.cat_packing_type_uuid= (scope.selected_cat_packing_type == null) ? null : scope.selected_cat_packing_type.uuid
            scope.formdata.vat_uuid= (scope.selected_vat == null) ? null : scope.selected_vat.uuid


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
                        scope.PUT('items/' + scope.formdata.uuid, scope.formdata).then(res => {
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
                            } else {
                                alert('ERROR')
                            }
                        })
                    }                              
                })
            } else {
                scope.POST('items', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.ROUTE({path: '/item-main/'})
                        })
                    } else {
                        alert('ERROR')
                    }
                })
            }
            
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

        getItemDetails: function (itemUUID) {
            var scope = this

            if (itemUUID == null) {
                scope.load_ready = true
                return;
            } 

            scope.GET('items/' + itemUUID).then(res => {
                let data = res.data

                console.log(data)

                scope.formdata.uuid = itemUUID

                scope.formdata.item_code = data.item_code
                scope.formdata.item_barcode = data.item_barcode
                scope.formdata.item_description = data.item_description
                scope.formdata.item_shortname = data.item_shortname
                scope.formdata.is_purchase_item = data.is_purchase_item

                scope.formdata.purchase_price = data.purchase_price
                scope.formdata.is_sales_item = data.is_sales_item

                scope.formdata.sales_price = data.sales_price
                scope.formdata.is_expiry = data.is_expiry
                scope.formdata.ico = data.ico

                scope.formdata.is_maintain_stock = data.is_maintain_stock
                scope.formdata.is_active = data.is_active

                scope.formdata.cat_size = data.cat_size

                scope.formdata.suppliers = data.suppliers

                scope.load_ready = true



                if (data.item_group !== null){
                    scope.selected_item_group = {
                            uuid: data.item_group.uuid,
                            text: data.item_group.item_group
                        }
                }

                if (data.income_account !== null){
                    scope.selected_income_account = {
                            uuid: data.income_account.uuid,
                            text: data.income_account.account_name
                        }
                }

                if (data.cos_account !== null){
                    scope.selected_cost_of_sales = {
                            uuid: data.cos_account.uuid,
                            text: data.cos_account.account_name
                        }
                }

                if (data.cat_department !== null){
                    scope.selected_cat_department = {
                            uuid: data.cat_department.uuid,
                            text: data.cat_department.department
                        }
                }

                if (data.cat_section !== null){
                    scope.selected_cat_section = {
                            uuid: data.cat_section.uuid,
                            text: data.cat_section.section
                        }
                }

                if (data.cat_category !== null){
                    scope.selected_cat_category = {
                            uuid: data.cat_category.uuid,
                            text: data.cat_category.category
                        }
                }

                if (data.cat_manufacturer !== null){
                    scope.selected_cat_manufacturer = {
                            uuid: data.cat_manufacturer.uuid,
                            text: data.cat_manufacturer.manufacturer
                        }
                }

                if (data.cat_item_type !== null){
                    scope.selected_cat_item_type = {
                            uuid: data.cat_item_type.uuid,
                            text: data.cat_item_type.item_type
                        }
                }

                if (data.cat_brand !== null){
                    scope.selected_cat_brand = {
                            uuid: data.cat_brand.uuid,
                            text: data.cat_brand.brand
                        }
                }

                if (data.cat_form !== null){
                    scope.selected_cat_form = {
                            uuid: data.cat_form.uuid,
                            text: data.cat_form.form
                        }
                }

                if (data.cat_packing_type !== null){
                    scope.selected_cat_packing_type = {
                            uuid: data.cat_packing_type.uuid,
                            text: data.cat_packing_type.packing_type
                        }
                }

                if (data.base_u_o_m !== null){
                    scope.selected_base_uom = {
                            uuid: data.base_u_o_m.uuid,
                            text: data.base_u_o_m.uom
                        }
                }


                if (data.asset_group !== null){
                    scope.selected_asset_group = {
                            uuid: data.asset_group.uuid,
                            text: data.asset_group.asset_group
                        }
                }

                if (data.asset_group !== null){
                    scope.selected_asset_group = {
                            uuid: data.asset_group.uuid,
                            text: data.asset_group.asset_group
                        }
                }

                if (data.v_a_t !== null){
                    scope.selected_vat = {
                            uuid: data.v_a_t.uuid,
                            text: data.v_a_t.tax_name
                        }
                }
   
            })
        }
    },
    
    mounted() {
        var scope = this

        scope.getTaxationItem()
        scope.getItemGroup()
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
        scope.getGlobalBaseUOM()

        scope.formdata.uuid = (scope.$route.params.itemUUID != 'create') ? scope.$route.params.itemUUID : null

    },
}
</script>

<style scoped></style>