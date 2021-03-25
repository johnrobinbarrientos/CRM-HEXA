<template>
    <div>
        <br/>
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">Branch</div>
                        <div class="col-md-6">
                            <div style="text-align:right;">
                                <button @click="addNewBranch()"  type="button" class="btn-gray-small" :disabled="view_mode">New Branch</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom:80px;" v-bind:class="{ 'table-responsive': table_responsive }">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Customer Name</th>
                                <th>Contact Person</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Is Active?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="branches.length > 0">
                            <tr @click="selectBranch(branch)"  v-for="(branch,index) in branches" :key="index" >
                                <td width="80">
                                    <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="edit(branch,index)">
                                        <b-dropdown-item href="javascript:void(0)"  @click="edit(branch,index)">Edit</b-dropdown-item>
                                        <b-dropdown-item href="javascript:void(0)" @click="remove(branch,index)">Delete</b-dropdown-item>
                                    </b-dropdown>
                                </td>
                                <td>
                                    {{ branch.name }}
                                </td>
                                <td>
                                    {{ branch.contact_person }}
                                </td>
                                <td>
                                    {{ branch.address }}
                                </td>
                                <td>
                                    {{ branch.email_address }}
                                </td>
                                <td>
                                    {{ branch.contact_no }}
                                </td>
                                <td v-if="branch.is_active === 1">Yes</td>
                                <td v-else>No</td>
                            </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="7" style="padding:20px; text-align:center; font-weight:600;">No Records</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>


        <div class="modal fade modal-single-form" tabindex="-1" id="modalBranches">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="selected_branch" class="modal-title">
                            <span v-if="!selected_branch.id">New</span>
                            <span v-else>Edit</span>
                        </h5>
                        <a href="javascript:void(0)"  @click="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form v-if="selected_branch" action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div style="padding:5px;">
                                        <input v-model="selected_branch.name" class="form-control-gray-medium"  v-bind:class="{'error' : selected_branch.name_error}" type="text" placeholder="Customer Name">
                                    </div>
                                </div>                                           
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div style="padding:5px;">
                                        <input v-model="selected_branch.contact_person" class="form-control-gray-medium"  type="text" placeholder="Contact Person">
                                    </div>
                                </div>                                           
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div style="padding:5px;">
                                        <input v-model="selected_branch.address" class="form-control-gray-medium"  type="text" placeholder="Address">
                                    </div>
                                </div>                                           
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div style="padding:5px;">
                                        <input v-model="selected_branch.email_address" class="form-control-gray-medium"  type="text" placeholder="Email Address">
                                    </div>
                                </div>                                           
                            </div> 

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div style="padding:5px;">
                                        <input v-model="selected_branch.contact_no" class="form-control-gray-medium"  v-bind:class="{'error' : selected_branch.contact_no_error}" type="text" placeholder="Contact No.">
                                    </div>
                                </div>                                           
                            </div>

                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" v-model="selected_branch.is_active" true-value="1" false-value="0" class="custom-control-input" id="is-active-branch" :disabled="view_mode">
                                            <label class="custom-control-label" for="is-active-branch">Is Active?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>                                     
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="selected_branch && selected_branch.uuid === null" @click="save()" type="button" class="btn btn-sm btn-primary">Save</button>
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
    name: 'customer-branches',
    props: ['properties','customer_uuid','view_mode'],
    data: function () {
        return {
            selected_branch: null,
            selected_branch_index: null, // used for editing
            branches: [],
            table_responsive: true,
        }
    },
    methods: {
        addNewBranch: function () {
           var scope = this

            scope.selected_branch  = {
                    id: null,
                    uuid: null,
                    name: '',
                    contact_person: '',
                    address: '',
                    email_address: '',
                    contact_no: '',
                    is_active: 1,
                    edit: true
            }

           scope.OPEN_MODAL('#modalBranches');
        },
        edit: function (data,index) {
            var scope = this

            scope.$set(data,'edit', true)
            var copy = JSON.parse(JSON.stringify(data))
           
            scope.selected_branch_index = index
            scope.selected_branch = copy
            scope.OPEN_MODAL('#modalBranches');
        },
        cancel: function (data,index) {
           var scope = this

            scope.selected_branch = null 
            scope.selected_branch_index = index    
            scope.CLOSE_MODAL('#modalBranches'); 
        },
        selectBranch: function (data) {
           var scope = this

           if (data.uuid === null) {
               return;
           }

           scope.selected_branch = data
       },
       getBranchByCustomer: function (customer_uuid) {
            var scope = this
            
            scope.GET('customers/' + customer_uuid + '/branches').then(res => {
                scope.branches = res.rows
                // auto select first 
                if (res.rows.length > 0) {
                    scope.selected_branch = res.rows[0]
                }
            })
       },
       remove: function(branch,index) {
            var scope = this
            var customer_uuid = scope.customer_uuid;

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
                    scope.DELETE('customers/'+ customer_uuid +'/branches/' + branch.uuid).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.branches.splice(index,1)
                            })
                        } else {
                            alert(res.message);
                        }
                        
                    })
                    
                }                              
            })
        },
        getBranches: function () {
            return this.branches
        },
        save: function (data) {
            var scope = this

            var error = 0
            scope.$set(scope.selected_branch,'name_error',false);
            scope.$set(scope.selected_branch,'contact_no_error',false);

            if (scope.selected_branch.name == '') {
                error++;
                scope.selected_branch.name_error = true
            }

            if (scope.selected_branch.contact_no == '') {
                error++;
                scope.selected_branch.contact_no_error = true
            }

            if (error) {
                return
            }

            scope.selected_branch.edit = false

            if (scope.selected_branch_index === null) {
                 scope.branches.push(scope.selected_branch);
            } else {
                var copy = JSON.parse(JSON.stringify(scope.selected_branch))
                scope.branches[scope.selected_branch_index] = copy
            }


            console.log(scope.selected_branch)


            scope.selected_branch = null
            scope.selected_branch_index = null
            scope.CLOSE_MODAL('#modalBranches');
        }
    },
    mounted() {
        var scope = this
        
        if(scope.customer_uuid) {
            var customer_uuid = scope.customer_uuid
            scope.getBranchByCustomer(customer_uuid)
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