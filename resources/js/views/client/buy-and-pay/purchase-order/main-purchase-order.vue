<template>
    <div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">Purchase Orders</div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" placeholder="Search Purchase Order">
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalPurchaseOrder');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New Purchase Order</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th width="120">Actions</th>
                                <th width="100">#</th>
                                <th>PO No.</th>
                                <th>PO Date</th>
                                <th>Supplier</th>    
                                <th>Amount</th> 
                                <th>Status</th> 
                                <th>Reason Code</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(purchase, index) in purchaseOrders" :key="purchase.uuid" class="tb-tnx-item">
                                <td>
                                    <a href="javascript:void(0)"  @click="ROUTE({path: '/purchase-order/' + purchase.uuid })" class="btn btn-sm btn-light"><i class="bx bx bx-detail"></i></a>
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalPurchaseOrder');setData(purchase)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(chain)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                                <td><span class="">{{ (index + 1) }}</span></td>
                                <td><span class="">{{purchase.po_no}}</span></td>
                                <td><span class="">{{purchase.date_purchased}}</span></td>
                                <td><span class="">{{ purchase.supplier.business_shortname }}</span></td>
                                <td><span class=""></span></td>
                                <td><span class="">{{ purchase.status }}</span></td>
                                <!-- <td><span class="">{{ purchase.order_reason_code.reason_code }}</span></td> -->
                                 <td><span class=""></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalPurchaseOrder">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Purchase Order Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalPurchaseOrder');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
<!-- 
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label">PO No.: </label>
                                        <label class="form-label" >{{formdata.po_no}}</label>
                                    </div>
                                </div> -->

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="item-group">PO Type</label>
                                        <select class="form-select-item-group" v-model="selected_item_group" :options="options_item_group" name="item-group">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12" v-show="show_asset_group">
                                    <div class="form-group">
                                        <label class="form-label" for="asset-group">Asset Group</label>
                                        <select class="form-select-asset-group" v-model="selected_asset_group" :options="options_asset_group" name="asset-group">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="date-terminated">PO Date</label>
                                        <div class="form-control-wrap">
                                            <date-picker v-model="formdata.date_purchased" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="supplier">Supplier</label>
                                        <select class="form-select-supplier" v-model="selected_supplier" :options="options_supplier" name="supplier">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="date-terminated">Term:</label>
                                            <strong><span>{{formdata.term}}</span></strong>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="discount-group">Discount Group</label>
                                        <select class="form-select-item-discount-group" v-model="selected_item_discount_group" :options="options_item_discount_group" name="discount-group">
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="date-terminated">Expected Date</label>
                                        <div class="form-control-wrap">
                                            <date-picker v-model="formdata.date_expected" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="branch">Branch: </label>
                                        <strong><span>{{branch_name}}</span></strong>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="branch-location">Location</label>
                                        <select class="form-select-branch-location" v-model="selected_branch_location" :options="options_branch_location" name="branch-location">
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="asset-group">Reason Code</label>
                                        <select class="form-select-reason-code" v-model="selected_reason_code" :options="options_reason_code" name="reason-code">
                                        </select>
                                    </div>
                                </div>   -->
                                
                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="formdata.uuid === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                        <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</template>

<script>

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {
            selected_item_group: null,
            options_item_group: [],

            selected_supplier: [],
            options_supplier: [],

            selected_asset_group: null,
            options_asset_group: [],

            selected_reason_code: null,
            options_reason_code: [],

            selected_item_discount_group: null,
            options_item_discount_group: [],

            selected_branch_location: null,
            options_branch_location: [],

            show_asset_group: false,

            branch_name: '',

            purchaseOrders: [],
            formdata: { 
                uuid: null, 
                po_no: '',
                item_group_uuid: '',
                asset_group_uuid: '',
                item_discount_group_uuid: '',
                term: '',
                date_purchased: '',
                date_expected: '',
                supplier_uuid: '',
                status: 'open',
                orders_reason_code_uuid: '',
                is_apply_tax: 0,
                branch_uuid: '',
                branch_locations_uuid: ''
            },

        }
    },
    methods: {
        getPurchaseOrders: function () {
           var scope = this
            scope.GET('buy-and-pay/orders').then(res => {
                scope.purchaseOrders = res.rows
            })
        },

        getBranch: function () {
           var scope = this
            scope.GET('users/get-branch').then(res => {
                scope.formdata.branch_uuid = res.rows.branch_uuid
                scope.branch_name = res.rows.branch_name
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

        getItemDiscountGroup: function () {
           var scope = this
            scope.GET('items/item-discount-group').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_item_discount_group.push({
                        id: data.uuid,
                        text: data.group_name
                    })
                
                })

                $(".form-select-item-discount-group").select2({data: scope.options_item_discount_group});
                scope.selected_item_discount_group = scope.options_item_discount_group[0].id
                
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
            })

        },
        getSupplier: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.business_shortname,
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
            })
        },

        checkLeadTime: function() {
            var scope = this
            for (var i = 0; i < scope.options_supplier.length; i++) {
                if(scope.options_supplier[i].id==scope.selected_supplier){
                    
                    scope.formdata.term = scope.options_supplier[i].lead_time
                    scope.formdata.date_expected = moment().add(scope.options_supplier[i].lead_time ,'days').format('YYYY-MM-DD')
                    
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

        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.po_no = ''
            scope.formdata.item_group_uuid = ''
            scope.formdata.asset_group_uuid = ''
            scope.formdata.item_discount_group_uuid = ''
            scope.formdata.date_purchased = moment().format('YYYY-MM-DD')
            // scope.formdata.date_expected = moment().format('YYYY-MM-DD')
            scope.formdata.supplier_uuid = ''
            scope.formdata.status = 'Open'
            scope.formdata.orders_reason_code_uuid = ''
            scope.formdata.branch_locations_uuid = ''

            scope.show_asset_group = false
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.po_no = data.po_no
            scope.formdata.date_purchased = data.date_purchased
            scope.formdata.date_expected = data.date_expected
            scope.formdata.status = data.status

            scope.formdata.term = data.term

            $('.form-select-item-group').val(data.item_group_uuid);
            $('.form-select-item-group').trigger('change');

            $('.form-select-asset-group').val(data.asset_group_uuid);
            $('.form-select-asset-group').trigger('change');

            $('.form-select-supplier').val(data.supplier_uuid);
            $('.form-select-supplier').trigger('change');

            $('.form-select-orders_reason_code').val(data.orders_reason_code_uuid);
            $('.form-select-orders_reason_code').trigger('change');

            $('.form-select-item-discount-group').val(data.item_discount_group_uuid);
            $('.form-select-item-discount-group').trigger('change');

            $('.form-select-branch-location').val(data.branch_locations_uuid);
            $('.form-select--branch-location').trigger('change');

        },
        save: function () {
            var scope = this
            scope.formdata.item_group_uuid = scope.selected_item_group
            scope.formdata.asset_group_uuid = scope.selected_asset_group
            scope.formdata.supplier_uuid = scope.selected_supplier
            scope.formdata.orders_reason_code_uuid = scope.selected_reason_code
            scope.formdata.item_discount_group_uuid = scope.selected_item_discount_group
            scope.formdata.branch_locations_uuid = scope.selected_branch_location


            scope.POST('buy-and-pay/order', scope.formdata).then(res => {
            if (res.success) {
                window.swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Orders Successfuly Saved',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    scope.getPurchaseOrders()
                    scope.CLOSE_MODAL('#modalPurchaseOrder')
                })
            } else {
                alert('ERROR:' + res.code)
            } 
            })
        },

        update: function () {
            var scope = this
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
                    scope.POST('buy-and-pay/order', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Chain Successfuly Updated',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.getCustomerChains()
                            scope.CLOSE_MODAL('#modalPurchaseOrder')
                        })
                    } else {
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
                    scope.POST('globals/customer-chain/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Chain Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCustomerChains()
                            scope.CLOSE_MODAL('#modalPurchaseOrder')
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        }
    },
    mounted() {
        var scope = this
        scope.getPurchaseOrders()
        scope.getItemGroup()
        scope.getAssetGroup()
        scope.getSupplier()
        scope.getOrderReasonCodes()
        scope.getItemDiscountGroup()

        scope.getBranch()
        scope.getBranchLocations()


        scope.formdata.po_no = scope.company_prefix + '_' 


        $('.form-select-item-group').on("change", function(e) { 
            scope.selected_item_group = $('.form-select-item-group').val();
            scope.checkAsset()
        })

        $('.form-select-supplier').on("change", function(e) { 
            scope.selected_supplier = $('.form-select-supplier').val();
            scope.checkLeadTime()
        })

        $('.form-select-asset-group').on("change", function(e) { 
            scope.selected_asset_group = $('.form-select-asset-group').val();
        })

        $('.form-select-reason-code').on("change", function(e) { 
            scope.selected_reason_code = $('.form-select-reason-code').val();
        })

         $('.form-select-item-discount-group').on("change", function(e) { 
            scope.selected_item_discount_group = $('.form-select-item-discount-group').val();
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