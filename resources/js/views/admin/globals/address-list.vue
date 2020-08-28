<template>
    <div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">Address List</div>
                <div class="mb-3 card-subtitle">
                    Below are the list of active address list.
                </div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" placeholder="Search Item">
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalAddressList');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New Address</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>#</th>
                                <th>Barangay</th>
                                <th>City/Municipality</th>
                                <th>Province</th>
                                <th>Region</th>
                                <th>Country</th>
                                <th>Postal/Zip Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(address, index) in addressList" :key="address.uuid" class="tb-tnx-item">
                                <td>
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalAddressList');setData(address)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(address)" class="btn btn-sm btn-danger"><i  class="bx bx-trash"></i></a>
                                </td>
                                <td>{{ (index + 1) }}</td>
                                <td>{{ address.barangay }}</td>
                                <td>{{ address.city_municipality }}</td>
                                <td>{{ address.province }}</td>
                                <td>{{ address.region }}</td>
                                <td>{{ address.country }}</td>
                                <td>{{ address.postal_code }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
      
        
        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalAddressList">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Address Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalAddressList');" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="address-list">Barangay</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.barangay" type="text" class="form-control" id="barangay" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="address-list">City/Municipality</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.city_municipality" type="text" class="form-control" id="city" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="address-list">Province</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.province" type="text" class="form-control" id="province" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="address-list">Region</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.region" type="text" class="form-control" id="region" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="address-list">Country</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.country" type="text" class="form-control" id="country" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="address-list">Postal/Zip Code</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.postal_code" type="text" class="form-control" id="postal" required>
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
    name: 'address-list',
    props: ['properties'],
    data: function () {
        return {
            addressList: [],
            formdata: { 
                uuid: null, 
                barangay: '',
                city_municipality: '',
                province: '',
                region: '',
                country: '',
                postal_code: ''
            }
        }
    },
    methods: {
        getAddressList: function () {
           var scope = this
            scope.GET('globals/address-list').then(res => {
                scope.addressList = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.barangay = ''
            scope.formdata.city_municipality = ''
            scope.formdata.province = ''
            scope.formdata.region = ''
            scope.formdata.country = ''
            scope.formdata.postal_code = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.barangay = data.barangay
            scope.formdata.city_municipality = data.city_municipality
            scope.formdata.province = data.province
            scope.formdata.region = data.region
            scope.formdata.country = data.country
            scope.formdata.postal_code = data.postal_code
        },
        save: function () {
            var scope = this
            scope.POST('globals/address-list', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Address Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getAddressList()
                        scope.CLOSE_MODAL('#modalAddressList')
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
                    scope.POST('globals/address-list', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Address Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getAddressList()
                                scope.CLOSE_MODAL('#modalAddressList')
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
                    scope.POST('globals/address-list/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Address Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getAddressList()
                            scope.CLOSE_MODAL('#modalAddressList')
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
        scope.getAddressList()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>