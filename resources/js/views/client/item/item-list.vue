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
                                    <th><span class="">ICO</span></th>
                                    <th><span class="">Supplier</span></th>
                                    <th><span class="">Is Expiry?</span></th>
                                    <th><span class="">Applied VAT?</span></th>
                                    <th><span class="">Purchase Cost</span></th>
                                    <th><span class="">Sales Cost</span></th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr v-for="(item, index) in Groups" :key="item.uuid" class="tb-tnx-item"> -->
                                <tr>
                                    <!-- <th class="table-fixed-column" style="border-top:1px solid #dbdfea; left:0px; width:150px; background:#fff;"><span class="">Actions</span></th>
                                    <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:150px; width:100px; background:#fff;"><span class="">#</span></td>
                                    <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:250px; width:200px; background:#fff; border-right:1px solid #dbdfea;"><span class="">Shortname Tide</span></td> -->
                                    <td>
                                    <span class="">
                                        <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalItemGroup');setData(item)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                        <a href="javascript:void(0)"  @click="remove(item)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                    </span>
                                    </td>
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">Item Description</span></td>
                                    <td><span class="">Item Code</span></td>
                                    <td><span class="">Item Barocode</span></td>
                                    <td><span class="">Case/Box Barocde</span></td>
                                    <td><span class="">Item Group</span></td>
                                    <td><span class="">ICO</span></td>
                                    <td><span class="">Supplier</span></td>
                                    <td><span class="">Is Expiry?</span></td>
                                    <td><span class="">Applied VAT?</span></td>
                                    <td><span class="">Purchase Cost</span></td>
                                    <td><span class="">Sales Cost</span></td>
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
                            <label class="form-label" for="item-name">Item Group</label>
                            <select class="form-select-item-group" v-model="selected_item_group" :options="options_item_group" name="item-group">
                            <!-- <option></option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Item Code</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Item Description</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Shortname</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Item Barcode</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Item Shortname</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Case/Box Barcode</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Supplier Name</label>
                            <select class="form-select" name="state">
                                <option value="AL">Alabama</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>
                   
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="business-name">Re-Order Qty</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input v-model="formdata.is_expiry" type="checkbox" class="custom-control-input" id="customCheck3">
                                <label class="custom-control-label" for="customCheck3">Is Expiry?</label>
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
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#inventory">Inventory</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#system">System</a>    
                        </li>      
                    </ul>

                    <div class="tab-content">    
                        <div class="tab-pane active" id="account">
                    
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Income Account</label>
                                    <select class="form-select" name="state">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Cost Of Sales</label>
                                    <select class="form-select" name="state">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input v-model="formdata.is_sales_item" type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Applied VAT?</label>
                                    </div>
                                </div>
                            </div>
 
                        </div>

                        <div class="tab-pane" id="category">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Department</label>
                                    <select class="form-select" name="state">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Sub-Department</label>
                                    <select class="form-select" name="state">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Category</label>
                                    <select class="form-select" name="state">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Brand</label>
                                    <select class="form-select" name="state">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="business-name">Brand Form</label>
                                    <select class="form-select" name="state">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>        
      
                        </div>
                        <div class="tab-pane" id="cost"> 
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input v-model="formdata.is_purchase_item" type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Is Purchase Item?</label>
                                        </div>
                                    </div>
                                    <div v-show="formdata.is_purchase_item" class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="business-name">Purchase UOM</label>
                                                <select class="form-select" name="state">
                                                    <option value="AL">PC</option>
                                                    <option value="WY">CS</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="business-name">Purchase Cost</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input v-model="formdata.is_sales_item" type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Is Sales Item?</label>
                                        </div>
                                    </div>
                                    <div v-show="formdata.is_sales_item" class="row">
                                        
                                        
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="business-name">Sales UOM</label>
                                                <select class="form-select" name="state">
                                                    <option value="AL">PC</option>
                                                    <option value="WY">CS</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="business-name">Sales Cost</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="business-name">Transfer Cost</label>
                                                <div class="form-control-wrap">
                                                    <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>   
                        <div class="tab-pane" id="unit-of-measure">        
      
                        </div>   
                        <div class="tab-pane" id="asset">        
      
                        </div>   
                        <div class="tab-pane" id="inventory">        
      
                        </div>   
                        <div class="tab-pane" id="system">        
      
                        </div>       
                    </div>
                
            </form>
            <div style="margin-top:30px; text-align:right;">
                <button v-if="formdata.uuid === null" @click="toggleForm()()" type="submit" class="btn btn-lg btn-primary">Save</button>
                <button v-else @click="toggleForm()()" type="submit" class="btn btn-lg btn-primary">Save Changes</button>
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
            selected_item_group: null,
            options_item_group: [],
            locations: [],
            location_groups: [],
            show_form: false,
            formdata: { 
                uuid: null, 
                location_code: '', 
                location_name: '', 
                location_shortname: '',
                is_purchase_item: false,
                is_sales_item: false,
                is_expiry: false,
            },
            formLocationGroup: {
                uuid: null, 
                location_group_name: '',
                form: 'hidden'
            }
        }
    },
    methods: {
        toggleForm() {
            var scope = this
            scope.show_form = !scope.show_form
        },
        getLocations: function () {
           var scope = this
            scope.GET('locations').then(res => {
                scope.locations = res.rows
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
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.location_code = ''
            scope.formdata.location_name = ''
            scope.formdata.location_shortname = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.location_code = data.location_code
            scope.formdata.location_name = data.location_name
            scope.formdata.location_shortname = data.location_shortname
        },
        save: function () {
            var scope = this
            scope.POST('locations', scope.formdata).then(res => {
                if (res.success) {
                    scope.locations.push(res.data)
                    scope.CLOSE_MODAL('#modalLocation')
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.PUT('locations', scope.formdata).then(res => {
                if (res.success) {
                    scope.getLocations()
                    scope.CLOSE_MODAL('#modalLocation')
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        editGroupToggle(group) {
            var scope = this
            scope.$set(group,'edit',!group.edit)
            scope.$set(group,'temp',group.location_group_name)
        },
        formLocationGroupToggle(name) {
            var scope = this

            if (scope.formLocationGroup.form === name) {
                scope.formLocationGroup.form = 'hidden'
                return
            }
            scope.formLocationGroup.form = name
        },
        getLocationGroups: function () {
            var scope = this
            scope.GET('locations/groups').then(res => {
                scope.location_groups = res.rows
            })
        },
        saveLocationGroup: function () {
            var scope = this
            scope.POST('locations/groups', scope.formLocationGroup).then(res => {
                if (res.success) {
                    scope.location_groups.push(res.data)
                    scope.formLocationGroup.location_group_name = ''
                    // scope.CLOSE_MODAL('#modalGroup')
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        updateLocationGroup: function (data) {
            var scope = this
            scope.PUT('locations/groups', data).then(res => {
                if (res.success) {
                    scope.$set(data,'edit',false)
                    scope.$set(data,'location_group_name',res.data.location_group_name)
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
    },
    mounted() {
        var scope = this
        scope.getAllItemGroup()

        $('.form-select-item-group').on("change", function(e) { 
            scope.selected_item_group = $('.form-select-item-group').val();
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