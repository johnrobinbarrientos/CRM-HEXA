<template>
    <div>
        <br/>
        <div class="row">

            <div class="col-md-5 col-12">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div style="text-align:right;">
                                <button @click="addNewPayee()"  type="button" class="btn-gray-small" :disabled="view_mode">New UOM</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom:80px;" v-bind:class="{ 'table-responsive': table_responsive }">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>UOM</th>
                                <th>Barcode</th>
                                <th>Packing</th>
                                <th>Sales Description</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="uoms.length > 0">
                            <tr @click="selectUOM(uom)"  v-for="(uom,index) in uoms" :key="index" >
                                <td width="80">
                                    <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="edit(uom,index)">
                                        <b-dropdown-item href="javascript:void(0)"  @click="edit(uom,index)">Edit</b-dropdown-item>
                                        <b-dropdown-item href="javascript:void(0)" @click="remove(uom,index)">Delete</b-dropdown-item>
                                    </b-dropdown>
                                </td>
                                <td>{{ getGlobalUOMName(uom.global_uom_uuid) }}</td>
                                <td>{{ uom.barcode }}</td>
                                <td>{{ uom.packing_qtty }}</td>
                                <td>{{ uom.sales_description }}</td>
                                <td>{{ uom.remarks }}</td>
                            </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="6" style="padding:20px; text-align:center; font-weight:600;">No Records</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>


        <div class="modal fade modal-single-form" tabindex="-1" id="modalUOM">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="selected_uom" class="modal-title">
                            <span v-if="!selected_uom.id">New UOM</span>
                            <span v-else>Edit UOM</span>
                        </h5>
                        <a href="javascript:void(0)"  @click="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form v-if="selected_uom" action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div style="padding:5px;">
                                        <!-- <span>{{ getGlobalUOMName(item_uom.uuid) }}</span> -->
                                        <div class="form-group">
                                            <label class="form-label" for="group-name">Select a UOM</label>
                                            <div class="form-control-wrap">
                                                <select v-model="selected_uom.global_uom_uuid" class="form-control">
                                                    <option :value="null">Select a UOM</option>
                                                    <option v-for="(uom,index_uom) in global_uoms" :key="'base-' + uom.uuid + '-' + index_uom" :value="uom.uuid">{{ uom.uom}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="group-name">Enter barcode</label>
                                            <div class="form-control-wrap">
                                                <input v-model="selected_uom.barcode" class="form-control"  v-bind:class="{'error' : selected_uom.barcode_error}" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="group-name">Enter packing</label>
                                            <div class="form-control-wrap">
                                                <input v-model="selected_uom.packing_qtty" class="form-control"  v-bind:class="{'error' : selected_uom.packing_qtty_error}" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="group-name">Enter sales description</label>
                                            <div class="form-control-wrap">
                                                <input v-model="selected_uom.sales_description" class="form-control"  v-bind:class="{'error' : selected_uom.sales_description_error}" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="group-name">Enter remarks</label>
                                            <div class="form-control-wrap">
                                                <input v-model="selected_uom.remarks" class="form-control"  v-bind:class="{'error' : selected_uom.remarks_error}" type="text"> 
                                            </div>
                                        </div>

                                    </div>
                                </div>                                           
                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="selected_uom && selected_uom.uuid === null" @click="save()" type="button" class="btn btn-sm btn-primary">Save</button>
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
    name: 'item-uoms',
    props: ['properties','item','view_mode'],
    data: function () {
        return {
            prerequiste: {
                global_uoms: false
            },
            selected_uom: null,
            selected_uom_index: null, // used for editing
            uoms: [],
            global_uoms: [],
            table_responsive: true,
        }
    },
    methods: {
        getGlobalUoms: function () {
           var scope = this
            scope.GET('globals/uom').then(res => {
                scope.global_uoms = res.rows
                scope.prerequiste.getGlobalUoms = true
            })
        },
        addNewPayee: function () {
           var scope = this

            scope.selected_uom  = {
                id: null,
                uuid: null,
                global_uom_uuid: null,
                barcode: '',
                packing_qtty: '',
                sales_description: '',
                remarks: '',
                edit: true
            }

           scope.OPEN_MODAL('#modalUOM');
        },
        edit: function (data,index) {
            var scope = this
   
            scope.$set(data,'edit', true)
            var copy = JSON.parse(JSON.stringify(data))
           
            scope.selected_uom_index = index
            scope.selected_uom = copy
            scope.OPEN_MODAL('#modalUOM');
        },
        cancel: function (data,index) {
           var scope = this

            scope.selected_uom = null 
            scope.selected_uom_index = null    
            scope.CLOSE_MODAL('#modalUOM'); 
        },
        selectPayee: function (data) {
           var scope = this

           if (data.uuid === null) {
               return;
           }

           scope.selected_uom = data
         },
      
        getItemUoms: function () {
            var scope = this
            var item_uuid = scope.item.uuid;

            scope.GET('items/'+ item_uuid +'/uoms').then(res => {
                // we use global UOM UUID as uuid instead
                scope.uoms = res.rows
            })
        },
       remove: function(payee,index) {
            var scope = this
            scope.uoms.splice(index,1)
        },
        save: function (data) {
            var scope = this

            var error = 0
            scope.$set(scope.selected_uom,'uom_error',false);
            scope.$set(scope.selected_uom,'barcode_error',false);
            scope.$set(scope.selected_uom,'packing_qtty_error',false);
            scope.$set(scope.selected_uom,'sales_description_error',false);
            scope.$set(scope.selected_uom,'remarks_error',false);

            if (scope.selected_uom.global_uom_uuid == '' || scope.selected_uom.global_uom_uuid === null) {
                error++;
                scope.selected_uom.uom_error = true
            }

            if (scope.selected_uom.barcode == '') {
                error++;
                scope.selected_uom.barcode_error = true
            }

            if (scope.selected_uom.packing_qtty == '') {
                error++;
                scope.selected_uom.packing_qtty_error = true
            }

        
            if (error) {
                return
            }

            scope.selected_uom.edit = false

            if (scope.selected_uom_index === null) {
                 scope.uoms.push(scope.selected_uom);
            } else {
                var copy = JSON.parse(JSON.stringify(scope.selected_uom))
                scope.uoms[scope.selected_uom_index] = copy
            }

            scope.selected_uom = null
            scope.selected_uom_index = null
            scope.CLOSE_MODAL('#modalUOM');
        },
        getGlobalUOMName: function (uuid) {
            var data = this.global_uoms.filter((uom) => {
                return uom.uuid.indexOf(uuid) > -1;
            })
            
            if (data.length < 1) {
                return ''
            }

            return data[0].uom
        },
        getUOMS: function () {
            return this.uoms
        }
    },
    mounted() {
        var scope = this


        scope.getGlobalUoms();
        scope.getItemUoms();

        if(scope.properties) {
            scope.table_responsive = scope.properties.table_responsive
        }
    },
}
</script>

<style scoped>
a.disabled {
    pointer-events: none;
    color: #ccc;
}

.form-group { margin-bottom: 1rem !important; }

</style>