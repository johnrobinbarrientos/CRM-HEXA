<template>
    <div>
        <br/>
        <div class="row">
            <div class="col-lg-5 col-12" >
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">Discount</div>
                        <div class="col-md-6">
                            <div style="text-align:right;">
                                <button @click="addNewGroup()"  type="button" class="btn-gray-small" :disabled="view_mode">New Group</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom:80px;" v-bind:class="{ 'table-responsive': table_responsive }">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Name</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="groups.length > 0">
                                <template v-bind:class="{'table-success' : (selected_group && selected_group.uuid === group.uuid) }" style="cursor:pointer;" v-for="(group,index) in groups">
                                    
                                        <tr :key="'group-' + index">
                                                <td width="80" class="text-center">
                                                
                                                <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="editGroup(group,index)">
                                                    <b-dropdown-item href="javascript:void(0)"  @click="editGroup(group,index)">Edit</b-dropdown-item>
                                                    <b-dropdown-item href="javascript:void(0)" @click="viewGroup(group)">View</b-dropdown-item>
                                                    <b-dropdown-item href="javascript:void(0)" @click="removeGroup(index)">Delete</b-dropdown-item>
                                                </b-dropdown>

                                            
                                                </td>
                                                <td>
                                                    <strong >{{ group.name }}</strong>
                                                </td>
                                                <td width="20" class="text-right">
                                                    <strong >{{ totalDiscountGroup(group.discounts) }}</strong>
                                                </td>
     
                                        </tr>
                                    
                            

                                        <tr v-if="group.view == true" :key="'group-items-' + index">
                                            <td style="padding:0px;"  colspan="3">
                                                <div style="padding:5px; background:#f5f5f5; border-bottom: 1px solid #ccc;">
                                                    <div style="font-weight:600; margin:3px; margin-bottom:10px;">
                                                        {{ group.name || 'Discount Group' }}
                                                        <div style="float:right;">
                                                            <a @click="cancelGroup(group)" href="javascript:void(0);" class="btn-closer-square"><i class="bx bx-x"></i></a>
                                                        </div>
                                                    </div>
                                                    <table style="margin-top:5px;" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr style="background:#fff;">
                                                                <th>Name</th>
                                                                <th>Rate</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr style="background:#fff;" v-for="discount,discount_index in group.discounts" :key="'group-discount-' + discount_index ">
                                                                <td style="padding:0px 5px;">
                                                                    {{ discount.name  }}
                                                                </td>
                                                                <td style="padding:0px 5px;" class="text-right"  width="70">
                                                                    {{ discount.rate  }}%
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>

                                    
                                </template>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="3" style="padding:20px; text-align:center; font-weight:600;">No Records</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>


        <div class="modal fade modal-md-form" tabindex="-1" id="modalDiscounts">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="selected_group" class="modal-title">
                            <span v-if="!selected_group.id">New</span>
                            <span v-else>Edit</span>
                        </h5>
                        <a href="javascript:void(0)"  @click="cancelGroup()" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form v-if="selected_group" action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">

                                    <div style="padding:5px;">

                                        <div class="form-group">
                                            <label class="form-label" for="group-name">Group Name:</label>
                                            <div class="form-control-wrap">
                                                <input v-model="selected_group.name" class="form-control" v-bind:class="{'error' : selected_group.name_error}" type="text" placeholder="ie: Chocolates" required>
                                            </div>
                                        </div>

                                        <div class="hx-card-small">
                                            <div class="card-header">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span style="font-weight: 600">Discount List</span>
                                                    <button class="btn-gray-small btn-primary m-0" @click="addNewDiscount(selected_group)" type="button" :disabled="view_mode">
                                                        <i class="las la-plus"></i> Add Discount
                                                    </button>
                                                </div>
                                            </div>
                                            <div style="padding: 8px 10px;">
                                                <table style="margin-top:5px;" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr style="background:#fff;">
                                                            <th>Action</th>
                                                            <th>Name</th>
                                                            <th>Rate</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background:#fff;" v-for="(discount,discount_index) in selected_group.discounts" :key="'edit-group-discount-' + discount_index ">
                                                          
                                                            <td width="60"><button class="btn-gray-small" type="button" @click="removeDiscount(selected_group.discounts,discount_index)" :disabled="view_mode">Delete</button></td>
                                                            <td style="padding:0px 2px;">
                                                                <input class="form-control-gray-small" v-bind:class="{'error' : discount.name_error}" type="text" v-model="discount.name ">
                                                            </td>
                                                            <td style="padding:0px 2px;"  width="70">
                                                                <input class="form-control-gray-small" v-bind:class="{'error' : discount.rate_error}"  type="text" v-model="discount.rate ">
                                                            </td>
                                                      
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button  @click="cancelGroup()" type="button" class="btn btn-sm btn-outline-secondary">Close</button>
                        <button v-if="selected_group && selected_group.uuid === null" @click="saveGroup()" type="button" class="btn btn-sm btn-primary">Save</button>
                        <button v-else @click="saveGroup()" type="button" class="btn btn-sm btn-primary">Update</button>
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
    name: 'supplier-group',
    props: ['properties','supplier_uuid','view_mode'],
    data: function () {
        return {
            selected_group: null,
            discounts: [],
            groups: [],
            table_responsive: true,
            falsee: false,
            selected_group_index: null // used for editing
        }
    },
    methods: {
        totalDiscountGroup: function (discounts) {

            var total = 0
            for (let i = 0; i < discounts.length; i++) {
                var current = discounts[i]

                if (current.rate == '' || isNaN(current.rate)) {
                    continue;
                }
                
                var rate = parseFloat(current.rate)
                total += rate
            }

            return total.toFixed(2)
        },
        addNewDiscount: function (group) {
           var scope = this
            group.discounts.push({
                id: null,
                uuid: null,
                name: '',
                rate: '',
                excluded_items: []
            });
        },
        removeDiscount: function (discounts,discount_index) {
            var scope = this
            discounts.splice(discount_index,1)
        },
        addNewGroup: function () {
            var scope = this
            scope.selected_group = {
                id: null,
                uuid: null,
                name: '',
                edit: true,
                view: false,
                new: true,
                discounts: []
            }
            scope.addNewDiscount(scope.selected_group);
            scope.OPEN_MODAL('#modalDiscounts');

        },
        editGroup: function (data,index) {
           var scope = this
            // we will use this when cancelling the edit
            var copy = JSON.parse(JSON.stringify(data))
            scope.selected_group = copy
            scope.selected_group.new = false
            scope.selected_group.edit = true
            scope.selected_group_index = index

           scope.OPEN_MODAL('#modalDiscounts'); 
        },
        viewGroup: function (data) {
           var scope = this
           scope.$set(data,'view', true)
        },
        cancelGroup: function () {
            var scope = this 
            scope.selected_group = null   
            scope.selected_group_index = null  
            scope.CLOSE_MODAL('#modalDiscounts'); 
        },
        removeGroup: function (index) {
            var scope = this
            scope.groups.splice(index, 1)
        },
        getGroups: function () {
            var scope = this
            var supplier_uuid = scope.supplier_uuid;

            scope.GET('suppliers/' + supplier_uuid + '/base-discounts').then(res => {
                scope.groups = (res.rows) ? res.rows : []
            })
        },
        getDiscountGroups: function () {
           return this.groups
        },
        updateDiscountGroups: function (data) {
            var scope = this
            scope.groups = data
        },
       saveGroup: function (group) {
            var scope = this

            var error = 0

            scope.$set(scope.selected_group,'name_error',false);
            if (scope.selected_group.name == '') {
                error++;
                scope.selected_group.name_error = true
            }
            
            for (let i = 0; i < scope.selected_group.discounts.length; i++) {
                var discount = scope.selected_group.discounts[i]

                scope.$set(scope.selected_group.discounts[i],'name_error',false);
                scope.$set(scope.selected_group.discounts[i],'rate_error',false);

                if (discount.name == '') {
                    error++;
                    scope.selected_group.discounts[i].name_error = true
                } 

                if (discount.rate == '') {
                    error++;
                    scope.selected_group.discounts[i].rate_error = true
                }
            }

            if (error) {
                return
            }

            scope.selected_group.edit = false

            if (scope.selected_group_index === null) {
                scope.groups.push(scope.selected_group);
            } else {
                scope.groups[scope.selected_group_index] = JSON.parse(JSON.stringify(scope.selected_group)) 
            }

            scope.selected_group = null
            scope.selected_group_index = null
            scope.CLOSE_MODAL('#modalDiscounts');
       }
    },
    mounted() {
        var scope = this
        scope.getGroups()
        
        if(scope.properties) {
            scope.table_responsive = scope.properties.table_responsive
        }

    
        console.log(scope.properties)
        console.log(scope.properties.table_responsive)

    },
}
</script>

<style scoped>
a.disabled {
    pointer-events: none;
    color: #ccc;
}

.table-discounts thead th { background-color: #398cdb; color: #fff; }
.table-discounts tbody th {
    font-weight: normal;
}
.table-success, .table-success>td, .table-success>th { background-color: #eee !important; }
</style>