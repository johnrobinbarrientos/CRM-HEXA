<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">Purchase Order</div>
                <div class="mb-3 card-subtitle">
                    
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label class="form-label" for="supplier">Supplier</label>
                            <select class="form-select-suppliers" v-model="selected_supplier" :options="options_supplier" name="supplier">
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div style="float:right; padding-bottom:10px;">
                            <div class="btn-group btn-group-sm mt-2" role="group" aria-label="Basic example">
                                <button @click="OPEN_MODAL('#modal-item-list');" class="btn btn-primary btn btn-secondary">Add Items</button>
                                <button @click="addAllItems()" class="btn btn-primary btn btn-secondary">Add All Items</button>
                            </div>
                            <div class="btn-group btn-group-sm mt-2" role="group" aria-label="Basic example">
                                <button class="btn btn-danger btn btn-secondary">Remove Zero</button>
                            </div>
                        </div>
                    </div>
                </div>
   
                <table class="table mb-0 table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Code</th>
                            <th>Item Description</th>
                            <th>Quantity</th>
                            <th>UOM</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Net Sales</th>
                            <th>VAT</th>
                            <th>Total Amount</th>
                            <th>Location</th>
                            <th>Price Rule?</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in selected_items" :key="item.uuid">
                            <td>{{ (index + 1) }}</td>
                            <td>{{ item.item_code }}</td>
                            <td>{{ item.item_description }}</td>
                            <td>0</td>
                            <td>PC</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>N/A</td>
                            <td>12%</td>
                            <td>0</td>
                            <td>N/A</td>
                            <td>PN/A</td>
                        </tr> 
                        <!--
                        <tr v-for="(company, index) in companies" :key="index">
                            <td class="editable">
                                <span>{{ company.company_name  }}</span>
                                <input v-model="company.company_name" type="text" class="editable-control">
                            </td>
                            <td class="editable">
                                <span>{{ company.shortname  }}</span>
                                <input  v-model="company.shortname" type="text" class="editable-control">
                            </td>
                            <td class="editable">
                                <span>{{ company.website  }}</span>
                                <input  v-model="company.website" type="text" class="editable-control">
                            </td>
                        </tr>
                        -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-item-list">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Item List</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modal-item-list');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="defaultCheck1" value="">
                                            </div>
                                        </th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-lg btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'purchase-order-details',
    props: ['properties'],
    data: function () {
        return {
            selected_supplier: null,
            suppliers: [],
            options_supplier: [],
            items: [],
            selected_items: [],
        }
    },
    methods: {
        getSuppliers: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.business_name + '('+ data.business_shortname +')'
                    })
                
                })

                $(".form-select-suppliers").select2({data: scope.options_supplier});
            })
        },
        getSupplierItems: function(supplier_uuid) {
            var scope = this

            scope.selected_items = []
            scope.GET('suppliers/supplier-list/' + supplier_uuid + '/items').then(res => {
                scope.items = res.rows
            })
        },
        addAllItems: function() {
            var scope = this
            scope.selected_items = scope.items
        }
    },
    mounted() {
        var scope = this
        scope.getSuppliers()

        $(document).unbind().on('change','.form-select-suppliers', function(e) { 
            scope.selected_supplier = $('.form-select-suppliers').val();
            scope.getSupplierItems(scope.selected_supplier);
        })
    },
}



</script>

<style scoped>
    .editable.focused { background:red; }
    .editable.focused span {display:none; }
    .editable > .editable-control { width:0px; height:0px; opacity:0; }
    .editable > .editable-control:focus { width:inherit; height:25px; opacity:1; }
</style>
