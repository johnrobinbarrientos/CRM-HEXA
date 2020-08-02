<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Address">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalAddressList');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Address</span>
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
                                            <th><span class="">Barangay</span></th>
                                            <th><span class="">City/Municipality</span></th>
                                            <th><span class="">Province</span></th>
                                            <th><span class="">Region</span></th>
                                            <th><span class="">Country</span></th>
                                            <th><span class="">Postal/Zip Code</span></th>
                                            <th><span class="">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(address, index) in addressList" :key="address.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ address.barangay }}</span></td>
                                            <td><span class="">{{ address.city_municipality }}</span></td>
                                            <td><span class="">{{ address.province }}</span></td>
                                            <td><span class="">{{ address.region }}</span></td>
                                            <td><span class="">{{ address.country }}</span></td>
                                            <td><span class="">{{ address.postal_code }}</span></td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalAddressList');setData(address)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(address)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
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