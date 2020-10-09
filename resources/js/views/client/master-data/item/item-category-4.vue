<template>
    <div id="accordion">
        <div class="card shadow-none">
            <a href="#collapseFour" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="headingFour">
                <div class="card-header" id="headingFour">
                    <h5 class="m-0">Category 4</h5>
                </div>
            </a>

            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion" style="">
                <div class="card-body">

                    <div class="container-fluid">
                        <div class="d-none d-lg-flex justify-content-between" style="margin-bottom: 20px;">
                            <div>
                                <em class="icon ni ni-search"></em>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Category 1">
                            </div>
                            <div>
                                <a href="javascript:void(0)" @click="OPEN_MODAL('#modalCategory4');resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                                    <i class="las la-plus"></i> <span>New Item Category 4</span>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th><span class="">Actions</span></th>
                                        <th><span class="">#</span></th>
                                        <th><span class="">Item Category 4</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(category, index) in categories" :key="category.uuid" class="tb-tnx-item">
                                        <td width="100">
                                            <span class="w-65px d-block mx-auto">
                                                <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCategory4');setData(category)" class="btn btn-sm btn-light"><i class="mdi mdi-pencil"></i></em></a>
                                                <a href="javascript:void(0)"  @click="remove(category)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                            </span>
                                        </td>
                                        <td width="100"><span class="">{{ (index + 1) }}</span></td>
                                        <td><span class="">{{ category.category4 }}</span></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            


                        <!-- Modal Category1 Form -->
                        <div class="modal fade" tabindex="-1" id="modalCategory4">
                            <div class="modal-dialog modal-lg " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Category 4 Details</h5>
                                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalCategory4');" class="close" data-dismiss="modal" aria-label="Close">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" class="form-validate is-alter">

                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="category4">Category 4</label>
                                                        <div class="form-control-wrap">
                                                            <input v-model="formdata.category4" type="text" class="form-control" id="category4" required>
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
            </div>

        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'category4',
    props: ['properties'],
    data: function () {
        return {
            categories: [],
            formdata: { 
                uuid: null, 
                category4: ''
            }
        }
    },
    methods: {
        getCategory4: function () {
           var scope = this
            scope.GET('items/category4').then(res => {
                scope.categories = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.category4 = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.category4 = data.category4
        },
        save: function () {
            var scope = this
            scope.POST('items/category4', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Category Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getCategory4()
                        scope.CLOSE_MODAL('#modalCategory4')
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
                    scope.POST('items/category4', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Category Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getCategory4()
                                scope.CLOSE_MODAL('#modalCategory4')
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
                    scope.POST('items/category4/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Category Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCategory4()
                            scope.CLOSE_MODAL('#modalCategory4')
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
        scope.getCategory4()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>