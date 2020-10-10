<template>
    <div class="hx-contained">
        <div class="hx-tab">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Price Rule</h1>
                </div>
                <div class="bar-right">
                    <a @click="ROUTE({path: '/price-rules' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
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
                                <label class="form-label" for="rule-name">Rule Name</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.rule_name" type="text" class="form-control" id="rule-name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="rule-name">Rate</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.rate" type="text" class="form-control" id="rate-price-rule" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="mechanics">Mechanics</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.mechanics" type="text" class="form-control" id="mechanics" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="minimum-amount">Target Amount</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.target_amount" type="text" class="form-control" id="minimum-amount" required>
                                </div>
                            </div>
                        </div>


                        
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="date-start">Date Start</label>
                                <div class="form-control-wrap">
                                    <date-picker v-model="formdata.date_start" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="date-end">Date End</label>
                                <div class="form-control-wrap">
                                    <date-picker v-model="formdata.date_end" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div v-if="formdata.uuid">
                        <hr/>
                        <div class="row">
                            <div class="col-md-5 col-12">
                                <h4 class="card-title">Selected Suppliers</h4>
                                <p>Below are the list of suppliers included on this price rule</p>
                                
                                <div style="position:relative; padding-right:100px;">
                                    <select v-model="selectedSupplierUUID" class="form-control">
                                        <option value="null">Select a Supplier</option>
                                        <template v-for="(supplier, index2) in suppliers" >
                                            <option v-if="!isSupplierAdded(supplier.uuid)" :key="'opt-' + supplier.id + '-' + index2" :value="supplier.uuid">{{ supplier.business_name }}</option>
                                        </template>
                                    </select>
                                    <button @click="addPriceRuleSupplierDetail()" type="button" style="position:absolute; top:0px; right:0px; width:90px; height:34px;" class="hx-btn hx-btn-shineblue">Add</button>
                                </div>

                                <br/>
                                <table class="table table-striped table-bordered responsiveTable">
                                    <thead>
                                        <tr class="tb-tnx-head">
                                            <th width="90">Actions</th>
                                            <th width="20">#</th>
                                            <th>Supplier Name</th>
                                            <th>Applied To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="cursor:pointer; z-index:3000;" @click="selectPriceRuleDetails(priceRuleSupplierDetail)" v-for="(priceRuleSupplierDetail, index) in priceRuleSupplierDetails" :key="index" v-bind:class="{'table-success' : (selectedPriceRuleDetail && selectedPriceRuleDetail.uuid == priceRuleSupplierDetail.uuid) }">
                                            <th>
                                                <a href="javascript:void(0)"  v-if="priceRuleSupplierDetail.edit" @click="savePriceRuleSupplierDetail(priceRuleSupplierDetail)" class="btn btn-sm  hx-btn-shineblue"><i class="bx bx-save"></i></a>
                                                <a href="javascript:void(0)"  v-else @click="editPriceRuleSupplierDetail(priceRuleSupplierDetail)" class="btn btn-sm  hx-btn-shineblue"><i class="bx bx-pencil"></i></a>
                                                <a href="javascript:void(0)"  @click="deletePriceRuleSupplierDetail(priceRuleSupplierDetail)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                            </th>
                                            <th width="40">{{ index + 1 }}</th>
                                            <td>
                                                <strong>{{ getSupplierDetails('business_name', priceRuleSupplierDetail.supplier_uuid) }}</strong>
                                            </td>
                                            <td>
                                                <strong v-if="!priceRuleSupplierDetail.edit">{{ priceRuleSupplierDetail.applied_to }}</strong>
                                                <select style="z-index:4000;" v-else @change="selectPriceRuleDetails(priceRuleSupplierDetail)"  v-model="priceRuleSupplierDetail.applied_to" class="form-control">
                                                    <option value="all">All</option>
                                                    <option value="selected">Selected</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 col-12 offset-md-1">
                                <div v-if="selectedPriceRuleDetail">
                                <h4 class="card-title">{{ getSupplierDetails('business_name',selectedPriceRuleDetail.supplier_uuid) }}</h4>
                                <p>Below are the list of items included in this price rule</p>

                                <table class="table table-striped table-bordered responsiveTable">
                                    <thead>
                                        <tr class="tb-tnx-head">
                                            <th width="30">#</th>
                                            <th>Item Code</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in items" :key="index" v-bind:class="{'table-success' : selectedPriceRuleDetail.applied_to == 'all' || isSupplierItemSelected(item)}">
                                            <th>
                                                <div v-if="selectedPriceRuleDetail.applied_to == 'all'" class="form-check mb-3">
                                                    <input checked disabled class="form-check-input" type="checkbox">
                                                </div>
                                                <div v-else class="form-check mb-3">
                                                    <input v-if="!isSupplierItemSelected(item)" @change="addPriceRuleSupplierItem(item)" class="form-check-input" type="checkbox">
                                                    <input v-else @change="removePriceRuleSupplierItem(item)" class="form-check-input" type="checkbox" checked>
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
                    </div>
                </form>
            </div>          
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'price-rule-supplier',
    props: ['properties'],
    data: function () {
        return {
            priceRuleSupplierUUID: null,
            suppliers: [],
            priceRuleSupplierDetails: [],
            items: [],
            selectedSupplierUUID: null,
            selectedPriceRuleDetail: null,

            formdata: { 
                uuid: null,
                rule_name: '',
                type: 'rate',
                fixed: '',
                date_start: '',
                date_end: '',
                mechanics: '',
                target_amount: '',
            }
        }
    },

    computed: {
    },

    methods: {
        addPriceRuleSupplierDetail: function() {
            var scope = this
            
            if (!scope.selectedSupplierUUID) {
                alert('Please select a supplier');
                return
            }

            var data = { uuid: null, supplier_uuid: scope.selectedSupplierUUID, applied_to: 'all', edit: true, items: [], }

            scope.POST('price-rule/supplier/'+ scope.priceRuleSupplierUUID +'/details', data).then(res => {
                if (res.success) {
                    data.uuid = res.data.uuid
                    scope.priceRuleSupplierDetails.push(data);
                    
                    var index = (scope.priceRuleSupplierDetails.length - 1)

                    scope.selectedPriceRuleDetail = scope.priceRuleSupplierDetails[index]
                    scope.getItemList(scope.selectedPriceRuleDetail.supplier_uuid)
                    scope.selectedSupplierUUID = null

                } else {
                    alert('ERROR:' + res.code)
                }
                
            })

            
        },
        savePriceRuleSupplierDetail: function(priceRuleSupplierDetail) {
            var scope = this
            
            var data = { 
                uuid: priceRuleSupplierDetail.uuid, 
                supplier_uuid: priceRuleSupplierDetail.supplier_uuid, 
                applied_to: priceRuleSupplierDetail.applied_to,  
            }

            scope.POST('price-rule/supplier/'+ scope.priceRuleSupplierUUID +'/details', data).then(res => {
                if (res.success) {
                    priceRuleSupplierDetail.edit = false
                    scope.selectPriceRuleDetails(priceRuleSupplierDetail)
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })

            
        },
        deletePriceRuleSupplierDetail: function(priceRuleSupplierDetail) {
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
                        
                    scope.DELETE('price-rule/supplier/'+ scope.priceRuleSupplierUUID +'/details/' + scope.selectedPriceRuleDetail.uuid  ).then(res => {
                        if (res.success) {
                            for (let i = 0; i < scope.priceRuleSupplierDetails.length; i++) {
                                var current = scope.priceRuleSupplierDetails[i]
                                if (current.uuid == priceRuleSupplierDetail.uuid) {
                                    scope.priceRuleSupplierDetails.splice(i,1)
                                }
                            }
                        } else {
                            alert('ERROR:' + res.code)
                        }
                        
                    })      
                }                              
            })
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.rule_name = data.rule_name
            scope.formdata.rate = data.rate
            scope.formdata.date_start = data.date_start
            scope.formdata.date_end = data.date_end
            scope.formdata.mechanics = data.mechanics
            scope.formdata.target_amount = data.target_amount
        },
        getPriceRuleSupplier: function (priceRuleSupplierUUID) {
            var scope = this
            scope.GET('price-rule/supplier/' + priceRuleSupplierUUID).then(res => {
                if (res.success) {
                    scope.formdata = res.data
                }
            })

        },
        getPriceRuleSupplierDetails: function (priceRuleSupplierUUID) {
            var scope = this
            scope.GET('price-rule/supplier/'+ priceRuleSupplierUUID +'/details').then(res => {
                if (res.success) {
                    for (let i = 0; i < res.rows.length; i++) {
                        var current = res.rows[i]
                        var data = { uuid: current.uuid, supplier_uuid: current.supplier_uuid, applied_to: current.applied_to, edit: false, items: current.items }
                        scope.priceRuleSupplierDetails.push(data);

                        if (i == 0) {
                            scope.selectPriceRuleDetails(current)
                        }
                    }
                }
            })

        },
        editPriceRuleSupplierDetail: function(priceRuleSupplierDetail) {
            var scope = this
            priceRuleSupplierDetail.edit = true
            scope.selectPriceRuleDetails(priceRuleSupplierDetail)
        },
        selectPriceRuleDetails: function(priceRuleSupplierDetail) {
            var scope = this
            var isSameSelectedPriceRuleDetail = (scope.selectedPriceRuleDetail && scope.selectedPriceRuleDetail.uuid == priceRuleSupplierDetail.uuid) ? true : false
            
            scope.selectedPriceRuleDetail = priceRuleSupplierDetail
            
            if (scope.selectedPriceRuleDetail.supplier_uuid == 0) {
                return;
            }
            
            if (isSameSelectedPriceRuleDetail) {
                return;
            }

            scope.getItemList(scope.selectedPriceRuleDetail.supplier_uuid)
        },
        getSupplierList: function () {
           var scope = this
            scope.GET('suppliers/supplier-list').then(res => {
                scope.suppliers = res.rows
            })
        },
        getSupplierDetails: function (field, supplierUUID) {
            var scope = this
            for (let i = 0; i < scope.suppliers.length; i++) {
                var current = scope.suppliers[i]
                if (current.uuid == supplierUUID) {
                    return current[field]
                }
            }
            return ''
        },
        isSupplierAdded: function (supplierUUID) {
            var scope = this
            for (let i = 0; i < scope.priceRuleSupplierDetails.length; i++) {
                var current = scope.priceRuleSupplierDetails[i]
                if (current.supplier_uuid == supplierUUID) {
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
        isSupplierItemSelected: function (item) {
            var scope = this
            for (let i = 0; i < scope.selectedPriceRuleDetail.items.length; i++) {
                var current = scope.selectedPriceRuleDetail.items[i]
                if (current == item.uuid) {
                    return true
                }
            }

            return false
        },
        addPriceRuleSupplierItem: function (item) {
            var scope = this
            scope.selectedPriceRuleDetail.items.push(item.uuid)
 
            scope.POST('price-rule/supplier/details/' + scope.selectedPriceRuleDetail.uuid + '/items', {item_uuid: item.uuid}).then(res => {
                if (res.success) {
                    
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })

            
        },
        removePriceRuleSupplierItem: function (item) {
            var scope = this

            for (let i = 0; i < scope.selectedPriceRuleDetail.items.length; i++) {
                var current = scope.selectedPriceRuleDetail.items[i]
                if (current == item.uuid) {
                    scope.selectedPriceRuleDetail.items.splice(i,1)

                    scope.DELETE('price-rule/supplier/details/' + scope.selectedPriceRuleDetail.uuid + '/items/' + item.uuid ).then(res => {
                        if (res.success) {
                            
                        } else {
                            alert('ERROR:' + res.code)
                        }
                        
                    })
                }
            }
        },
        save: function () {
            var scope = this
            scope.POST('price-rule/supplier', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Price Rule Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.setData(res.rows)
                        // console.log(res.rows)
                        scope.getPriceRules()
                        // scope.toggleForm()
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
                    scope.POST('price-rule/supplier', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Price Rule Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.setData(res.rows)
                                scope.getPriceRules()
                                // scope.toggleForm()
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
                    scope.POST('price-rule/supplier/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Price Rule Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getPriceRules()
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
        var priceRuleSupplierUUID = scope.$route.params.priceRuleSupplierUUID
        scope.priceRuleSupplierUUID = priceRuleSupplierUUID

        if (priceRuleSupplierUUID) {
            scope.getPriceRuleSupplier(priceRuleSupplierUUID)
            scope.getPriceRuleSupplierDetails(priceRuleSupplierUUID)
            scope.getSupplierList()
        }
        
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; }
/*.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }*/
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>