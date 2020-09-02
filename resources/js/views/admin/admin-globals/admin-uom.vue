<template>
    <div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">UOM</div>
                <div class="mb-3 card-subtitle">
                    Below are the list of active UOM.
                </div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" placeholder="Search UOM">
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalUom');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New UOM</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th width="100">Actions</th>
                                <th width="100">#</th>
                                <th>UOM</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(uom, index) in Uoms" :key="uom.uuid">
                                <td>
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalUom');setData(uom)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(uom)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                                <td>{{ (index + 1) }}</td>
                                <td>{{ uom.uom }}</td>
                                <td>{{ uom.type }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalUom">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">UOM Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalUom');" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="uom">UOM</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.uom" type="text" class="form-control" id="uom" required>
                                        </div>
                                        <label class="form-label" for="type">Type</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.type" type="text" class="form-control" id="type" required>
                                        </div>
                                    </div>
                                </div>
                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="formdata.uuid === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                        <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'admin-uom',
    props: ['properties'],
    data: function () {
        return {
            Uoms: [],
            formdata: { 
                uuid: null, 
                uom: '',
                type: '',
            }
        }
    },
    methods: {
        getUoms: function () {
           var scope = this
            scope.GET('admin/uom').then(res => {
                scope.Uoms = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.uom = ''
            scope.formdata.type = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.uom = data.uom
            scope.formdata.type = data.type
        },
        save: function () {
            var scope = this
            scope.POST('admin/uom', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'UOM Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getUoms()
                        scope.CLOSE_MODAL('#modalUom')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            window.swal.fire({
                title: 'Update Record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('admin/uom', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'UOM Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getUoms()
                                scope.CLOSE_MODAL('#modalUom')
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        },
        remove: function (data) {
            var scope = this

            window.swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('admin/uom/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Uom Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getUoms()
                            scope.CLOSE_MODAL('#modalUom')
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        }
    },
    mounted() {
        var scope = this
        scope.getUoms()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>