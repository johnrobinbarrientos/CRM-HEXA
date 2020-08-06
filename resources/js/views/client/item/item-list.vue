<template>
    <div>
        <div v-show="!show_form">
        <div class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Item">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="toggleForm();resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Item</span>
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
                                    <th><span class="">Item Description</span></th>
                                    <th><span class="">Item Code</span></th>
                                    <th><span class="">Item Barcode</span></th>
                                    <th><span class="">Case/Box Barcode</span></th>
                                    <th><span class="">Item Group</span></th>
                                    <th><span class="">Re-order Qtyy / ICO</span></th>
                                    <th><span class="">Supplier</span></th>
                                    <th><span class="">Is Expiry?</span></th>
                                    <th><span class="">Purchase Cost</span></th>
                                    <th><span class="">Sales Cost</span></th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in itemList" :key="item.uuid" class="tb-tnx-item">
                                    <!-- <th class="table-fixed-column" style="border-top:1px solid #dbdfea; left:0px; width:150px; background:#fff;"><span class="">Actions</span></th>
                                    <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:150px; width:100px; background:#fff;"><span class="">#</span></td>
                                    <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:250px; width:200px; background:#fff; border-right:1px solid #dbdfea;"><span class="">Shortname Tide</span></td> -->
                                    <td>
                                    <span class="">
                                        <a href="javascript:void(0)"  @click="setData(item); toggleForm() " class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                        <a href="javascript:void(0)"  @click="remove(item)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                    </span>
                                    </td>
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">{{item.item_description}}</span></td>
                                    <td><span class="">{{item.item_code}}</span></td>
                                    <td><span class="">{{item.item_barcode}}</span></td>
                                    <td><span class="">{{item.cs_barcode}}</span></td>
                                    <td><span class="">{{item.item_group.item_group}}</span></td>
                                    <td><span class="">{{item.reorder_qty}}</span></td>
                                    <td><span class="">{{item.supplier.business_shortname}}</span></td>
                                    <td v-if="item.is_expiry === 1">Yes</td>
                                    <td v-else>No</td>
                                    <td><span class="">{{item.purchase_cost}}</span></td>
                                    <td><span class="">{{item.sales_cost}}</span></td>
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
                            <select class="form-select-supplier" v-model="selected_supplier" :options="options_supplier" name="supplier">
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
                                    <input type="checkbox" v-model="formdata.is_expiry" true-value="1" false-value="0" class="custom-control-input" id="is-expiry">
                                    <label class="custom-control-label" for="is-expiry">Is Expiry?</label>
                                </div>
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
                            <a class="nav-link" data-toggle="tab" href="#category">Category</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#cost">Cost</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#unit-of-measure">Unit of Measure</a>    
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

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="tax">Tax</label>
                                    <select class="form-select-tax" v-model="selected_tax" :options="options_tax" name="tax">
                                    </select>
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
                        <div class="tab-pane" id="cost"> 
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
                                                <label class="form-label" for="purchase-uom">Purchase UOM</label>
                                                <select v-model="selected_purchase_uom">
                                                <option>PC</option>
                                                <option>CS</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="purchase-cost">Purchase Cost</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="formdata.purchase_cost" type="text" class="form-control" id="purchase-cost" required>
                                                </div>
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
                                                <input type="checkbox" v-model="formdata.is_sales_item" value="1" class="custom-control-input" id="is-sales-item">
                                                <label class="custom-control-label" for="is-sales-item">Is Sales Item?</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div v-show="formdata.is_sales_item" class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="sales-uom">Sales UOM</label>
                                                <select v-model="selected_sales_uom">
                                                <option>PC</option>
                                                <option>CS</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="sales-cost">Sales Cost</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="formdata.sales_cost" type="text" class="form-control" id="sales-cost" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="transfer-cost">Transfer Cost</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="formdata.transfer_cost" type="text" class="form-control" id="transfer-cost" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>   


                        <div class="tab-pane" id="unit-of-measure">
                            
                            <div class="row">
                              

                                <div class="col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="item-uom">UOM</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="itemUOMFormData.uom" type="text" class="form-control" id="item-uom" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="conversion">Conversion</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="itemUOMFormData.conversion" type="text" class="form-control" id="conversion" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div style="padding:10px 0px; text-align:right;">
                                                <button v-if="itemUOMFormData.uuid !== null" @click="updateUOMs()" type="button" class="btn btn-lg btn-primary">Update</button>
                                                <button v-if="itemUOMFormData.uuid === null && itemUOMFormData.index !== null "  @click="saveTempUOMs()" type="button" class="btn btn-lg btn-primary">Update</button>
                                                <button v-if="itemUOMFormData.uuid === null && itemUOMFormData.index === null " @click="saveTempUOMs()" type="button" class="btn btn-lg btn-primary">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="card card-bordered card-preview">
                                        <table class="table table-items">
                                            <thead>
                                                <tr class="tb-tnx-head">
                                                    <th><span class="">UOM</span></th>
                                                    <th><span class="">Conversion</span></th>
                                                    <th><span>Actions</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(tempItemUOM, index) in tempItemUOMs" :key="index">
                                                    <td><span class="">{{ tempItemUOM.uom }}</span></td>
                                                    <td><span class="">{{ tempItemUOM.conversion }}</span></td>
                                                    <td>
                                                        <a href="javascript:void(0);" @click="editTempUOM(index)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                        <a href="javascript:void(0);" @click="removeTempUOM(index)" class="btn btn-sm btn-danger"><em class="icon ni ni-cross"></em></a>
                                                    </td>
                                                </tr>
                                                <tr v-for="(itemUOM, index) in itemUOMs" :key="index">
                                                    <td><span class="">{{ itemUOM.uom }}</span></td>
                                                    <td><span class="">{{ itemUOM.conversion }}</span></td>
                                                    <td>
                                                        <a href="javascript:void(0);" @click="editUOM(itemUOM, index)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                        <a href="javascript:void(0);" @click="removeUOM(itemUOM, index)" class="btn btn-sm btn-danger"><em class="icon ni ni-cross"></em></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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

            selected_supplier: null,
            options_supplier: [],

            selected_income_account: null,
            options_income_account: [],

            selected_cost_of_sales: null,
            options_cost_of_sales: [],

            selected_tax: null,
            options_tax: [],

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


            selected_purchase_uom: 'PC',
            selected_sales_uom: 'PC',

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
                supplier_uuid: '',
                is_purchase_item: 0,
                purchase_uom: '',
                purchase_cost: '',
                is_sales_item: 0,
                sales_uom: '',
                sales_cost: '',
                transfer_cost: '',
                is_expiry: '',
                vat_uuid: '',
                coa_income_account_uuid: '',
                coa_cos_account_uuid: '',
                reorder_qty: '',
                item_asset_group_uuid: '',
                category1_uuid: '',
                category2_uuid: '',
                category3_uuid: '',
                category4_uuid: '',
                category5_uuid: ''
            },

            itemUOMs: [],
            tempItemUOMs: [],
            
            itemUOMFormData:{
                index: null, 
                uuid: null,
                item_uuid: null,
                uom: '',
                conversion: ''
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

        getAllItemGroup: function () {
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

        getAllSupplier: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.business_shortname
                    })
                
                })

                $(".form-select-supplier").select2({data: scope.options_supplier});
                
                scope.selected_supplier = scope.options_supplier[0].id
            })
        },

        getAllIncomeAccount: function () {
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

        getAllCostofSales: function () {
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

        getAllCategory1: function () {
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


        getAllCategory2: function () {
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

        getAllCategory3: function () {
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

        getAllCategory4: function () {
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

        getAllCategory5: function () {
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

        getAllAssetGroup: function () {
           var scope = this
            scope.GET('items/item-asset-group').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_asset_group.push({
                        id: data.uuid,
                        text: data.asset_group
                    })
                
                })

                $(".form-select-asset-group").select2({data: scope.options_asset_group});
                
                scope.selected_asset_group = scope.options_asset_group[0].id
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
            scope.formdata.supplier_uuid = ''
            scope.formdata.is_purchase_item = 0
            scope.formdata.purchase_uom = ''
            scope.formdata.purchase_cost = ''
            scope.formdata.is_sales_item = 0
            scope.formdata.sales_uom = ''
            scope.formdata.sales_cost = ''
            scope.formdata.transfer_cost = ''
            scope.formdata.is_expiry = ''
            scope.formdata.vat_uuid = ''
            scope.formdata.coa_income_account_uuid = ''
            scope.formdata.coa_cos_account_uuid = ''
            scope.formdata.reorder_qty = ''
            scope.formdata.item_asset_group_uuid = ''
            scope.formdata.category1_uuid = ''
            scope.formdata.category2_uuid = ''
            scope.formdata.category3_uuid = ''
            scope.formdata.category4_uuid = ''
            scope.formdata.category5_uuid = ''

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

            scope.formdata.purchase_cost = data.purchase_cost
            scope.formdata.is_sales_item = data.is_sales_item

            scope.formdata.sales_cost = data.sales_cost
            scope.formdata.transfer_cost = data.transfer_cost
            scope.formdata.is_expiry = data.is_expiry
            scope.formdata.reorder_qty = data.reorder_qty

            scope.selected_purchase_uom = data.purchase_uom
            scope.selected_sales_uom = data.sales_uom

            scope.itemUOMs = []
            scope.itemUOMs = data.u_o_ms

            $('.form-select-item-group').val(data.item_group_uuid);
            $('.form-select-item-group').trigger('change');

            $('.form-select-supplier').val(data.supplier_uuid);
            $('.form-select-supplier').trigger('change');

            $('.form-select-income-account').val(data.coa_income_account_uuid);
            $('.form-select-income-account').trigger('change');
            
            $('.form-select-cost-of-sales').val(data.coa_cos_account_uuid);
            $('.form-select-cost-of-sales').trigger('change');

            $('.form-select-tax').val(data.vat_uuid);
            $('.form-select-tax').trigger('change');

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

        },
        save: function () {
            var scope = this
            scope.formdata.item_group_uuid = scope.selected_item_group
            scope.formdata.supplier_uuid = scope.selected_supplier
            scope.formdata.vat_uuid = scope.selected_tax
            scope.formdata.coa_income_account_uuid = scope.selected_income_account
            scope.formdata.coa_cos_account_uuid = scope.selected_cost_of_sales
            scope.formdata.item_asset_group_uuid = scope.selected_asset_group

            scope.formdata.category1_uuid = scope.selected_category1
            scope.formdata.category2_uuid = scope.selected_category2
            scope.formdata.category3_uuid = scope.selected_category3
            scope.formdata.category4_uuid = scope.selected_category4
            scope.formdata.category5_uuid = scope.selected_category5


            scope.formdata.purchase_uom = scope.selected_purchase_uom
            scope.formdata.sales_uom = scope.selected_sales_uom

            scope.formdata.uoms = scope.tempItemUOMs

            scope.POST('items/item-list/save', scope.formdata).then(res => {
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
            scope.formdata.supplier_uuid = scope.selected_supplier
            scope.formdata.vat_uuid = scope.selected_tax
            scope.formdata.coa_income_account_uuid = scope.selected_income_account
            scope.formdata.coa_cos_account_uuid = scope.selected_cost_of_sales
            scope.formdata.item_asset_group_uuid = scope.selected_asset_group

            scope.formdata.category1_uuid = scope.selected_category1
            scope.formdata.category2_uuid = scope.selected_category2
            scope.formdata.category3_uuid = scope.selected_category3
            scope.formdata.category4_uuid = scope.selected_category4
            scope.formdata.category5_uuid = scope.selected_category5


            scope.formdata.purchase_uom = scope.selected_purchase_uom
            scope.formdata.sales_uom = scope.selected_sales_uom

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
                    scope.PUT('items/item-list/update', scope.formdata).then(res => {
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
                    scope.POST('items/item-list/delete', data).then(res => {
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
        saveTempUOMs() {
            var scope = this
            
            if (scope.formdata.uuid !== null) {

                if (scope.itemUOMFormData.uuid === null) {
                    scope.saveUOMs();
                } else {
                    scope.updateUOMs();
                } 

                return;
            }

            if (scope.itemUOMFormData.uuid == null && scope.itemUOMFormData.index !== null) {
                var index = scope.itemUOMFormData.index
                scope.tempItemUOMs[index].uom = scope.itemUOMFormData.uom
                scope.tempItemUOMs[index].conversion = scope.itemUOMFormData.conversion 
            } else {
                scope.tempItemUOMs.push({
                    uom: scope.itemUOMFormData.uom, 
                    conversion: scope.itemUOMFormData.conversion 
                })
            }
            
            // reset form
            scope.itemUOMFormData.index = null
            scope.itemUOMFormData.uuid  = null
            scope.itemUOMFormData.uom = ''
            scope.itemUOMFormData.conversion = ''
        },
        editTempUOM(index) {
            var scope = this
            
            scope.itemUOMFormData.index = index
            scope.itemUOMFormData.uuid = null
            scope.itemUOMFormData.uom = scope.tempItemUOMs[index].uom
            scope.itemUOMFormData.conversion =  scope.tempItemUOMs[index].conversion
        },
        editUOM(data, index) {
            var scope = this
            
            scope.itemUOMFormData.index = index
            scope.itemUOMFormData.uuid = data.uuid
            scope.itemUOMFormData.uom = data.uom
            scope.itemUOMFormData.conversion =  data.conversion
        },
        removeTempUOM(index) {
            var scope = this
            scope.tempItemUOMs.splice(index, 1)
        },
        updateUOMs: function () {
            var scope = this

            scope.PUT('items/uom/update', scope.itemUOMFormData).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'UOM Successfuly Updated',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        var index = scope.itemUOMFormData.index
                        scope.itemUOMs[index].uom = res.data.uom
                        scope.itemUOMs[index].conversion = res.data.conversion

                        // reset form
                        scope.itemUOMFormData.index = null
                        scope.itemUOMFormData.uuid  = null
                        scope.itemUOMFormData.uom = ''
                        scope.itemUOMFormData.conversion = ''
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        },
        saveUOMs: function () {
            var scope = this

            scope.itemUOMFormData.item_uuid = scope.formdata.uuid
            scope.POST('items/uom/save', scope.itemUOMFormData).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'UOM Successfuly Added',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                         scope.itemUOMs.push(res.data)

                        // reset form
                        scope.itemUOMFormData.index = null
                        scope.itemUOMFormData.uuid  = null
                        scope.itemUOMFormData.uom = ''
                        scope.itemUOMFormData.conversion = ''
                    })
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        },
        removeUOM(data,index) {
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
                    scope.POST('items/uom/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'UOM Successfuly Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.itemUOMs.splice(index, 1)
                            })
                        } else {
                            alert('ERROR:' + res.code)
                        } 
                    })
                }
            })
        }
    },
    mounted() {
        var scope = this
        scope.getItemList()

        scope.getAllItemGroup()
        scope.getAllSupplier()
        scope.getAllIncomeAccount()
        scope.getAllCostofSales()
        scope.getAllTax()
        scope.getAllCategory1()
        scope.getAllCategory2()
        scope.getAllCategory3()
        scope.getAllCategory4()
        scope.getAllCategory5()
        scope.getAllAssetGroup()

        $('.form-select-item-group').on("change", function(e) { 
            scope.selected_item_group = $('.form-select-item-group').val();
        })

        $('.form-select-supplier').on("change", function(e) { 
            scope.selected_supplier = $('.form-select-supplier').val();
        })

        $('.form-select-income-account').on("change", function(e) { 
            scope.selected_income_account = $('.form-select-income-account').val();
        })

        $('.form-select-cost-of-sales').on("change", function(e) { 
            scope.selected_cost_of_sales = $('.form-select-cost-of-sales').val();
        })

        $('.form-select-tax').on("change", function(e) { 
            scope.selected_tax = $('.form-select-tax').val();
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
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; }
.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>