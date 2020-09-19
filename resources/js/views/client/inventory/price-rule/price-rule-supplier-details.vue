<template>
    <div>

        <div style="margin-top:10px; margin-bottom:10px;">
            <div class="row">
                <div class="col-12 col-md-3">
                    <input style="display:none;" href="javascript:void(0)"  type="text" class="form-control" placeholder="Search">
                </div>
                <div class="col-12 col-md-2 offset-md-7">
                    <a style="display:none;" href="javascript:void(0)" @click="OPEN_MODAL('#modalPriceRule');resetData()" class="btn btn-block btn-primary" data-toggle="modal">
                        <em class="icon ni ni-plus"></em> <span>Add</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-5 col-12">
                <h4 class="card-title">Selected Suppliers</h4>
                <p>Below are the list of suppliers included on this price rule</p>

                <table class="table table-striped table-bordered responsiveTable">
                    <thead>
                        <tr class="tb-tnx-head">
                            <th width="20">#</th>
                            <th>Supplier Name</th>
                            <th>Applied To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(priceRule, index) in priceRuleSuppliers" :key="index">
                            <th width="20">{{ index + 1 }}</th>
                            <td>
                                <strong v-if="priceRule.edit !== true">{{ group.group_name }}</strong>
                                <select @change="selectePriceRule(priceRule)" v-else v-model="priceRule.supplier_uuid" class="form-control">
                                    <option value="0">Select a Supplier</option>
                                    <option v-if="!isSupplierAdded(supplier.uuid) || priceRule.supplier_uuid == supplier.uuid" v-for="(supplier, index2) in suppliers" :key="'opt-' + supplier.id + '-' + index2" :value="supplier.uuid">{{ supplier.business_name }}</option>
                                </select>
                            </td>
                            <td>
                                <strong v-if="priceRule.edit !== true">{{ group.group_name }}</strong>
                                <select @change="selectePriceRule(priceRule)" v-else v-model="priceRule.applied_to" class="form-control">
                                    <option value="all">All</option>
                                    <option value="selected">selected</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th @click="addPriceRuleSupplier()" colspan="4" style="text-align:center; cursor:pointer;">Add Supplier</th>
                        </tr>
                    </tbody>
                </table>
            </div>

             <div class="col-md-5 col-12 offset-md-1">
                <div v-if="selectedPriceRule">
                    <h4 class="card-title">{{ getSupplierName(selectedPriceRule.supplier_uuid) }}</h4>
                    <p>Below are the list of items included on this price rule</p>

                    <table class="table table-striped table-bordered responsiveTable">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th width="30">#</th>
                                <th>Item Code</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in items" :key="index" v-bind:class="{'table-success' : selectedPriceRule.applied_to == 'all' || isSupplierItemSelected(item)}">
                                <th>
                                    <div v-if="selectedPriceRule.applied_to == 'all'" class="form-check mb-3">
                                        <input checked disabled class="form-check-input" type="checkbox">
                                    </div>
                                    <div v-else class="form-check mb-3">
                                        <input v-if="!isSupplierItemSelected(item)" @change="addSupplierItem(item)" class="form-check-input" type="checkbox">
                                        <input v-else @change="removeSupplierItem(item)" class="form-check-input" type="checkbox">
                                    </div>
                                </th>
                                <td><strong>{{ item.item_code }}</strong></td>
                                <td><strong>{{ item.item_description }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 

        <!-- Modal Discount Group Form -->
        <div class="modal fade" tabindex="-1" id="modalPriceRule">
            <div class="modal-dialog modal-md " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Price Rule Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalPriceRule');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="discount-name">Discount Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.discount_name" type="text" class="form-control" id="discount-name-price-rule" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">    
                                            <input v-model="formdata.discount_type" value="rate" type="radio" id="option-rate-price-rule" class="custom-control-input">    
                                            <label class="custom-control-label" for="option-rate-price-rule">Rate</label>
                                        </div> 

                                        <div class="form-control-wrap">
                                            <input v-model="formdata.discount_rate" :disabled="isDisabledRate" type="text" class="form-control" id="discount-rate-price-rule" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">    
                                            <input v-model="formdata.discount_type" value ="fixed" type="radio" id="option-fixed-price-rule" class="custom-control-input">    
                                            <label class="custom-control-label" for="option-fixed-price-rule">Fixed</label>
                                        </div> 

                                        <div class="form-control-wrap">
                                            <input v-model="formdata.discount_fixed" :disabled="isDisabledFixed" type="text" class="form-control" id="discount-fixed-price-rule" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Default Functionality</label>
                                        <div class="input-group">
                                            <input type="text" v-model="formdata.date_start" class="form-control datepicker" data-date-format="yyyy-mm-dd" data-provide="datepicker">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                     
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="date-end">Date End</label>
                                        <div class="form-control-wrap">
                                            <date-picker v-model="formdata.date_end" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                        </div>
                                    </div>
                                </div>

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
    name: 'supplier-price-rule',
    props: ['properties'],
    data: function () {
        return {
            priceRules: [],
            formdata: { 
                uuid: null,
                supplier_uuid: '', 
                discount_type: 'rate',
                discount_name: '',
                discount_rate: '',
                discount_fixed: '',
                date_start: '',
                date_end: ''
            },
            items: [],
            suppliers: [],
            priceRuleSuppliers: [],
            selectedPriceRule: null,
        }
    },
    computed: {

    },
    methods: {
        addPriceRuleSupplier: function() {
            var scope = this
            
            if (!scope.hasAvailableSuppliers()) {
                alert('You already added all the suppliers on this price rule');
                return
            }

            scope.priceRuleSuppliers.push({
                supplier_uuid: 0, 
                applied_to: 'all',
                edit: true,
                items: [],
            });
        },
        selectePriceRule: function(priceRule) {
            var scope = this
            scope.selectedPriceRule = priceRule
            if (scope.selectedPriceRule.supplier_uuid == 0) {
                return;
            }

            scope.getItemList(scope.selectedPriceRule.supplier_uuid)
        },
        getSupplierList: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                scope.suppliers = res.rows
            })
        },
        getSupplierName: function (supplierUUID) {
            var scope = this
            for (let i = 0; i < scope.suppliers.length; i++) {
                var current = scope.suppliers[i]
                if (current.uuid == supplierUUID) {
                    return current.business_name
                }
            }

            return ''
        },
        isSupplierAdded: function (supplierUUID) {
            var scope = this
            for (let i = 0; i < scope.priceRuleSuppliers.length; i++) {
                var current = scope.priceRuleSuppliers[i]
                if (current.supplier_uuid == supplierUUID) {
                    return true
                }
            }

            return false
        },
        hasAvailableSuppliers: function (supplierUUID) {
            var scope = this
            if (scope.priceRuleSuppliers.length < scope.suppliers.length) {
                return true
            }

            return false
        },
        addSupplierItem: function (item) {
            var scope = this
            scope.selectedPriceRule.items.push(item.uuid)
        },
        removeSupplierItem: function (item) {
            var scope = this

            for (let i = 0; i < scope.selectedPriceRule.items.length; i++) {
                var current = scope.selectedPriceRule.items[i]
                if (current == item.uuid) {
                    scope.selectedPriceRule.items.splice(i,1)
                }
            }
        },
        isSupplierItemSelected: function (item) {
            var scope = this

            for (let i = 0; i < scope.selectedPriceRule.items.length; i++) {
                var current = scope.selectedPriceRule.items[i]
                if (current == item.uuid) {
                    return true
                }
            }

            return false
        },
        getItemList: function (supplierUUID) {
            var scope = this
            scope.items = [] 
            scope.GET('suppliers/supplier-list/' + supplierUUID + '/items').then(res => {
                scope.items = res.rows
            })
        },
        getPriceRuleSuppliers: function() {
            // use this to return to the "parent" the list of selected suppliers for the price rule
            return this.priceRuleSuppliers
        },
        getPriceRules: function () {
           var scope = this
            scope.GET('suppliers/supplier-price-rule/' + scope.formdata.supplier_uuid).then(res => {
                scope.priceRules = res.rows
            })
        },
        resetData: function () {
            var scope = this

        },
        setData: function (data) {
            var scope = this

        },
        save: function () {
            var scope = this
            scope.formdata.suppliers = scope.priceRuleSuppliers
            scope.POST('suppliers/supplier-price-rule', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Discount Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getPriceRules()
                        scope.CLOSE_MODAL('#modalPriceRule')
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
                    scope.POST('suppliers/supplier-price-rule', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Discount Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getPriceRules()
                                scope.CLOSE_MODAL('#modalPriceRule')
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
                    scope.POST('suppliers/supplier-price-rule/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Discount Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getPriceRules()
                            scope.CLOSE_MODAL('#modalPriceRule')
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
        scope.formdata.supplier_uuid = scope.properties
        scope.getSupplierList()
        //scope.getPriceRules()

    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>