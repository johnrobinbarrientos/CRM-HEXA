<template>
    <div>
        <br/>
        <div class="row">
            <div class="col-lg-5 col-12" >
                <div class="card-title">Discount Group</div>
                <div style="margin-bottom:80px;" v-bind:class="{ 'table-responsive': table_responsive }">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Name</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="groups.length > 0">
                                <template @click="selectGroup(group)" v-bind:class="{'table-success' : (selected_group && selected_group.uuid === group.uuid) }" style="cursor:pointer;" v-for="(group,index) in groups">
                                    <tr v-if="!group.edit && !group.view " :key="'group-' + index">
                                        <td width="100" class="text-center">

                                        
                                        <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="editGroup(group)">
                                            <b-dropdown-item href="javascript:void(0)"  @click="editGroup(group)">Edit</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="viewGroup(group)">View</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="removeGroup(group,index)">Delete</b-dropdown-item>
                                        </b-dropdown>

                                    
                                        </td>
                                        <td>
                                            <strong >{{ group.group_name }}</strong>
                                        </td>
                                        <td width="20" class="text-right">
                                            <strong >{{ group.supplier_base_discount_group_details.length }}</strong>
                                        </td>
                                    </tr>
                                    <tr v-if="group.edit == true" :key="'group-items-' + index">
                                        <td style="padding:0px;"  colspan="3">
                                            <div style="padding:5px; background:#f5f5f5; border-bottom: 1px solid #ccc;">
                                                <p style="font-weight:600; margin:3px; margin-bottom:5px;">Discount Group</p>
                                                <input v-model="group.group_name" class="form-control-gray-medium"  v-bind:class="{'error' : group.group_name_error}" type="text" placeholder="Enter group name">
                                                
                                                <div style="text-align:right; margin-top:10px;">
                                                    <button class="btn-gray-small" @click="addNewDiscount(group)" type="button" :disabled="view_mode">Add Discount</button>
                                                </div>
                                                <table style="margin-top:5px;" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr style="background:#fff;">
                                                            <th>Action</th>
                                                            <th>Name</th>
                                                            <th>Rate</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background:#fff;" v-for="(discount,index2) in group.supplier_base_discount_group_details" :key="'group-discount-' + index + '-' + index2 ">
                                                            <td width="60"><button class="btn-gray-small" type="button" @click="removeDiscount(group,index2)" :disabled="view_mode">Delete</button></td>
                                                            <td style="padding:0px;">
                                                                <input class="form-control-gray-small" v-bind:class="{'error' : discount.discount_name_error}" type="text" v-model="discount.discount_name ">
                                                            </td>
                                                            <td style="padding:0px;"  width="70">
                                                                <input class="form-control-gray-small" v-bind:class="{'error' : discount.discount_rate_error}"  type="text" v-model="discount.discount_rate ">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div style="margin-top:10px; margin-bottom:15px; text-align:center;">
                                                    <button class="btn-gray-small" @click="saveGroup(group)" type="button" :disabled="view_mode">Save</button>
                                                    <button class="btn-gray-small" @click="cancelEditGroup(group,index)" type="button" :disabled="view_mode">Cancel</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr v-if="group.view == true" :key="'group-items-' + index">
                                        <td style="padding:0px;"  colspan="3">
                                            <div style="padding:5px; background:#f5f5f5; border-bottom: 1px solid #ccc;">
                                                <p style="font-weight:600; margin:3px; margin-bottom:5px; color:#333;">{{ group.group_name }}</p>
                                                <table style="margin-top:5px;" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr style="background:#fff;">
                                                            <th>Name</th>
                                                            <th>Rate</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background:#fff;" v-for="discount in group.supplier_base_discount_group_details" :key="'group-discount-' + discount.uuid ">
                                                            <td style="padding:0px 5px;">
                                                                {{ discount.discount_name  }}
                                                            </td>
                                                            <td style="padding:0px 5px;" class="text-right"  width="70">
                                                                 {{ discount.discount_rate  }}%
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div style="margin-top:10px; margin-bottom:15px; text-align:center;">
                                                    <button class="btn-gray-small" @click="cancelViewGroup(group)" type="button" :disabled="view_mode">Close</button>
                                                </div>
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
                            <tr>
                                <td style="padding:0px;" colspan="3" >
                                    <button @click="addNewGroup()"  type="button" style="margin:0px; font-weight:600; border-radius: 0; padding-top: 4px; padding-bottom: 4px; width:100%; background:#e7e9ec;  color: #495057!important; border:1px solid #ccc;" :disabled="view_mode" class="btn-gray-small"> New Group</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
            </div>

        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'

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
        }
    },
    methods: {
        totalDiscountGroup: function (discounts) {
            var total = 0
            for (let i = 0; i < discounts.length; i++) {
                var current = discounts[i]

                if (current.discount_rate == '' || isNaN(current.discount_rate)) {
                    continue;
                }
                
                var rate = parseFloat(current.discount_rate)
                total += rate
            }

            return total.toFixed(2)
        },
        getDiscounts: function () {
            var scope = this
            var supplier_discount_group_uuid = scope.selected_group.uuid;
            scope.discounts = []
            scope.GET('suppliers/' + supplier_discount_group_uuid + '/supplier-base-discount-group-details').then(res => {
                scope.discounts = res.rows
            })
       },
        addNewDiscount: function (group) {
           var scope = this
            console.log(group)
            group.supplier_base_discount_group_details.push({
                id: null,
                uuid: null,
                discount_name: '',
                discount_rate: '',
           });
        },
        removeDiscount: function (group,index) {
            var scope = this

            group.supplier_base_discount_group_details.splice(index,1)
                      
        },
        addNewGroup: function () {
           var scope = this

           scope.groups.push({
                id: null,
                uuid: null,
                group_name: '',
                edit: true,
                view: false,
                supplier_base_discount_group_details: []
           });

           var index = scope.groups.length - 1
           var group = scope.groups[index]
           scope.addNewDiscount(group);
        },
        editGroup: function (data) {
           var scope = this
           
           if (data.uuid === null) {
               return;
           }

           scope.$set(data,'edit', true)

           // we will use this when cancelling the edit
           var copy = JSON.parse(JSON.stringify(data.supplier_base_discount_group_details))
           scope.$set(data,'supplier_base_discount_group_details_copy', copy)
        },
        viewGroup: function (data) {
           var scope = this
           
           if (data.uuid === null) {
               return;
           }

           scope.$set(data,'view', true)
        },
        cancelEditGroup: function (data,index) {
            var scope = this          

            data.supplier_base_discount_group_details = data.supplier_base_discount_group_details_copy
            
            if (!data.uuid) {
                scope.groups.splice(index,1)
            }

           data.edit = false
        },
        cancelViewGroup: function (data) {
           data.view = false
        },
        removeGroup: function (group,index) {
            var scope = this
            
     
            window.swal.fire({
                title: 'Delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                    scope.DELETE('suppliers/'+ group.supplier_uuid +'/supplier-base-discount-group/' + group.uuid).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Saved',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.groups.splice(index,1)
                            })
                        } else {
                            alert(res.message);
                        }
                        
                    })
                }                              
            })
        },
        selectGroup: function (data) {
           var scope = this

           if (data.uuid === null) {
               return;
           }

           scope.selected_group = data
           scope.getDiscounts()
       },
       getGroups: function () {
            var scope = this
            var supplier_uuid = scope.supplier_uuid;

            scope.GET('suppliers/' + supplier_uuid + '/supplier-base-discount-group?discounts=yes').then(res => {
                scope.groups = res.rows
                // auto select first group
                if (res.rows.length > 0) {
                    scope.selected_group = res.rows[0]
                    scope.getDiscounts();
                }
            })
       },
       saveGroup: function (group) {
            var scope = this
            var supplier_uuid = scope.supplier_uuid;
            
            scope.POST('suppliers/'+ supplier_uuid +'/supplier-base-discount-group', group).then(res => {
                
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        for (var key in res.data) {
                            group[key] = res.data[key]
                        }
                        group.edit = false
                    })
                } else {

                    for (var key in res.data) {
                        group[key] = res.data[key]
                    }
                }
                
            })
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