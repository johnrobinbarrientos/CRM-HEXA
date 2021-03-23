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
                                <button @click="addNewPayee()"  type="button" class="btn-gray-small" :disabled="view_mode">Add</button>
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
                                <td width="80">
                                    <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="edit(payee,index)">
                                        <b-dropdown-item href="javascript:void(0)"  @click="edit(payee,index)">Edit</b-dropdown-item>
                                        <b-dropdown-item href="javascript:void(0)" @click="remove(payee,index)">Delete</b-dropdown-item>
                                    </b-dropdown>
                                </td>
                                <td>
                                    {{ payee.check_payee }}
                                </td>
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


        <div class="modal fade modal-single-form" tabindex="-1" id="modalPayee">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="selected_payee" class="modal-title">
                            <span v-if="!selected_payee.id">New</span>
                            <span v-else>Edit</span>
                        </h5>
                        <a href="javascript:void(0)"  @click="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form v-if="selected_payee" action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div style="padding:5px;">
                                        <input v-model="selected_payee.check_payee" class="form-control-gray-medium"  v-bind:class="{'error' : selected_payee.check_payee_error}" type="text" placeholder="Payee">
                                    </div>
                                </div>                                           
                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="selected_payee && selected_payee.uuid === null" @click="save()" type="button" class="btn btn-sm btn-primary">Save</button>
                        <button v-else @click="save()" type="button" class="btn btn-sm btn-primary">Update</button>
                        <button  @click="cancel()" type="button" class="btn btn-sm btn-default">Close</button>
                    </div>
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
            selected_payee_index: null, // used for editing
            payees: [],
            table_responsive: true,
        }
    },
    methods: {
        addNewPayee: function () {
           var scope = this

            scope.selected_payee  = {
                    id: null,
                    uuid: null,
                    check_payee: '',
                    edit: true
            }

            /*
            scope.payees.push({
                    id: null,
                    uuid: null,
                    check_payee: '',
                    edit: true
            });
            */

           

           scope.OPEN_MODAL('#modalPayee');
        },
        edit: function (data,index) {
            var scope = this

            scope.$set(data,'edit', true)
            var copy = JSON.parse(JSON.stringify(data))
           
            scope.selected_payee_index = index
            scope.selected_payee = copy
            scope.OPEN_MODAL('#modalPayee');
        },
        cancel: function (data,index) {
           var scope = this

            scope.selected_payee = null 
            scope.selected_payee_index = index    
            scope.CLOSE_MODAL('#modalPayee'); 
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
                title: 'Delete?',
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
                                title: 'Deleted',
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
        getPayees: function () {
            return this.payees
        },
        save: function (data) {
            var scope = this

            var error = 0
            scope.$set(scope.selected_payee,'check_payee_error',false);

            if (scope.selected_payee.check_payee == '') {
                error++;
                scope.selected_payee.check_payee_error = true
            }

            if (error) {
                return
            }

            scope.selected_payee.edit = false

            if (scope.selected_payee_index === null) {
                 scope.payees.push(scope.selected_payee);
            } else {
                var copy = JSON.parse(JSON.stringify(scope.selected_payee))
                scope.payees[scope.selected_payee_index] = copy
            }

            scope.selected_payee = null
            scope.selected_payee_index = null
            scope.CLOSE_MODAL('#modalPayee');
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