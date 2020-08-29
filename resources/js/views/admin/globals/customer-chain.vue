<template>
    <div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">Customer Chain</div>
                <div class="mb-3 card-subtitle">
                    Below are the list of active custom chain.
                </div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" placeholder="Search Item">
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalCustomerChain');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New Customer Chain</span>
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
                                <th>Chain</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(chain, index) in customerChains" :key="chain.uuid" class="tb-tnx-item">
                                <td>
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCustomerChain');setData(chain)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(chain)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                                <td><span class="">{{ (index + 1) }}</span></td>
                                <td><span class="">{{ chain.chain }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalCustomerChain">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chain Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalCustomerChain');" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="chain">Chain</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.chain" type="text" class="form-control" id="chain" required>
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
    name: 'customer-chain',
    props: ['properties'],
    data: function () {
        return {
            customerChains: [],
            formdata: { 
                uuid: null, 
                chain: ''
            }
        }
    },
    methods: {
        getCustomerChains: function () {
           var scope = this
            scope.GET('globals/customer-chain').then(res => {
                scope.customerChains = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.chain = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.chain = data.chain
        },
        save: function () {
            var scope = this
            scope.POST('globals/customer-chain', scope.formdata).then(res => {
            if (res.success) {
                window.swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Chain Successfuly Saved',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    scope.getCustomerChains()
                    scope.CLOSE_MODAL('#modalCustomerChain')
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
                    scope.POST('globals/customer-chain', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Chain Successfuly Updated',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.getCustomerChains()
                            scope.CLOSE_MODAL('#modalCustomerChain')
                        })
                    } else {
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
                    scope.POST('globals/customer-chain/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Chain Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCustomerChains()
                            scope.CLOSE_MODAL('#modalCustomerChain')
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
        scope.getCustomerChains()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>