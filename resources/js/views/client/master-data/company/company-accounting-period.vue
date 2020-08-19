<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Period">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalAccountingPeriod');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Period</span>
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
                                            <th><span class="">Year</span></th>
                                            <th><span class="">JAN</span></th>
                                            <th><span class="">FEB</span></th>
                                            <th><span class="">MAR</span></th>
                                            <th><span class="">APR</span></th>
                                            <th><span class="">MAY</span></th>
                                            <th><span class="">JUN</span></th>
                                            <th><span class="">JUL</span></th>
                                            <th><span class="">AUG</span></th>
                                            <th><span class="">SEP</span></th>
                                            <th><span class="">OCT</span></th>
                                            <th><span class="">NOV</span></th>
                                            <th><span class="">DEC</span></th>
                                            <th><span class="">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                                <td><span class="">{{ (index + 1) }}</span></td>
                                                <td><span class="">{{ period.year_name}}</span></td>
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
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalAccountingPeriod');setData(period)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(period)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    


                    <!-- Modal Group Form -->
                    <div class="modal fade" tabindex="-1" id="modalAccountingPeriod">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Period Details</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalAccountingPeriod');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
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
import moment from 'moment'

export default {
    name: 'accounting-period',
    props: ['properties'],
    data: function () {
        return {
            accountingPeriod: [],
            formdata: { 
                uuid: null, 
                year_name: moment("2025", "yyyy"),
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
    methods: {
        getAccountingPeriod: function () {
           var scope = this
            scope.GET('company/account-period').then(res => {
                scope.accountingPeriod = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.year_name = ''
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
        // remove: function (data) {
        //     var scope = this

        //     window.swal.fire({
        //         title: 'Are you sure?',
        //         text: 'You won\'t be able to revert this',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!',
        //         cancelButtonText: 'Cancel'
        //     }).then((result) => {
        //         if (result.value) {
        //             scope.POST('company/cost-center/delete', data).then(res => {
        //                 if (res.success) {
        //                     window.swal.fire({
        //                         position: 'center',
        //                         icon: 'success',
        //                         title: 'Cost Center Deleted',
        //                         showConfirmButton: false,
        //                         timer: 1500
        //                     }).then(() => {
        //                     scope.getAccountingPeriod()
        //                     scope.CLOSE_MODAL('#modalAccountingPeriod')
        //                     })
        //                 }
        //                 else{
        //                     alert('ERROR:' + res.code)
        //                 }
        //             })            
        //         }                              
        //     })
        // }
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