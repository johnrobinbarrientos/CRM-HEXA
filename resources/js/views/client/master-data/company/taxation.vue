<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title">
                    <i class="las la-list-ul"></i>
                    <span>Taxation Table</span>
                </h1>
            </div>
            <div class="bar-right">
                <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <a href="javascript:void(0)" @click="OPEN_MODAL('#modalTaxation');resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>
        

        <div v-if="listLoading" class="text-center my-3 text-loader">
            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="105">Action</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(tax) in Taxations" :key="tax.uuid">
                                <td width="100">
                                    <span class="hx-table-actions">
                                        <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="OPEN_MODAL('#modalTaxation');setData(tax)">
                                            <b-dropdown-item href="javascript:void(0)" @click="OPEN_MODAL('#modalTaxation');setData(tax)">Edit</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="remove(tax)">Delete</b-dropdown-item>
                                        </b-dropdown>
                                    </span>
                                </td>
                                <td>{{ tax.tax_type }}</td>
                                <td>{{ tax.tax_name }}</td>
                                <td>{{ tax.tax_rate }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 

            <div style="padding:10px; padding-top:20px; padding-bottom:0px;"> Showing {{ listOffset + 1  }} to {{ listOffset +  listResults }} of  {{ listCount }} entries</div>
            <nav v-if="listTotalPages > 1" class="pagination pagination-rounded justify-content-center mt-4" aria-label="pagination">
                <ul class="pagination">
                    <li @click="listPaginate('prev')"  v-bind:class="{'disabled' : listCurrentPage <= 1}"  class="page-item" >
                        <a href="javascript:void(0)" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">???</span><span class="sr-only">Previous</span>
                        </a>
                    </li>

                    
                    <li @click="listPaginate(page)" v-for="page in listTotalPages" :key="page" class="page-item" v-bind:class="{'active' : page === listCurrentPage}">
                        <a href="javascript:void(0)" class="page-link">
                            {{ page }}
                        </a>
                    </li>
                    
                    <li @click="listPaginate('next')" v-bind:class="{'disabled' : listCurrentPage >= listTotalPages}" class="page-item">
                        <a href="javascript:void(0)" class="page-link" aria-label="Next"><span aria-hidden="true">???</span><span class="sr-only">Next</span></a>
                    </li>
                </ul>
            </nav>
                    


        <!-- Modal Group Form -->
        <div class="modal fade modal-single-form" tabindex="-1" id="modalTaxation">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Taxation</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalTaxation');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tax-type">Type:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.tax_type" type="text" class="form-control" id="tax-type" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tax-name">Name:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.tax_name" type="text" class="form-control" id="tax-name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tax-rate">Rate:</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.tax_rate" type="text" class="form-control" id="tax-rate" required>
                                        </div>
                                    </div>
                                </div>

                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="formdata.uuid === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                        <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'taxations',
    props: ['properties'],
    data: function () {
        return {
            Taxations: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            listOffset: 0,
            listResults: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null, 
                tax_type: '',
                tax_name: '',
                tax_rate: '',
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
        getTaxation: function () {
            var scope = this
            scope.listLoading = true
            scope.Taxations = []
            scope.GET('company/taxation?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.Taxations = res.rows
                scope.listLoading = false
                scope.listCount = res.count

                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.tax_type = ''
            scope.formdata.tax_name = ''
            scope.formdata.tax_rate = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.tax_type = data.tax_type
            scope.formdata.tax_name = data.tax_name
            scope.formdata.tax_rate = data.tax_rate
        },
        save: function () {
            var scope = this
            scope.POST('company/taxation', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getTaxation()
                        scope.CLOSE_MODAL('#modalTaxation')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            window.swal.fire({
                title: 'Update?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('company/taxation', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getTaxation()
                                scope.CLOSE_MODAL('#modalTaxation')
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
                title: 'Delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('company/taxation/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getTaxation()
                            scope.CLOSE_MODAL('#modalTaxation')
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
                scope.getTaxation()
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

            scope.getTaxation()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getTaxation()
        }
    },
    mounted() {
        var scope = this
        scope.getTaxation()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>