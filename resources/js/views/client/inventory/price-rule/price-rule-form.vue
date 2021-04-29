<template>
    <div class="hx-contained">
        <div class="hx-tab">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Price Rule</h1>
                </div>
                <div class="bar-right">
                    <a @click="ROUTE({path: '/price-rule-main' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-x"></i> <span>Cancel</span>
                    </a>
                    <a v-if="!formdata.uuid" @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <span>Save</span>
                    </a>
                    <a v-else @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <span>Update</span>
                    </a>
                </div>
            </div>
        
            <div>
                
                <form action="#" class="form-validate is-alter">

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="rule-name">Rule Name</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.name" type="text" class="form-control" id="rule-name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="rule-name">Rate</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.rate" type="text" class="form-control" id="rate-price-rule" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="mechanics">Mechanics</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.mechanics" type="text" class="form-control" id="mechanics" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="date-start">Date Start</label>
                                <div class="form-control-wrap">
                                    <date-picker v-model="formdata.date_start" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                             <div class="form-group">
                                <label class="form-label" for="date-end">Date End</label>
                                <div class="form-control-wrap">
                                    <date-picker v-model="formdata.date_end" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="applicable-to">Applicable To</label>
                                <select :disabled="formdata.uuid" class="form-control form-select-applicable-to" v-model="formdata.applicable_to" name="applicable-to">
                                    <option value="Buying">Buying</option>
                                    <option value="Selling">Selling</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div v-show="formdata.applicable_to=='Buying'" class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="suppliers">Supplier</label>
                                <select :disabled="formdata.uuid && formdata.is_locked" class="form-select-suppliers" v-model="formdata.supplier_uuid" :options="options_supplier" name="suppliers">
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

                <div v-show="formdata.applicable_to=='Selling'" style="padding:10px 10px; padding-bottom:20px; margin-top:15px; background:#fafafa; border:1px solid #efefef;">
                    <div class="row">
                        <div class="col-7">
                           <span style="display:inline-block; margin-top:8px; font-weight:600; font-size:16px;">Customers</span> 
                        </div>
                        <div class="col-5">
                            <div style="display: flex;  align-content: flex-end;">
                                <div style="flex: 1" v-show="customer_apply_to === 'All'">
                                    &nbsp;
                                </div>
                                <div style="flex: 1">
                                    <div style="padding:5px;">
                                        Apply To:
                                        <select v-model="customer_apply_to" class="form-control-gray-small">
                                            <option value="All">All Customers</option>
                                            <option value="Group">Customer Group</option>
                                            <option value="Chain">Customer Chain</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-show="customer_apply_to != 'All'" style="flex: 1">
                                    <div v-if="customer_apply_to == 'Group'" style="padding:5px;">
                                        Customer Group:
                                        <select v-model="selected_customer_group_uuid" class="form-control-gray-small">
                                            <option :value="null">Select a Customer Group</option>
                                            <option v-for="customer_group,index in customer_groups" :key="'cg-'+index" :value="customer_group.uuid">{{ customer_group.group_name }}</option>
                                        </select>
                                    </div>
                                    <div  v-if="customer_apply_to == 'Chain'" style="padding:5px;">
                                        Customer Chain:
                                        <select v-model="selected_customer_chain_uuid" class="form-control-gray-small">
                                            <option :value="null">Select a Customer Chain</option>
                                            <option v-for="customer_chain,index in customer_chains" :key="'cc-'+index" :value="customer_chain.uuid">{{ customer_chain.chain }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div style="padding:5px; text-align:right;">
                                        <p style="margin:0px; margin-bottom:-3px;">&nbsp;</p>
                                        <button @click="addCustomers()" type="button" class="btn-gray-small">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <template v-if="customers.length > 0">
                            <thead>
                                <tr style="background:#fff;">
                                    <th></th>
                                    <th>Name</th>
                                    <th>Group</th>
                                    <th>Chain</th>
                                </tr>
                            </thead>
                        </template>
                        <tbody>
                            
                            <tr v-for="customer,index in customers" :key="'customer-' + index" style="background:#fff;" >
                                <td width="30" style="padding:2px 5px;">
                                    <input type="checkbox" v-model="customer.selected" :check="customer.selected">
                                </td>
                                <td style="padding:2px 5px;">{{ customer.business_name }} </td>
                                <td style="padding:5px; ">{{ customer.customer_group.group_name }}</td>
                                <td style="padding:5px; ">{{ customer.customer_chain.chain }}</td>
                            </tr>
                        
                        </tbody>
                    </table>
                </div>

                <div style="padding:10px 10px; padding-bottom:20px; margin-top:15px; background:#fafafa; border:1px solid #efefef;">
                    <div class="row">
                        <div class="col-6">
                           <span style="display:inline-block; margin-top:8px; font-weight:600; font-size:16px;">Items</span> 
                        </div>
                        <div class="col-6">
                            <div style="padding:5px 0px; text-align:right;">
                                <button @click="addAllItems()" type="button" class="btn-gray-small">Add all items</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div v-if="is_loaded_items">
                                <table class="table table-bordered table-hover">
                                    <template v-if="selected_items.length > 0">
                                        <thead>
                                            <tr style="background:#fff;">
                                                <th></th>
                                                <th>Barcode</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                    </template>
                                    <tbody>
                                        <template v-if="selected_items.length > 0">
                                            <tr v-for="item,index in selected_items" :key="'item-' + index" style="background:#fff;" >
                                                <td width="30" style="padding:2px 5px;">
                                                    <button @click="remove(index)" type="button" class="btn-gray-small">Delete</button>
                                                </td>
                                                <td width="170" style="padding:2px 5px;">{{ item.item_barcode }} </td>
                                                <td style="padding:5px; ">{{ item.item_description }}</td>
                                            </tr>
                                        </template>
                                        <template v-else>
                                            <td colspan="3" style="background:#fff; padding:30px 5px; text-align:center;">
                                                No items selected
                                            </td>
                                        </template>
                                        <tr>
                                            <td colspan="3" style="padding:2px 5px;">
                                                <input type="text" id="autocomplete" class="form-control"  style="width: 100%;">
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>

                            <div v-else style="padding:50px 15px;  margin-top:15px;  text-align:center; background:#fff; border:1px solid #efefef;">
                                Loading...
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
    name: 'price-rule-form',
    props: ['properties'],
    data: function () {
        return {
            prerequiste: {
                getPriceRuleDetails: false,
                getSuppliers: false,
                getCustomers: false,
            },
            formdata: { 
                uuid: null,
                name: '',
                rate: '',
                date_start: '',
                date_end: '',
                mechanics: '',
                applicable_to: 'Buying',
                supplier_uuid: null,
                initital_items: [],
                initital_customers: [],
                selected_items: [],
                selected_customers: [],
                is_locked: false,
            },
            options_supplier: [],
            options_customer: [],
            customers: [],
            items: [],
            selected_items: [],
            is_loaded_items: false,
           
            customer_groups: [], 
            customer_chains: [],
            customer_apply_to: 'All', // All, Group or Chain
            selected_customer_group_uuid: null,
            selected_customer_chain_uuid: null,
        }
    },
    components: {

    },
    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getPriceRuleDetails && scope.prerequiste.getSuppliers && scope.prerequiste.getCustomers) {
                return true
            }

            return false
        },
        globalUOMs() {
            return this.global_uoms
        }
    },
    watch: {
        ready: function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){
                    $(".form-select-suppliers").select2({data: scope.options_supplier});
                    scope.formdata.supplier_uuid = (!scope.formdata.supplier_uuid) ? scope.options_supplier[0].id : scope.formdata.supplier_uuid
                    
                    $(".form-select-suppliers").val(scope.formdata.supplier_uuid).trigger('change')

                    
                },500)
                
            }
        },
        'prerequiste.getPriceRuleDetails': function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){
                    scope.getSuppliers()
                    scope.getCustomers()
                },1000)
            }
        },
    }, 
    methods: {
        getPriceRuleDetails: function (price_rule_uuid) {
            var scope = this

            if (!price_rule_uuid) {
                scope.prerequiste.getPriceRuleDetails = true
                return;
            }

            scope.GET('price-rules/'+ price_rule_uuid).then(res => {
                if (res.success) {
                    scope.formdata.uuid = res.data.uuid
                    scope.formdata.name = res.data.name
                    scope.formdata.rate = res.data.rate
                    scope.formdata.date_start = res.data.date_start
                    scope.formdata.date_end = res.data.date_end
                    scope.formdata.mechanics = res.data.mechanics
                    scope.formdata.initital_items = (res.data.items) ? res.data.items : []
                    scope.formdata.initital_customers = (res.data.customers) ? res.data.customers : []
                    scope.formdata.applicable_to = res.data.applicable_to
                    scope.formdata.is_locked = res.data.is_locked

                    if (res.data.applicable_to == 'Buying') {
                        scope.formdata.supplier_uuid = res.data.supplier_uuid
                    }

                    scope.prerequiste.getPriceRuleDetails = true
                }
            })
        },

        save: function () {
            var scope = this

            scope.formdata.supplier_uuid = [];
            scope.formdata.selected_customers  = [];

            if (scope.formdata.applicable_to == 'Buying') {
                scope.formdata.supplier_uuid = $(".form-select-suppliers").val()
            } else {
                scope.packSelectedCustomerUUIDs();
            }

            scope.packSelectedItemUUIDs();
            
            if (!scope.formdata.uuid) {
                scope.POST('price-rules', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                             scope.ROUTE({path: '/price-rule-main/'})
                        })
                    } else {
                        alert('ERROR:' + res.code)
                    }
                    
                })
            } else {
                var URL = 'price-rules/' + scope.formdata.uuid
                scope.PUT(URL, scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.ROUTE({path: '/price-rule-main/'})
                        })
                    } else {
                        alert('ERROR:' + res.code)
                    }
                    
                })
            }
            
        },
        getSuppliers: function () {
           var scope = this
            scope.GET('suppliers').then(res => {

                res.rows.forEach(function (data) {
                    scope.options_supplier.push({
                        id: data.uuid,
                        text: data.supplier_name
                    })
                })

                scope.prerequiste.getSuppliers = true
                
            })

        },
        getCustomers: function () {
           var scope = this
            scope.GET('customers').then(res => {

                res.rows.forEach(function (data) {
                    var customer = data
                    if (scope.formdata.initital_customers.includes(customer.uuid)) {
                        customer.selected = true
                    } else {
                        customer.selected = false
                    }
                    scope.customers.push(customer)
                })

                scope.prerequiste.getCustomers = true
                
            })
        }, 
        getCustomerGroups: function () {
           var scope = this
            scope.GET('customers/customer-group').then(res => {
                scope.customer_groups = res.rows
            })
        },
        getCustomerChains: function () {
           var scope = this
            scope.GET('customers/customer-chain?take=500').then(res => {
                scope.customer_chains = res.rows
            })
        },
        getSupplierItems: function (supplier_uuid) {
            var scope = this
            scope.items = []
            scope.selected_items = []
            scope.is_loaded_items = false
            
            scope.GET('suppliers/' + supplier_uuid + '/items').then(res => {
                 res.rows.forEach(function (data) {
                    var row = data
                    row.value = row.item_code + ' ' + row.item_description
                    scope.items.push(row)
                    
                    if (scope.formdata.initital_items.includes(row.uuid)) {
                        scope.selected_items.push(JSON.parse(JSON.stringify(row)));
                    }
                })
                
                scope.is_loaded_items = true
                scope.initializeAutosuggest();
            })
        },
        getSalesItems: function () {
            var scope = this
            scope.items = []
            scope.selected_items = []
            scope.is_loaded_items = false
            scope.GET('items?is_sales_item=yes&children=none&take=500').then(res => {
                 res.rows.forEach(function (data) {
                    var row = data
                    row.value = row.item_code + ' ' + row.item_description
                    scope.items.push(row)
                })
                
                scope.is_loaded_items = true
                scope.initializeAutosuggest();
            })
        },
        initializeAutosuggest: function () {
            var scope = this
            
            setTimeout(function(){
                $('#autocomplete').autocomplete({
                    lookup: scope.items,
                    onSelect: function (suggestion) {

                        for (let i = 0; i < scope.selected_items.length; i++) {
                            var current = scope.selected_items[i]
                            if (current.item_code == suggestion.item_code) {
                                $('#autocomplete').val('')
                                return
                            }
                        }

                        scope.selected_items.push(JSON.parse(JSON.stringify(suggestion)));
                        $('#autocomplete').val('')
                    },
                    beforeRender: function (container, suggestions) {
                        container.html('Searching..')
                        var html = '<table class="table table-hover" style="width:100%;"><thead style="padding:2px 3px;"><tr style="background:#efefef; color:#333;"><th style="width:120px;">Barcode</th><th style="width:340px;">Item Description</th></tr></thead>'
                        html += '<tbody style="padding:2px 3px;">';
                        for (let i = 0; i < suggestions.length; i++) {
                            var suggestion = suggestions[i]
                            html += '<tr class="autocomplete-suggestion" value="'+ suggestion.item_barcode +'" data-barcode="'+ suggestion.item_barcode +'">'
                            html += '<td style="border-right:1px solid #ccc; padding:0px 10px;">'+suggestion.item_barcode+'</td>'
                            html += '<td style="border-right:1px solid #ccc; padding:0px 10px;">'+suggestion.item_description+'</td>'
                            html += '</tr>'
                        }
                        html += '</tbody>'
                        html += '</table>'
                        container.html(html)
                    }
                });
            },100);
            
        },
        addAllItems: function () {
            var scope = this
            scope.selected_items = JSON.parse(JSON.stringify(scope.items))
        },
        remove: function (index) {
            var scope = this
            scope.selected_items.splice(index,1)
        },
        addCustomers: function () {
           var scope = this
           if (scope.customer_apply_to == 'All') {
               scope.customers.forEach(function (data) {
                    data.selected = true
                });
           } else if (scope.customer_apply_to == 'Group') {

                scope.customers.forEach(function (data) {
                    if (data.customer_group_uuid == scope.selected_customer_group_uuid) {
                        data.selected = true
                    }
                });
           } else if (scope.customer_apply_to == 'Chain') {
               scope.selected_customer_chain_uuid 
               scope.customers.forEach(function (data) {
                    if (data.customer_chain_uuid == scope.selected_customer_chain_uuid) {
                        data.selected = true
                    }
                });
           }
 
        },
        packSelectedCustomerUUIDs: function () {
            var scope = this
            scope.formdata.selected_customers = []
            scope.customers.forEach(function (data) {
                if (data.selected) {
                    scope.formdata.selected_customers.push(data.uuid)
                }
            });
        },
        packSelectedItemUUIDs: function () {
            var scope = this
            scope.formdata.selected_items = []
            scope.selected_items.forEach(function (data) {
                scope.formdata.selected_items.push(data.uuid)
            });
        }

    },
    mounted() {
        var scope = this
        scope.formdata.uuid = (scope.$route.params.priceRuleUUID != 'create') ? scope.$route.params.priceRuleUUID : null
        scope.getPriceRuleDetails(scope.formdata.uuid)
        scope.getCustomerGroups()
        scope.getCustomerChains()
       

        $('.form-select-suppliers').on('change',function(e) { 
            scope.formdata.supplier_uuid = $('.form-select-suppliers').val();
            scope.getSupplierItems(scope.formdata.supplier_uuid);
        })

        $('.form-select-applicable-to').on('change',function(e) { 
            if (scope.formdata.applicable_to == 'Selling') {
                scope. getSalesItems();
            }
        })
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; }
/*.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }*/
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>