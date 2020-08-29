<template>
    <div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">Cost Center</div>
                <div class="mb-3 card-subtitle">
                    Below are the list of active Cost Center.
                </div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" placeholder="Search Item">
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalCostCenter');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New Cost Center</span>
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
                                <th>Cost Center Name</th>
                                <th>Shortname</th>
                                <th>Is Group</th>
                                <th>Cost Center Group</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(costcenter, index) in costCenters" :key="costcenter.uuid">
                                <td>
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCostCenter');setData(costcenter)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(costcenter)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                                <td>{{ (index + 1) }}</td>
                                <td>{{ costcenter.cost_center_name }}</td>
                                <td>{{ costcenter.cost_center_shortname }}</td>
                                <td v-if="costcenter.is_group === 1">Yes</td>
                                <td v-else>No</td>
                                <td>{{ costcenter.cost_center_group }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalCostCenter">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cost Center Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalCostCenter');" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cost-center">Cost Center Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.cost_center_name" type="text" class="form-control" id="cost-center-name" required>
                                        </div>
                                        <label class="form-label" for="cost-center">Shortname</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.cost_center_shortname" type="text" class="form-control" id="cost-center-shortname" required>
                                        </div>
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.is_group" true-value="1" false-value="0" class="custom-control-input" id="is-group">
                                                <label class="custom-control-label" for="is-group">Is Group?</label>
                                            </div>
                                        </div>
                                        <label class="form-label" for="cost-center">Cost Center Group</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.cost_center_group" type="text" class="form-control" id="cost-center-group" required>
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
    name: 'cost-centers',
    props: ['properties'],
    data: function () {
        return {
            costCenters: [],
            formdata: { 
                uuid: null, 
                cost_center_name: '',
                cost_center_shortname: '',
                is_group: '',
                cost_center_group: ''
            }
        }
    },
    methods: {
        getCostCenters: function () {
           var scope = this
            scope.GET('admin/cost-center').then(res => {
                scope.costCenters = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.cost_center_name = ''
            scope.formdata.cost_center_shortname = ''
            scope.formdata.is_group = ''
            scope.formdata.cost_center_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.cost_center_name = data.cost_center_name
            scope.formdata.cost_center_shortname = data.cost_center_shortname
            scope.formdata.is_group = data.is_group
            scope.formdata.cost_center_group = data.cost_center_group
        },
        save: function () {
            var scope = this
            scope.POST('admin/cost-center', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cost Center Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getCostCenters()
                        scope.CLOSE_MODAL('#modalCostCenter')
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
                    scope.POST('admin/cost-center', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Cost Center Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getCostCenters()
                                scope.CLOSE_MODAL('#modalCostCenter')
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
                    scope.POST('admin/cost-center/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Cost Center Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCostCenters()
                            scope.CLOSE_MODAL('#modalCostCenter')
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
        scope.getCostCenters()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>