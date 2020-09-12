<template>
    <div>


        <div class="card">
            <div class="card-body">
                <div class="card-title">Customer Channel</div>
                <div class="mb-3 card-subtitle">
                    Below are the list of active customer channel.
                </div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalCustomerChannel');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th width="100">Actions</th>
                                <th>#</th>
                                <th>Channel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(channel, index) in customerChannels" :key="channel.uuid">
                                <td>
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCustomerChannel');setData(channel)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(channel)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                                <td>{{ (index + 1) }}</td>
                                <td>{{ channel.channel }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalCustomerChannel">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Channel Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalCustomerChannel');" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="channel">Channel</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.channel" type="text" class="form-control" id="channel" required>
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
    name: 'customer-channel',
    props: ['properties'],
    data: function () {
        return {
            customerChannels: [],
            formdata: { 
                uuid: null, 
                channel: ''
            }
        }
    },
    methods: {
        getCustomerChannels: function () {
           var scope = this
            scope.GET('globals/customer-channel').then(res => {
                scope.customerChannels = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.channel = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.channel = data.channel
        },
        save: function () {
            var scope = this
            scope.POST('globals/customer-channel', scope.formdata).then(res => {
            if (res.success) {
                window.swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Channel Successfuly Saved',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    scope.getCustomerChannels()
                    scope.CLOSE_MODAL('#modalCustomerChannel')
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
                    scope.POST('globals/customer-channel', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Channel Successfuly Updated',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.getCustomerChannels()
                            scope.CLOSE_MODAL('#modalCustomerChannel')
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
                    scope.POST('globals/customer-channel/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Channel Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getCustomerChannels()
                            scope.CLOSE_MODAL('#modalCustomerChannel')
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
        scope.getCustomerChannels()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>