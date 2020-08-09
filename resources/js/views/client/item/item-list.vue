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
                                    <td>
                                        <span v-if="item.suppliers.length > 0">
                                            <span v-for="item_supplier in item.suppliers" :key="item_supplier.uuid">
                                                <span  class="badge badge-dim badge-outline-secondary">{{ item_supplier.supplier.business_shortname }}</span> &nbsp;
                                            </span>
                                        </span>
                                        <span v-else>
                                            NOT SPECIFIED
                                        </span>
                                    </td>
                                    <td v-if="item.is_expiry === 1">Yes</td>
                                    <td v-else>No</td>
                                    <td><span class="">{{item.purchase_price}}</span></td>
                                    <td><span class="">{{item.sales_price}}</span></td>
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
                <ul class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="nav-link active" data-toggle="tab" href="#account">Financial Account</a>    
                        </li>    
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#category">Category</a>    
                        </li>
                        <li class="nav-item">
                            <a v-if="formdata.uuid === null" class="nav-link disabled" data-toggle="tab" href="#pricing">Pricing</a> 
                            <a v-else class="nav-link" data-toggle="tab" href="#pricing">Pricing</a>           
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
                                                <label class="form-label" for="purchase-uom">Purchase UOM</label>
                                                <select class="form-select-purchase-uom" v-model="selected_purchase_uom" :options="options_purchase_uom" name="purchase-uom">
                                                </select>
                                            </div>
                                        </div>

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
                                                            <label class="form-label" for="sales-uom">Sales UOM</label>
                                                            <select class="form-select-sales-uom" v-model="selected_sales_uom" :options="options_sales_uom" name="sales-uom">
                                                            </select>
                                                        </div>
                                                    </div>

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

                                                    <!-- <div class="col-md-4 col-12">
                                                        <div class="custom-control custom-radio">    
                                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">    
                                                            <label class="custom-control-label" for="customRadio1">Manual</label>
                                                        </div>
                                                    </div> -->

                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="mark-up-rate">Markup Rate</label>
                                                            <div class="custom-control custom-radio">    
                                                                <input v-model="compute_selection" value = "manual" type="radio" id="manual-compute" class="custom-control-input" checked>    
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

            selected_ewt: null,
            options_ewt: [],

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

            selected_purchase_uom: null,
            options_purchase_uom: [],

            selected_sales_uom: null,
            options_sales_uom: [],


            selected_customer_group: null,
            options_customer_group: [],

            input_markup_rate: '',
            customer_markup_rate: '',

            is_vat: 0,
            is_ewt: 0,
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
                supplier_uuid: '',
                is_purchase_item: 0,
                purchase_uom_uuid: '',
                purchase_price: '',
                is_sales_item: 0,
                sales_uom_uuid: '',
                sales_price: '',
                transfer_price: '',
                is_expiry: 0,
                vat_uuid: '',
                ewt_uuid: '',
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

        getPurchaseUom: function () {
           var scope = this

           scope.options_purchase_uom.push({
               id: '',
               text: 'NONE'
           });

            scope.GET('items/' + scope.formdata.uuid + '/uom').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_purchase_uom.push({
                        id: data.uuid,
                        text: data.uom
                    })
                
                })

                $(".form-select-purchase-uom").select2({data: scope.options_purchase_uom});
                
                $('.form-select-purchase-uom').val(null);
                $('.form-select-purchase-uom').trigger('change');
            })

        },

        getSalesUom: function () {
           var scope = this

           scope.options_sales_uom.push({
               id: '',
               text: 'NONE'
           });

            scope.GET('items/' + scope.formdata.uuid + '/uom').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_sales_uom.push({
                        id: data.uuid,
                        text: data.uom
                    })
                
                })

                $(".form-select-sales-uom").select2({data: scope.options_sales_uom});
                
                $('.form-select-sales-uom').val(null);
                $('.form-select-sales-uom').trigger('change');
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
            scope.formdata.purchase_uom_uuid = ''
            scope.formdata.purchase_price = ''
            scope.formdata.is_sales_item = 0
            scope.formdata.sales_uom_uuid = ''
            scope.formdata.sales_price = ''
            scope.formdata.transfer_price = ''
            scope.formdata.is_expiry = 0
            scope.formdata.vat_uuid = ''
            scope.formdata.ewt_uuid = ''
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
            scope.is_ewt = 0
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

            scope.itemUOMs = []
            scope.itemUOMs = data.u_o_ms

            var suppliers = [];

            scope.getPurchaseUom()
            scope.getSalesUom()

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

            $('.form-select-ewt').val(data.ewt_uuid);
            $('.form-select-ewt').trigger('change');

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

            $('.form-select-purchase-uom').val(data.purchase_uom_uuid);
            $('.form-select-purchase-uom').trigger('change');

            $('.form-select-sales-uom').val(data.sales_uom_uuid);
            $('.form-select-sales-uom').trigger('change');

        },
        save: function () {
            var scope = this
            scope.formdata.item_group_uuid = scope.selected_item_group
            scope.formdata.supplier_uuids = scope.selected_suppliers
            scope.formdata.vat_uuid = scope.selected_vat
            scope.formdata.ewt_uuid = scope.selected_ewt
            scope.formdata.coa_income_account_uuid = scope.selected_income_account
            scope.formdata.coa_cos_account_uuid = scope.selected_cost_of_sales
            scope.formdata.item_asset_group_uuid = scope.selected_asset_group

            scope.formdata.category1_uuid = scope.selected_category1
            scope.formdata.category2_uuid = scope.selected_category2
            scope.formdata.category3_uuid = scope.selected_category3
            scope.formdata.category4_uuid = scope.selected_category4
            scope.formdata.category5_uuid = scope.selected_category5


            scope.formdata.purchase_uom_uuid = scope.selected_purchase_uom
            scope.formdata.sales_uom_uuid = scope.selected_sales_uom

            scope.formdata.uoms = scope.tempItemUOMs

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
            scope.formdata.ewt_uuid = scope.selected_ewt
            scope.formdata.coa_income_account_uuid = scope.selected_income_account
            scope.formdata.coa_cos_account_uuid = scope.selected_cost_of_sales
            scope.formdata.item_asset_group_uuid = scope.selected_asset_group

            scope.formdata.category1_uuid = scope.selected_category1
            scope.formdata.category2_uuid = scope.selected_category2
            scope.formdata.category3_uuid = scope.selected_category3
            scope.formdata.category4_uuid = scope.selected_category4
            scope.formdata.category5_uuid = scope.selected_category5


            scope.formdata.purchase_uom_uuid = scope.selected_purchase_uom
            scope.formdata.sales_uom_uuid = scope.selected_sales_uom

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

                        scope.getPurchaseUom()
                        scope.getSalesUom()

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

                         scope.getPurchaseUom()
                         scope.getSalesUom()

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
        scope.getEwt()
        scope.getCategory1()
        scope.getCategory2()
        scope.getCategory3()
        scope.getCategory4()
        scope.getCategory5()
        scope.getAssetGroup()

        scope.getCustomerGroup()

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

        $('.form-select-ewt').on("change", function(e) { 
            scope.selected_ewt = $('.form-select-ewt').val();
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

        $('.form-select-purchase-uom').on("change", function(e) { 
            scope.selected_purchase_uom = $('.form-select-purchase-uom').val();
        })

        $('.form-select-sales-uom').on("change", function(e) { 
            scope.selected_sales_uom = $('.form-select-sales-uom').val();
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
.table-tranx { table-layout: auto; }
.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>