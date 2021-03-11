<template>
    <div>
        <br/>
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">Check Payee</div>
                        <div class="col-md-6">
                            <div style="text-align:right;">
                                <button @click="addNewPayee()"  type="button" class="btn-gray-small" :disabled="view_mode">New Payee</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom:80px;" v-bind:class="{ 'table-responsive': table_responsive }">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="payees.length > 0">
                            <tr @click="selectPayee(payee)"  v-for="(payee,index) in payees" :key="index" >
                                <template  v-if="!payee.edit">
                                    <td width="80">
                                        <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="edit(payee)">
                                            <b-dropdown-item href="javascript:void(0)"  @click="edit(payee)">Edit</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="remove(payee,index)">Delete</b-dropdown-item>
                                        </b-dropdown>
                                    </td>
                                    <td>
                                        {{ payee.check_payee }}
                                    </td>
                                </template>
                                <template  v-else>
                                    <td style="padding:0px;" colspan="2">
                                        <div style="padding:8px; padding-top:15px; background:#f5f5f5; border:2px solid #ccc;">
                                            <strong>Check Payee</strong>
                                            <input v-model="payee.check_payee" class="form-control-gray-medium" type="text" placeholder="Enter check payee">

                                            <div style="margin-top:10px; margin-bottom:10px; text-align:center;">
                                                <button class="btn-gray-small" @click="save(payee)" type="button">Save</button>
                                                <button class="btn-gray-small" @click="cancel(payee,index)" type="button" >Cancel</button>
                                            </div>
                                        </div>
                                    </td>
                                </template>
                    
                            </tr>
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
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'supplier-check-payee',
    props: ['properties','supplier_uuid','view_mode'],
    data: function () {
        return {
            selected_payee: null,
            payees: [],
            table_responsive: true,
        }
    },
    methods: {
        addNewPayee: function () {
           var scope = this

            var allow_add = true
            for (let i = 0; i < scope.payees.length; i++) {
               var current = scope.payees[i]
               if (!current.id) {
                   allow_add = false
                   break;
               }
            }

            if (!allow_add) {
                return
            }

           scope.payees.push({
                id: null,
                uuid: null,
                check_payee: '',
                edit: true
           });
        },
        edit: function (data) {
           var scope = this

           var copy = JSON.parse(JSON.stringify(data))
           scope.$set(data,'check_payee_copy', copy.check_payee)
           scope.$set(data,'edit', true)
        },
        cancel: function (data,index) {
           var scope = this

           if (!data.uuid) {
                scope.payees.splice(index,1)
            }

           data.edit = false
           scope.$set(data,'check_payee',data.check_payee_copy)
        },
        selectPayee: function (data) {
           var scope = this

           if (data.uuid === null) {
               return;
           }

           scope.selected_payee = data
       },
       getPayeesBySupplier: function (supplier_uuid) {
            var scope = this
            
            scope.GET('suppliers/' + supplier_uuid + '/check-payee').then(res => {
                scope.payees = res.rows
                // auto select first payee
                if (res.rows.length > 0) {
                    scope.selected_payee = res.rows[0]
                }
            })
       },
       remove: function(payee,index) {
            var scope = this
            var supplier_uuid = scope.supplier_uuid;

            window.swal.fire({
                title: 'Remove?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                    scope.DELETE('suppliers/'+ supplier_uuid +'/check-payee/' + payee.uuid).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Saved',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.payees.splice(index,1)
                            })
                        } else {
                            alert(res.message);
                        }
                        
                    })
                    
                }                              
            })
       },
       save: function (data) {
            var scope = this
            var supplier_uuid = scope.supplier_uuid;

            data['supplier_uuid'] = supplier_uuid
            scope.POST('suppliers/'+ supplier_uuid +'/check-payee', data).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        data.id = res.data.id
                        data.uuid = res.data.uuid
                        data.edit = false
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
       }
    },
    mounted() {
        var scope = this
        
        if(scope.supplier_uuid) {
            var supplier_uuid = scope.supplier_uuid
            scope.getPayeesBySupplier(supplier_uuid)
        }

        if(scope.properties) {
            scope.table_responsive = scope.properties.table_responsive
        }
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