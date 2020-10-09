<template>
    <div>

        <div style="margin-top:10px; margin-bottom:10px;">
            <div class="row">
                <div class="col-12 col-md-3">
                    <input type="text" class="form-control" placeholder="Search Item">
                </div>
                <div class="col-12 col-md-2 offset-md-7">
                    <a href="javascript:void(0)" @click="OPEN_MODAL('#modalItemDiscountGroup');resetData()" class="btn btn-block btn-primary" data-toggle="modal">
                        <em class="icon ni ni-plus"></em> <span>New Item Discount Group</span>
                    </a>
                </div>
            </div>
        </div>

         <table class="table table-striped table-bordered">
                <thead>
                    <tr class="tb-tnx-head">
                        <th width="100">Actions</th>
                        <th width="100">#</th>
                        <th>Group Name</th>
                        <th>Group Rate</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(discount_group, index) in discountGroups" :key="discount_group.uuid" class="tb-tnx-item">
                        <td>
                            <span class="">
                                <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalItemDiscountGroup');setData(discount_group)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                <a href="javascript:void(0)"  @click="remove(discount_group)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                            </span>
                        </td>
                        <td><span class="">{{ (index + 1) }}</span></td>
                        <td><span class="">{{ discount_group.group_name }}</span></td>
                        <td><span class="">{{ discount_group.group_rate }}</span></td>
                        
                    </tr>
                </tbody>
            </table>
 

        <!-- Modal Discount Group Form -->
        <div class="modal fade" tabindex="-1" id="modalItemDiscountGroup">
            <div class="modal-dialog modal-md " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Item Discount Group Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalItemDiscountGroup');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="discount-group-name">Group Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.group_name" type="text" class="form-control" id="discount-group-name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="discount-group-rate">Group Rate</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.group_rate" type="text" class="form-control" id="discount-group-rate" required>
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
    name: 'item-discount-group',
    props: ['properties'],
    data: function () {
        return {
            discountGroups: [],
            formdata: { 
                uuid: null, 
                group_name: '',
                group_rate: ''
            }
        }
    },
    methods: {
        getItemDiscountGroup: function () {
           var scope = this
            scope.GET('items/item-discount-group').then(res => {
                scope.discountGroups = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.group_name = ''
            scope.formdata.group_rate = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.group_name = data.group_name
            scope.formdata.group_rate = data.group_rate
        },
        save: function () {
            var scope = this
            scope.POST('items/item-discount-group', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Discount Group Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getItemDiscountGroup()
                        scope.CLOSE_MODAL('#modalItemDiscountGroup')
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
                    scope.POST('items/item-discount-group', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Discount Group Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getItemDiscountGroup()
                                scope.CLOSE_MODAL('#modalItemDiscountGroup')
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
                    scope.POST('items/item-discount-group/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Discount Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getItemDiscountGroup()
                            scope.CLOSE_MODAL('#modalItemDiscountGroup')
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
        scope.getItemDiscountGroup()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>