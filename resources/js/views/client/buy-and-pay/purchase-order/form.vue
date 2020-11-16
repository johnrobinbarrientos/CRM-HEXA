<template>
    <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Purchase Orders</h1>
                </div>
                <div class="bar-right">
                    <a @click="ROUTE({path: '/purchase-order-main' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-x"></i> <span>Cancel</span>
                    </a>
                    <a @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-saves"></i> <span>Save</span>
                    </a>
                </div>
            </div>
                    
            <div>
                    <form action="#" class="form-validate is-alter">
                    <div class="row">
                        <div class="col-md-6 col-12">

                            <div class="form-group">
                                <label class="form-label" for="item-group">PO Type</label>
                                <select class="form-select-item-group" v-model="selected_item_group" :options="options_item_group" name="item-group">
                                </select>
                            </div>

                            <div class="form-group" v-show="show_asset_group">
                                <label class="form-label" for="asset-group">Asset Group</label>
                                <select class="form-select-asset-group" v-model="selected_asset_group" :options="options_asset_group" name="asset-group">
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="item-group">Branch</label>
                                <input type="text" class="form-control disabled" v-model="branch_name" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="branch-location">Location</label>
                                <select class="form-select-branch-location" v-model="selected_branch_location" :options="options_branch_location" name="branch-location">
                                </select>
                            </div>
                            
                        
                            <div class="form-group">
                                <label class="form-label" for="supplier">Supplier</label>
                                <select class="form-select-supplier" v-model="selected_supplier" :options="options_supplier" name="supplier">
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="discount-group">Discount Group</label>
                                <select class="form-select-supplier-discount-group" multiple="multiple" v-model="selected_item_discount_group" :options="options_item_discount_group" name="discount-group">
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="item-group">Term</label>
                                <input type="text" class="form-control disabled" v-model="formdata.term" readonly>
                            </div>
                        </div>


                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="date-terminated">PO Date</label>
                                <div class="form-control-wrap">
                                    <date-picker v-model="formdata.date_purchased" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="date-terminated">Expected Date</label>
                                <div class="form-control-wrap">
                                    <date-picker v-model="formdata.date_expected" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                </div>
                            </div>
                        </div>

                                                
                    </div>                                                    
                </form>
            </div>

    </div>
</template>

<script>

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'purchase-order-form',
    props: ['form','order','view_mode'],
    data: function () {
        return {
            edit: false,
            //ready: false,
            prerequisite: {
                getBranch: false,
                getBranchLocations: false,
                getSupplierDiscountGroup: false,
                getAssetGroup: false,
                getOrderReasonCodes: false,
                getSupplier: false,
            },
            selected_item_group: null,
            options_item_group: [],

            selected_supplier: [],
            options_supplier: [],

            selected_asset_group: null,
            options_asset_group: [],

            selected_reason_code: null,
            options_reason_code: [],

            selected_item_discount_group: [],
            options_item_discount_group: [],

            selected_branch_location: null,
            options_branch_location: [],

            show_asset_group: false,

            branch_name: '',

            selected_supplier_discount_groups: [],
            formdata: { 
                uuid: null, 
                po_no: '',
                item_group_uuid: '',
                asset_group_uuid: '',
                selected_supplier_discount_groups: [],
                term: '',
                date_purchased: moment(),
                date_expected: '',
                supplier_uuid: '',
                po_status: 'To Receive',
                orders_reason_code_uuid: '',
                is_apply_tax: 0,
                branch_uuid: '',
                branch_locations_uuid: ''
            },
        }
    },
    computed: {
        ready: function () {
            console.log(this.prerequisite)
            if (this.prerequisite.getBranch && this.prerequisite.getBranchLocations && this.prerequisite.getSupplierDiscountGroup 
                && this.prerequisite.getAssetGroup && this.prerequisite.getOrderReasonCodes && this.prerequisite.getItemGroup) {
                return true
            }
            return false
        }
    },
    methods: {
        test: function() {
            alert(this.formdata.date_purchased)
        },
        toggleEdit: function () {
            var scope = this
            scope.edit = !scope.edit

            if (scope.edit) {
                scope.loadFormFields();
            } else {
                scope.prerequisite.getBranch = false
                scope.prerequisite.getBranchLocations = false
                scope.prerequisite.getSupplierDiscountGroup = false
                scope.prerequisite.getAssetGroup = false
                scope.prerequisite.getOrderReasonCodes = false
                scope.prerequisite.getSupplier = false
                scope.prerequisite.getItemGroup = false
            }
        },
        getBranch: function () {
           var scope = this
            scope.GET('users/get-branch').then(res => {
                scope.formdata.branch_uuid = res.rows.branch_uuid
                scope.branch_name = res.rows.branch_name

                scope.prerequisite.getBranch = true

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
                
                scope.prerequisite.getItemGroup = true
            })
        },
        getBranchLocations: function () {
           var scope = this
            scope.GET('users/get-branch-locations').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_branch_location.push({
                        id: data.uuid,
                        text: data.location_name
                    })
                
                })

                $(".form-select-branch-location").select2({data: scope.options_branch_location});
                scope.selected_branch_location = scope.options_branch_location[0].id

                scope.prerequisite.getBranchLocations = true
            })
        },
        getSupplierDiscountGroup: function (suppier_uuid) {
            var scope = this
            scope.options_item_discount_group = []
            

            scope.GET('suppliers/' + suppier_uuid + '/supplier-base-discount-group').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_item_discount_group.push({
                        id: data.uuid,
                        text: data.group_name
                    })
                })

                $(".form-select-supplier-discount-group").select2();
                $(".form-select-supplier-discount-group").html('');
                $(".form-select-supplier-discount-group").select2({data: scope.options_item_discount_group});

                
                $(".form-select-supplier-discount-group").val(scope.selected_item_discount_group).trigger('change');
            

                scope.prerequisite.getSupplierDiscountGroup = true
                    
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

                scope.prerequisite.getAssetGroup = true
            })

        },
        getOrderReasonCodes: function () {
           var scope = this
           
           scope.options_reason_code.push({
               id: '',
               text: 'NONE'
           });

            scope.GET('buy-and-pay/order-reason-code').then(res => {
                
                res.rows.forEach(function (data) {
                    scope.options_reason_code.push({
                        id: data.uuid,
                        text: data.reason_code
                    })
                })

                $(".form-select-reason-code").select2({data: scope.options_reason_code});

                scope.prerequisite.getOrderReasonCodes = true
            })

        },
        getSupplier: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.supplier_shortname,
                        lead_time: data.lead_time,
                        vat_uuid: data.vat_uuid
                    })
                
                })

                if (scope.options_supplier[0].vat_uuid!==null){
                    scope.formdata.is_apply_tax = 1
                }
                else{
                    scope.formdata.is_apply_tax = 0
                }
                
                scope.formdata.term = scope.options_supplier[0].lead_time
                scope.formdata.date_expected = moment().add(parseInt(scope.options_supplier[0].lead_time) ,'days').format('YYYY-MM-DD')

                $(".form-select-supplier").select2({data: scope.options_supplier});

                if (scope.order && scope.order.supplier_uuid) {
                    $(".form-select-supplier").val(scope.order.supplier_uuid).trigger('change');
                } else {
                    $(".form-select-supplier").trigger('change');
                }
                
               

                scope.prerequisite.getSupplier = true
            })
        },

        checkLeadTime: function() {
            var scope = this

            for (var i = 0; i < scope.options_supplier.length; i++) {
                if(scope.options_supplier[i].id==scope.selected_supplier){
                    
                    scope.formdata.term = scope.options_supplier[i].lead_time
                    scope.formdata.date_expected = moment().add(scope.formdata.term ,'days').format('YYYY-MM-DD')
                    
                    if (scope.options_supplier[i].vat_uuid!==null){
                        scope.formdata.is_apply_tax = 1
                    }
                    else{
                        scope.formdata.is_apply_tax = 0
                    }
                }
            }
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
            scope.formdata.asset_group_uuid = scope.selected_asset_group
            scope.formdata.supplier_uuid = scope.selected_supplier
            scope.formdata.orders_reason_code_uuid = scope.selected_reason_code
            scope.formdata.selected_supplier_discount_groups = scope.selected_supplier_discount_groups
            scope.formdata.branch_locations_uuid = scope.selected_branch_location

            console.log('asdsad')
            console.log(scope.formdata.item_group_uuid )


            scope.POST('buy-and-pay/order', scope.formdata).then(res => {
            if (res.success) {
                window.swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Orders Successfuly Saved',
                    showConfirmButton: false,
                    timer: 1000
                }).then(() => {
                    if (!scope.$props.order) {
                        scope.ROUTE({path: '/purchase-orders/' + res.data.uuid })
                    } else {

                        scope.$parent.loadData()

                        scope.toggleEdit();
                    }
                })
            } else {
                alert('ERROR:' + res.code)
            } 
            })
        },
        loadFormFields: function () {
            var scope = this
            scope.getItemGroup()
            scope.getAssetGroup()
            scope.getSupplier()
            scope.getOrderReasonCodes()

            scope.getBranch()
            scope.getBranchLocations()

            if (!scope.$props.order) {
                scope.checkLeadTime()
            } else {

                scope.formdata.date_purchased = scope.$props.order.date_purchased
                scope.formdata.date_expected = scope.$props.order.date_expected

                $('.form-select-supplier').val(scope.formdata.supplier_uuid);
                $('.form-select-supplier').trigger('change');

                $('.form-select-branch-location').val(scope.order.branch_locations_uuid);
                $('.form-select-branch-location').trigger('change');

            }
        }
    },
    mounted() {
        var scope = this

        scope.loadFormFields();

      
        $(".form-select-supplier").on('change',function(){
            var suppier_uuid = $(".form-select-supplier").val()
            //scope.formdata.supplier_uuid = suppier_uuid
            scope.checkLeadTime()
            scope.getSupplierDiscountGroup(suppier_uuid)
        });
        
        $(".form-select-supplier-discount-group").on('change',function(){
            var ids = $(".form-select-supplier-discount-group").val()
            scope.selected_supplier_discount_groups = ids
        });


        $('.form-select-item-group').on("change", function(e) { 
            scope.selected_item_group = $('.form-select-item-group').val();
            scope.checkAsset()
        })

        $('.form-select-supplier').on("change", function(e) { 
            scope.selected_supplier = $('.form-select-supplier').val();
        })

        $('.form-select-asset-group').on("change", function(e) { 
            scope.selected_asset_group = $('.form-select-asset-group').val();
        })

        $('.form-select-reason-code').on("change", function(e) { 
            scope.selected_reason_code = $('.form-select-reason-code').val();
        })


        $('.form-select-branch-location').on("change", function(e) { 
            scope.selected_branch_location = $('.form-select-branch-location').val();
        })        
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>