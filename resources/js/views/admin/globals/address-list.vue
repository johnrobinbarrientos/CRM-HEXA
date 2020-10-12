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
                            <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                            <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                                <option value="1">1</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalAddressList');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div v-if="listLoading" class="text-center my-3 text-loader">
                    <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
                </div>

                <div class="table-responsive">
                    <table class="table mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th width="100">Actions</th>
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

                    <nav v-if="listTotalPages > 1" class="pagination pagination-rounded justify-content-center mt-4" aria-label="pagination">
                        <ul class="pagination">
                            <li @click="listPaginate('prev')"  v-bind:class="{'disabled' : listCurrentPage <= 1}"  class="page-item" >
                                <a href="javascript:void(0)" class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">‹</span><span class="sr-only">Previous</span>
                                </a>
                            </li>

                            
                            <li @click="listPaginate(page)" v-for="page in listTotalPages" :key="page" class="page-item" v-bind:class="{'active' : page === listCurrentPage}">
                                <a href="javascript:void(0)" class="page-link">
                                    {{ page }}
                                </a>
                            </li>
                            
                            <li @click="listPaginate('next')" v-bind:class="{'disabled' : listCurrentPage >= listTotalPages}" class="page-item">
                                <a href="javascript:void(0)" class="page-link" aria-label="Next"><span aria-hidden="true">›</span><span class="sr-only">Next</span></a>
                            </li>
                        </ul>
                    </nav>

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
                            <i class="bx bx-x"></i>
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
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
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
    computed: {
        listTotalPages: function () {
            var scope = this
            var pages = Math.ceil(scope.listCount / scope.listItemPerPage)
            return pages
        }
    },
    methods: {
        getAddressList: function () {
            var scope = this

            scope.listLoading = true
            scope.addressList = []
            scope.GET('globals/address-list?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.addressList = res.rows
                scope.listLoading = false
                scope.listCount = res.count
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
        },
        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getAddressList()
            }, 800);
        },
        listPaginate: function(page) {
            var scope = this
        
            if (page === 'prev') {
                scope.listCurrentPage = scope.listCurrentPage - 1
            } else if (page === 'next') {
                scope.listCurrentPage = scope.listCurrentPage + 1
            } else {
                scope.listCurrentPage = page
            }

            if (scope.listCurrentPage < 1) {
                scope.listCurrentPage = 1
                return
            } else  if (scope.listCurrentPage > scope.listTotalPages) {
                scope.listCurrentPage =  scope.listTotalPages
                return
            }

            scope.getAddressList()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getAddressList()
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