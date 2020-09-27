<template>
    <div>

        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-stream"></i> Asset Group</h1>
            </div>
            <div class="bar-right">
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Item Asset Group"> 
                <a href="javascript:void(0)" @click="OPEN_MODAL('#modalItemAssetGroup');resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                    <i class="las la-plus"></i> <span>New Asset Group</span>
                </a>
            </div>
        </div>

         <table class="table table-striped table-bordered responsiveTable">
                <thead>
                    <tr class="tb-tnx-head">
                        <th width="100">#</th>
                        <th>Item Asset Group</th>
                        <th width="100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(asset, index) in assetGroups" :key="asset.uuid" class="tb-tnx-item">
                        <td><span class="">{{ (index + 1) }}</span></td>
                        <td><span class="">{{ asset.asset_group }}</span></td>
                        <td>
                            <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalItemAssetGroup');setData(asset)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                            <a href="javascript:void(0)"  @click="remove(asset)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
 

        <!-- Modal Asset Group Form -->
        <div class="modal fade" tabindex="-1" id="modalItemAssetGroup">
            <div class="modal-dialog modal-md " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Asset Group Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalItemAssetGroup');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="asset-group">Asset Group</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.asset_group" type="text" class="form-control" id="asset-group" required>
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
    name: 'asset-group',
    props: ['properties'],
    data: function () {
        return {
            assetGroups: [],
            formdata: { 
                uuid: null, 
                asset_group: ''
            }
        }
    },
    methods: {
        getAssetGroup: function () {
           var scope = this
            scope.GET('items/item-asset-group').then(res => {
                scope.assetGroups = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.asset_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.asset_group = data.asset_group
        },
        save: function () {
            var scope = this
            scope.POST('items/item-asset-group', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Asset Group Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getAssetGroup()
                        scope.CLOSE_MODAL('#modalItemAssetGroup')
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
                    scope.POST('items/item-asset-group', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Asset Group Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getAssetGroup()
                                scope.CLOSE_MODAL('#modalItemAssetGroup')
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
                    scope.POST('items/item-asset-group/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Asset Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getAssetGroup()
                            scope.CLOSE_MODAL('#modalItemAssetGroup')
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
        scope.getAssetGroup()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>