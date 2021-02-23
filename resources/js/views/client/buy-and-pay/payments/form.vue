<template>
    <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><!--<i class="las la-list-ul"></i>--> New Payment Entry</h1>
                </div>
                <div class="bar-right">
                    <a @click="ROUTE({path: '/purchase-order-main' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-x"></i> <span>Cancel</span>
                    </a>
                    <a @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-saves"></i> <span>Next</span>
                    </a>
                </div>
            </div>
                    
            <div class="card hx-card-override no-header">
                <div class="card-body">
                    
                    <div class="row">


                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Entry Type</label>
                                <select class="form-control">
                                    <option value="Pay">Pay</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Supplier</label>
                                <select class="form-select-supplier" v-model="formdata.supplier_uuid" :options="options_supplier" name="supplier"></select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Mode</label>
                                <select class="form-control">
                                    <option value="Cash">Cash</option>
                                    <option value="Check">Check</option>
                                    <option value="Direct to Bank">Direct to Bank</option>
                                    <option value="Adjustment +">Adjustment +</option>
                                    <option value="Adjustment -">Adjustment -</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="date-terminated">Date</label>
                                <div class="form-control-wrap">
                                    <date-picker v-model="formdata.date_expected" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Check No.</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="date-terminated">Check Date</label>
                                <div class="form-control-wrap">
                                    <date-picker v-model="formdata.date_expected" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                </div>
                            </div>
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
            

            selected_supplier: [],
            options_supplier: [],

            formdata: {
                supplier_uuid: null
            }

        }
    },
    computed: {
    },
    methods: {
        getSupplier: function () {
           var scope = this
            scope.GET('suppliers').then(res => {

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

                    scope.GET('company/taxation/' + scope.options_supplier[0].vat_uuid).then(res => {
                        scope.formdata.supplier_tax_rate = res.rows.tax_rate
                    })
                }
                else{
                    scope.formdata.is_apply_tax = 0
                    scope.formdata.supplier_tax_rate = 0
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
        save: function () {
            var scope = this
            scope.formdata.item_group_uuid = scope.selected_item_group
            scope.formdata.asset_group_uuid = scope.selected_asset_group
            scope.formdata.supplier_uuid = scope.selected_supplier
            scope.formdata.orders_reason_code_uuid = scope.selected_reason_code
            scope.formdata.selected_supplier_discount_groups = scope.selected_supplier_discount_groups
            scope.formdata.branch_locations_uuid = scope.selected_branch_location

            scope.POST('buy-and-pay/orders', scope.formdata).then(res => {
                if (res.success) {
                    if (!scope.$props.order) {
                        scope.ROUTE({path: '/buy-and-pay/orders/' + res.data.uuid + '/edit'})
                    } else {
                        scope.$parent.loadData()
                        scope.toggleEdit();
                    }
                } else {
                    alert('ERROR:' + res.code)
                } 
            })
        }
    },
    mounted() {
        var scope = this

        scope.getSupplier()
        


        $('.form-select-supplier').on("change", function(e) { 
            scope.selected_supplier = $('.form-select-supplier').val();
        })

      
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>