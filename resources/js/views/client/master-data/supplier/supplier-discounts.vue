<template>
    <div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="card-title">Discount Groups</div>
                <div class="table-responsive">
                    <table class="table  table-striped table-bordered table-hover mb-0 table">
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
                                <td>
                                    <template v-if="group.edit !== true">
                                        <button @click="editGroup(group)" class="btn btn-sm btn-light" role="button" :disabled="show_view"><i class="bx bx-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger" role="button"><i class="bx bx-trash-alt" :disabled="show_view"></i></button>
                                    </template>
                                    <template v-else>
                                        <button @click="saveGroup(group)" class="btn btn-sm btn-primary" role="button" :disabled="show_view"><i class="bx bx-save"></i></button>
                                        <!-- <a @click="saveGroup(group)" class="btn btn-sm btn-primary" role="button" href="javascript:void(0);"><i class="bx bx-save"></i></a> -->
                                        <button class="btn btn-sm btn-danger" role="button" :disabled="show_view"><i class="bx bx-trash-alt"></i></button>
                                        <!-- <a class="btn btn-sm btn-danger" role="button" href="javascript:void(0);"><i class="bx bx-trash-alt"></i></a> -->
                                    </template>
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
                                <td @click="addNewGroup()" colspan="3" style="background:#efefef; text-align:center; cursor:pointer; font-weight:600;"><i class="bx bx-plus"></i> NEW GROUP</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
            </div>
            <div v-if="selected_group" class="col-md-7 col-12 offset-md-1">
                <div class="card-title">{{ selected_group.group_name }} Discounts</div>
                <div class="table-responsive">
                    <table class="table  table-striped table-bordered table-hover mb-0 table">
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
                                <td>
                                    <template v-if="discount.edit !== true">
                                        <a @click="editDiscount(discount)" class="btn btn-sm btn-light" role="button" href="javascript:void(0);"><i class="bx bx-pencil"></i></a>
                                        <a class="btn btn-sm btn-danger" role="button" href="javascript:void(0);"><i class="bx bx-trash-alt"></i></a>
                                    </template>
                                    <template v-else>
                                        <a @click="saveDiscount(discount)" class="btn btn-sm btn-primary" role="button" href="javascript:void(0);"><i class="bx bx-save"></i></a>
                                        <a class="btn btn-sm btn-danger" role="button" href="javascript:void(0);"><i class="bx bx-trash-alt"></i></a>
                                    </template>
                                </td>
                                <th scope="row">
                                   {{ (index + 1) }}
                                </th>
                                <td>
                                    <strong v-if="discount.edit !== true">{{ discount.discount_name }}</strong>
                                    <input v-else v-model="discount.discount_name" class="form-control" type="text" placeholder="Enter discount name">
                                </td>

                                <td class="text-right">
                                    <strong v-if="discount.edit !== true">{{ discount.discount_rate }}%</strong>
                                    <input v-else v-model="discount.discount_rate" class="form-control" type="text" placeholder="Enter discount rate">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total</strong></td>
                                <td class="text-right"><strong>{{ totalDiscountGroup(discounts) }}%</strong></td>
                            </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="4" style="padding:20px; text-align:center; font-weight:600;"><strong>{{ selected_group.group_name }}</strong> has no discounts yet</td>
                                </tr>
                            </template>
                            <tr>
                                <td @click="addNewDiscount()" colspan="4" style="background:#efefef; text-align:center; cursor:pointer; font-weight:600;"><i class="bx bx-plus"></i> NEW DISCOUNT</td>
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
    props: ['properties','supplier_uuid'],
    data: function () {
        return {
            selected_group: null,
            discounts: [],
            groups: [],
            show_view: false
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
       }
    },
    mounted() {
        var scope = this
        scope.getGroups()
        scope.show_view = scope.properties.view
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */
a.disabled {
    pointer-events: none;
    color: #ccc;
}

</style>