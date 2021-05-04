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
                                <th>Purok/Street/Zone</th>
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
                                        <b-dropdown-item href="javascript:void(0)" @click="remove(index)">Delete</b-dropdown-item>
                                    </b-dropdown>
                                </td>
                                <td>
                                    {{ branch.customer_name }}
                                </td>
                                <td>
                                    {{ branch.contact_person }}
                                </td>
                                <td>
                                    {{ branch.address1 }}
                                </td>
                                <td>
                                    <span v-if="branch.address_list!=null">
                                        {{ branch.address_list.barangay }} {{ branch.address_list.city_municipality }} {{ branch.address_list.province }} {{ branch.address_list.region }} {{ branch.address_list.postal_code }}
                                    </span>
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


        <div class="modal fade modal-md-form" tabindex="-1" id="modalBranches">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="selected_branch" class="modal-title">
                            <span v-if="!selected_branch.id">New Branch</span>
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
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Customer Name:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_branch.customer_name" class="form-control" v-bind:class="{'error' : selected_branch.customer_name_error}" type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Contact Person:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_branch.contact_person" class="form-control"  type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Purok/Street/Zone:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_branch.address1" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>

                            <label class="form-label" for="group-name">Address:</label>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <multiselect v-model="selected_address" :options="options_address" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="branch_new_mode">
                                        <span slot="noResult">No Results</span>
                                    </multiselect>
                                </div>                                           
                            </div>
                            <br/>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Email Address:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_branch.email_address" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div> 

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Contact No.:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_branch.contact_no" class="form-control"  v-bind:class="{'error' : selected_branch.contact_no_error}" type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>

                            <div class="form-group mt-2">
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" v-model="selected_branch.is_active" true-value="1" false-value="0" class="custom-control-input" id="is-active-branch" :disabled="view_mode">
                                        <label class="custom-control-label" for="is-active-branch">Is Active?</label>
                                    </div>
                                </div>
                            </div>                                  
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="selected_branch && selected_branch.uuid === null" @click="save()" type="button" class="btn btn-sm btn-primary">Save</button>
                        <button v-else @click="save()" type="button" class="btn btn-sm btn-primary">Update</button>
                        <button  @click="cancel()" type="button" class="btn btn-sm btn-outline-secondary">Close</button>
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

            selected_address: [],
            options_address: [],

            selected_supplier_group: null,
            options_supplier_group: [],

            branch_new_mode: true,

            selected_branch: null,
            selected_branch_index: null, // used for editing
            branches: [],
            table_responsive: true,

            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: ''
        }
    },

    watch: {
        selected_address: function () {
            var scope = this
            scope.fillAddress()
        },

    },

    methods: {
        addNewBranch: function () {
           var scope = this

           scope.branch_new_mode = true

            scope.selected_branch  = {
                    id: null,
                    uuid: null,
                    customer_name: '',
                    contact_person: '',
                    address1: '',
                    address_uuid: '',
                    address_list: [],
                    email_address: '',
                    contact_no: '',
                    is_active: 1,
                    edit: true
            }

            scope.selected_address = (scope.options_address.length < 1) ? [] : {
                            uuid: scope.options_address[0].uuid,
                            text: scope.options_address[0].text
                        }


           scope.OPEN_MODAL('#modalBranches');
        },

        getAddressList: function () {
           var scope = this
            scope.GET('company/address-list-all').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_address.push({
                        uuid: data.uuid,
                        text: data.barangay + ' ' + data.city_municipality + ' ' + data.province + ' ' + data.region + ' ' + data.postal_code,
                        barangay: data.barangay,
                        city_municipality: data.city_municipality,
                        province: data.province,
                        region: data.region,
                        postal_code: data.postal_code
                    })
                

                    scope.selected_address = (scope.options_address.length < 1) ? [] : {
                            uuid: scope.options_address[0].uuid,
                            text: scope.options_address[0].text
                        }
                    })

            })

        },

        edit: function (data,index) {
            var scope = this

            scope.$set(data,'edit', true)
            var copy = JSON.parse(JSON.stringify(data))
           
            scope.selected_branch_index = index
            scope.selected_branch = copy

            scope.branch_new_mode = false

            if (scope.selected_branch.address_list !== null){
                scope.selected_address = {
                        uuid: scope.selected_branch.address_list.uuid,
                        text: scope.selected_branch.address_list.barangay + ', ' + scope.selected_branch.address_list.city_municipality + ', ' + scope.selected_branch.address_list.province + ', ' + scope.selected_branch.address_list.postal_code + ', ' + scope.selected_branch.address_list.region
                    }
            }


            scope.OPEN_MODAL('#modalBranches');
        },
        cancel: function () {
           var scope = this

            scope.selected_branch = null 
            scope.selected_branch_index = null    
            scope.CLOSE_MODAL('#modalBranches'); 
        },
        selectBranch: function (data) {
           var scope = this

           if (data.uuid === null) {
               return;
           }

           scope.selected_branch = data
       },

       fillAddress: function () {
           var scope = this

            for (var i = 0; i < scope.options_address.length; i++) {
                if(scope.options_address[i].uuid==scope.selected_address.uuid){
                    scope.barangay = scope.options_address[i].barangay
                    scope.city_municipality = scope.options_address[i].city_municipality
                    scope.province = scope.options_address[i].province
                    scope.region = scope.options_address[i].region
                    scope.postal_code = scope.options_address[i].postal_code
                }
            }
                       
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
       remove: function(index) {
            var scope = this
            scope.branches.splice(index, 1)
        },
        getBranches: function () {
            return this.branches
        },
        save: function (data) {
            var scope = this

            var error = 0
            scope.$set(scope.selected_branch,'customer_name_error',false);
            scope.$set(scope.selected_branch,'contact_no_error',false);

            if (scope.selected_branch.customer_name == '') {
                error++;
                scope.selected_branch.customer_name_error = true
            }

            if (scope.selected_branch.contact_no == '') {
                error++;
                scope.selected_branch.contact_no_error = true
            }

            if (error) {
                return
            }

            scope.selected_branch.edit = false

            scope.selected_branch.address_uuid = (scope.selected_address == null) ? null : scope.selected_address.uuid

                scope.selected_branch.address_list = {
                    uuid: scope.selected_address.uuid,
                    barangay: scope.barangay,
                    city_municipality: scope.city_municipality,
                    postal_code: scope.postal_code,
                    province: scope.province,
                    region: scope.region
                }


            if (scope.selected_branch_index === null) {
                scope.branches.push(scope.selected_branch);

            } else {

                var copy = JSON.parse(JSON.stringify(scope.selected_branch))

                scope.branches[scope.selected_branch_index] = copy
            }


            scope.selected_branch = null
            scope.selected_branch_index = null
            scope.CLOSE_MODAL('#modalBranches');
        }
    },
    mounted() {
        var scope = this

        scope.getAddressList()
        
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