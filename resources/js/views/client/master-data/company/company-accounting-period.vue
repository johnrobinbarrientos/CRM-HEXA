<template>
    <div>
        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-list-ul"></i>Accounting Period</h1>
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
                <a href="javascript:void(0)" @click="OPEN_MODAL('#modalAccountingPeriod');resetData()" class="btn btn-primary" data-toggle="modal">
                    <em class="icon ni ni-plus"></em> <span>New</span>
                </a>
            </div>
        </div>
                      

        <div v-if="listLoading" class="text-center my-3 text-loader">
            <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
        </div>

        <div v-else class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Year</th>
                        <th>JAN</th>
                        <th>FEB</th>
                        <th>MAR</th>
                        <th>APR</th>
                        <th>MAY</th>
                        <th>JUN</th>
                        <th>JUL</th>
                        <th>AUG</th>
                        <th>SEP</th>
                        <th>OCT</th>
                        <th>NOV</th>
                        <th>DEC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(period, index) in accountingPeriod" :key="period.uuid">

                            <td width="100">
                                <span class="w-65px d-block mx-auto">
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalAccountingPeriod');setData(period)" class="btn btn-sm btn-shineblue" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(period)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can" title="Trash"></i></a>
                                </span>
                            </td>

                            <td>{{ (index + 1) }}</td>
                            <td>{{ period.year_name}}</td>
                            <td v-if="period.jan_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.feb_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.mar_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.apr_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.may_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.jun_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.jul_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.aug_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.sep_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.oct_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.nov_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>
                            <td v-if="period.dec_is_open === 1">OPEN</td>
                            <td v-else>CLOSED</td>

                    </tr>
                </tbody>
            </table>
        </div>
                    


        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalAccountingPeriod">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Period Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalAccountingPeriod');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="date-terminated">Period</label>
                                        <div class="form-control-wrap">
                                            <date-picker v-model="formdata.year_name" :config="{format: 'YYYY'}"></date-picker>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.jan_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-jan">
                                                <label class="custom-control-label" for="is-open-jan">Jan</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.feb_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-feb">
                                                <label class="custom-control-label" for="is-open-feb">Feb</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.mar_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-mar">
                                                <label class="custom-control-label" for="is-open-mar">Mar</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.apr_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-apr">
                                                <label class="custom-control-label" for="is-open-apr">Apr</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.may_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-may">
                                                <label class="custom-control-label" for="is-open-may">May</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.jun_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-jun">
                                                <label class="custom-control-label" for="is-open-jun">Jun</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.jul_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-jul">
                                                <label class="custom-control-label" for="is-open-jul">Jul</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.aug_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-aug">
                                                <label class="custom-control-label" for="is-open-aug">Aug</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.sep_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-sep">
                                                <label class="custom-control-label" for="is-open-sep">Sep</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.oct_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-oct">
                                                <label class="custom-control-label" for="is-open-oct">Oct</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.nov_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-nov">
                                                <label class="custom-control-label" for="is-open-nov">Nov</label>
                                            </div>
                                        </div>

                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.dec_is_open" true-value="1" false-value="0" class="custom-control-input" id="is-open-dec">
                                                <label class="custom-control-label" for="is-open-dec">Dec</label>
                                            </div>
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
import moment from 'moment'

export default {
    name: 'accounting-period',
    props: ['properties'],
    data: function () {
        return {
            accountingPeriod: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,
            formdata: { 
                uuid: null, 
                year_name: moment().set('year', Date()),
                jan_is_open: 1,
                feb_is_open: 1,
                mar_is_open: 1,
                apr_is_open: 1,
                may_is_open: 1,
                jun_is_open: 1,
                jul_is_open: 1,
                aug_is_open: 1,
                sep_is_open: 1,
                oct_is_open: 1,
                nov_is_open: 1,
                dec_is_open: 1
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
        getAccountingPeriod: function () {
            var scope = this

            scope.listLoading = true
            scope.accountingPeriod = []
            scope.GET('company/account-period?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.accountingPeriod = res.rows
                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.year_name = moment().set('year', Date())
            scope.formdata.jan_is_open = 1
            scope.formdata.feb_is_open = 1
            scope.formdata.mar_is_open = 1
            scope.formdata.apr_is_open = 1
            scope.formdata.may_is_open = 1
            scope.formdata.jun_is_open = 1
            scope.formdata.jul_is_open = 1
            scope.formdata.aug_is_open = 1
            scope.formdata.sep_is_open = 1
            scope.formdata.oct_is_open = 1
            scope.formdata.nov_is_open = 1
            scope.formdata.dec_is_open = 1
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
             scope.formdata.year_name = moment().set('year', data.year_name)
            scope.formdata.jan_is_open = data.jan_is_open
            scope.formdata.feb_is_open = data.feb_is_open
            scope.formdata.mar_is_open = data.mar_is_open
            scope.formdata.apr_is_open = data.apr_is_open
            scope.formdata.may_is_open = data.may_is_open
            scope.formdata.jun_is_open = data.jun_is_open
            scope.formdata.jul_is_open = data.jul_is_open
            scope.formdata.aug_is_open = data.aug_is_open
            scope.formdata.sep_is_open = data.sep_is_open
            scope.formdata.oct_is_open = data.oct_is_open
            scope.formdata.nov_is_open = data.nov_is_open
            scope.formdata.dec_is_open = data.dec_is_open
        },
        save: function () {
            var scope = this
            scope.POST('company/account-period', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Accounting Period Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getAccountingPeriod()
                        scope.CLOSE_MODAL('#modalAccountingPeriod')
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
                    scope.POST('company/account-period', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Accounting Period Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getAccountingPeriod()
                                scope.CLOSE_MODAL('#modalAccountingPeriod')
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
                scope.getAccountingPeriod()
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

            scope.getAccountingPeriod()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getAccountingPeriod()
        }
    },
    mounted() {
        var scope = this
        scope.getAccountingPeriod()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>