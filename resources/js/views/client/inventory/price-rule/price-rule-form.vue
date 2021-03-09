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
                    <a v-if="formdata.is_draft" @click="save()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-saves"></i> <span>Save</span>
                    </a>
                    <a v-else @click="update()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-saves"></i> <span>Update</span>
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

                            <div class="form-group">
                                <label class="form-label" for="applicable-to">Applicable To</label>
                                <select class="form-control" v-model="selected_applicable_to" name="applicable-to">
                                    <option v-for="option in options_applicable_to" :value="option.id" :key="'option-' + option.id">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

                <br/>
                <div class="hx-tab-2 tabbed round">
                    <ul class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="active" data-toggle="tab" href="#details">Details</a>    
                        </li>    
                    </ul>
                    <div class="clearfix"></div>
                    <div class="tab-content">    
                        <div class="tab-pane active" id="details">
                            <span v-if="selected_applicable_to=='Buying'">
                                <div id="accordion">
                                    <div class="card shadow-none">
                                        <a href="#collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="m-0">By Group</h5>
                                                <i class="las la-plus-circle fs-30"></i>
                                            </div>
                                        </a>
                                        <div id="collapseOne" v-bind:class="{'show' : buying_by_group }" class="collapse"  aria-labelledby="headingOne" data-parent="#accordion">
                                            <buying-by-group></buying-by-group>
                                        </div>
                                        
                                        <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="m-0">By Supplier</h5>
                                                <i class="las la-plus-circle fs-30"></i>
                                            </div>
                                        </a>
                                        <div id="collapseTwo" v-bind:class="{'show' : buying_by_supplier }" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <buying-by-supplier></buying-by-supplier>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <span v-else>
                                <selling-by-group></selling-by-group>
                                <selling-by-customer></selling-by-customer>
                                <selling-by-item></selling-by-item>
                            </span>
                            
                        </div>
                    </div>

                </div>

            </div>          
        </div>
    </div>
</template>

<script>

import BuyingByGroup from './buying-by-group'
import BuyingBySupplier from './buying-by-supplier'

import SellingByGroup from './selling-by-group'
import SellingByCustomer from './selling-by-customer'
import SellingByItem from './selling-by-item'

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'price-rule-form',
    props: ['properties'],
    data: function () {
        return {
            priceRuleUUID: null,

            selected_applicable_to: null,

            options_applicable_to: [
                { id: 'Buying', text: 'Buying' },
                { id: 'Selling', text: 'Selling' }
            ],

            formdata: { 
                uuid: null,
                rule_name: '',
                type: 'rate',
                fixed: '',
                date_start: '',
                date_end: '',
                mechanics: '',
                applicable_to: 'Buying',
                is_draft: '',
            },
            buying_by_group: false,
            buying_by_supplier: true
        }
    },
    components: {
        'buying-by-group': BuyingByGroup,
        'buying-by-supplier': BuyingBySupplier,
        'selling-by-group': SellingByGroup,
        'selling-by-customer': SellingByCustomer,
        'selling-by-item': SellingByItem,
    },

    methods: {
        getPriceRuleDetails: function (priceRuleUUID) {
            var scope = this
            scope.GET('price-rules/'+ priceRuleUUID).then(res => {
                if (res.success) {
                    scope.formdata.uuid = res.data.uuid
                    scope.formdata.rule_name = res.data.rule_name
                    scope.formdata.rate = res.data.rate
                    scope.formdata.date_start = res.data.date_start
                    scope.formdata.date_end = res.data.date_end
                    scope.formdata.mechanics = res.data.mechanics
                    scope.formdata.is_draft = res.data.is_draft

                    $('.form-select-applicable-to').val(res.data.applicable_to);
                    $('.form-select-applicable-to').trigger('change');
                }
            })
        },

        save: function () {
            var scope = this

            scope.formdata.applicable_to = scope.selected_applicable_to

            scope.PUT('price-rules/', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
 
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },

        update: function () {
            var scope = this

            scope.formdata.applicable_to = scope.selected_applicable_to
        
            window.swal.fire({
                title: 'Update?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.PUT('price-rules/', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                
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
        var priceRuleUUID = scope.$route.params.priceRuleUUID
        scope.priceRuleUUID = priceRuleUUID

        if (priceRuleUUID) {
            scope.getPriceRuleDetails(priceRuleUUID)
        }

        $(".form-select-applicable-to").select2({data: scope.options_applicable_to});
        scope.selected_applicable_to = scope.options_applicable_to[0].id


        $('.form-select-applicable-to').on("change", function(e) { 
            scope.selected_applicable_to = $('.form-select-applicable-to').val();
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