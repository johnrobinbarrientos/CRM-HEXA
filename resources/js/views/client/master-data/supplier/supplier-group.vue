<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i> Supplier Group</h1>
            </div>
            <div class="bar-right">
                <input type="text" class="form-control" placeholder="Search">
                <a @click="OPEN_MODAL('#modalSupplierGroup');toggleForm();resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>
            
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-12">
                    <div class="card card-bordered card-preview">
                        <table class="table table-tranx jd-sm-table">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th><span class="">#</span></th>
                                    <th><span class="">Group Name</span></th>
                                    <th><span class="">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(group, index) in groups" :key="group.uuid" class="tb-tnx-item">
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">{{ group.group_name }}</span></td>
                                    <td>
                                        <span class="">
                                            <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalSupplierGroup');setData(group)" class="btn btn-sm btn-light"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript:void(0)"  @click="remove(group)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            


            <!-- Modal Group Form -->
            <div class="modal fade" tabindex="-1" id="modalSupplierGroup">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Supplier Group Details</h5>
                            <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalSupplierGroup');" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="bx bx-x"></i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <form action="#" class="form-validate is-alter">

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="group-name">Group Name</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.group_name" type="text" class="form-control" id="group-name" required>
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
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'supplier-group',
    props: ['properties'],
    data: function () {
        return {
            groups: [],
            formdata: { 
                uuid: null, 
                group_name: ''
            }
        }
    },
    methods: {
        getSupplierGroup: function () {
           var scope = this
            scope.GET('suppliers/supplier-group').then(res => {
                scope.groups = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.group_name = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.group_name = data.group_name
        },
        save: function () {
            var scope = this
            scope.POST('suppliers/supplier-group', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Supplier Group Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getSupplierGroup()
                        scope.CLOSE_MODAL('#modalSupplierGroup')
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
                    scope.POST('suppliers/supplier-group', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Supplier Group Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getSupplierGroup()
                                scope.$parent.refreshSupplierGroup()
                                scope.CLOSE_MODAL('#modalSupplierGroup')
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
                    scope.POST('suppliers/supplier-group/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Supplier Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getSupplierGroup()
                            scope.CLOSE_MODAL('#modalSupplierGroup')
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
        scope.getSupplierGroup()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>