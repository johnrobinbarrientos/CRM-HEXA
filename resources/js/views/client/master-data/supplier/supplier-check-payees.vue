<template>
    <div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="card-title">Check Payees</div>
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
                            <template v-if="payees.length > 0">
                            <tr @click="selectPayee(payee)" v-bind:class="{'table-success' : (selected_payee && selected_payee.uuid === payee.uuid) }" style="cursor:pointer;" v-for="(payee,index) in payees" :key="index" >
                                <td>
                                    <template v-if="payee.edit !== true">
                                        <button @click="editPayee(payee)" type="button" class="btn btn-sm btn-light" :disabled="view_mode"><i class="bx bx-pencil"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                    </template>
                                    <template v-else>
                                        <button  @click="savePayee(payee)" type="button" class="btn btn-sm btn-primary" :disabled="view_mode"><i class="bx bx-save"></i></button>
                                        <button  type="button" class="btn btn-sm btn-danger" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                    </template>
                                </td>
                                <th scope="row" >
                                   {{ (index + 1) }}
                                </th>
                                <td>
                                    <strong v-if="payee.edit !== true">{{ payee.check_payee }}</strong>
                                    <input v-else v-model="payee.check_payee" class="form-control" type="text" placeholder="Enter check payee" :readonly="view_mode">
                                </td>
                                
                            </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="3" style="padding:20px; text-align:center; font-weight:600;">No payee has been added yet</td>
                                </tr>
                            </template>
                            <tr>
                                <!-- <td @click="addNewPayee()" colspan="3" style="background:#efefef; text-align:center; cursor:pointer; font-weight:600;"><i class="bx bx-plus"></i> New Payee</td> -->
                                <td style="text-align:center; cursor:pointer; font-weight:600; background:#efefef;" colspan="3" >
                                    <button @click="addNewPayee()"  type="button" style="font-weight:600; background:transparent; border:none;" :disabled="view_mode"><i class="bx bx-plus"></i>New Payee</button>
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
    name: 'supplier-check-payee',
    props: ['properties','supplier_uuid','view_mode'],
    data: function () {
        return {
            selected_payee: null,
            payees: []
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
        editPayee: function (data) {
           var scope = this
           
           if (data.uuid === null) {
               return;
           }

           scope.$set(data,'edit', true)
        },
        selectPayee: function (data) {
           var scope = this

           if (data.uuid === null) {
               return;
           }

           scope.selected_payee = data
       },
       getPayees: function () {
            var scope = this
            var supplier_uuid = scope.supplier_uuid;

            scope.GET('suppliers/' + supplier_uuid + '/check-payee').then(res => {
                scope.payees = res.rows
                // auto select first payee
                if (res.rows.length > 0) {
                    scope.selected_payee = res.rows[0]
                }
            })
       },
       savePayee: function (data) {
            var scope = this
            var supplier_uuid = scope.supplier_uuid;

            data['supplier_uuid'] = supplier_uuid
            scope.POST('suppliers/'+ supplier_uuid +'/check-payee', data).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Check payee has been successfuly Saved',
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
        scope.getPayees()
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