<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i> Employment Type</h1>
            </div>
            <div class="bar-right">
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Employee">
                <a @click="OPEN_MODAL('#modalEmploymentType');resetData();" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                    <i class="las la-plus"></i> <span>Add New Employee</span>
                </a>
            </div>
        </div>
                
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-12">
                    <div class="card card-bordered card-preview">
                        <table class="table table-tranx">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th><span class="">#</span></th>
                                    <th><span class="">Employment Type</span></th>
                                    <th><span class="">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(type, index) in employmentTypes" :key="type.uuid" class="tb-tnx-item">
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">{{ type.employment_type }}</span></td>
                                    <td>
                                        <span class="">
                                            <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalEmploymentType');setData(type)" class="btn btn-sm btn-light"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript:void(0)"  @click="remove(type)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            


            <!-- Modal Group Form -->
            <div class="modal fade" tabindex="-1" id="modalEmploymentType">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Employment Type Details</h5>
                            <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalEmploymentType');" class="close" data-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                        <div class="modal-body">
                            <form action="#" class="form-validate is-alter">

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="employment-type">Employment Type</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.employment_type" type="text" class="form-control" id="employment-type" required>
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
    name: 'employment-type',
    props: ['properties'],
    data: function () {
        return {
            employmentTypes: [],
            formdata: { 
                uuid: null, 
                employment_type: ''
            }
        }
    },
    methods: {
        getEmploymentType: function () {
           var scope = this
            scope.GET('employees/employment-type').then(res => {
                scope.employmentTypes = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.employment_type = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.employment_type = data.employment_type
        },
        save: function () {
            var scope = this
            scope.POST('employees/employment-type', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Employment Type Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getEmploymentType()
                        scope.CLOSE_MODAL('#modalEmploymentType')
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
                    scope.POST('employees/employment-type', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Employment Type Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getEmploymentType()
                                scope.CLOSE_MODAL('#modalEmploymentType')
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
                    scope.POST('employees/employment-type/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Employment Type Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getEmploymentType()
                            scope.CLOSE_MODAL('#modalEmploymentType')
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
        scope.getEmploymentType()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>