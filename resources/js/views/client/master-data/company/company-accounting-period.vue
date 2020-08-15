<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="date-terminated">Period</label>
                            <div class="form-control-wrap">
                                <date-picker v-model="formdata.year_name" :config="{format: 'YYYY'}"></date-picker>
                            </div>
                        </div>
                    </div>
                    <button @click="save()" type="submit" class="btn btn-lg btn-primary">Add</button>
            </div>
            <!-- <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalTaxation');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>Accounting Period</span>
                        </a>
                    </li>
                </ul>
            </div> -->


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
                                            <th><span class="">Month</span></th>
                                            <th><span class="">Is Open</span></th>
                                            <th><span class="">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(period) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                                <td><span class="">{{ (index + 1) }}</span></td>
                                                <td><span class="">{{ period.year_name + 1}}</span></td>
                                                <td><span class="">JAN</span></td>
                                                <td v-if="period.jan_is_open === 1">Yes</td>
                                                <td v-else>No</td>
                                                <td>
                                                    <span class="">
                                                        <a href="javascript:void(0)"  @click="update(period)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    </span>
                                                </td>
                                        </tr>

                                         <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">FEB</span></td>
                                            <td v-if="period.feb_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="update(period)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <!--<tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">MAR</span></td>
                                            <td v-if="period.mar_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">APR</span></td>
                                            <td v-if="period.apr_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">MAY</span></td>
                                            <td v-if="period.may_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">JUN</span></td>
                                            <td v-if="period.jun_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">JUL</span></td>
                                            <td v-if="period.jul_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">AUG</span></td>
                                            <td v-if="period.aug_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">SEP</span></td>
                                            <td v-if="period.sep_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">OCT</span></td>
                                            <td v-if="period.oct_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">NOV</span></td>
                                            <td v-if="period.nov_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr v-for="(period, index) in accountingPeriod" :key="period.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ period.year_name }}</span></td>
                                            <td><span class="">DEC</span></td>
                                            <td v-if="period.dec_is_open === 1">Yes</td>
                                            <td v-else>No</td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalTaxation');setData(tax)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(tax)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr> -->

                                    </tbody>
                                </table>
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
    name: 'taxations',
    props: ['properties'],
    data: function () {
        return {
            accountingPeriod: [],
            formdata: { 
                uuid: null, 
                year_name: '',
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
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        // update: function () {
        //     var scope = this
        //     window.swal.fire({
        //         title: 'Update Record?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, Update it!',
        //         cancelButtonText: 'Cancel'
        //     }).then((result) => {
        //         if (result.value) {
        //             scope.POST('company/taxation', scope.formdata).then(res => {
        //                 if (res.success) {
        //                     window.swal.fire({
        //                         position: 'center',
        //                         icon: 'success',
        //                         title: 'Taxation Updated',
        //                         showConfirmButton: false,
        //                         timer: 1500
        //                     }).then(() => {
        //                         scope.getTaxation()
        //                         scope.CLOSE_MODAL('#modalTaxation')
        //                     })
        //                 }
        //                 else{
        //                     alert('ERROR:' + res.code)
        //                 }
        //             })            
        //         }                              
        //     })
        // },
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