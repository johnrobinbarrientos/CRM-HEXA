<template>
    <div>
        <br/>
        <div class="row">
            <div class="col-lg-4 col-12" >
                <div class="card-title">Discount Groups</div>
                <div v-bind:class="{ 'table-responsive': table_responsive }">
                    <table class="table table-bordered table-hover mb-0 table-discounts">
                        <thead>
                            <tr>
                                <th width="90">Actions</th>
                                <th width="40">#</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="groups.length > 0">
                            <tr @click="selectGroup(group)" v-bind:class="{'table-success' : (selected_group && selected_group.uuid === group.uuid) }" style="cursor:pointer;" v-for="(group,index) in groups" :key="index" >
                                <td width="65" class="text-center">
                                    <span class="hx-table-actions">
                                        <template v-if="group.edit !== true">
                                            <button @click="editGroup(group)" class="btn btn-sm btn-shineblue" role="button" :disabled="view_mode"><i class="mdi mdi-pencil"></i></button>
                                            <button class="btn btn-sm btn-danger" role="button" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                        </template>
                                        <template v-else>
                                            <button @click="saveGroup(group)" class="btn btn-sm btn-primary" role="button" :disabled="view_mode"><i class="bx bx-save"></i></button>
                                            <button class="btn btn-sm btn-danger" role="button" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                        </template>
                                    </span>
                                </td>
                                <th scope="row" >
                                   {{ (index + 1) }}
                                </th>
                                <td>
                                    <strong v-if="group.edit !== true">{{ group.group_name }}</strong>
                                    <input v-else v-model="group.group_name" class="form-control" type="text" placeholder="Enter group name">
                                </td>
                                
                            </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="3" style="padding:20px; text-align:center; font-weight:600;">No supplier discount group has been added yet</td>
                                </tr>
                            </template>
                            <tr>
                                <td class="p-0" colspan="3" >
                                    <button @click="addNewGroup()"  type="button" style="font-weight:600; border-radius: 0; padding-top: 4px; padding-bottom: 4px;" :disabled="view_mode" class="hx-btn hx-btn-shineblue w-100"><i class="bx bx-plus"></i> New Group</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
            </div>
            <div v-if="selected_group" class="col-lg-4 col-12 offset-lg-1">
                <div class="card-title">{{ selected_group.group_name }} Discounts</div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0 table-discounts">
                        <thead>
                            <tr>
                                <th width="90">Actions</th>
                                <th width="40">#</th>
                                <th>Name</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="discounts.length > 0">
                            <tr style="cursor:pointer;" v-for="(discount,index) in discounts" :key="index" >
                                <td width="65" class="text-center">
                                    <span class="hx-table-actions">
                                        <template v-if="discount.edit !== true">
                                            <button @click="editDiscount(discount)" type="button" class="btn btn-sm btn-shineblue" :disabled="view_mode"><i class="mdi mdi-pencil"></i></button>
                                            <button class="btn btn-sm btn-danger" type="button" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                        </template>
                                        <template v-else>
                                            <button @click="saveDiscount(discount)" type="button" class="btn btn-sm btn-primary" :disabled="view_mode"><i class="bx bx-save"></i></button>
                                            <button class="btn btn-sm btn-danger" type="button" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                        </template>
                                    </span>
                                </td>
                                <th scope="row">
                                   {{ (index + 1) }}
                                </th>
                                <td>
                                    <span v-if="discount.edit !== true">{{ discount.discount_name }}</span>
                                    <input v-else v-model="discount.discount_name" class="form-control" type="text" placeholder="Enter discount name">
                                </td>

                                <td class="text-right">
                                    <span v-if="discount.edit !== true">{{ discount.discount_rate }}%</span>
                                    <input v-else v-model="discount.discount_rate" class="form-control" type="text" placeholder="Enter discount rate">
                                </td>
                            </tr>
                            <tr class="bg-grey">
                                <td colspan="3" class="text-right" style="border-bottom-color: #bbb !important;"><strong>Total</strong></td>
                                <td class="text-right" style="border-bottom-color: #bbb !important;"><strong>{{ totalDiscountGroup(discounts) }}%</strong></td>
                            </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="4" style="padding:20px; text-align:center; font-weight:600;"><strong>{{ selected_group.group_name }}</strong> has no discounts yet</td>
                                </tr>
                            </template>
                            <tr>
                                <td class="p-0" colspan="4" >
                                    <button @click="addNewDiscount()" type="button" style="font-weight:600; border-color: transparent; border-radius: 0; padding-top: 4px; padding-bottom: 4px;" :disabled="view_mode" class="hx-btn hx-btn-shineblue w-100"><i class="bx bx-plus"></i> New Discount</button>
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
        addNewDiscount: function () {
           var scope = this

           var allow_add = true
            for (let i = 0; i < scope.discounts.length; i++) {
               var current = scope.discounts[i]
               if (!current.id) {
                   allow_add = false
                   break;
               }
            }

            if (!allow_add) {
                return
            }

           scope.discounts.push({
                id: null,
                uuid: null,
                discount_name: '',
                discount_rate: '',
                edit: true
           });
        },
        editDiscount: function (data) {
           var scope = this
           
           if (data.uuid === null) {
               return;
           }

           scope.$set(data,'edit', true)
        },
        saveDiscount: function (data) {
            var scope = this
            var supplier_discount_group_uuid = scope.selected_group.uuid;
            scope.POST('suppliers/'+ supplier_discount_group_uuid +'/supplier-base-discount-group-details', data).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Discount Group has been successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.$set(data,'id',res.data.id)
                        scope.$set(data,'uuid',res.data.uuid)
                        scope.$set(data,'edit', false)
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },

        addNewGroup: function () {
           var scope = this

            var allow_add = true
            for (let i = 0; i < scope.groups.length; i++) {
               var current = scope.groups[i]
               if (!current.id) {
                   allow_add = false
                   break;
               }
            }

            if (!allow_add) {
                return
            }

           scope.groups.push({
                id: null,
                uuid: null,
                group_name: '',
                edit: true
           });
        },
        editGroup: function (data) {
           var scope = this
           
           if (data.uuid === null) {
               return;
           }

           scope.$set(data,'edit', true)
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

            scope.GET('suppliers/' + supplier_uuid + '/supplier-base-discount-group').then(res => {
                scope.groups = res.rows
                // auto select first group
                if (res.rows.length > 0) {
                    scope.selected_group = res.rows[0]
                    scope.getDiscounts();
                }
            })
       },
       saveGroup: function (data) {
            var scope = this
            var supplier_uuid = scope.supplier_uuid;
            scope.POST('suppliers/'+ supplier_uuid +'/supplier-base-discount-group', data).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.$set(data,'id',res.data.id)
                        scope.$set(data,'uuid',res.data.uuid)
                        scope.$set(data,'edit', false)
                    })
                } else {
                    alert('ERROR:' + res.code)
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