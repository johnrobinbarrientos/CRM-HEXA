<template>
    <div>
        <br/>
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">Contact</div>
                        <div class="col-md-6">
                            <div style="text-align:right;">
                                <button @click="addNewContact()"  type="button" class="btn-gray-small" :disabled="view_mode">New Contact</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom:80px;" v-bind:class="{ 'table-responsive': table_responsive }">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Contact Person</th>
                                <th>Position</th>
                                <th>Email Address</th>
                                <th>Contact No.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="contacts.length > 0">
                                <tr @click="selectContact(contact)"  v-for="(contact,index) in contacts" :key="index" >
                         
                                    <td width="80">
                                        <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="edit(contact,index)">
                                            <b-dropdown-item href="javascript:void(0)"  @click="edit(contact,index)">Edit</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="remove(index)">Delete</b-dropdown-item>
                                        </b-dropdown>
                                    </td>
                                    <td>
                                        {{ contact.contact_person }}
                                    </td>
                                    <td>
                                        {{ contact.position }}
                                    </td>
                                    <td>
                                        {{ contact.email_address }}
                                    </td>
                                    <td>
                                        {{ contact.contact_no }}
                                    </td>
                             
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="5" style="padding:20px; text-align:center; font-weight:600;">No Records</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>


        <div class="modal fade modal-single-form" tabindex="-1" id="modalContact">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="selected_contact" class="modal-title">
                            <span v-if="!selected_contact.id">New</span>
                            <span v-else>Edit</span>
                        </h5>
                        <a href="javascript:void(0)"  @click="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form v-if="selected_contact" action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Contact Person:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_contact.contact_person" class="form-control"  v-bind:class="{'error' : selected_contact.contact_person_error}" type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Position:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_contact.position" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Email Address:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_contact.email_address" class="form-control"  type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div> 

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="group-name">Contact No.:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="selected_contact.contact_no" class="form-control"  v-bind:class="{'error' : selected_contact.contact_no_error}" type="text" required>
                                        </div>
                                    </div>
                                </div>                                           
                            </div>                                     
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="selected_contact && selected_contact.uuid === null" @click="save()" type="button" class="btn btn-sm btn-primary">Save</button>
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
import moment from 'moment'

export default {
    name: 'supplier-contacts',
    props: ['properties','supplier_uuid','view_mode'],
    data: function () {
        return {
            selected_contact: null,
            selected_contact_index: null, // used for editing
            contacts: [],
            table_responsive: true,
        }
    },
    methods: {
        addNewContact: function () {
           var scope = this

            scope.selected_contact  = {
                    id: null,
                    uuid: null,
                    contact_person: '',
                    position: '',
                    email_address: '',
                    contact_no: '',
                    edit: true
            }

           scope.OPEN_MODAL('#modalContact');
        },
        edit: function (data,index) {
            var scope = this

            scope.$set(data,'edit', true)
            var copy = JSON.parse(JSON.stringify(data))
           
            scope.selected_contact_index = index
            scope.selected_contact = copy
            scope.OPEN_MODAL('#modalContact');
        },
        cancel: function (data,index) {
           var scope = this

            scope.selected_contact = null 
            scope.selected_contact_index = index    
            scope.CLOSE_MODAL('#modalContact'); 
        },
        selectContact: function (data) {
           var scope = this

           if (data.uuid === null) {
               return;
           }

           scope.selected_contact = data
       },
       getContactsBySupplier: function (supplier_uuid) {
            var scope = this
            
            scope.GET('suppliers/' + supplier_uuid + '/contacts').then(res => {
                scope.contacts = res.rows
                // auto select first 
                if (res.rows.length > 0) {
                    scope.selected_contact = res.rows[0]
                }
            })
       },
       remove: function(index) {
            var scope = this
            scope.contacts.splice(index, 1)
        },
        getContacts: function () {
            return this.contacts
        },
        save: function (data) {
            var scope = this

            var error = 0
            scope.$set(scope.selected_contact,'contact_person_error',false);
            scope.$set(scope.selected_contact,'contact_no_error',false);

            if (scope.selected_contact.contact_person == '') {
                error++;
                scope.selected_contact.contact_person_error = true
            }

            if (scope.selected_contact.contact_no == '') {
                error++;
                scope.selected_contact.contact_no_error = true
            }

            if (error) {
                return
            }

            scope.selected_contact.edit = false

            if (scope.selected_contact_index === null) {
                 scope.contacts.push(scope.selected_contact);
            } else {
                var copy = JSON.parse(JSON.stringify(scope.selected_contact))
                scope.contacts[scope.selected_contact_index] = copy
            }



            scope.selected_contact = null
            scope.selected_contact_index = null
            scope.CLOSE_MODAL('#modalContact');
        }
    },
    mounted() {
        var scope = this
        
        if(scope.supplier_uuid) {
            var supplier_uuid = scope.supplier_uuid
            scope.getContactsBySupplier(supplier_uuid)
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