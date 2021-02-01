<template>
    <div>
        <div v-show="!show_form">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Price Rules</h1>
                </div>
                <div class="bar-right">
                    <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                    <a @click="toggleForm();resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-plus"></i> <span>New</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div v-show="!show_form">          
            <div class="row">
                <div class="col-12">
                    <div class="card card-bordered card-preview">
                        <div style="overflow-x:auto;"> 
                        <table class="table table-tranx table-items">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th><span class="">Actions</span></th>
                                    <th><span class="">#</span></th>
                                    <th><span class="">Rule Name</span></th>
                                    <th><span class="">Date Start</span></th>
                                    <th><span class="">Date End</span></th>
                                    <th><span class="">Rate</span></th>
                                    <th><span class="">Fixed</span></th>
                                    <th><span class="">Mechanics</span></th>
                                    <th><span class="">Minimum Amount</span></th>
                                    <th><span class="">Maximum Amount</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(price_rule, index) in priceRules" :key="price_rule.uuid" class="tb-tnx-price-rule">
                                    <td>
                                    <span class="">
                                        <a href="javascript:void(0)"  @click="setData(price_rule); toggleForm() " class="btn btn-sm btn-light"><i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"  @click="remove(price_rule)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                    </span>
                                    </td>
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">{{price_rule.rule_name}}</span></td>
                                    <td><span class="">{{price_rule.date_start}}</span></td>
                                    <td><span class="">{{price_rule.date_end}}</span></td>
                                    <td><span class="">{{price_rule.rate}}</span></td>
                                    <td><span class="">{{price_rule.fixed}}</span></td>
                                    <td><span class="">{{price_rule.mechanics}}</span></td>
                                    <td><span class="">{{price_rule.minimum_amount}}</span></td>
                                    <td><span class="">{{price_rule.maximum_amount}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div v-show="show_form">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title">New Price Rule</h1>
                </div>
                <div class="bar-right">
                    <a v-if="formdata.uuid === null" @click="save()" type="submit" class="hx-btn hx-btn-primary" href="javascript:void(0)">Save</a>
                    <a v-else @click="update()" type="submit" class="hx-btn hx-btn-primary" href="javascript:void(0)">Save Changes</a>
                    <a @click="toggleForm(); resetData();" type="submit" class="hx-btn hx-btn-danger" href="javascript:void(0)">Cancel</a> 
                </div>
            </div>

            <form action="#" class="form-validate is-alter">

                <div class="row">

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label class="form-label" for="rule-name">Rule Name</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.rule_name" type="text" class="form-control" id="rule-name" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <div class="custom-control custom-radio">    
                                <input v-model="formdata.type" value="rate" type="radio" id="option-rate-price-rule" class="custom-control-input">    
                                <label class="custom-control-label" for="option-rate-price-rule">Rate</label>
                            </div> 

                            <div class="form-control-wrap">
                                <input v-model="formdata.rate" :disabled="isDisabledRate" type="text" class="form-control" id="rate-price-rule" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <div class="custom-control custom-radio">    
                                <input v-model="formdata.type" value ="fixed" type="radio" id="option-fixed-price-rule" class="custom-control-input">    
                                <label class="custom-control-label" for="option-fixed-price-rule">Fixed</label>
                            </div> 

                            <div class="form-control-wrap">
                                <input v-model="formdata.fixed" :disabled="isDisabledFixed" type="text" class="form-control" id="fixed-price-rule" required>
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
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label" for="date-end">Date End</label>
                            <div class="form-control-wrap">
                                <date-picker v-model="formdata.date_end" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label" for="mechanics">Mechanics</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.mechanics" type="text" class="form-control" id="mechanics" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label" for="maximum-amount">Maximum Amount</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.maximum_amount" type="text" class="form-control" id="maximum-amount" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label" for="minimum-amount">Minimum Amount</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.minimum_amount" type="text" class="form-control" id="minimum-amount" required>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <br/>
                
                <ul v-show ="formdata.uuid" class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="nav-link active" data-toggle="tab" href="#supplier">Supplier</a>    
                        </li>       
                </ul>

                    <div class="tab-content">    
                        
                        <div class="tab-pane active" id="supplier">
                            <customer-details v-if="formdata.uuid" :properties="formdata.uuid"></customer-details>
                        </div>

                    </div>
                
            </form>
        </div>        
             
    </div>
</template>

<script>

import CustomerDetails from './customer-details'

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'customer-list',
    props: ['properties'],

    components: {
        'customer-details': CustomerDetails,
    },

    data: function () {
        return {

            show_form: false,

            priceRules: [],

            formdata: { 
                uuid: null,
                rule_name: '',
                type: 'rate',
                rate: '',
                fixed: '',
                date_start: '',
                date_end: '',
                mechanics: '',
                minimum_amount: '',
                maximum_amount: ''
            }

        }
    },

     computed: {
      isDisabledRate() {
        var scope = this
        if (scope.formdata.type =='rate'){
            return false
        }
        else{
            scope.formdata.rate = ''
            return true
        }  
      },
      isDisabledFixed() {
        var scope = this
        if (scope.formdata.type =='fixed'){
            return false
        }
        else{
            scope.formdata.fixed = ''
            return true
        }  
      }
    },

    methods: {
        toggleForm() {
            var scope = this
            scope.show_form = !scope.show_form
        },
        getPriceRules: function () {
           var scope = this
            scope.GET('price-rule/customer').then(res => {
                scope.priceRules = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.rule_name = ''
            scope.formdata.type = 'rate'
            scope.formdata.rate = ''
            scope.formdata.fixed = ''
            scope.formdata.date_start = moment().format('YYYY-MM-DD')
            scope.formdata.date_end = moment().format('YYYY-MM-DD')
            scope.formdata.mechanics = ''
            scope.formdata.minimum_amount = ''
            scope.formdata.maximum_amount = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.rule_name = data.rule_name
            scope.formdata.type = data.type
            scope.formdata.rate = data.rate
            scope.formdata.fixed = data.fixed
            scope.formdata.date_start = data.date_start
            scope.formdata.date_end = data.date_end
            scope.formdata.mechanics = data.mechanics
            scope.formdata.minimum_amount = data.minimum_amount
            scope.formdata.maximum_amount = data.maximum_amount
        },
        save: function () {
            var scope = this
            scope.POST('price-rule/customer', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
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
                title: 'Update?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('price-rule/customer', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
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
                title: 'Delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('price-rule/customer/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
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
        scope.getPriceRules()
        
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; }
/*.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }*/
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>