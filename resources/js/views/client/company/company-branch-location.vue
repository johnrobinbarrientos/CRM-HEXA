<template>
    <div >
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Branch Location">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalBranchLocation');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Branch Location</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="nk-content nk-content-fluid">          
            <div class="container-fluid">
                <div class="nk-content-body">

                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="card card-bordered card-preview">
                                <table class="table table-tranx">
                                    <thead>
                                        <tr class="tb-tnx-head">
                                            <th><span class="">#</span></th>
                                            <th><span class="">Location Name</span></th>
                                            <th><span class="">Shortname</span></th>
                                            <th><span class="">Branch</span></th>
                                            <th><span class="">Actions</span></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(location, index) in branchLocations" :key="location.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ location.location_name }}</span></td>
                                            <td><span class="">{{ location.location_shortname }}</span></td>
                                            <td><span class="">{{ location.branch.branch_name }}</span></td>

                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalBranchLocation');setData(location)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(location)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    


                    <!-- Modal Group Form -->
                    <div class="modal fade" tabindex="-1" id="modalBranchLocation">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Branch Location Details</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalBranchLocation');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="location-branch">Location Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_name" type="text" class="form-control" id="location-name" required>
                                                    </div>
                                                    <label class="form-label" for="location-branch">Location Shortname</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_shortname" type="text" class="form-control" id="location-shortname" required>
                                                    </div>
                                                    <label class="form-label" for="location-branch">Branch</label>
                                                     <select class="form-select-branch" v-model="selected_branch" :options="options_branch" name="branch">
                                                        <!-- <option></option> -->
                                                    </select>
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
        </div>        
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'branch-location',
    props: ['properties'],
    data: function () {
        return {
            branchLocations: [],
            formdata: { 
                uuid: null,
                branch_uuid: '', 
                location_name: '',
                location_shortname: ''
            },
            selected_branch: null,
            options_branch: []

        }
    },
    watch: {

    },
    methods: {
        getBranch: function () {
           var scope = this
            scope.GET('company/branch').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_branch.push({
                        id: data.uuid,
                        text: data.branch_name
                    })
                
                })

                $(".form-select-branch").select2({data: scope.options_branch});
                
                scope.selected_branch = scope.options_branch[0].id
            })

        },
        getBranchLocations: function () {
           var scope = this
            scope.GET('company/branch-location').then(res => {
                scope.branchLocations = res.rows
            })
        },

        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.branch_uuid = ''
            scope.formdata.account_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.location_name = data.location_name
            scope.formdata.location_shortname = data.location_shortname

            $('.form-select-branch').val(data.branch_uuid);
            $('.form-select-branch').trigger('change');
        },
        save: function () {
            var scope = this
            scope.formdata.branch_uuid = scope.selected_branch

            scope.POST('company/branch-location', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Branch Location Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getBranchLocations()
                        scope.CLOSE_MODAL('#modalBranchLocation')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.formdata.branch_uuid = scope.selected_branch

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
                    scope.POST('company/branch-location', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Branch Location Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getBranchLocations()
                                scope.CLOSE_MODAL('#modalBranchLocation')
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
                    scope.POST('company/branch-location/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Branch Location Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getBranchLocations()
                            scope.CLOSE_MODAL('#modalBranchLocation')
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
        scope.getBranch()
        scope.getBranchLocations()
         
        $('.form-select-branch').on("change", function(e) { 
            scope.selected_branch = $('.form-select-branch').val();
        })
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>