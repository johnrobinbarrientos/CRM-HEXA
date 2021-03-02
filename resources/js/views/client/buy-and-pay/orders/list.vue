<template>
    <div>

            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i>Purchase Orders</h1>
                </div>
                    <div class="bar-right">
                        <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                        <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                        </select>
                        <a @click="ROUTE({path: '/buy-and-pay/orders/create' });" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                            <i class="las la-plus"></i> <span>New</span>
                        </a>

                    </div>
            </div>

            <div v-if="listLoading" class="text-center my-3 text-loader">
                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
            </div>

            <div v-else class="table-responsive;">

                <div class="table-filter">
                    <div class="table-filter-row">
                        <div class="select-wrap">
                            <select @change="getPurchaseOrders()" v-model="selected_item_group">
                                <option value="">Item Type</option>     
                                <option v-for="item_type in options_item_group" :value="item_type.id" :key="'option-' + item_type.id ">{{ item_type.text }}</option>
                            </select>
                        </div>
                        <div class="select-wrap">
                            <select  @change="getPurchaseOrders()" v-model="selected_supplier">
                                <option value="">Supplier</option>
                                <option v-for="supplier in options_supplier" :value="supplier.id"  :key="'option-' + supplier.id ">{{ supplier.text }}</option>
                            </select>
                        </div>
                        <div class="select-wrap">
                            <select  @change="getPurchaseOrders()" v-model="selected_branch">
                                <option value="">Branch</option>
                                <option v-for="branch in options_branch" :value="branch.id"  :key="'option-' + branch.id ">{{ branch.text }}</option>
                            </select>
                        </div>
                        <div class="select-wrap">
                            <select  @change="getPurchaseOrders()" v-model="selected_branch_location">
                                <option value="">Location</option>
                                <option v-for="location in options_branch_location" :value="location.id"  :key="'option-' + location.id ">{{ location.text }}</option>
                            </select>
                        </div>
                        <div class="select-wrap">
                            <select  @change="getPurchaseOrders()" v-model="selected_status">
                                <option value="">Status</option>
                                <option value="To Receive">To Receive</option>
                                <option value="Partially Received">Partially Received</option>
                                <option value="Fully Received">Fully Received</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="select-wrap">
                            <select  @change="getPurchaseOrders()" v-model="selected_reason_code_filter">
                                <option value="">Reason Code</option>
                                <option v-for="reason_code in options_reason_code" :value="reason_code.id"  :key="'option-' + reason_code.id ">{{ reason_code.text }}</option>
                            </select>
                        </div>
                        <div class="select-wrap">
                            <date-picker class="transaction-from" placeholder="Start Date" :config="{format: 'DD-MMM-YYYY'}" v-model="transaction_from" style="border:none; padding:3px !important; min-height:0px !important; height:27px !important; background:transparent !important;"></date-picker>
                        </div>
                        <div class="select-wrap">
                            <date-picker class="transaction-to"  placeholder="End Date" :config="{format: 'DD-MMM-YYYY'}" v-model="transaction_to" style="border:none; padding:3px !important; min-height:0px !important; height:27px !important; background:transparent !important;"></date-picker>
                        </div>
                        <div class="select-wrap options-wrap" style="width:60px !important;">
                            <b-button @click="reset()" variant="outline-secondary" size="sm">Reset</b-button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover table-striped
                ">
                    <thead class="th-nowrap">
                        <tr>
                            <th  width="105">Action</th>
                            <th>Item Type</th>
                            <th>Transaction No.</th>
                            <th>Supplier Name</th>
                            <th>Branch</th>
                            <th>Location</th>
                            <th>Transaction Date</th>
                            <th>Expected Date</th>
                            <th>Amount</th>
                            <th>Term</th>

                            <th>Status</th> 
                            <th>Reason Code</th> 
                        </tr>
                    </thead>
                    <tbody class="td-border-bottom-black">
                        <template v-if="purchaseOrders.length > 0">
                            
                            <tr v-for="(purchase) in purchaseOrders" :key="purchase.uuid">
                                <td>  
                                    <span v-if="purchase.po_status == 'To Receive'" class="hx-table-actions">
                                        <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/orders/' + purchase.uuid +'/edit'  })">
                                            <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/orders/' + purchase.uuid + '/edit'})">Edit</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/orders/' + purchase.uuid +'/view' })">View</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)">Reason Code</b-dropdown-item>
                                            <b-dropdown-item href="#" @click="cancel()">Cancel</b-dropdown-item>
                                        </b-dropdown>
                                    </span>
                                    <span v-else class="hx-table-actions">
                                        <b-dropdown split text="View" size ="sm" class="m-2" href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/orders/' + purchase.uuid + '/view' })">
                                            <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/buy-and-pay/orders/' + purchase.uuid + '/view' })">View</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)">Reason Code</b-dropdown-item>
                                        </b-dropdown>
                                    </span>
                                </td>
                                
                                <td width="100">{{ purchase.item_group.item_group }}</td>
                                <td width="200">{{ purchase.po_no }}</td>
                                <td width="200">{{ purchase.supplier.supplier_name }}</td>
                                <td>{{ purchase.branch.branch_shortname.toUpperCase()}}</td>
                                <td>{{ purchase.branch_location.location_shortname.toUpperCase()}}</td>
                                <td width="120">{{ moment(purchase.date_purchased) }}</td>
                                <td width="120">{{ moment(purchase.date_expected) }}</td>

                                <td v-if="purchase.po_total_amount == 0" class="text-right">0.00</td>
                                <td v-else class="text-right">{{putSeparator(purchase.po_total_amount.toFixed(2))}}</td>
                                
                                <td v-if="purchase.term > 1">{{ purchase.term }} Days</td>
                                <td v-else-if ="purchase.term === 1">{{ purchase.term }} Day</td>
                                <td v-else></td>
                                
                                <td v-if="purchase.po_status === 'To Receive'" class="editable" width="150">
                                    <span class="badge badge-danger">To Receive</span>
                                </td>
                                <td v-else-if="purchase.po_status === 'Partially Received'" class="editable" width="150">
                                    <span class="badge badge-warning">Partially Received</span>
                                </td>
                                <td v-else-if="purchase.po_status === 'Cancelled'" class="editable" width="150">
                                    <span class="badge badge-secondary">Cancelled</span>
                                </td>
                                <td v-else-if="purchase.po_status === 'Fully Received'" class="editable" width="150">
                                    <span class="badge badge-success">Fully Received</span>
                                </td>

                                <td class="editable" width="150">
                                    <span v-if="purchase.order_reason_code==null" class="cursor-pointer"></span>
                                    <span v-else class="cursor-pointer">{{ purchase.order_reason_code.short_name }}</span>
                                    <select @change="changeReasonCode(purchase.uuid)" v-model="selected_reason_code" type="text" class="editable-control">
                                        <option :value="reasoncode.id " v-for="(reasoncode,index) in options_reason_code" :key="index">{{ reasoncode.text }}</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7"></td>
                                <td style="border-left: 2px solid #eee">
                                    <span><strong>Total:</strong></span>
                                </td>
                                <td class="text-right">
                                    <span v-if="grand_total==0"><strong>0.00</strong></span>
                                    <span v-else><strong>{{putSeparator(grand_total.toFixed(2))}}</strong></span>
                                </td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="13">
                                    <div style="margin-bottom: 2px;"></div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="13" class="text-center">
                                    <strong style="display: block; height: 30px; line-height: 30px;">No Transactions</strong>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div style="padding:10px; padding-top:20px; padding-bottom:0px;"> Showing {{ listOffset + 1  }} to {{ listOffset +  listResults }} of  {{ listCount }} entries</div>
                <nav style="float:right;" v-if="listTotalPages > 1" class="pagination pagination-rounded mt-4" aria-label="pagination">
                    <ul class="pagination">
                        <li @click="listPaginate('prev')"  v-bind:class="{'disabled' : listCurrentPage <= 1}"  class="page-item" >
                            <a href="javascript:void(0)" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">‹</span><span class="sr-only">Previous</span>
                            </a>
                        </li>

                        
                        <li @click="listPaginate(page)" v-for="page in listTotalPages" :key="page" class="page-item" v-bind:class="{'active' : page === listCurrentPage}">
                            <a href="javascript:void(0)" class="page-link">
                                {{ page }}
                            </a>
                        </li>
                        
                        <li @click="listPaginate('next')" v-bind:class="{'disabled' : listCurrentPage >= listTotalPages}" class="page-item">
                            <a href="javascript:void(0)" class="page-link" aria-label="Next"><span aria-hidden="true">›</span><span class="sr-only">Next</span></a>
                        </li>
                    </ul>
                </nav>

            </div>

    </div>
</template>

<script>
import ReasonCodes from './reason-codes'
import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {
            prerequisite: {
                getBranch: false,
                getBranchLocations: false,
                getSupplierDiscountGroup: false,
                getAssetGroup: false,
                getOrderReasonCodes: false,
                getSupplier: false,
            },

            transaction_from: null,
            transaction_to: null,

            selected_item_group: '',
            options_item_group: [],

            selected_supplier: '',
            options_supplier: [],

            selected_asset_group: '',
            options_asset_group: [],

            selected_reason_code: '',

            selected_reason_code_filter: '',
            options_reason_code: [],

            selected_item_discount_group: '',
            options_item_discount_group: [],

            selected_branch: '',
            options_branch: [],

            selected_branch_location: '',
            options_branch_location: [],

            selected_status: '',

            purchaseOrders: [],
            grand_total: 0,
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            listOffset: 0,
            listResults: 0,
            searchKeyword: '',
            timer: null,
        }
    },
    components: {
        'reason-codes': ReasonCodes,
    },
    watch: {
        transaction_from: function () {
            var scope = this
            scope.getPurchaseOrders()
        },
        transaction_to: function () {
            var scope = this
            scope.getPurchaseOrders()
        }
    },
    computed: {
        listTotalPages: function () {
            var scope = this
            var pages = Math.ceil(scope.listCount / scope.listItemPerPage)
            return pages
        },
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
        reset: function () {
            var scope = this
            scope.selected_item_group = ""
            scope.selected_supplier = ""
            scope.selected_branch = ""
            scope.selected_branch_location = ""
            scope.selected_status = ""
            scope.selected_reason_code_filter = ""
            scope.transaction_to = ""
            scope.transaction_from = ""
            scope.getPurchaseOrders()
        },
        moment: function (date) {
            return moment(date).format('DD-MMM-YYYY')
        },
        putSeparator: function(value) {
            var num_parts = value.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        },
        getPurchaseOrders: function () {
           var scope = this

            scope.listLoading = true
            scope.purchaseOrders = []

            var params = {
                item_group: scope.selected_item_group,
                supplier: scope.selected_supplier,
                reason_code: scope.selected_reason_code_filter,
                item_discount_group: scope.selected_item_discount_group,
                branch: scope.selected_branch,
                branch_location: scope.selected_branch_location,
                status: scope.selected_status,
                from: scope.transaction_from,
                to: scope.transaction_to,
            }

            var str = jQuery.param( params );
            
            scope.GET('buy-and-pay/orders?type=order&keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage + '&' + str).then(res => {
                scope.purchaseOrders = res.rows
                scope.grand_total = res.grand_total

                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        getReasonCodes: function () {
           var scope = this

           scope.options_reason_code.push({
               id: '',
               text: 'None'
           });

            scope.GET('reason-codes?type=purchase-order').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_reason_code.push({
                        id: data.uuid,
                        text: data.details
                    })
                
                })
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

                //$(".form-select-item-group").select2({data: scope.options_item_group});
                //scope.selected_item_group = scope.options_item_group[0].id
                
                scope.prerequisite.getItemGroup = true
            })
        },
        getBranch: function () {
           var scope = this
            scope.GET('companies/branches').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_branch.push({
                        id: data.uuid,
                        text: data.branch_name
                    })
                
                })

                scope.prerequisite.getBranch = true

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

                //$(".form-select-branch-location").select2({data: scope.options_branch_location});
                //scope.selected_branch_location = scope.options_branch_location[0].id

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
        changeReasonCode: function (po_uuid) {
            var scope = this

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
                    scope.POST('buy-and-pay/order/reason_code', {uuid: po_uuid, orders_reason_code_uuid: scope.selected_reason_code}).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getPurchaseOrders()
                            })
                        } else {
                            alert('ERROR:' + res.code)
                        }
                    })
                }                              
            })

        },
        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getPurchaseOrders()
            }, 800);
        },
        listPaginate: function(page) {
            var scope = this
        
            if (page === 'prev') {
                scope.listCurrentPage = scope.listCurrentPage - 1
            } else if (page === 'next') {
                scope.listCurrentPage = scope.listCurrentPage + 1
            } else {
                scope.listCurrentPage = page
            }

            if (scope.listCurrentPage < 1) {
                scope.listCurrentPage = 1
                return
            } else  if (scope.listCurrentPage > scope.listTotalPages) {
                scope.listCurrentPage =  scope.listTotalPages
                return
            }

            scope.getPurchaseOrders()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getPurchaseOrders()
        },
        cancel : function () {
            var scope = this

            window.swal.fire({
                title: 'Cancel?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                    scope.POST('buy-and-pay/order/' + scope.order.uuid + '/cancel').then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Cancelled',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.ROUTE({path: '/purchase-order-main' })
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        },

    },
    mounted() {
        var scope = this
        scope.getPurchaseOrders()
        scope.getReasonCodes()


        scope.getItemGroup()
        scope.getAssetGroup()
        scope.getSupplier()
        scope.getBranchLocations()
        scope.getBranch()
       

        $('.form-reason-codes').on("change", function(e) { 
            scope.selected_reason_code = $('.form-reason-codes').val();
        })
    },
}
</script>

<style scoped>
.table-filter { background:#f9f9f9; border:1px solid #d7d8e0; padding:0px; margin-bottom: 8px; }
.table-filter-row { display:flex; justify-content: space-evenly; }
.select-wrap { background:#e5e5ed; padding-right: 5px; border-right:1px solid #d7d8e0; width: 100%; }
.select-wrap select { padding:5px; padding-top: 6px; background:transparent; border:none; width:100%; font-size: 12px; }
.badge { font-size: 11px; }

.td-border-bottom-black tr:nth-last-child(3) td { border-bottom-color: #495057 !important; }
.td-border-bottom-black tr:nth-last-child(2) td { border-bottom-color: #495057 !important; }
.td-border-bottom-black tr:nth-last-child(1) td { border-bottom-color: #495057 !important; }
</style>